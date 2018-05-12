@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Bài Hát
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
                <form action="admin/baihat/sua/{{$baihat->id}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <div class="form-group">
                        <label>Tên Bài Hát</label>
                        <input class="form-control" name="ten" placeholder="Nhập tên bài hát" value="{{$baihat->ten}}"/>
                    </div>
                    <div class="form-group">
                        <label>Ca sĩ</label>
                        <select class="form-control" name="casi" id="casi">
                            @foreach($casi as $cs)
                                <option 
                                @if($baihat->casi->id == $cs->id)
                                    {{'selected'}}
                                @endif

                                value="{{$cs->id}}">{{$cs->ten}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Thể loại</label>
                        <select class="form-control" name="theloai" id="theloai">
                            @foreach($theloai as $tl)
                                <option 
                                @if($baihat->casi->theloai->id == $tl->id)
                                    {{'selected'}}
                                @endif
                                value="{{$tl->id}}">{{$tl->ten}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Lời bài hát</label>
                        <textarea id="demo" name="lyrics" class="form-control ckeditor" rows="3">
                            {{$baihat->lyrics}}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label>Karaoke</label>
                        <textarea id="demo" name="karaoke" class="form-control ckeditor" rows="5">
                            {{$baihat->karaoke}}
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label>Nhạc thường</label>
                        <p src="upload/baihat/nhacthuong/{{$baihat->urlthuong}}"></p>
                        <input type="file" name="thuong" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nhạc Vip</label>
                        <p src="upload/baihat/nhacvip/{{$baihat->urlvip}}"></p>
                        <input type="file" name="vip" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Ảnh</label>
                        <p><img width="400px" src="upload/baihat/images/{{$baihat->urlanh}}"></p>
                        <input type="file" name="anh" class="form-control">
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