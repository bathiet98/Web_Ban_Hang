<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends FrontendController
{
    public function index(Request $request, $slug)
    {
        // Lấy thuộc tính
        $attributes     =   $this->syncAttributeGroup();

        $arraySlug = explode('-', $slug);
        $id = array_pop($arraySlug);
        if ($id) {
            // $attributes =  $this->syncAttributeGroup();
            $category = Category::find($id);
            $products = Product::where([
                'pro_active' => 1,
                'pro_category_id' => $id
            ]);
        }

        $paramAtbSearch = $request->except('price','page','country');
        $paramAtbSearch = array_values($paramAtbSearch);

        if (!empty($paramAtbSearch))
        {
            $products->whereHas('attributes',  function ($query) use($paramAtbSearch){
                $query->whereIn('pa_attribute_id', $paramAtbSearch);
            });
        }

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

        if ($name = $request->k) $products->where('pro_name','like','%'.$name.'%');
        if ($country = $request->country) $products->where('pro_country',$country);

        $modelProduct = new Product();

        $products = $products->select('id','pro_name','pro_slug','pro_sale','pro_avatar','pro_price','pro_review_total','pro_review_star')
            ->paginate(12);

        $viewData = [
            'products'      => $products,
            'attributes'    =>  $attributes,
            'title_page'    => $category->c_name,
            'query'         => $request->query(),
            'country'       => $modelProduct->country,
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
