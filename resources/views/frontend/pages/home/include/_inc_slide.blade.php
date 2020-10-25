
<div id="slider">
    <div class="imageSlide js-banner owl-carousel">
        @foreach($slides as $item)
        <div>
            <a href="{{$item -> sd_link}}" title="{{$item->sd_title}}">
                <img alt="DQW" src="{{pare_url_file($item->sd_image)}}"  class=""/>
            </a>
        </div>
        @endforeach
{{--        <div>--}}
{{--            <a href="https://bom.to/mye3CD" title="">--}}
{{--                <img alt="DQW" src="https://www.dangquangwatch.vn/upload/slideshow/993732684_DangQuang_T9350K.jpg" />--}}
{{--            </a>--}}
{{--        </div>--}}
    </div>
</div>
