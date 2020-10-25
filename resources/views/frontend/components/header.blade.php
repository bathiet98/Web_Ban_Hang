<div class="commonTop">
    <div id="headers" style="background: #FF6347	;">
        <div class="container header-wrapper">
            <!--Thay đổi-->
            <div class="logo">
                <a href="/" class="desktop">
                    <img src="{{ url('images/logo.jpg') }}" alt="Home" >
                </a>
                <a href="/" class="mobile">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Home">
                </a>
            </div>
            <div class="search" >
                <form action="{{ $link_search ?? route('get.product.list',['k' => Request::get('k')]) }}" role="search" method="GET" >
                    <input type="text" name="k" value="{{ Request::get('k') }}" class="form-control" placeholder="Tìm kiếm sản phẩm ..." style="background: white" >
                    <button type="submit" class="btnSearch" style="background: grey;">
                        <i class="fa fa-search"></i>
                        <span>Tìm kiếm</span>
                    </button>
                </form>

                <ul class="right">
                    <li>
                        <a href="{{route('get.shopping.list')}}" title="Giỏ hàng">
                            <i class="fa fa-shopping-cart" style="font-size: 20px"></i><span> Giỏ hàng ({{\Cart::count()}})</span>
                        </a>
                    </li>
                    <li>
                        <a href="/" title="">
                            <i class="fa fa-phone" style="font-size: 30px"></i>
                            <span class="text">
                                <span class="">Hotline</span>
                                <span>0975388336</span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Hệ thống cửa hàng">
                            <i class="fa fa-map-marker" style="font-size: 30px"></i>
                            <span class="text">
                                <span>Hệ thống cửa hàng</span>
                                <span>Toàn Quốc</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <a href="{{route('get.product.list')}}" class="open-sidebar js-open-bar">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </a>
        </div>
    </div>
    <div id="menu-main" style="background: #FF8C00;">
        <div class="container menu-wrapper">
            <div class="menu-left">
                <a href="{{route('get.product.list')}}" title="" class="title" style="background: chocolate;">
                    <i class="fa fa-bars"></i> Danh mục sản phẩm
                </a>
                <ul id="menu">
                    @if(isset($categories))
                        @foreach($categories as $category)
                            <li>
                                <a href="{{route('get.category.list',$category->c_slug . '-' .$category->id)}}">
                                    {{$category->c_name}}
                                    <span class="openSub">
                                        <i class="icon icon-submenu"></i>
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="menu-right">
                <div class="left">
                    <ul>
                        @if(isset($categoriesHot))
                            @foreach($categoriesHot as $category)
                                <li>
                                    <a href="{{route('get.category.list',$category->c_slug . '-' .$category->id)}}" title="Đồng hồ Thụy Sỹ">
                                        <span class="name">
                                            {{$category->c_name}}
									    </span>
{{--                                        <i class="icon icon-clock"></i>--}}
                                    </a>
                                </li>
                            @endforeach
                        @endif

{{--                        @if(Auth::check())--}}
{{--                            <li>--}}
{{--                                <a href=""><span>Xin chào: {{Auth::user()->name}}</span></a>--}}
{{--                            </li>--}}

{{--                            <li>--}}
{{--                                <a href="{{route('get.user.dashboard')}}"><span>Quản lý tài khoản</span></a>--}}
{{--                            </li>--}}

{{--                            <li>--}}
{{--                                <a href="{{route('get.logout')}}"><span>Đăng xuất</span></a>--}}
{{--                            </li>--}}

{{--                        @else--}}
{{--                            <li>--}}
{{--                                <a href="{{route('get.login')}}"><span>Đăng Nhập</span></a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="{{route('get.register')}}"><span>Đăng Ký</span></a>--}}
{{--                            </li>--}}
{{--                        @endif--}}


                    </ul>
                </div>
                <div class="right">
                    <a href="/" title="Trả góp">
                        <span class="text">Trả góp 0%</span>
                        <i class="icon icon-installment"></i>
                    </a>
                    <a href="{{route('get.blog.list')}}" title="Tin tức - Sự kiện">
                        <i class="icon icon-news"></i>
                        <span class="text">Tin tức</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
