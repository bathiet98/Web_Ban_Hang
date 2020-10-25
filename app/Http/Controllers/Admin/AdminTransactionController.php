<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TransactionExport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminTransactionController extends Controller
{
    public function index(Request $request)
    {
        //Tổng hđơn hàng
        $totalTransactions = \DB::table('transactions')->select('id')->count();

        $transactions = Transaction::whereRaw(1);

        if ($request->id) $transactions->where('id',$request->id);

        if ($email = $request->email) $transactions->where('tst_email', 'like', '%'.$email.'%')->get();

        if ($type = $request->type)
        {
            if ($type == 1)
            {
                $transactions->where('tst_user_id', '<>',0);
            }else
                $transactions->where('tst_user_id',0);
        }

        if ($status = $request->status)
        {
            $transactions->where('tst_status',$status);
        }


        $transactions = $transactions->orderByDesc('id')
            ->paginate(12);

        if ($request->export)
        {
            return \Excel::download(new TransactionExport($transactions), 'don-hang.xlsx');
        }
        $viewData = [
            'transactions'          =>  $transactions,
            'query'                 =>  $request->query(),
            'totalTransactions'    => $totalTransactions
        ];
        return view('admin.transaction.index',$viewData);
    }

    // ajax phần hiển thị chi tiết đơn hàng
    public function getTransactionDetail(Request $request,$id)
    {
        if ($request->ajax()){
            $orders = Order::where('od_transaction_id', $id)
                ->get();
            $html = view('components.order',compact('orders'))->render();

            return response([
                'html'=>$html
            ]);
        };
    }

    public function deleteOrderItem(Request $request, $id)
    {
        if ($request->ajax()){
            $order = Order::find($id);
            if ($order)
            {
                $money = $order->od_qty * $order->od_price;
                \DB::table('transactions')->where('id',$order->od_transaction_id)
                    ->decrement('tst_total_money',$money);
                $order ->delete();
            }
            return response(['code' => 200]);
        }
    }

    public function delete($id)
    {
        $transaction = Transaction::find($id);
        if ($transaction)
        {
            $transaction->delete();
            \DB::table('orders')->where('od_transaction_id',$id)->delete();
        }
        return redirect()->back();
    }

    public function getTransactionAction($action,$id)
    {
        $transaction = Transaction::find($id);
        if ($transaction)
        {
            switch ($action) {
                case 'process':
                    $transaction->tst_status = 2;
                    break;

                case 'success':
                    $transaction->tst_status = 3;
                    break;

                case 'cancel':
                    $transaction->tst_status = -1;
                    break;
            }
            $transaction->save();

        }
        return redirect()->back();
    }
}
