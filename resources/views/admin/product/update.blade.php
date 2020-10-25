@extends('layouts.app_master_admin')
@section('content')

    <section class="content-header">
        <h1>
            Cập nhật sản phẩm
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="{{route('admin.product.index')}}"> Sản phẩm</a></li>
            <li class="active"> Update</li>

        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
       @include('admin.product.form')

    </section>
@stop
