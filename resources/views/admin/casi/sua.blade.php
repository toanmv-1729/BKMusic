@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Ca Sĩ
                    <small>Sửa</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-10" style="padding-bottom:120px">
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                            {{$err}}<br>
                        @endforeach()
                    </div>
                @endif
                @if(session('thongbao'))
                    <div class="alert alert-success"> 
                        {{session('thongbao')}}
                    </div>
                @endif
                <form action="admin/casi/sua/{{$casi->id}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <div class="form-group">
                        <label>Tên Ca sĩ</label>
                        <input class="form-control" name="ten" placeholder="Nhập tên ca sĩ" value="{{ $casi->ten }}" />
                    </div>
                    <div class="form-group">
                        <label>Thể Loại Nhạc</label>
                        <select class="form-control" name="theloai">
                            @foreach($theloai as $tl)
                                <option
                                    @if($casi->idtheloai == $tl->id)
                                        {{"selected"}}
                                    @endif
                                    value="{{$tl->id}}">{{$tl->ten}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Thông tin</label>
                        <textarea id="demo" name="thongtin" class="form-control ckeditor" rows="3">{{ $casi->thongtin }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Ảnh</label>
                        <p><img width="400px" src="upload/casi/{{$casi->urlanh}}"></p>
                        <input type="file" name="urlanh" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-default">Sửa</button>
                    <button type="reset" class="btn btn-default">Làm mới</button>
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection