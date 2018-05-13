@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Bình luận
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
                        <th>Id bình luận</th>
                        <th>Id bình luận cha</th>
                        <th>Id người dùng</th>
                        <th>Id bài hát</th>
                        <th>Bình luận</th>
                        <th>Ngày tạo</th>
                        <th>Ngày sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comment as $cm)
                    <tr class="odd gradeX" align="center">
                        <td>{{$cm->id}}</td>
                        <td>{{$cm->parent_id}}</td>
                        <td>{{$cm->user_id}}</td>
                        <td>{{$cm->music_id}}</td>
                        <td>{{$cm->comment}}</td>
                        <td>{{$cm->created_at}}</td>
                        <td>{{$cm->updated_at}}</td>
                        <td class="center"><i class="fa fa-trash-o fa-fw"></i> <a href="admin/comment/xoa/{{$cm->id}}">Xóa</a></td>
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