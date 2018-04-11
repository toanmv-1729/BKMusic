@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Bài Hát
                    <small>Thêm</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
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
                <form action="admin/baihat/them" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <div class="form-group">
                        <label>Tên Bài Hát</label>
                        <input class="form-control" name="ten" placeholder="Nhập tên bài hát" />
                    </div>
                    <div class="form-group">
                        <label>Ca sĩ</label>
                        <select class="form-control" name="casi" id="casi">
                            @foreach($casi as $cs)
                                <option value="{{$cs->idCaSi}}">{{$cs->ten}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Thể loại</label>
                        <select class="form-control" name="theloai" id="theloai">
                            @foreach($casi as $cs)
                                <option value="{{$cs->idCaSi}}">{{$cs->ten}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Lời bài hát</label>
                        <textarea id="demo" name="lyrics" class="form-control ckeditor" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Karaoke</label>
                        <textarea id="demo" name="karaoke" class="form-control ckeditor" rows="5"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Nhạc thường</label>
                        <input type="file" name="thuong" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nhạc Vip</label>
                        <input type="file" name="vip" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Ảnh</label>
                        <input type="file" name="anh" class="form-control">
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