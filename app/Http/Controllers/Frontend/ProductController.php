<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends FrontendController
{
    public function index(Request $request)
    {
        $paramAtbSearch = $request->except('price','page','k','country');
        $paramAtbSearch = array_values($paramAtbSearch);
        $products       =   Product::where('pro_active', 1);
        if (!empty($paramAtbSearch))
        {
            $products->whereHas('attributes',  function ($query) use($paramAtbSearch){
               $query->whereIn('pa_attribute_id', $paramAtbSearch);
            });
        }
        if ($name = $request->k) $products->where('pro_name','like','%'.$name.'%');
        if ($country = $request->country) $products->where('pro_country',$country);

        if ($request->price)
        {
            $price = $request->price;
            if ($price == 6)
            {
                $products->where('pro_price','>',10000000)->orderBy('pro_price');
            }elseif ($price == 5){
                $products->where('pro_price','<', 10000000)->orderByDesc('pro_price');
            }elseif ($price == 4){
                $products->where('pro_price','<', 8000000)->orderByDesc('pro_price');
            }elseif ($price == 3){
                $products->where('pro_price','<', 6000000)->orderByDesc('pro_price');
            }elseif ($price == 2){
                $products->where('pro_price','<', 4000000)->orderByDesc('pro_price');
            }elseif ($price == 1){
                $products->where('pro_price','<', 2000000)->orderByDesc('pro_price');
            }
        }


        $attributes     =   $this->syncAttributeGroup();
        $modelProduct = new Product();

        $products = $products->orderByDesc('id')
            ->select('id','pro_name','pro_slug','pro_avatar','pro_sale','pro_price')
            ->paginate(12);
        $viewData =[
            'attributes'    => $attributes,
            'products'      => $products,
            'query'         => $request->query(),
            'country'       => $modelProduct->country,
            'link_search'   => request()->fullUrlWithQuery(['k' => \Request::get('k')])
        ];
        return view('frontend.pages.product.index', $viewData);
    }

    public function syncAttributeGroup()
    {
        $attributes = Attribute::get();
        $groupAttribute = [];
        foreach ($attributes as $key => $attribute)
        {
            $key = $attribute->gettype($attribute->atb_type)['name'];
            $groupAttribute[$key][]     =   $attribute ->toArray() ;
        }
        return $groupAttribute;
    }
}
