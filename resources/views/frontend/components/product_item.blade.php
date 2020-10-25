{{--@if(isset($product))--}}
{{--    <div class="product-item">--}}
{{--        <a href="{{route('get.product.detail', $product->pro_slug . '-' . $product->id)}}" title="" class="avatar image contain">--}}
{{--            <img alt="" src="{{ pare_url_file($product->pro_avatar) }}" style="width: 200px; height: 210px" class="lazyload">--}}
{{--        </a>--}}

{{--        <a href="{{route('get.product.detail', $product->pro_slug . '-' . $product->id)}}" title="{{$product->pro_name}}" class="title">--}}
{{--            <h3>{{$product->pro_name}}</h3>--}}
{{--        </a>--}}
{{--        @if($product->pro_sale)--}}
{{--            <p class="percent">-{{$product->pro_sale}}%</p>--}}
{{--            @php--}}
{{--                $price = (100- $product->pro_sale)  / 100  * $product->pro_price ;--}}
{{--            @endphp--}}
{{--            <p class="price">{{number_format($price,0,',','.')}} vnđ</p>--}}
{{--            <p class="price-sale">{{number_format($product->pro_price,0,',','.')}} vnđ</p>--}}

{{--        @else--}}
{{--            <p class="price">{{number_format($product->pro_price,0,',','.')}} vnđ</p>--}}
{{--            <p class="price-sale">{{number_format($product->pro_price,0,',','.')}} vnđ</p>--}}
{{--        @endif--}}


{{--    </div>--}}
{{--@endif--}}

@if (isset($product))
    <div class="product-item">
        <a href="{{ route('get.product.detail',$product->pro_slug . '-'.$product->id ) }}" title="" class="avatar image contain">
            <img alt="{{  $product->pro_name }}" data-src="{{ pare_url_file($product->pro_avatar) }}" src="{{ pare_url_file($product->pro_avatar) }}" class="lazyload lazy">
        </a>
        <a href="{{ route('get.product.detail',$product->pro_slug . '-'.$product->id ) }}"
           title="{{  $product->pro_name }}" class="title">
            <h3>{{  $product->pro_name }}</h3>
        </a>
        @if ($product->pro_sale)
            <p>
                <span class="percent">-{{ $product->pro_sale }}%</span>
                @php
                    $price = ((100 - $product->pro_sale) * $product->pro_price)  /  100 ;
                @endphp
                <span class="price">{{  number_format($price,0,',','.') }} đ</span>
                <span class="price-sale">{{ number_format($product->pro_price,0,',','.') }} đ</span>
            </p>
        @else
            <p class="price">{{  number_format($product->pro_price,0,',','.') }} đ</p>
        @endif

    </div>
@endif
