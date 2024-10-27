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
                    <li><a href="#" title="">Kids</a></li>
                    <li><a href="#" title="">Men</a></li>
                    <li><a href="#" title="">Images</a></li>
                    <li><a href="#" title="">Teens</a></li>
                    <li><a href="#" title="">Women</a></li>
                    <li><a href="#" title="">Color</a></li>
                    <li><a href="#" title="">Logo</a></li>
                    <li><a href="#" title="">Phrase</a></li>
                </ul>
            </div>
            <div class="col-md-5 col-sm-5 col-xs-12 pad20">
                <div class="row row10">
                    <div class="col-md-6 col-sm-6 col-xs-6 fashions pad10">
                        <a href="#" title="" class="c-img">
                            <img title="" src="{{ asset('assets/web/images/anh1-1.jpg') }}" alt="">
                        </a>
                        <div class="shirt">
                            <a href="#" title="">ÁO</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 fashions pad10">
                        <a href="#" title="" class="c-img">
                            <img title="" src="{{ asset('assets/web/images/anh1-1.jpg') }}" alt="">
                        </a>
                        <div class="trousers">
                            <a href="#" title="">QUẦN</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 fashions pad10">
                        <a href="#" title="" class="c-img">
                            <img title="" src="{{ asset('assets/web/images/anh2-2.jpg') }}" alt="">
                        </a>
                        <div class="shoes">
                            <a href="#" title="">GIẦY</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 fashions pad10">
                        <a href="#" title="" class="c-img">
                            <img title="" src="{{ asset('assets/web/images/anh2-3.jpg') }}" alt="">
                        </a>
                        <div class="accessories">
                            <a href="#" title="">PHỤ KIỆN</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 			Video			 -->
    <div class="container p-top50 pad20">
        <div class="row row20">
            <div class="col-md-7 col-sm-7 col-xs-12 pad20">
                <div class="video-big c-img">
                    <img title="" data-id="cnOIfm7imwQ" src="{{ asset('assets/web/images/video1.jpg') }}"
                        alt="">
                </div>
            </div>
            <div class="col-md-5 col-sm-5 col-xs-12 pad20">
                <div class="row row10">
                    <div class="col-md-6 col-sm-6 col-xs-6 pad10">
                        <div class="video-small c-img">
                            <img title="" src="{{ asset('assets/web/images/video2.jpg') }}" data-id="r7HA_9rKIMI"
                                alt="">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 pad10">
                        <div class="video-small c-img">
                            <img title="" src="{{ asset('assets/web/images/video2.jpg') }}" data-id="jqvmZMg4huo"
                                alt="">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 pad10">
                        <div class="video-small c-img">
                            <img title="" src="{{ asset('assets/web/images/video2.jpg') }}" data-id="iJP465wRjlM"
                                alt="">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 pad10">
                        <div class="video-small c-img">
                            <img title="" src="{{ asset('assets/web/images/video2.jpg') }}" data-id="x2ZdnWIzsno"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 			End Video			 -->

    <!-- 			SP bán chạy -->
    <div class="container p-top50">
        <h2 class="title-category">
            <a href="#" title="">SẢN PHẨM BÁN CHẠY</a>
        </h2>
        <div class="row p-top30">
            <div class="col-md-3 col-sm-3 col-xs-6 sp-hot">
                <a href="#" title="" class="c-img">
                    <img title="" src="{{ asset('assets/web/images/sp-ban-chay1.jpg') }}" alt="">
                </a>
                <div class="info-product">
                    <h3 class="title-product">
                        <a href="#" title="">SHORT SLEEVE T-SHIRT</a>
                    </h3>
                    <span class="price">5.000.000 VNĐ</span>
                    <form action="#">
                        <a href="#" title=""><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                        <button class="add">THÊM VÀO GIỎ</button>
                    </form>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 sp-hot">
                <a href="#" title="" class="c-img">
                    <img title="" src="{{ asset('assets/web/images/sp-ban-chay2.jpg') }}" alt="">
                </a>
                <div class="info-product">
                    <h3 class="title-product">
                        <a href="#" title="">SHORT SLEEVE T-SHIRT</a>
                    </h3>
                    <span class="price">5.000.000 VNĐ</span>
                    <form action="#">
                        <a href="#" title=""><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                        <button class="add">THÊM VÀO GIỎ</button>
                    </form>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 sp-hot">
                <a href="#" title="" class="c-img">
                    <img title="" src="{{ asset('assets/web/images/sp-ban-chay2.jpg') }}" alt="">
                </a>
                <div class="info-product">
                    <h3 class="title-product">
                        <a href="#" title="">SHORT SLEEVE T-SHIRT</a>
                    </h3>
                    <span class="price">5.000.000 VNĐ</span>
                    <form action="#">
                        <a href="#" title=""><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                        <button class="add">THÊM VÀO GIỎ</button>
                    </form>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 sp-hot">
                <a href="#" title="" class="c-img">
                    <img title="" src="{{ asset('assets/web/images/sp-ban-chay1.jpg') }}" alt="">
                </a>
                <div class="info-product">
                    <h3 class="title-product">
                        <a href="#" title="">SHORT SLEEVE T-SHIRT</a>
                    </h3>
                    <span class="price">5.000.000 VNĐ</span>
                    <form action="#">
                        <a href="#" title=""><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                        <button class="add">THÊM VÀO GIỎ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- 			End SP bán chạy -->

    <!-- 			SP Mới -->
    <div class="container p-top50 p-bot50">
        <h2 class="title-category bg-product-new">
            <a href="#" title="">SẢN PHẨM MỚI</a>
        </h2>
        <div class="row p-top30">
            <div class="col-md-3 col-sm-3 col-xs-6 sp-hot">
                <a href="#" title="" class="c-img">
                    <img title="" src="{{ asset('assets/web/images/sp-ban-chay3.jpg') }}" alt="">
                </a>
                <div class="info-product">
                    <h3 class="title-product">
                        <a href="#" title="">SHORT SLEEVE T-SHIRT</a>
                    </h3>
                    <span class="price">5.000.000 VNĐ</span>
                    <form action="#">
                        <a href="#" title=""><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                        <button class="add">THÊM VÀO GIỎ</button>
                    </form>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 sp-hot">
                <a href="#" title="" class="c-img">
                    <img title="" src="{{ asset('assets/web/images/sp-ban-chay3.jpg') }}" alt="">
                </a>
                <div class="info-product">
                    <h3 class="title-product">
                        <a href="#" title="">SHORT SLEEVE T-SHIRT</a>
                    </h3>
                    <span class="price">5.000.000 VNĐ</span>
                    <form action="#">
                        <a href="#" title=""><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                        <button class="add">THÊM VÀO GIỎ</button>
                    </form>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 sp-hot">
                <a href="#" title="" class="c-img">
                    <img title="" src="{{ asset('assets/web/images/sp-ban-chay3.jpg') }}" alt="">
                </a>
                <div class="info-product">
                    <h3 class="title-product">
                        <a href="#" title="">SHORT SLEEVE T-SHIRT</a>
                    </h3>
                    <span class="price">5.000.000 VNĐ</span>
                    <form action="#">
                        <a href="#" title=""><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                        <button class="add">THÊM VÀO GIỎ</button>
                    </form>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 sp-hot">
                <a href="#" title="" class="c-img">
                    <img title="" src="{{ asset('assets/web/images/sp-ban-chay3.jpg') }}" alt="">
                </a>
                <div class="info-product">
                    <h3 class="title-product">
                        <a href="#" title="">SHORT SLEEVE T-SHIRT</a>
                    </h3>
                    <span class="price">5.000.000 VNĐ</span>
                    <form action="#">
                        <a href="#" title=""><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                        <button class="add">THÊM VÀO GIỎ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- 			End SP Mới -->
@endsection
