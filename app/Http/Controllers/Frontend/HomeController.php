<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderShipped;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends FrontendController
{
    public function index()
    {
        //sản phẩm mới
        $productsNew = Product::where('pro_active', 1)
            -> orderByDesc('id')
            -> limit(4)
            -> select('id','pro_name','pro_slug','pro_sale','pro_price','pro_avatar')
            -> get();

        //sản phẩm Hot
        $productsHot = Product::where([
                'pro_hot'       => 1,
                'pro_active'    => 1
            ])
            -> orderByDesc('id')
            -> limit(4)
            -> select('id','pro_name','pro_slug','pro_sale','pro_price','pro_avatar')
            -> get();

        //sản phẩm mua nhiều
        $productsPay = Product::where([
            'pro_active'    =>  1,
            ])
            ->where('pro_pay', '>',1)
            ->orderByDesc('pro_pay')
            ->limit(4)
            ->select('id','pro_name','pro_slug','pro_sale','pro_price','pro_avatar')
            ->get();

        // Lấy slide trang chủ
        $slides = Slide::where('sd_active',1)
            ->orderBy('sd_sort','asc')
            ->get();

        // Sản phẩm thuộc danh mục hot
        $categoriesHot = Category::with([
            'products' => function($q) {
                $q->where('pro_active',1)
                    ->select('id','pro_name','pro_slug','pro_category_id','pro_sale','pro_avatar','pro_price','pro_review_total','pro_review_star')
                    ->limit(20)
                    ->orderByDesc('id')
                    ->get();
            }
        ])
            ->where([
                'c_hot'      => 1,
                'c_status'   => 1
            ])->get();


        $viewData = [
            'productsNew'   =>  $productsNew,
            'productsHot'   =>  $productsHot,
            'productsPay'   =>  $productsPay,
            'slides'        =>  $slides,
            'categoriesHot' =>  $categoriesHot,
            'title_page'    => "SĂN HÀNG ONLINE",
        ];
        return view('frontend.pages.home.index', $viewData);
    }
}
