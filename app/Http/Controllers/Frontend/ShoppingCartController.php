<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\TransactionSuccess;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ShoppingCartController extends FrontendController
{

    // danh sách sp trong giỏ hàng
    public function index()
    {
        $shopping = \Cart::content();
        $viewData = [
            'title_page'    => 'Danh sách giỏ hàng',
            'shopping'      =>  $shopping
        ];

        return view('frontend.pages.shopping.index', $viewData);
    }

    // Thêm sp vào giỏ hàng
    public function add($id)
    {
        $product = Product::find($id);

        //1. Kiểm tra tồn tại sản phẩm
        if (!$product) return redirect()->to('/');

        // 2. Kiểm tra số lượng sản phẩm
        if ($product->pro_number < 1) {
            \Session::flash('toastr', [
                'type'    => 'error',
                'message' => 'Số lượng sản phẩm không đủ'
            ]);

            return redirect()->back();
        }

        // 3. Thêm sản phẩm vào giỏ hàng
        \Cart::add(['id' => $product->id,
            'name'      => $product->pro_name,
            'qty'       => 1,
            'price'     => number_price($product->pro_price,$product->pro_sale),
            'weight'    => 1,
            'options'   => [
                'sale'  => $product->pro_sale,
                'price_old' => $product->pro_price,
                'image' => $product->pro_avatar
            ]
        ]);
        //4. Thông báo
        \Session::flash('toastr',[
            'type'       => 'success',
            'message'   => 'Sản Phẩm Đã Được Thêm Vào Giỏ Hàng'
        ]);

//        $shopping = \Cart::content();
//        $viewData = [
//            'title_page'    => 'Danh sách giỏ hàng',
//            'shopping'      =>  $shopping
//        ];

        return redirect()->route('get.shopping.list');
    }


    //Lưu đơn hàng và chi tiết đơn hàng vào trong database
    public function postPay(Request $request)
    {
        $data = $request->except('_token');
        if (isset(\Auth::user()->id))
        {
            $data['tst_user_id'] = \Auth::user()->id;
        }

        $data['tst_total_money']    =  str_replace(',','',\Cart::subtotal(0));
        $data['created_at']          = Carbon::now();
        $transactionID              = Transaction::insertGetId($data);


        if ($transactionID) {
            $shopping = \Cart::content();
            //Mail::to($request->tst_email)->send(new TransactionSuccess($shopping));
            foreach ($shopping as $key => $item)
            {
                \Session::flash('toastr',[
                    'type'       => 'success',
                    'message'   => 'Bạn Đặt Hàng Thành Công'
                ]);
                //lưu chi tiết đơn hàng
                Order::insert([
                    'od_transaction_id' => $transactionID,
                    'od_product_id'     => $item->id,
                    'od_sale'           => $item->options->sale,
                    'od_qty'            => $item->qty,
                    'od_price'          => $item->price
                ]);

                //Tăng pay (số lượt mua của sản phẩm đó)
                \DB::table('products')
                    ->where('id', $item->id)
                    ->increment('pro_pay');
            }
        }
        \Cart::destroy();

        return redirect()->route('get.pay.success');
    }

    //update giỏ hàng
    public function update(Request $request, $id)
    {
        if ($request->ajax()) {

            //1.Lấy tham số
            $qty       = $request->qty ?? 1;
            $idProduct = $request->idProduct;
            $product   = Product::find($idProduct);

            //2. Kiểm tra tồn tại sản phẩm
            if (!$product) return response(['messages' => 'Không tồn tại sản sản phẩm cần update']);

            //3. Kiểm tra số lượng sản phẩm còn ko
;            if ($product->pro_number < $qty) {
                return response([
                    'messages' => 'Số lượng cập nhật không đủ',
                    'error'    => true
                ]);
            }

            //4. Update
            \Cart::update($id, $qty);

            return response([
                'messages'   => 'Cập nhật thành công',
//                'totalMoney' => \Cart::subtotal(0),
//                'totalItem'  => number_format(number_price($product->pro_price, $product->pro_sale) * $qty, 0, ',', '.')
            ]);
        }
    }

    // Xóa sản phẩm đơn hàng
    public function delete($id)
    {
        \Cart::remove($id);
        return redirect()->back();
    }
}
