<style type="text/css">
    .item__content .active a {
        color: red;
    }
</style>
<div class="filter-sidebar">
{{--    <div class="item">--}}
{{--        <div class="item__title">Thương hiệu</div>--}}
{{--        <div class="item__content">--}}
{{--            <ul>--}}
{{--                <li>--}}
{{--                    <label>--}}
{{--                        <input type="checkbox" value="594">--}}
{{--                        <h2><span>Đồng hồ Philippe Auguste</span></h2>--}}
{{--                    </label>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <label>--}}
{{--                        <input type="checkbox" value="594">--}}
{{--                        <h2><span>Đồng hồ Philippe Auguste</span></h2>--}}
{{--                    </label>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    @if(isset($attributes))--}}
{{--        @foreach($attributes as $key => $attribute)--}}
{{--            <div class="item">--}}
{{--                <div class="item__title">{{$key}}</div>--}}
{{--                    <div class="item__content" >--}}
{{--                        <ul>--}}
{{--                            @foreach($attribute as $item)--}}
{{--                                <li class= "{{ Request::get('attr_'.$item['atb_type']) == $item['id'] ? "active" : "" }}">--}}
{{--                                    <a href="{{request()->fullUrlWithQuery(['attr_'.$item['id'] => $item['id']])}}">--}}
{{--                                        <h2><span>{{$item['atb_name']}}</span></h2>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--            </div>--}}
{{--        @endforeach--}}
{{--    @endif--}}
    @if (isset($country))
        <div class="item">
            <div class="item__title" >Xuất xứ</div>
            <div class="item__content" >
                <ul>
                    @foreach($country as $key => $item)
                        <li class="{{ Request::get('country') == $key ? "active" : "" }} js-param-search" data-param="country={{ $key }}">
                            <a href="{{ request()->fullUrlWithQuery(['country'=> $key]) }}">
                                <span>{{ $item }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @if (isset($attributes))
        @foreach($attributes as $key => $attribute)
            <div class="item">
                <div class="item__title">{{ $key }}</div>
                <div class="item__content">
                    <ul>
                        @foreach($attribute as $item)
                            <li class=" js-param-search {{ Request::get('attr_'.$item['atb_type']) == $item['id'] ? "active" : "" }}"
                                data-param="attr_{{ $item['atb_type'] }}={{ $item['id'] }}">
                                <a href="{{ request()->fullUrlWithQuery(['attr_'.$item['atb_type'] => $item['id']]) }}">
                                    <span>{{ $item['atb_name'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    @endif


</div>
