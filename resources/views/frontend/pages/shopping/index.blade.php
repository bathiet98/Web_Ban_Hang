@extends('layouts.app_master_frontend')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/cart.min.css') }}">
    <style type="text/css">
        .btn-action{
            font-size: 12px;
            padding: 0px 10px;
            border: 1px solid #E91E63;
            background: #E91E63;
            color: white;
            margin-top: 5px;
            display: inline-block;
            border-radius: 10px;
        }
        .btn-action-delete{
            font-size: 12px;
            padding: 0px 10px;
            border: 1px solid #888888;
            background: #888888;
            color: white;
            margin-top: 5px;
            display: inline-block;
            border-radius: 10px;
        }
    </style>
@stop
@section('content')
    <div class="container cart">
        <div class="left" style="width: 100%">
            <div class="list" >
                <div class="title">THÔNG TIN GIỎ HÀNG</div>
                <div class="list__content">
                    <table class="table">
                        <thead>
                        <tr>
                            <th style="width: 100px;"></th>
                            <th style="width: 20%">Sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($shopping ?? '' as $key => $item)
                            <tr>
                                <td>
                                    <a style="text-align: center" href="{{ route('get.product.detail',\Str::slug($item->name).'-'.$item->id) }}"
                                       title="{{ $item->name }}" class="avatar image contain">
                                        <img alt="" src="{{ pare_url_file($item->options->image) }}" class="lazyload">
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('get.product.detail',\Str::slug($item->name).'-'.$item->id) }}"><strong>{{ $item->name }}</strong></a>
                                </td>
                                <td>
                                    <p style="text-align: center"><b>{{  number_format($item->price,0,',','.') }} đ</b></p>
{{--                                    <p>--}}

{{--                                        @if ($item->options->price_old)--}}
{{--                                            <span style="text-decoration: line-through;">{{  number_format(number_price($item->options->price_old),0,',','.') }} đ</span>--}}
{{--                                            <span class="sale">- {{ $item->options->sale }} %</span>--}}
{{--                                        @endif--}}
{{--                                    </p>--}}
                                </td>
                                <td>
                                    <div class="qty_number">
                                        <input type="number"  min="1" class="input_quantity" name="quantity_14692" value="{{  $item->qty }}" id="" style="width: 100px">
                                        <a href="{{route('ajax_get.shopping.update',$key)}}" data-id-product="{{$item->id}}" class="js-update-item-cart btn-action" data-id="{{$key}}">Cập nhật</a>
                                        <a href="{{  route('get.shopping.delete', $key) }}" class="js-delete-item btn-action-delete">Xoá<i class="la la-trash"></i></a>
                                    </div>
                                </td>
                                <td>
                                    <span class="js-total-item">{{ number_format($item->price * $item->qty,0,',','.') }} đ</span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <p style="float: left;margin-top: 20px; font-size: 30px">Tổng tiền : <b id="sub-total" style="color:red">{{ \Cart::subtotal(0) }} đ</b></p>
                </div>
            </div>
        </div>
    </div>

    <div style="padding-top:50px ">
        <div class="container cart">
            <div class="left">
                <div class="customer" style="width: 500px;">
                <div class="title">THÔNG TIN ĐẶT HÀNG</div>
                <div class="customer__content">
                    <form class="from_cart_register" action="{{ route('post.shopping.pay') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name" >Họ và tên <span class="cRed">(*)</span></label>
                            <input name="tst_name" id="name" required="" value="{{ get_data_user('web','name') }}" type="text" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="phone">Điện thoại <span class="cRed">(*)</span></label>
                            <input name="tst_phone" id="phone" required="" value="{{ get_data_user('web','phone') }}" type="text" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ <span class="cRed">(*)</span></label>
                            <input name="tst_address" id="address" required="" value="{{ get_data_user('web','address') }}" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email <span class="cRed">(*)</span></label>
                            <input name="tst_email" id="email" value="{{ get_data_user('web','email') }}" type="text" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="note">Ghi chú thêm</label>
                            <textarea name="tst_note" id="note" cols="3" style="min-height: 100px;" rows="2" class="form-control" placeholder="Chọn màu và thời gian nhận hàng"></textarea>
                        </div>
                        <div class="btn-buy">
                            <button class="buy1 btn btn-purple " type="submit">
                                Thanh toán khi nhận hàng
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script src="{{ asset('js/cart.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://codeseven.github.io/toastr/build/toastr.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $(".js-update-item-cart").click(function (event) {
                event.preventDefault();
                let $this = $(this);
                let url = $this.attr('href');
                let qty = $this.prev().val();
                let idProduct = $this.attr('data-id-product')

                if(url){
                    $.ajax({
                        url: url,
                        data: {
                            qty : qty,
                            idProduct : idProduct
                        }
                    }).done(function (results) {
                        toastr.success(results.messages)
                        window.location.reload();
                    })
                }
            })
        })
    </script>
@stop
