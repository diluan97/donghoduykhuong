<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>Đồng Hồ Duy Khương</title>
	<meta charset="UTF-8">
	<meta name="description" content="Dong ho Duy Khuong">
	<meta name="keywords" content="donghoduykhuong, duykhuongwatch, donghodk">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta property="og:title" content="Dong ho Duy Khuong"/>
	<meta property="og:type" content="article" />
	<meta property="og:url" content="http://www.example.com/" />
	<meta property="og:image" content="http://example.com/image.jpg" />
	<meta property="og:description" content="Description Here" />
	<!-- Favicon -->   
	<link href="img/favicon.ico" rel="shortcut icon"/>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="{{asset('theplaza/css/bootstrap.min.css')}}"/>
	<link rel="stylesheet" href="{{asset('theplaza/css/font-awesome.min.css')}}"/>
	<link rel="stylesheet" href="{{asset('theplaza/css/owl.carousel.css')}}"/>
	<link rel="stylesheet" href="{{asset('theplaza/css/style.css')}}"/>	
	<link rel="stylesheet" href="{{asset('theplaza/css/animate.css')}}"/>
	<script src="{{asset('theplaza/js/jquery-3.2.1.min.js')}}"></script>
	

	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>
	
	<!-- Header section -->
	<header class="header-section" style="background:black">
		<div class="container-fluid">
			<!-- logo -->
			<div class="site-logo">
			    <a href="{{route('home')}}"><h4 style="font-family: 'Patrick Hand', cursive; color:white">Duy Khương</h4></a>
				<!-- <img src="img/logo.png" alt="logo"> -->
			</div>
			<!-- responsive -->
			<div class="nav-switch">
				<i class="fa fa-bars"></i>
			</div>
			<div class="header-right">
			@if(Auth::check())
				<a href="{{route('login_user')}}"style="margin-right:20px;color:white">{{Auth::user()->name}}</a>
				<a href="{{route('logout')}}"style="margin-right:20px;color:white; font-family:Verdana">Đăng xuất</a>
				@else
				<a href="{{route('login_user')}}"style="margin-right:20px;color:white; font-family:Verdana">Đăng nhập</a>
				<!-- <a href="{{route('login_user')}}"style="margin-right:20px;color:white; font-family:Verdana" >Đăng ký</a> -->
				@endif
				<a href="{{route('cart')}}" class="card-bag"><img src="{{asset('theplaza/img/icons/bag.png')}}" alt=""><span>{{Cart::count()}}</span></a>
				<!-- <a href="#" class="search"><img src="{{asset('theplaza/img/icons/search.png')}}" alt=""></a> -->
				
			</div>
			<!-- site menu -->
			<ul class="main-menu" >
				<li><a href="{{route('home')}}" style="font-family:Verdana">Trang chủ</a></li>
				<li><a href="{{route('getcontact')}}" style="font-family:Verdana">Liên hệ</a></li>
				<li><a href="{{route('policy')}}" style="font-family:Verdana">Chính sách</a></li>
				@if(Auth::check())
				<li><a href="{{route('history_order')}}" style="font-family:Verdana">Lịch sử mua hàng</a></li>
				@endif
				
			</ul>
		</div>
	</header>
	<!-- Header section end -->
	
<form action="{{route('login_client')}}"method="post">
@csrf
		<div class="modal fade" id="dangnhap" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			@include('layouts.component.modal_login')
	    </div>
</form>
<form action="{{route('register_client')}}" method="post">
@csrf
	<div class="modal fade" id="dangky" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Đăng ký</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				        <div>
							<label class="form-input">Tên khách hàng</label>
							<input type="name" class="form-control" name="name">
							@if ($errors->has('name'))
								<p class="help is-danger"style="color:red">{{ $errors->first('name') }}</p>
							@endif
						</div>
						<div>
							<label class="form-input">Email</label>
							<input type="email" class="form-control" name="email">
							@if ($errors->has('email'))
								<p class="help is-danger"style="color:red">{{ $errors->first('email') }}</p>
							@endif
						</div>
						<div>
							<label class="form-input">Mật khẩu</label>
							<input type="password" class="form-control" name="password">
							@if ($errors->has('password'))
								<p class="help is-danger"style="color:red">{{ $errors->first('password') }}</p>
							@endif
						</div>
						<div>
							<label class="form-input">Nhập lại mật khẩu</label>
							<input type="password" class="form-control" name="password_confirmation">
							@if ($errors->has('password_confirmation'))
								<p class="help is-danger"style="color:red">{{ $errors->first('password_confirmation') }}</p>
							@endif
						</div>
					
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-secondary" >Đăng ký</button>
			</div>
			</div>
		</div>
	</div>
</form>
@yield('content')

	<!-- Footer top section -->	
	<section class="footer-top-section home-footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-4 col-sm-12">
					<div class="footer-widget about-widget">
					<h4 style="color:white; margin-left:-10px">Địa chỉ</h4>
						<p style="color:white;font-family:Verdana; margin-left:-10px; padding-top:48px">150 Sư Vạn Hạnh, Phường 5, Quận 10</p>
						
					</div>
				</div>
				
				<div class="col-lg-2 col-md-4 col-sm-6">
					<div class="footer-widget">
						<h6 class="fw-title">VỀ CHÚNG TÔI</h6>
						<ul>
							<li>Facebook</li>
							<li>Instagram</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-2 col-md-4 col-sm-6">
					<div class="footer-widget">
						<h6 class="fw-title">TẢI ỨNG DỤNG</h6>
						<ul>
							<li>App Store</li>
							<li>Google Play</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-2 col-md-4 col-sm-8">
					<div class="footer-widget">
						<h6 class="fw-title">Liên hệ</h6>
						<ul>
							<li>Thứ 2 đến CN:9am-6pm</li>
							<li>Giao hàng & đặt hàng</li>
							<li>Trung tâm hỗ trợ</li>
							
						</ul>
					</div>
				</div>
				<div class="col-lg-2 col-md-4 col-sm-6">
					<div class="footer-widget">
						<h6 class="fw-title">Duy Khương</h6>
						<ul>
							<li>Tuyển dụng</li>
							<li>Chính sách</li>
							<li>Báo chí</li>
						</ul>
					</div>
				</div>
				
			</div>
		</div>
	</section>
	<!-- Footer top section end -->	

		<!-- Footer section -->
	<footer class="footer-section">
		<div class="container">
			<p class="copyright">
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</p>
		</div>
	</footer>
	<!-- Footer section end -->


	<!--====== Javascripts & Jquery ======-->
	<script src="{{asset('theplaza/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('theplaza/js/owl.carousel.min.js')}}"></script>
	<script src="{{asset('theplaza/js/mixitup.min.js')}}"></script>
	<script src="{{asset('theplaza/js/sly.min.js')}}"></script>
	<script src="{{asset('theplaza/js/jquery.nicescroll.min.js')}}"></script>
	<script src="{{asset('theplaza/js/main.js')}}"></script>
    </body>
</html>