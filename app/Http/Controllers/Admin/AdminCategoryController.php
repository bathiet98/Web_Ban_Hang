<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminRequestCategory;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCategoryController extends AdminController
{
    public function index()
    {
        $categories = Category::paginate(10);

        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(AdminRequestCategory $request)
    {
        $this->insertOrUpdate($request);
        return redirect()->route('admin.category.index');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.update', compact('category'));
    }

    public function update(AdminRequestCategory $request, $id)
    {
        $this->insertOrUpdate($request, $id);
        return redirect()->route('admin.category.index');
    }

    public function insertOrUpdate($request,$id='')
    {
            $category = new Category();

            if ($id)
            {
                $category   = Category::find($id);
            }
            $category->c_name = $request->c_name;
            $category->c_slug = Str::slug($request->c_name);
            $category->save();
    }

    public function delete($id)
    {
        $category = Category::find($id);
        if ($category) $category->delete();
        return redirect()->back();
    }

    public function active($id)
    {
        $category = Category::find($id);
        $category->c_status = ! $category->c_status;
        $category->save();
        return redirect()->back();
    }

    public function hot($id)
    {
        $category = Category::find($id);
        $category->c_hot = ! $category->c_hot;
        $category->save();
        return redirect()->back();
    }
}
