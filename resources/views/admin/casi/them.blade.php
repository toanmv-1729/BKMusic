@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Ca Sĩ
                    <small>Thêm</small>
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
                <form action="admin/casi/them" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <div class="form-group">
                        <label>Tên Ca sĩ</label>
                        <input class="form-control" name="ten" placeholder="Nhập tên ca sĩ" />
                    </div>
                    
                    <div class="form-group">
                        <label>Thể loại</label>
                        <select class="form-control" name="theloai">
                            @foreach($theloai as $tl)
                                <option value="{{$tl->id}}"> {{$tl->ten}} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Thông tin</label>
                        <textarea id="demo" name="thongtin" class="form-control ckeditor" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Ảnh</label>
                        <input type="file" name="urlanh" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-default">Thêm</button>
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