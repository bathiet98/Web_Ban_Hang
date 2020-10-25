@extends('layouts.app_master_admin')
@section('content')

    <section class="content-header">
        <h1>
            Thêm mới tin tức
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="{{route('admin.article.index')}}"> Tin tức</a></li>
            <li class="active"> Create</li>

        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        @include('admin.article.form')

    </section>
@stop
