
<div class="blog-item">
    <div class="avatar">
        <a href="{{route('get.article.detail',$article->a_slug . '-' . $article->id )}}" title="" class="image cover">
            <img data-src="" class="lazyload" alt="" src="{{ pare_url_file($article->a_avatar) }}">
        </a>
    </div>
    <div class="info">
        <a href="" title="">{{$article->a_name}}</a>
        <p>{{$article->a_description}}</p>
    </div>
</div>

