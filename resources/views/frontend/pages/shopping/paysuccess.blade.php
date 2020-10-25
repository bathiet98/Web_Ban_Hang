@extends('layouts.app_master_frontend')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/cart.min.css') }}">
@stop
@section('content')
    <div class="box_home_content" style="padding-top: 20px">
        <table width="95%" align="center" border="0" cellpadding="4" cellspacing="0">
            <tbody><tr>
                <td align="center">
                    <img src="{{asset('images/dat-hang-thanh-cong.png')}}" border="0">
                </td>
            </tr>
{{--            <tr>--}}
{{--                <td align="center" style="border-bottom: 1px solid #ccc;padding: 10px;font-size: 16px;">--}}
{{--                    <p style="font-weight: bold;font-size: 18px;">THÔNG TIN ĐƠN HÀNG</p>--}}
{{--                    <p>Mã đơn hàng: <b>ĐH </b></p>--}}
{{--                    <p>Tổng giá trị đơn hàng: <b></b> VNĐ</p>--}}
{{--                </td>--}}
{{--            </tr>--}}
            <tr><td align="center" style="display: none;">
                    <ul id="idList">
                        <li>11603</li>
                    </ul>
                </td>
            </tr>
            <tr><td align="center" style="color:#000;font-size:18px;line-height:26px;">
                    Cảm ơn quý khách hàng đã mua hàng trên hệ thống Quang Store. <br>
                    Chúng tôi sẽ liên hệ tới quý khách hàng trong thời gian sớm nhất.<br> Chân thành cảm ơn quý khách!<br>
                    <a style="font-style:italic;text-decoration:underline;color:#ff9c00;" href="{{route('get.home')}}" rel="home">&lt;--- Quay về trang chủ</a>   |   <a style="font-style:italic;text-decoration:underline;color:#ff9c00;" href="{{route('get.product.list')}}" rel="home">Tiếp tục mua hàng ---&gt;</a>
                </td></tr>

            </tbody></table>
    </div>
@stop


