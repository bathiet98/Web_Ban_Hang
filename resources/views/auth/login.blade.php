@extends('layouts.app_master_frontend')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/home.min.css') }}">
@stop
@section('content')
{{--    @include('frontend.pages.home.include._inc_slide',['slides' => $slides])--}}
    <div class="auth" style="background: white;">
        <form class="from_cart_register" action="" method="post" style="width: 500px;margin:0 auto;padding: 30px 0">
            @csrf
            <div class="form-group">
                <label for="name">Email <span class="cRed">(*)</span></label>
                <input name="email" id="name" type="email" class="form-control" placeholder="nguyenvana@gmail.com">
                @if ($errors->first('email'))
                    <span class="text-danger" style="color: red">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label>Password <span class="cRed">(*)</span></label>
                <input name="password" id="phone" type="password" placeholder="********" class="form-control">
                @if ($errors->first('password'))
                    <span class="text-danger" style="color: red">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="form-group">
                <button class="btn btn-purple btn-xs">Đăng nhập</button>
                <a href="">Google</a><br>
                <a href="">Quên mật khẩu</a>
            </div>
        </form>
    </div>
    </div>
@stop
@section('script')
    <script src="{{ asset('js/home.js') }}" type="text/javascript"></script>
@stop

