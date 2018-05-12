<!DOCTYPE html>
<html lang="en">
<head>
	<title>Đăng nhập hệ thống BKMp3</title>
	<meta charset="UTF-8">
	<base href="{{asset('')}}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="pages/login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="pages/login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="pages/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="pages/login/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="pages/login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="pages/login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="pages/login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="pages/login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="pages/login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="pages/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="pages/login/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" role="form" action="dangnhap" method="POST">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<span class="login100-form-title p-b-26" style="font-family: serif;">
						Đăng nhập
					</span>
					<span class="login100-form-title p-b-48">
						<i class="zmdi zmdi-font"></i>
					</span>

					@if(count($errors) > 0)
					<div class="alert alert-danger">
						@foreach($errors->all() as $err)
						{{$err}}<br>
						@endforeach()
					</div>
					@endif

					@if(session('thongbao'))
					<div class="alert alert-danger">
						{{session('thongbao')}}
					</div>                        
					@endif

					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="text" name="email">
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Mật khẩu"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Đăng nhập
							</button>
						</div>
					</div>

					<div class="text-center p-t-115">
						<span class="txt1">
							Bạn chưa có tài khoản?
						</span>

						<a class="txt2" href="dangky">
							Đăng ký ngay
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="pages/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="pages/login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="pages/login/vendor/bootstrap/js/popper.js"></script>
	<script src="pages/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="pages/login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="pages/login/vendor/daterangepicker/moment.min.js"></script>
	<script src="pages/login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="pages/login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="pages/login/js/main.js"></script>

</body>
</html>