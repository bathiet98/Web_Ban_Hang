<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequestArticle;
use App\Models\Article;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('menu:id,mn_name')->paginate(12);
        $viewData = [
            'articles'  => $articles,
        ];
        return view('admin.article.index', $viewData);
    }

    public function create()
    {
        $menus = Menu::all();
        return view('admin.article.create',compact('menus'));
    }

    public function store(AdminRequestArticle $request)
    {
        $data = $request->except('_token','a_avatar');
        $data['a_slug'] = Str::slug($request->a_name);
        $data['created_at']   = Carbon::now();
        if ($request->a_avatar) {
            $image = upload_image('a_avatar');
            if ($image['code'] == 1)
                $data['a_avatar'] = $image['name'];
        }

        $id = Article::insertGetId($data);
        return redirect()->route('admin.article.index');

    }

    public function edit($id)
    {
        $menus = Menu::all();
        $article = Article::find($id);
        $viewData = [
            'menus'     => $menus,
            'article'   => $article,
        ];

        return view('admin.article.update', $viewData);
    }

    public function update(AdminRequestArticle $request,$id)
    {
        $article = Article::find($id);
        $data = $request->except('_token','a_avatar');
        $data['a_slug'] = Str::slug($request->a_name);
        $data['updated_at']   = Carbon::now();
        if ($request->a_avatar) {
            $image = upload_image('a_avatar');
            if ($image['code'] == 1)
                $data['a_avatar'] = $image['name'];
        }
        $article->update($data);
        return redirect()->route('admin.article.index');
    }

    public function delete($id)
    {
        $article = Article::find($id);
        if ($article) $article->delete();
        return redirect()->back();
    }

    public function active($id)
    {
        $article = Article::find($id);
        if ($article)
        {
            $article->a_active = ! $article->a_active;
        }
        $article->save();
        return redirect()->back();
    }

    public function hot($id)
    {
        $article = Article::find($id);
        $article->a_hot = ! $article->a_hot;
        $article->save();
        return redirect()->back();
    }
}
