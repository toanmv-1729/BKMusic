@extends('admin.layout.index')
@section('content')

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Bài hát
                    <small>Danh sách</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            
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

            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>STT</th>
                        <th>Tên bài hát</th>
                        <th>Thể loại</th>
                        <th>Ca sĩ</th>
                        <th>Lời bài hát</th>
                        <th>Số lượt nghe</th>
                        <th>Số lượt tải</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=0 @endphp
                    @foreach($baihat as $bh)
                    <tr class="odd gradeX" align="center">
                        <td>@php echo ++$i @endphp</td>
                        <td>{{$bh->ten}}</td>
                        <td>{{$bh->casi->theloai->ten}}</td>
                        <td>{{$bh->casi->ten}}</td>
                        <td>{{$bh->lyrics}}</td>
                        <td>{{$bh->luotnghe}}</td>
                        <td>{{$bh->luottai}}</td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/baihat/sua/{{$bh->id}}"> Sửa</a></td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/baihat/xoa/{{$bh->id}}"> Xóa</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
        <!-- /#page-wrapper -->
@endsection