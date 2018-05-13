@extends('pages.layouts.index')

@section('content')
<section class="s-content s-content--narrow s-content--no-padding-bottom">

	<article class="row format-audio">

		<div class="s-content__header col-full">

			@if(session('thongbao'))
			<div class="alert-box alert-box--success"> 
				{{session('thongbao')}}
			</div>
			@endif

			<h3 class="add-bottom" style="font-family: serif;">Thông tin người dùng</h3>

			<form method="POST" action="nguoidung" enctype="multipart/form-data">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div>
					<label for="sampleInput">Email</label>
					<input class="full-width" readonly name="email" type="email" value="{{ $user->email }}" id="sampleInput">
				</div>

				<div>
					<label for="sampleInput">Họ và tên</label>
					<input class="full-width" type="text" name="name" value="{{ $user->name }}" id="sampleInput">
				</div>

				<div>
					<input type="checkbox" id="changePassword" class="" name="changePassword">
					<label for="sampleInput">Mật khẩu</label>
					<input type="password" class="form-control password" name="password" id="password" placeholder="Enter your Password" aria-describedby="basic-addon1" disabled/>
				</div>

				<div>
					<label for="sampleInput">Nhập lại mật khẩu</label>
					<input type="password" class="form-control password" name="passwordAgain" id="confirm" placeholder="Confirm your Password" aria-describedby="basic-addon1" disabled/>
				</div>

				<div>
					<label for="sampleInput">Ảnh</label>
					<p><img width="200px" src="upload/user/{{$user->urlanh}}"></p>
                        <input type="file" name="urlanh" class="form-control">
				</div>

				<input class="btn--primary full-width" type="submit" value="Cập nhật thông tin">

			</form>

		</div>
	</article>

</section>
@endsection

@section('script')
	<script>
		$(document).ready(function(){
			$("#changePassword").change(function(){
				if($(this).is(":checked")) {
					$(".password").removeAttr('disabled');
				}
				else {
					$(".password").attr('disabled','');
				}
			});
		});
	</script>
@endsection