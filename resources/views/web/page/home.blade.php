@extends('web.layouts.master')
@section('content')
    <div class="container p-top50 pad20">
        <div class="row row20">
            <div class="col-md-7 col-sm-7 col-xs-12 pad20">
                <div class="slider-noibat">
                    <div><a href="#" class="c-img" title=""><img title=""
                                src="{{ asset('assets/web/images/anh-noi-bat.jpg') }}" alt=""></a></div>
                    <div><a href="#" class="c-img" title=""><img title=""
                                src="{{ asset('assets/web/images/anh1-1.jpg') }}" alt=""></a></div>
                    <div><a href="#" class="c-img" title=""><img title=""
                                src="{{ asset('assets/web/images/anh2-2.jpg') }}" alt=""></a></div>
                    <div><a href="#" class="c-img" title=""><img title=""
                                src="{{ asset('assets/web/images/anh2-3.jpg') }}" alt=""></a></div>
                </div>
                <ul class="category">
                    @foreach ($categories as $category)
                        <li><a href="{{ route('web.category', $category->id) }}"
                                title="{{ $category->name }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-5 col-sm-5 col-xs-12 pad20">
                <div class="row row10">
                    <div class="col-md-6 col-sm-6 col-xs-6 fashions pad10">
                        <a href="{{ route('web.category', 1) }}" title="Áo" class="c-img">
                            <img title="Áo" src="{{ asset('assets/web/images/anh1-1.jpg') }}" alt="">
                        </a>
                        <div class="shirt">
                            <a href="{{ route('web.category', 1) }}" title="Áo">ÁO</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 fashions pad10">
                        <a href="{{ route('web.category', 2) }}" title="Quần" class="c-img">
                            <img title="Quần" src="{{ asset('assets/web/images/anh1-1.jpg') }}" alt="">
                        </a>
                        <div class="trousers">
                            <a href="{{ route('web.category', 2) }}" title="Quần">QUẦN</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 fashions pad10">
                        <a href="{{ route('web.category', 3) }}" title="Giày" class="c-img">
                            <img title="Giày" src="{{ asset('assets/web/images/anh2-2.jpg') }}" alt="">
                        </a>
                        <div class="shoes">
                            <a href="{{ route('web.category', 3) }}" title="Giày">GIÀY</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 fashions pad10">
                        <a href="{{ route('web.category', 4) }}" title="Phụ kiện" class="c-img">
                            <img title="Phụ kiện" src="{{ asset('assets/web/images/anh2-3.jpg') }}" alt="">
                        </a>
                        <div class="accessories">
                            <a href="{{ route('web.category', 4) }}" title="Phụ kiện">PHỤ KIỆN</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 			SP bán chạy -->
    <div class="container p-top50">
        <h2 class="title-category">
            SẢN PHẨM BÁN CHẠY
        </h2>
        <div class="row p-top30">
            @foreach ($bestSellingProducts as $item)
                @include('web.components._product', [
                    'product' => $item,
                ])
            @endforeach
        </div>
    </div>
    <!-- 			End SP bán chạy -->

    <!-- 			SP Mới -->
    <div class="container p-top50 p-bot50">
        <h2 class="title-category bg-product-new">
            SẢN PHẨM MỚI
        </h2>
        <div class="row p-top30">
            @foreach ($newProducts as $item)
                @include('web.components._product', [
                    'product' => $item,
                ])
            @endforeach
        </div>
    </div>
    <!-- 			End SP Mới -->

    <!-- 			Gợi ý mua hàng -->
    <div class="container p-top50">
        <h2 class="title-category">
            GỢI Ý MUA HÀNG
        </h2>
        <div class="row p-top30">
            @foreach ($suggestedProducts as $item)
                @include('web.components._product', [
                    'product' => $item,
                ])
            @endforeach
        </div>
    </div>
    <!-- 			End Gợi ý mua hàng -->
@endsection
