<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequestKeyword;
use App\Models\Keyword;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminKeywordController extends AdminController
{
    public function index()
    {
        $keywords = Keyword::paginate(10);
        $viewdata = [
            'keywords' => $keywords
        ];
        return view('admin.keyword.index',$viewdata);
    }

    public function create()
    {
        return view('admin.keyword.create');
    }

    public function store(AdminRequestKeyword $request)
    {
        $data                   = $request->except('_token');
        $data['k_slug']         = Str::slug($request->k_name);
        $data['created_at']     = Carbon::now();
        $id                     = Keyword::insertGetId($data);

        return redirect()->route('admin.keyword.index');
    }

    public function edit($id)
    {
        $keyword = Keyword::find($id);
        return view('admin.keyword.update',compact('keyword'));
    }

    public function update(AdminRequestKeyword $requestKeyword,$id)
    {
        $keyword                = Keyword::find($id);
        $data                   = $requestKeyword->except('_token');
        $data['k_slug']         = Str::slug($requestKeyword->k_name);
        $data['updated_at']     = Carbon::now();

        $keyword->update($data);
        return redirect()->route('admin.keyword.index');

    }

    public function delete($id)
    {
        $keyword = Keyword::find($id);
        if ($keyword) $keyword->delete();
        return redirect()->back();
    }

    public function hot($id)
    {
        $keyword = Keyword::find($id);
        $keyword->k_hot = ! $keyword-> k_hot;
        $keyword->save();
        return redirect()->back();
    }
}
