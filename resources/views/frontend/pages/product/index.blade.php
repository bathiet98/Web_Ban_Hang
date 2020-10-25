@extends('layouts.app_master_frontend')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/product_search.min.css') }}">
    <style>
        .filter-tab .active a {
            color: red;
        }
    </style>
@stop
@section('content')
    <div class="container">
        <div class="product-list">
            <div class="left">
                @include('frontend.pages.product.include._inc_sidebar')
            </div>
            <div class="right">
                <div class="breadcrumb">
                    <ul>
                        <li itemscope="" itemtype="">
                            <a itemprop="url" href="/"><span itemprop="title">Trang chủ</span></a>
                        </li>

                    </ul>
                </div>

                <div class="filter-tab">
                    <ul>
{{--                        @for($i =1; $i <= 5; $i++)--}}
{{--                            <li>--}}
{{--                                <label>--}}
{{--                                    <a href="{{request()->fullUrlWithQuery(['price' => $i])}}">Giá < {{$i * 2}} triệu</a>--}}
{{--                                </label>--}}
{{--                            </li>--}}
{{--                        @endfor--}}
{{--                            <li>--}}
{{--                                <a href="{{request()->fullUrlWithQuery(['price' => 6])}}">Lớn hơn 10 triệu</a>--}}
{{--                            </li>--}}
                        @for($i = 1; $i <= 6; $i++)
                            <li class="{{ Request::get('price') == $i ? "active" : "" }}">
                                <a href="{{ request()->fullUrlWithQuery(['price' =>  $i]) }}">
                                    {{  $i == 6 ? "Lớn hơn 10 triệu" : "Giá <" . $i * 2  ." triệu" }}
                                </a>
                            </li>
                        @endfor
                    </ul>
                </div>
                <div class="order-tab">
                    <span class="total-prod">Tổng số: {{$products->total()}} sản phẩm Tính năng</span>
                    <div class="sort">
                        <div class="item">
                            <span class="title">Sắp xếp <i class="fa fa-caret-down"></i></span>
                        </div>
                    </div>
                </div>
                <div class="group">
                    @if(isset($products))
                        @foreach($products as $product)
                            @include('frontend.components.product_item',['product' => $product])
                        @endforeach
                    @endif
                </div>
                <div style="display: block;text-align: center">
                    {!! $products->appends($query ?? [])->links() !!}
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script src="{{ asset('js/product_search.js') }}" type="text/javascript"></script>
@stop
