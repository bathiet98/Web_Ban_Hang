@extends('layouts.app_master_frontend')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/product_detail.min.css') }}">
@stop
@section('content')
    <div class="container">

        <div class="breadcrumb">
            <ul>
                <li>
                    <a itemprop="url" href="/" title="Home"><span itemprop="title">Trang chủ</span></a>
                </li>
                <li>
                    <a href="{{route('get.category.list',$product->category->c_slug . '-' .$product->category->id)}}" title=""><span itemprop="title">{{$product->category->c_name}}</span></a>
                </li>

                <li>
                    <a href="#" title="Đồng hồ Diamond D"><span itemprop="title">{{$product->pro_name}}</span></a>
                </li>

            </ul>
        </div>


        <div class="card">
            <div class="card-body info-detail">
                <div class="left">

                    <div class="left">
{{--                                            @include('frontend.pages.product_detail.include._inc_album')--}}
                        <a href="{{ route('get.product.detail',$product->pro_slug . '-'.$product->id ) }}" title=""
                           class="">
{{--                            <img alt="" style="width: 286px; height: 420px ;margin: 0px 91px" src="{{ pare_url_file($product->pro_avatar) }}"--}}
                            <img alt="" style="width: 386px; height: 480px ;margin: 0px" src="{{ pare_url_file($product->pro_avatar) }}"
                                 class="lazyload">
                        </a>
                    </div>


{{--                    </div>--}}
{{--                    <div class="slider-pro" id="my-slider">--}}
{{--                        <div class="sp-slides">--}}
{{--                            <!-- Slide 1 -->--}}
{{--                            <div class="sp-slide" style="height: 600px; width: 468px">--}}
{{--                                <img class="sp-image" src="{{ pare_url_file($product->pro_avatar)  }}" alt="" >--}}
{{--                            </div>--}}
{{--                            <div class="sp-slide">--}}
{{--                                <img class="sp-image" src="{{ pare_url_file($product->pro_avatar)  }}" alt="">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="sp-thumbnails">--}}
{{--                            <img class="sp-thumbnail" src="{{ url('images/banner/dongho.jpg') }}" />--}}
{{--                            <img class="sp-thumbnail" src="{{ url('images/banner/dongho.jpg') }}" />--}}
{{--                        </div>--}}
{{--                    </div>--}}

                </div>
                <div class="right">
                    <h1>{{$product->pro_name}}</h1>
                    <div class="right__content">
                        <div class="info">
                            <div class="prices">
                                <p>Giá niêm yết: <span class="value">{{number_format($product->pro_price,0,',','.')}} đ</span></p>
                                <p>
                                @php
                                    $price = (100- $product->pro_sale)  / 100  * $product->pro_price ;
                                @endphp
                                    Giá bán: <span class="value price-new">{{number_format($price,0,',','.')}} đ</span>
                                    <span class="sale">-{{$product->pro_sale}}%</span>
                                </p>
                            </div>
                            <div>
                                <span >Số Lượng :&nbsp;</span>
                                <span>{{$product->pro_number}}</span>
                            </div>
                            <div>
                                <span >Lượt xem :&nbsp;</span>
                                <span>{{$product->pro_view}}</span>
                            </div>
                            <div>
                                <span >Đã Bán :&nbsp;</span>
                                <span>{{$product->pro_pay}}</span>
                            </div>
                            <div class="btn-cart">
                                <a href="{{route('get.shopping.add', $product->id)}}" title="" onclick="add_cart_detail('17617',0);" class="muangay">
                                    <span>Mua Ngay</span>
                                    <span>Giá Bán {{number_format($price,0,',','.')}} VNĐ</span>
                                </a>
                                <a href="{{route('get.shopping.list')}}" title="mua ngay" class="muatragop">
                                    <span>Giỏ Hàng</span>
                                    <span>({{\Cart::count()}})</span>
                                </a>
                            </div>
                            <div class="infomation">
                                <h2 class="infomation__title">Thông Tin Sản Phẩm</h2>
                                <div class="infomation__group">

                                    <div class="item">
                                        <p class="text1">Danh mục sản phẩm:</p>
                                        @if(isset($product->category->c_name))
                                            <h3 class="text2">{{$product->category->c_name}}</h3>
                                        @else
                                            "[N\A]"
                                        @endif
                                    </div>
                                    <div class="item">
                                        <p class="text1">Xuất xứ:</p>
                                        <h3 class="text2">{{$product->getCountry($product->pro_country)}}</h3>
                                    </div>

                                    <div class="item">
                                        <p class="text1">Màu Sắc, Size:</p>
                                        <h3 class="text2">{{$product->pro_resistant}}</h3>
                                    </div>

                                    <div class="item">
                                        <p class="text1">Kiểu dáng:</p>
                                        <h2 class="text2">Thời Trang Hàn Quốc</h2>
                                    </div>
                                    <div class="item">
                                        <p class="text1">Chất Liệu:</p>
                                        <h3 class="text2">{{$product->pro_energy}}</h3>
                                    </div>


                                </div>
                                @if(isset($product->keywords))
                                    <div class="infomation" style="margin-top: 20px">
                                        <h2 class="infomation__title">Keyword</h2>
                                        <div class="infomation__group">
                                            <div class="item">
                                                @foreach($product->keywords as $keyword)
                                                <a href="" style="border: 1px solid #E91E63; display: inline-block; font-size: 13px;padding: 0 5px;border-radius: 5px;margin-right: 10px; color: #E91E63" >
                                                    {{$keyword -> k_name}}
                                                </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
{{--                        <div class="ads">--}}
{{--                            <a href="#" title="Giam giá" target="_blank"><img alt="Hoan tien" style="width: 100%" src="{{ url('images/banner/dongho.jpg') }}"></a>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div>--}}
{{--                        {!! $product -> pro_content !!}--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <h2 style="font-size: 30px; color: #ff6b7f"> Mô tả sản phẩm</h2>
                <div class=" card-body col-md-8 col-sm-8 col-xs-8 flex-right" style="border: solid #dedede 2px" >
                    <div class="product-comment" style="padding: 10px 10px">
                        <!-- Tab panes -->
                        <div class="tab-content">

                            <div id="description" class="tab-pane fade active in">
                                <div class="container-fluid product-description-wrapper">

                                    <p><span style="font-size: 12pt;" data-mce-style="font-size: 12pt;">  {!! $product -> pro_content !!}</span></p>

                                </div>
                            </div>



                        </div>
                    </div>
                </div>

{{--            @include('frontend.pages.product_detail.include._inc_ratings')--}}
            <div class="card-body product-des" >
                <div class="left">
                    <div class="tabs">
                        <div class="tabs__content">
                            <h1 style="font-size: 26px; color: #0b58a2; font-weight: bold">Sản phẩm liên quan</h1>
                            <div class="product-five">
                                <div class="bot js-product-5 owl-carousel owl-theme owl-custom">
                                    @foreach($productSuggest as $product)
                                            @include('frontend.components.product_item',['product' => $product])
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script src="{{ asset('js/product_detail.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script type="text/javascript">
        $(function () {
            $(".js-add-favourite").click(function (event) {
                event.preventDefault();
                let $this = $(this);
                let URL = $this.attr('href');

                if(URL){
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method: "POST",
                        url: URL,
                    }).done(function (results) {
                        toastr.success(results.messages)
                    })
                }

            })
        })
    </script>
@stop
