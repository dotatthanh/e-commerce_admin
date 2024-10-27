@extends('web.layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="list-item">
                    <ul>
                        <li><a href="#" title=""><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li><a href="#" title="">Áo</a></li>
                        <li><a href="#" title="">Short sleeve t-shirt</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <div class="slider-nav">
                            <img src="theme/frontend/images/produc1.jpg" alt="">
                            <img src="theme/frontend/images/produc1.jpg" alt="">
                            <img src="theme/frontend/images/produc1.jpg" alt="">
                            <img src="theme/frontend/images/produc1.jpg" alt="">
                            <img src="theme/frontend/images/produc1.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <div class="slider-for">
                            <img src="theme/frontend/images/sp-ban-chay2.jpg" alt="">
                            <img src="theme/frontend/images/sp-ban-chay2.jpg" alt="">
                            <img src="theme/frontend/images/sp-ban-chay2.jpg" alt="">
                            <img src="theme/frontend/images/sp-ban-chay2.jpg" alt="">
                            <img src="theme/frontend/images/sp-ban-chay2.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-sm-5 col-xs-12 product-detail p-bot20">
                <form action="#">
                    <h2>SHORT SLEEVE T-SHIRT</h2>
                    <div class="stt">
                        <p>Tình trạng:</p> <span>Còn hàng</span>
                    </div>
                    <div class="product-code">
                        <p>Mã SP:</p> <span>42027</span>
                    </div>
                    <div class="price-product">
                        <p>Giá bán:</p> <span>280.000đ</span>
                    </div>
                    <div class="color">
                        <p>Màu sắc:</p> <a href="#" title=""></a>
                        <p>Nhập mã màu: </p> <input type="text">
                    </div>
                    <div class="size">
                        <p>Size:</p> <input type="text">
                    </div>
                    <div class="amount">
                        <p>Số lượng:</p> <input type="number" value="1">
                    </div>
                </form>
                <a href="#" title="" class="product-other">Sản phẩm khác</a>
                <a href="#" title="" class="cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Giỏ
                    hàng</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 product-info">
                <div class="border-bottom">
                    <h3>Thông tin sản phẩm</h3>
                    <div class="bg-color">
                        <p>The history of T-shirt is very interesting. The T-shirt has been a part of clothing since ancient
                            Egypt. A type of modern T-shirt was developed in England in the end of 19th century. The idea of
                            a T-shirt came to the USA during the World War II when American soldiers saw the cotton
                            undershirts of European soldiers. That is a short story of T-shirts origin.</p>
                        <p>Actually this part of clothes is very unique and original. It is a way of self-expression because
                            nowadays making some logo or phrase has become very popular. Obviously the T-shirts are the part
                            of modern culture and they have a great influence on teens because of their freedom and epatage.
                        </p>
                        <p>We are offering you our unique and original products. Our store has a largest choice of different
                            high quality T-shirts. You can buy them at a fair price and get special discount which means
                            that our shop is saving your money. We know that our products have such advantages as premium
                            quality and original design.</p>
                        <p>And our products are the perfect combination of attractive design and real good content. It is
                            really a product of a new generation. We promise that with our goods you will always be
                            fashionable and stylish. For those people who don’t care about fashion we may offer some
                            interesting design versions.</p>
                        <p>Well, don’t waste your time on hesitations and make you first purchase in our store right now!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- 			Phụ kiện			-->
    <div class="container p-top50 p-bot30">
        <h2 class="title-category">
            <a href="#" title="">PHỤ KIỆN</a>
        </h2>
        <div class="row p-top30">
            <div class="col-md-3 col-sm-3 col-xs-6 sp-hot">
                <a href="#" title="" class="c-img">
                    <img title="" src="theme/frontend/images/sp-ban-chay1.jpg" alt="">
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
                    <img title="" src="theme/frontend/images/sp-ban-chay2.jpg" alt="">
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
                    <img title="" src="theme/frontend/images/sp-ban-chay2.jpg" alt="">
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
                    <img title="" src="theme/frontend/images/sp-ban-chay1.jpg" alt="">
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
    <!-- 			End Phụ kiện -->
@endsection
