<div id="footer" style="background: darkslategrey;">
    <div class="container footer">
        <div class="footer__left">
            <div class="top">
                <div class="item">
                    <div class="title">Về chúng tôi</div>
                    <ul>

                        <li>
                            <a href="{{ route('get.product.list') }}">Sản phẩm</a>
                        </li>
{{--                        <li>--}}
{{--                            <a href="{{ route('get.register') }}">Đăng ký</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="{{ route('get.login') }}">Đăng nhập</a>--}}
{{--                        </li>--}}
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
                <div class="item">
                    <div class="title">Tin tức</div>
                    <ul>
                        @if (isset($menus))
                            @foreach($menus as $menu)
                                <li>
                                    <a title="{{ $menu->mn_name }}"
                                       href="{{ route('get.article.by_menu',$menu->mn_slug.'-'.$menu->id) }}">
                                        {{ $menu->mn_name }}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                        <li><a href="">Liên hệ</a></li>
                        <li>
                            <a href="{{ route('get.blog.list') }}">Bài viết</a>
                        </li>
                    </ul>
                </div>
                <div class="item">
                    <div class="title">Chính sách</div>
                    <ul>
                        <li><a href="">Hướng dẫn mua hàng</a></li>
                        <li><a href="">Chính sách đổi trả</a></li>
                    </ul>
                </div>
            </div>
            <div class="bot">
                <div class="social">
                    <div class="title">KẾT NỐI VỚI CHÚNG TÔI</div>
                    <p>
                        <a href="" class="fa fa fa-youtube"></a>
                        <a href="" class="fa fa-facebook-official"></a>
                        <a href="" class="fa fa-twitter"></a>
                    </p>
                </div>
            </div>
        </div>
        <div class="footer__mid">
            <div class="title">Hệ thống cửa hàng</div>
            <div class="image">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.9159127208063!2d105.93057301398169!3d21.03605028599439!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ad25a212d169%3A0x7d818f6732663307!2zQ2h1bmcgY8awIFJ1YnkgQ2l0eSBDVDMgLSBDaOG7pyDEkOG6p3UgVMawIFRoxINuZyBMb25nIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1588436777848!5m2!1svi!2s" width="250" height="200" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>            </div>

        </div>
        <div class="footer__right">
            <div class="title">Fanpage của chúng tôi</div>
            <div class="image">
                <div class="fb-page" data-href="https://www.facebook.com/QUANGSPORTVNXK/" data-tabs="timeline" data-width="" data-height="200" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/QUANGSPORTVNXK/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/QUANGSPORTVNXK/">QUANG STORE - Chuyên Sỉ Thắt Lưng Balo Túi Ví Phụ Kiện Nam Nữ - 0975388336</a></blockquote></div>            </div>
        </div>
    </div>
</div>
{{-- <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v6.0&appId=3205159929509308&autoLogAppEvents=1"></script> --}}

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v6.0"></script>
