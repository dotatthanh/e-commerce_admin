<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <a href="{{ route('web.home') }}" title="">
                        <img title="" class="img-responsive" src="{{ asset('assets/web/images/logo.jpg') }}"
                            alt="">
                    </a>
                    <h1>
                        <a href="{{ route('web.home') }}" title="">S-FASHION</a>
                    </h1>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="menu">
                        <button class="menu-btn" type="button"><i class="fa fa-bars" aria-hidden="true"></i></button>
                        <ul>
                            <li>
                                <a href="{{ route('web.home') }}" title="Trang chủ">Trang chủ</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" title="Sản phẩm">Sản phẩm</a>
                                <ul>
                                    @foreach ($categories as $category)
                                        <li><a href="{{ route('web.category', $category->id) }}"
                                                title="{{ $category->name }}">{{ $category->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            @if (auth()->guard('web')->check())
                                <li>
                                    <a href="javascript:void(0)" title="">Tài khoản</a>
                                    <ul>
                                        <li><a href="{{ route('web.profile') }}" title="Thông tin cá nhân">Thông tin cá
                                                nhân</a></li>
                                        <li><a href="{{ route('web.purchase-history') }}" title="Lịch sử mua hàng">Lịch
                                                sử mua hàng</a></li>
                                        <li><a href="{{ route('web.change-password') }}" title="Đổi mật khẩu">Đổi mật
                                                khẩu</a></li>
                                        <li>
                                            <a href="javascript:void();"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng
                                                xuất</a>
                                            <form id="logout-form" action="{{ route('web.logout') }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('web.login') }}" title="Đăng nhập">Đăng nhập</a>
                                </li>
                                <li>
                                    <a href="{{ route('web.register') }}" title="Đăng ký">Đăng ký</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <a href="{{ route('web.cart') }}" class="search">
                        <p>({{ $cart->count() }}) Sản phẩm</p>
                        <form action="{{ route('web.search') }}" method="get">
                            <input type="text" name="search" value="{{ request('search') }}">
                            <button type="submit">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </form>
                    </a>
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
                    <p><i class="fa fa-map-marker" aria-hidden="true"></i>Võ Quý Huân, P.Phúc Diễn, Q.Bắc Từ Liêm, Hà Nội
                    </p>
                    <p><i class="fa fa-phone-square" aria-hidden="true"></i>Bs.Vũ Trí Linh: <a
                            href="tel:0906 799 222">0906 799 222</a></p>
                    <a href="mailto:S-fashion@gmail.com" title=""><i class="fa fa-envelope"
                            aria-hidden="true"></i>S-fashion@gmail.com</a>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 guide">
                    <h2>CHÍNH SÁCH</h2>
                    <li>
                        <a href="{{ route('web.privacy-policy') }}" title="">Chính sách bảo mật</a>
                    </li>
                    <a href="{{ route('web.purchase-policy') }}" title="">Chính sách mua hàng</a>
                    </li>
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
