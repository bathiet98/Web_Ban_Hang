<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class BlogBaseController extends Controller
{
    public function getProductPayTop()
    {
        //sản phẩm mua nhiều
        $productsPay = Product::with('category:id,c_name,c_slug')
        ->where([
            'pro_active'    =>  1,
        ])
            ->where('pro_pay', '>',1)
            ->orderByDesc('pro_pay')
            ->limit(4)
            ->select('id','pro_name','pro_slug','pro_sale','pro_price','pro_avatar','pro_category_id')
            ->get();
        return $productsPay;
    }
}
