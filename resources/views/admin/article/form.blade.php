<div class="row">
    <form action="" role="form" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-sm-8">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin cơ bản</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" name="a_name" placeholder="Iphone 5s..." autocomplete="off" value="{{$article->a_name ?? old('a_name')}}">
                        @if($errors->first('a_name'))
                            <span class="text-danger">{{$errors->first('a_name')}}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <textarea name="a_description" class="form-control" cols="5" rows="2" autocomplete="off" placeholder="Dang cập nhật">{{$article->a_description ?? old('a_description')}}</textarea>
                        @if($errors->first('a_description'))
                            <span class="text-danger">{{$errors->first('a_description')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label">Menu <b class="col-red">(*)</b></label>
                        <select name="a_menu_id" class="form-control">
                            <option value="">__Click__</option>
                            @foreach($menus as $menu)
                                <option value="{{$menu->id}}" {{($article->a_menu_id?? '') == $menu->id ? "selected='selected'" : ''}}>
                                    {{$menu->mn_name}}
                                </option>
                            @endforeach
                        </select>
                        @if($errors->first('a_menu_id'))
                            <span class="text-danger">{{$errors->first('a_menu_id')}}</span>
                        @endif
                    </div>

                </div>
            </div>

            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Nội dung</h3>
                </div>
                <div class="form-group">
                    <textarea name="a_content" id="content" cols="5" rows="2" class="form-control textarea">{{$article->a_content ?? old('a_content')}}</textarea>
                    @if($errors->first('a_content'))
                        <span class="text-danger">{{$errors->first('a_content')}}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Ảnh đại diện</h3>
                </div>

                <div class="form-group">
                    <img src="{{pare_url_file($article->a_avatar ?? '') }}" id="out_img" alt="" style="width: 100%"; height="250px" >
                </div>

                <div class="form-group">
                    <label for="a_avatar">Avatar:</label>
                    <input type="file" id="input_img" name="a_avatar" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="box-footer text-center">
                <a href="{{route('admin.article.index')}}" class="btn btn-danger">Quay lại <i class="fa fa-undo"></i></a>
                <button type="submit" class="btn btn-success"> {{isset($article) ? "Cập Nhật" : "Thêm Mới"}} <i class="fa fa-save"></i></button>
            </div>
        </div>
    </form>
</div>
<script src="{{asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('admin/ckeditor/ckeditor.js')}}"></script>
<script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
    CKEDITOR.replace( 'content',options );
</script>
