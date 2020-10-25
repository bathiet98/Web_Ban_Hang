<!DOCTYPE html>
<html lang="vi">
<head>
    <link rel="stylesheet" href="{{asset('admin/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('admin/bower_components/Ionicons/css/ionicons.min.css')}}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>{{ ($title_page ?? "SĂN HÀNG ONLINE")   }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="https://codeseven.github.io/toastr/build/toastr.min.css">
    @yield('css')
     Thông báo
    @if(session('toastr'))
        <script>
            var TYPE_MESSAGE = "{{session('toastr.type')}}";
            var MESSAGE = "{{session('toastr.message')}}";
        </script>
    @endif
</head>
<body>
    @include('frontend.components.header')
    @yield('content')
    @include('frontend.components.footer')
    <script>
        var DEVICE = '{{ device_agent() }}'
    </script>
    @yield('script')
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://codeseven.github.io/toastr/build/toastr.min.js"></script>
    <script type="text/javascript">
        if(typeof TYPE_MESSAGE != "undefined")
        {
            switch (TYPE_MESSAGE) {
                case 'success':
                    toastr.success(MESSAGE)
                    break;
                case 'error':
                    toastr.error(MESSAGE)
                    break;
            }
        }
        $(".js-show-login").click(function (event) {
            event.preventDefault();
            toastr.warning("Bạn phải đăng nhập để thực hiện tính năng này")
        })
    </script>
</body>
</html>
