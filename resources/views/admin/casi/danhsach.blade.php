@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Ca Sĩ
                    <small>Danh Sách</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            @if(session('thongbao'))
                <div class="alert alert-success">
                    {{session('thongbao')}}
                </div>
            @endif
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Thể loại nhạc</th>
                        <th>Thông tin</th>
                        <th>Ảnh</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($casi as $cs)
                    <tr class="odd gradeX" align="center">
                        <td>{{$cs->id}}</td>
                        <td>{{$cs->ten}}</td>
                        <td>{{$cs->theloai->ten}}</td>
                        <td>{{ cutstring($cs->thongtin , 20) }}</td>
                        <td>
                            <img src="upload/casi/{{$cs->urlanh}}" width="60px">
                        </td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/casi/sua/{{$cs->id}}"> Sửa</a></td>
                        <td class="center"><i class="fa fa-trash-o fa-fw"></i> <a href="admin/casi/xoa/{{$cs->id}}">Xóa</a></td>
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