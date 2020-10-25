<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProcessViewService;
use Illuminate\Http\Request;

class ProductDetailController extends FrontendController
{
    public function getProductDetail(Request $request, $slug)
    {
        $arraySlug  = explode('-', $slug);
        //dd($arraySlug);
        $id         = array_pop($arraySlug);

        if ($id){
            $product = Product::with('category:id,c_name,c_slug','keywords')->findOrFail($id);
            ProcessViewService::view('products','pro_view','product',$id);

            // Lấy album ảnh
            $images = \DB::table('product_images')
                ->where('pi_product_id', $id)
                ->get();


            $viewData=[
                'product' => $product,
                'productSuggest' => $this->getProductSuggest($product->pro_category_id),
                'title_page'       => $product->pro_name,
                'images'           => $images,
            ];
            return view('frontend.pages.product_detail.index', $viewData);
        }

        return redirect() -> to('/');
    }

    //lấy ra các sản phẩm cùng category
    public function getProductSuggest($categoriID)
    {
        $products = Product::where([
            'pro_active' => 1,
            'pro_category_id' => $categoriID
        ]);
        $products = $products->select('id','pro_name','pro_slug','pro_sale','pro_avatar','pro_price')->paginate(12);

        return $products;
    }
}
