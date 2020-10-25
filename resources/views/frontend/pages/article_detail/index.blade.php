@extends('layouts.app_master_frontend')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/blog_detail.min.css') }}">
@stop
@section('content')
    <div class="container">
        <div class="breadcrumb">
            <ul>
                <li>
                    <a href="/" title="Home"><span itemprop="title">Trang chủ</span></a>
                </li>
                <li>
                    <a href="{{route('get.blog.list')}}" title="Đồng hồ chính hãng"><span itemprop="title">Bài Viết</span></a>
                </li>

                <li>
                    <a href="javascript://" title="{{$article->a_name}}"><span itemprop="title">{{$article->a_name}}</span></a>
                </li>

            </ul>
        </div>
        <div class="blog-main">
            <div class="left">
                <div class="post-detail">
                    <h1 class="post-detail__title">{{$article->a_name}}</h1>
                    <p class="post-detail__intro">{{$article->a_description}}</p>
                    <div class="post-detail__content">
                        {!! $article->a_content !!}
                    </div>
                </div>
            </div>
            <div class="right">
                <div class="top-question">
                    <div class="title">Hỏi đáp về đồng hồ</div>
                    <ul>
                        <li>
                            <span class="stt">1</span><a href="#">Hỏi đáp về đồng hồ: Mặt kính đồng hồ đeo tay có bao nhiêu loại?</a>
                        </li>
                        <li>
                            <span class="stt">2</span><a href="#">Dược lựa chọn nhiều nhất tại Đăng Quang Watch</a>
                        </li>
                        <li>
                            <span class="stt">3</span><a href="#">Hỏi đáp về đồng hồ: Mặt kính đồng hồ đeo tay có bao nhiêu loại?</a>
                        </li>
                        <li>
                            <span class="stt">4</span><a href="#">Dược lựa chọn nhiều nhất tại Đăng Quang Watch</a>
                        </li>
                    </ul>
                </div>
                <div class="best-sell">
                    <div class="title">Top bán chạy nhất</div>
                    <div class="content">
                        @foreach($productsPay as $product)
                            <div class="item">
                                <div class="item__avatar">
                                    <a href="{{route('get.product.detail',$product->pro_slug .'-'. $product->id)}}" title="" class="image cover">
                                        <img data-src="" class="lazyload" alt="Đồng hồ Diamond D" src="{{ pare_url_file($product->pro_avatar) }}">
                                    </a>
                                </div>
                                <div class="item__info">
                                    <a href="#" title="Đồng hồ Diamond D" class="cate">{{$product->category->c_name}}</a>
                                    @if($product->pro_sale)
                                        <a href="" title="SaleOff" class="cate sale">-10%</a>
                                        <a href="{{route('get.product.detail',$product->pro_slug .'-'. $product->id)}}" title="Đồng hồ Diamond D DD6014B" class="name">{{$product->pro_name}}</a>
                                        @php
                                            $price = (100 - $product->pro_sale)/100 *$product->pro_price;
                                        @endphp
                                        <p class="price">
                                            <span>Giá bán: </span>
                                            <span class="new">{{number_format($price,0,',','.')}} đ</span>
                                        </p>
                                        <p class="price">
                                            <span>Giá gốc: </span>
                                            <span class="old">{{number_format($product->pro_price,0,',','.')}} đ</span>
                                        </p>
                                    @else
                                        <a href="" title="SaleOff" class="cate sale">0%</a>
                                        <a href="" title="Đồng hồ Diamond D DD6014B" class="name">{{$product->pro_name}}</a>
                                        <p class="price">
                                            <span>Giá bán: </span>
                                            <span class="new">{{number_format($product->pro_price,0,',','.')}} đ</span>
                                        </p>
                                        <p class="price">
                                            <span>Giá gốc: </span>
                                            <span class="old">{{number_format($product->pro_price,0,',','.')}} đ</span>
                                        </p>

                                    @endif

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="blog-top">
                    <div class="title">Tin Tức Nổi Bật</div>
                    <div class="bot">
                        @foreach($articlesHotTop as $article)
                            <div class="item">
                                <a href="{{ route('get.article.detail',$article->a_slug.'-'.$article->id) }}" title="{{  $article->a_name }}" class="image cover">
                                    <img  class="lazyload lazy" src="{{ pare_url_file($article->a_avatar) }}"  alt="{{  $article->a_name }}" data-src="{{ pare_url_file($article->a_avatar) }}">
                                    <p>{{  $article->a_name }}</p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script src="{{ asset('js/blog_detail.js') }}" type="text/javascript"></script>
@stop
