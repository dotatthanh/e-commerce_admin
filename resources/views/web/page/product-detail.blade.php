@extends('web.layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="list-item">
                    <ul>
                        <li><a href="{{ route('web.home') }}" title=""><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li><a href="{{ route('web.category', $category->id) }}" title="">{{ $category->name }}</a></li>
                        <li>{{ $product->name }}</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <div class="slider-nav">
                            @foreach ($product->productImages as $image)
                                <img src="{{ asset($image->file_path) }}" alt="">
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <div class="slider-for">
                            @foreach ($product->productImages as $image)
                                <img src="{{ asset($image->file_path) }}" alt="">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-sm-5 col-xs-12 product-detail p-bot20">
                <form action="#">
                    <h2>{{ $product->name }}</h2>
                    <div class="stt">
                        <p>Tình trạng:</p> <span>{{ $product->quantity > 0 ? 'Còn hàng' : 'Hết hàng' }}</span>
                    </div>
                    <div class="price-product">
                        <p>Giá bán:</p> <span>{{ number_format($product->price) }}đ</span>
                    </div>
                    <div class="color">
                        <p>Màu sắc:</p>
                        @foreach ($product->getColors() as $variant)
                            @once
                                <input type="hidden" name="color_code" value="{{ $variant }}">
                                @php $colorCode = $variant; @endphp
                            @endonce
                            <a href="javascript:void(0)" title="{{ $variant }}" class="{{ $loop->first ? 'active' : '' }} item-color" style="background: {{ $variant }};" data-color-code="{{ $variant }}"></a> 
                        @endforeach
                    </div>
                    <div class="size">
                        <p>Size:</p> 
                        <select name="size" style="width: 150px;">
                            @foreach ($product->variants->where('color_code', $colorCode) as $variant)
                                <option value="{{ $variant->size }}">{{ $variant->size }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($product->quantity > 0)
                    <button type="submit" class="cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Thêm vào giỏ</button>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 product-info">
                <div class="border-bottom">
                    <h3>Thông tin sản phẩm</h3>
                    <div class="bg-color">
                        {!! $product->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 			SẢN PHẨM KHÁC			-->
    <div class="container p-top50 p-bot30">
        <h2 class="title-category">
            <a href="javascript:void(0)" title="">SẢN PHẨM KHÁC</a>
        </h2>
        <div class="row p-top30">
            @foreach ($otherProducts as $item)
                @include('web.components._product', [
                    'category' => $item->categories->shuffle()->first(),
                    'product' => $item,
                ])
            @endforeach
        </div>
    </div>
    <!-- 			End SẢN PHẨM KHÁC -->
@endsection

@section('script')
    <script>
        $(".item-color").on("click", function() {
            $(".item-color").removeClass("active");
            $(this).addClass("active");
            const colorCode = $(this).data("color-code");
            
            $.ajax({
                url: `/products/get-variants-by-color-code`,
                data: {
                    color_code: colorCode,
                    product_id: {{ $product->id }},
                },
                type: "POST"
            })
            .done(function (response) {
                if (response.data && response.data.length) {
                    loadSizes(response.data)
                }
            })
            .fail(function () {
                alert('Lỗi server!');
            });
        });

        function loadSizes(data) {
            let options = data.map(function (item) {
                return `<option value="${item.id}">${item.variant.size}</option>`;
            }).join('');

            $(`select[name=size]`).html(options);
        }
    </script>
@endsection