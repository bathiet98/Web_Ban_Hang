{{--@extends('layouts.app_master_user')--}}
{{--@section('css')--}}

{{--@stop--}}
{{--@section('content')--}}
{{--    <section>--}}
{{--        <h2 class="title">Danh sách sản phẩm yêu thích</h2>--}}
{{--        <div class="row mb-5">--}}
{{--            <div class="col-sm-12">--}}
{{--                <table class="table table-striped">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th scope="col">Mã ĐH</th>--}}
{{--                        <th class="w-25" scope="col">Name</th>--}}
{{--                        <th scope="col">Category</th>--}}
{{--                        <th scope="col">Avatar</th>--}}
{{--                        <th scope="col">Price</th>--}}
{{--                        <th scope="col">#</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    @foreach($products as $item)--}}
{{--                        <tr>--}}
{{--                            <th scope="row">DH{{ $item->id }}</th>--}}
{{--                            <th>{{ $item->pro_name }}</th>--}}
{{--                            <th>--}}
{{--                                <span class="btn btn-primary">{{ $item->category->c_name ?? "[N\A]" }}</span>--}}
{{--                            </th>--}}
{{--                            <th>--}}
{{--                                <img src="{{ pare_url_file($item->pro_avatar) }}" style="width: 80px;height: 100px">--}}
{{--                            </th>--}}
{{--                            <th>{{ number_format($item->pro_price,0,',','.') }} đ</th>--}}
{{--                            <th>--}}
{{--                                <a class="btn btn-danger" href="{{  route('get.user.favourite.delete', $item->id) }}">Huỷ bỏ</a>--}}
{{--                            </th>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
{{--@stop--}}
