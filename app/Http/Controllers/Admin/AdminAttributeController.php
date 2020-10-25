<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequestAttribute;
use App\Models\Attribute;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminAttributeController extends AdminController
{
    public function index(){
        $attributes = Attribute::with('category:id,c_name')->orderByDesc('id') ->get();
        $viewData = [
          'attributes'  =>$attributes
        ];
        return view('admin.attribute.index', $viewData);
    }

    public function create()
    {
        $categories = Category::select('id','c_name')->get();
        $viewData = [
            'categories' => $categories,
        ];
        return view('admin.attribute.create', $viewData);
    }

    public function store(AdminRequestAttribute $request)
    {
        $data                   = $request->except('_token');
        $data['atb_slug']         = Str::slug($request->atb_name);
        $data['created_at']     = Carbon::now();
        $id                     = Attribute::insertGetId($data);

        return redirect()->route('admin.attribute.index');
    }

    public function edit($id)
    {
        $categories = Category::select('id','c_name')->get();
        $attribute = Attribute::find($id);
        $viewData =[
            'categories'    =>  $categories,
            'attribute'     => $attribute
        ];
        return view('admin.attribute.update',$viewData);
    }

    public function update(AdminRequestAttribute $request,$id)
    {
        $attribute                = Attribute::find($id);
        $data                   = $request->except('_token');
        $data['atb_slug']         = Str::slug($request->atb_name);
        $data['updated_at']     = Carbon::now();

        $attribute->update($data);
        return redirect()->route('admin.attribute.index');

    }

    public function delete($id)
    {
        $attribute = Attribute::find($id);
        if ($attribute) $attribute->delete();
        return redirect()->back();
    }

}

