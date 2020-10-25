@extends('layouts.app_master_admin')
@section('content')

    <section class="content-header">
        <h1>
            Cập nhật thuộc tính
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="{{route('admin.attribute.index')}}"> Attribute</a></li>
            <li class="active"> Update</li>

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
                            <div class="form-group {{$errors->first('atb_name') ? 'has-error' : ''}}">
                                <label for="name">Name <span class="text-danger">(*)</span></label>
                                <input type="text" class="form-control" name="atb_name" placeholder="Name...." value="{{$attribute->atb_name}}">
                                @if($errors->first('atb_name'))
                                    <span class="text-danger">{{$errors->first('atb_name')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="name">Group <span class="text-danger">(*)</span></label>
                                <select name="atb_type" class="form-control {{$errors->first('atb_category_id') ? 'has-error' : ''}}">
                                    <option value="">__Chọn thuộc tính__</option>
                                        <option value="1"{{(isset($attribute->atb_type) ? $attribute->atb_type : '') == 1 ? "selected= 'selected'" : ""}}>Thương Hiệu</option>
                                        <option value="2"{{(isset($attribute->atb_type) ? $attribute->atb_type : '') == 2 ? "selected= 'selected'" : ""}}>Dành Cho</option>
                                        <option value="3"{{(isset($attribute->atb_type) ? $attribute->atb_type : '') == 3 ? "selected= 'selected'" : ""}}>Chất Liệu</option>
                                        <option value="4"{{(isset($attribute->atb_type) ? $attribute->atb_type : '') == 4 ? "selected= 'selected'" : ""}}>Loại Mặt</option>
                                </select>
                                @if($errors->first('atb_type'))
                                    <span class="text-danger">{{$errors->first('atb_type')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="name">Category <span class="text-danger">(*)</span></label>

                                <select name="atb_category_id" class="form-control">
                                    <option value="">__Chọn danh mục__</option>
                                    @if(isset($categories))
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{(isset($attribute->atb_category_id) ? $attribute->atb_category_id : '') == $category->id ? "selected= 'selected'" : ""}}>{{$category->c_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if($errors->first('atb_category_id'))
                                    <span class="text-danger">{{$errors->first('atb_category_id')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="box-footer text-center">
                                <a href="{{route('admin.attribute.index')}}" class="btn btn-danger">Quay lại <i class="fa fa-undo"></i></a>
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
