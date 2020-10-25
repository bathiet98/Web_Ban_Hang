<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Http\Controllers\Frontend;
use Illuminate\Http\Request;

class BlogController extends BlogBaseController
{
    public function index()
    {
        //  Danh sách bài viết
        $articles = Article::where([
            'a_active'=>1
        ])
            ->select('id','a_name','a_slug','a_avatar','a_description')
            ->orderByDesc('id')
            ->paginate(12);

        //Bài viết nổi bật trung tâm
        $articlesHotTop = Article::where([
            'a_active'     => 1,
            'a_hot' => 1
        ])
            ->select('id','a_name','a_slug','a_description','a_avatar')
            ->orderByDesc('id')
            ->limit(5)
            ->get();


        $viewData = [
            'articles'          =>  $articles,
            'productsPay'       =>  $this->getProductPayTop(),
            'articlesHotTop'    => $articlesHotTop
        ];
        return view('frontend.pages.article.index', $viewData);
    }
}
