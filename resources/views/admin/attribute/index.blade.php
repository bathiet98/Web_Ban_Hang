@extends('layouts.app_master_admin')
@section('content')

    <section class="content-header">
        <h1>
            Quản Lý Thuộc Tính
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="{{route('admin.attribute.index')}}">Attribute</a></li>
            <li class="active"> List</li>

        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><a href="{{route('admin.attribute.create')}}" class="btn btn-primary"> Thêm Mới  <i class="fa fa-plus"></i> </a></h3>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width: 40px">#</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                            @if(isset($attributes))
                                @foreach($attributes as $attribute)
                                    <tr>
                                        <td>{{$attribute->id}}</td>
                                        <td>{{$attribute->atb_name}}</td>
                                        <td >
                                            <span class="{{$attribute->getType($attribute->atb_type)['class']}}">{{$attribute->getType($attribute->atb_type)['name']}}</span>
                                        </td>
                                        <td>
                                            <span class="label label-primary">
                                                {{$attribute->category->c_name ?? "[N\A]"}}
                                            </span>
                                        </td>
                                        <td>{{$attribute->created_at}}</td>

                                        <td>
                                            <a href="{{route('admin.attribute.update',$attribute->id)}}" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i>Edit</a>
                                            <a href="{{route('admin.attribute.delete',$attribute->id)}}" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i>Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
{{--                {!! $attributes->links() !!}--}}
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    </section>
@stop
