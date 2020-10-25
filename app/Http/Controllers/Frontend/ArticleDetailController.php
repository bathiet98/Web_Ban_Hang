<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleDetailController extends BlogBaseController
{
    public function index(Request $request,$slug)
    {
        $arraySlug  = explode('-', $slug);
        $id         = array_pop($arraySlug);
        if ($id)
        {
            $article = Article::find($id);
        }
        $articleSuggest = Article::where("a_menu_id",$article->id)
            ->select('id','a_name','a_slug')
            ->limit(10)
            ->orderByDesc('id')
            ->get();

        $articlesHotTop = Article::where([
            'a_active'     => 1,
            'a_hot' => 1
        ])
            ->select('id','a_name','a_slug','a_description','a_avatar')
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        $viewData = [
            'article'   => $article,
            'productsPay'   =>  $this->getProductPayTop(),
            'articlesHotTop'    => $articlesHotTop,
            'articleSuggest'        => $articleSuggest,

        ];


        return view('frontend.pages.article_detail.index', $viewData);
    }
}
