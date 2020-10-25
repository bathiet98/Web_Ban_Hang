@extends('layouts.app_master_admin')
@section('content')

    <section class="content-header">
        <h1>
            Thêm mới Menu
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="{{route('admin.menu.index')}}"> Menu</a></li>
            <li class="active"> Create</li>

        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <div class="box-body">
                    <form action="" method="POST" role="form">
                        @csrf
                        <div class="col-sm-8">
                            <div class="form-group {{$errors->first('mn_name') ? 'has-error' : ''}}">
                                <label for="name">Name <span class="text-danger">(*)</span></label>
                                <input type="text" class="form-control" name="mn_name" placeholder="Name....">
                                @if($errors->first('mn_name'))
                                    <span class="text-danger">{{$errors->first('mn_name')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-4">

                        </div>
                        <div class="col-sm-12">
                            <div class="box-footer text-center">
                                <a href="{{route('admin.menu.index')}}" class="btn btn-danger">Quay lại <i class="fa fa-undo"></i></a>
                                <button type="submit" class="btn btn-success">Lưu dữ liệu <i class="fa fa-save"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- /.box -->
    </section>
@stop
