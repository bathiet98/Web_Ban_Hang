@extends('layouts.app_master_frontend')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/home.min.css') }}">
@stop
@section('content')
    @include('frontend.pages.home.include._inc_slide',['slides' => $slides])
    <div class="container">
        <div class="product-one">
            <div class="top">
                <a href="#" title="" class="main-title"></a>
                <ul class="top__tab">
                    <li data-id="proNewst1" class="active"><a href="{{route('get.product.list')}}" title="">Tất cả</a></li>
                    <li data-id="proNewst1" class="active"><a href="{{route('get.shopping.list')}}" title="Giỏ hàng">
                            <i class="icon icon-cart" ></i>
                            <span class="text">
                                <span class="">Giỏ hàng ({{\Cart::count()}})</span>
                                <span></span>
	                        </span>
                        </a></li>

                    @if(isset($categoriesHot))
                        @foreach($categoriesHot as $category)
                            <li data-id="proNewst2">
                                    <a href="{{route('get.category.list',$category->c_slug . '-' .$category->id)}}" title="{{$category->name}}">
                                        <span class="name">
                                            {{$category->c_name}}
                                        </span>
{{--                                        <i class="icon icon-clock"></i>--}}
                                    </a>
                                </li>
                        @endforeach
                    @endif
                </ul>
            </div>

        </div>
        <div class="product-three" style="padding-top: -50px">
            <div class="top">
                <a href="#" title="" class="main-title">TOP SẢN PHẨM BÁN CHẠY </a>
            </div>
            <div class="bot">
                <div class="left">
                    <div class="image">
                        <a href="{{route('get.product.list')}}" title="" class="">
                            <img class="lazyload" alt="" src="{{asset('images/1.jpg')}}" />
                        </a>
                    </div>
                </div>
                <div class="right">
                    @if(isset($productsPay))
                        @foreach($productsPay as $product)
                            <div class="item">
                                @include('frontend.components.product_item',['$product' =>$product])
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="product-three" style="padding-top: 50px">
            <div class="top">
                <a href="#" title="" class="main-title">SẢN PHẨM MỚI</a>
            </div>
            <div class="bot">
                <div class="left">
                    <div class="image">
                        <a href="{{route('get.product.list')}}" title="" class="">
                            <img class="lazyload" alt="" src="{{asset('images/sp-top.jpg')}}" />
                        </a>
                    </div>
                </div>
                <div class="right">
                    @if(isset($productsNew))
                        @foreach($productsNew as $product)
                            <div class="item">
                                @include('frontend.components.product_item',['$product' =>$product])
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="product-two" style="padding-top: 50px">
            <div class="top">
                <a href="#" title="" class="main-title">SẢN PHẨM NỔI BẬT</a>
            </div>
            <div class="bot">
                @if(isset($productsHot))
                    @foreach($productsHot as $product)
                        <div class="item">
                            @include('frontend.components.product_item',['$product' =>$product])
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        @if ($categoriesHot)
            @foreach($categoriesHot as $category)
                <div class="product-five">
                    <div class="top">
                        <a href="#" class="main-title">{{ $category->c_name }}</a>
                    </div>

                    <div class="bot js-product-5 owl-carousel owl-theme owl-custom">
                        @if (isset($category->products))
                            @foreach($category->products as $product)
                                <div class="item">
                                    @include('frontend.components.product_item',['product' => $product])
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            @endforeach
        @endif

    </div>
@stop
@section('script')
    <script src="{{ asset('js/home.js') }}" type="text/javascript"></script>
@stop

