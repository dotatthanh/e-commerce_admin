<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> @yield('title') | S-Fashion</title>
    @include('web.layouts.head-css')
</head>
<body>
	<head>
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="brand">
						<a href="#" title="">
							<i class="fa fa-facebook" aria-hidden="true"></i>
						</a>
						<a href="#" title="">
							<i class="fa fa-twitter" aria-hidden="true"></i>
						</a>
						<a href="#" title="">
							<i class="fa fa-instagram" aria-hidden="true"></i>
						</a>
						<a href="#" title="">
							<i class="fa fa-facebook" aria-hidden="true"></i>
						</a>
						<a href="#" title="">
							<i class="fa fa-twitter" aria-hidden="true"></i>
						</a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-12 logo">
					<a href="#" title="">
						<img title="" class="img-responsive" src="{{ asset('assets/web/images/logo.jpg') }}" alt="">
					</a>
					<h1>
						<a href="#" title="">S-FASHION</a>
					</h1>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="menu">
						<button class="menu-btn" type="button"><i class="fa fa-bars" aria-hidden="true"></i></button>
						<ul>
							<li>
								<a href="#" title="">Trang chủ</a> <!-- <i class="down fa fa-angle-down" aria-hidden="true"></i> -->
								<ul>
									<li>
										<a href="#" title="">Trang chủ</a>
									</li>
									<li>
										<a href="#" title="">Trang chủ</a>
									</li>
									<li>
										<a href="#" title="">Trang chủ</a>
									</li>
									<li>
										<a href="#" title="">Trang chủ</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="#" title="">Giới thiệu</a>
							</li>
							<li>
								<a href="#" title="">Sản phẩm</a>
							</li>
							<li>
								<a href="#" title="">Tin tức</a>
							</li>
							<li>
								<a href="#" title="">Liên hệ</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="search">
						<p>(0) Sản phẩm</p>
						<form action="{{ route('web.search') }}" method="get">
							<input type="text" name="search" value="{{ request('search') }}">
							<button type="submit">
								<i class="fa fa-search" aria-hidden="true"></i>
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</head>

	<!-- 			Content			 -->
    @yield('content')
	<!-- 			End Content			 -->
	
	<footer>
		<div class="container">
			<div class="row p-bot20">
				<div class="col-md-5 col-sm-5 col-xs-12 contact">
					<h2>LIÊN HỆ VỚI CHÚNG TÔI</h2>
					<p><i class="fa fa-map-marker" aria-hidden="true"></i>Võ Quý Huân, P.Phúc Diễn, Q.Bắc Từ Liêm Hà Nội</p>
					<p><i class="fa fa-phone-square" aria-hidden="true"></i>Bs.Vũ Trí Linh: <a href="tel:0906 799 222">0906 799 222</a></p>
					<a href="emailto:S-fashion@gmail.com" title=""><i class="fa fa-envelope" aria-hidden="true"></i>S-fashion@gmail.com</a>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12 guide">
					<h2>HƯỚNG DẪN SỬ DỤNG</h2>
					<a href="#" title="">Tìm kiếm</a>
					<a href="#" title="">Giới thiệu</a>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12 registry">
					<h2>ĐĂNG KÝ NGAY</h2>
					<p>Nhanh tay nhập email đăng ký để nhận ngay ưu đãi 100.000 vnđ khi mua sản phẩm</p>
					<form action="#">
						<input type="text">
						<button>Đăng ký</button>
					</form>
				</div>
			</div>
		</div>
		<div class="foot">
			<p>© 2024 - Ecommerce software by PrestaShop™</p>
		</div>
	</footer>

    @include('web.layouts.vendor-scripts')
</body>
</html>