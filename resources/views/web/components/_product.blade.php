<div class="col-md-3 col-sm-3 col-xs-6 sp-hot p-bot50">
    <a href="{{ route('web.product-detail', ['category' => $category->id, 'product' => $product->id]) }}" title="" class="c-img">
        <img title="" src="{{ asset($product->file_path) }}" alt="">
    </a>
    <div class="info-product">
        <h3 class="title-product">
            <a href="#" title="">{{ $product->name }}</a>
        </h3>
        <span class="price">{{ $product->price }} VNĐ</span>
        <form action="#">
            <a href="#" title=""><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
            <button class="add">THÊM VÀO GIỎ</button>
        </form>
    </div>
</div>