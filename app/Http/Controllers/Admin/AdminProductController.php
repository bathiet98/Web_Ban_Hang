<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequestProduct;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Keyword;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        // dd(\Hash::make('12345678'));
        $products = Product::with('category:id,c_name');
        if ($id = $request->id) $products->where('id', $id);
        if ($name = $request->name) $products->where('pro_name','like', '%'.$name.'%');
        if ($category = $request->category) $products->where('pro_category_id',$category);

        $products = $products->orderByDesc('id')->paginate(10);
        $categories = Category::all();
        $viewData = [
            'products'   => $products,
            'categories' => $categories,
            'query'      => $request->query()
        ];

        return view('admin.product.index', $viewData);
    }

    public function create()
    {
        $categories = Category::all();
        $attributeOld = [];
        $keywordOld = [];
        $attributes     =   $this->syncAttributeGroup();
        $keywords = Keyword::all();
        return view('admin.product.create', compact('categories','attributes','attributeOld','keywords','keywordOld'));
    }

    public function store(AdminRequestProduct $request)
    {
        $data = $request->except('_token','pro_avatar','attribute','keywords','file');
        $data['pro_slug']     = Str::slug($request->pro_name);
        $data['created_at']   = Carbon::now();
        if ($request->pro_avatar) {
            $image = upload_image('pro_avatar');
            if ($image['code'] == 1)
                $data['pro_avatar'] = $image['name'];
        }

        $id = Product::insertGetId($data);

        if ($id){
            $this->syncAttribute($request->attribute,$id);
            $this->syncKeyword($request->keywords,$id);
            if ($request->file) {
                $this->syncAlbumImageAndProduct($request->file, $id);
            }
        }

        return redirect()->route('admin.product.index');
    }

    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::find($id);
        $attributes     =   $this->syncAttributeGroup();
        $attributeOld = \DB::table('products_attributes')
            ->where('pa_product_id',$id)
            ->pluck('pa_attribute_id')  //lấy giá trị của cột
            ->toArray();
        if (!$attributeOld) $attributeOld = [];

        $keywordOld = \DB::table('products_keywords')
            ->where('pk_product_id',$id)
            ->pluck('pk_keyword_id')  //lấy giá trị của cột
            ->toArray();
        if (!$keywordOld) $keywordOld = [];
        $keywords = Keyword::all();

        $images = \DB::table('product_images')
            ->where("pi_product_id", $id)
            ->get();

        $viewdata = [
            'product'       =>$product,
            'categories'    =>$categories,
            'attributes'    =>$attributes,
            'attributeOld'  =>$attributeOld,
            'keywords'      =>$keywords,
            'keywordOld'    => $keywordOld,
            'images'        => $images ?? []
        ];
        return view('admin.product.update', $viewdata);
    }

    public function update(AdminRequestProduct $request, $id)
    {
        $product           = Product::find($id);
        $data               = $request->except('_token','pro_avatar','attribute','keywords','file');
        $data['pro_slug']     = Str::slug($request->pro_name);
        $data['updated_at'] = Carbon::now();

        if ($request->pro_avatar) {
            $image = upload_image('pro_avatar');
            if ($image['code'] == 1)
                $data['pro_avatar'] = $image['name'];
        }
        $update = $product->update($data);

        if ($update)
        {
            $this->syncAttribute($request->attribute,$id);
            $this->syncKeyword($request->keywords,$id);
            if ($request->file) {
                $this->syncAlbumImageAndProduct($request->file, $id);
            }
        }
        return redirect()->route('admin.product.index');
    }

    public function syncAlbumImageAndProduct($files, $productID)
    {
        foreach ($files as $key => $fileImage) {
            $ext = $fileImage->getClientOriginalExtension();
            $extend = [
                'png','jpg','jpeg','PNG','JPG'
            ];

            if (!in_array($ext, $extend)) return false;

            $filename = date('Y-m-d__').Str::slug($fileImage->getClientOriginalName()).'.'.$ext;
            $path = public_path().'/uploads/'.date('Y/m/d/');
            if (!\File::exists($path)){
                mkdir($path, 0777, true);
            }

            $fileImage->move($path, $filename);
            \DB::table('product_images')
                ->insert([
                    'pi_name' => $fileImage->getClientOriginalName(),
                    'pi_slug' => $filename,
                    'pi_product_id' => $productID,
                    'created_at' => Carbon::now()
                ]);
        }
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if ($product) $product->delete();
        return redirect()->back();
    }

    public function deleteImage($imageID)
    {
        \DB::table('product_images')->where('id', $imageID)->delete();
        return redirect()->back();
    }

    public function hot($id)
    {
        $product = Product::find($id);
        $product['pro_hot']  =! $product['pro_hot'];
        $product -> save();
        return redirect()->back();
    }

    public function active($id)
    {
        $product = Product::find($id);
        $product['pro_active']  =! $product['pro_active'];
        $product -> save();
        return redirect()->back();
    }

    //đồng bộ Keyword để thêm dữ liệu và database
    protected function syncKeyword($keywords, $idProduct)
    {
        if (!empty($keywords)){
            $datas = [];
            foreach ($keywords as $key => $value){
                $datas[] = [
                    'pk_product_id'     => $idProduct,
                    'pk_keyword_id'     => $value
                ];
            }
            if (!empty($datas)) {
                \DB::table('products_keywords')->where('pk_product_id', $idProduct)->delete();
                \DB::table('products_keywords')->insert($datas);
            }
        }
    }

    //đồng bộ Attrinbute
    protected function syncAttribute($attributes, $idProduct)
    {
        if (!empty($attributes)){
            $datas = [];
            foreach ($attributes as $key => $value){
                $datas[] = [
                    'pa_product_id' => $idProduct,
                    'pa_attribute_id'  => $value
                ];
            }

            if (!empty($datas)){
                \DB::table('products_attributes')->where('pa_product_id',$idProduct)->delete();
                \DB::table('products_attributes')->insert($datas);
            }
        }
    }

    //Phân chia ra thành từng nhóm của thuộc tính
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
