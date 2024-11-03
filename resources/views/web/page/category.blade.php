@extends('web.layouts.master')
@section('content')
    <!-- 			select 			 -->
    <div class="select">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form action="{{ route('web.category', $category->id) }}" method="GET" id="from-order">
                        <div class="category-product">
                            <p>{{ $category->name }}</p>
                        </div>
                        <div class="price-range">
                            <p>KHOẢNG GIÁ</p>
                            <input type="number" name="from" id="pricefrom" value="{{ request()->from ?? 0 }}"> - <input type="number" name="to" value="{{ request()->to ?? 20000000 }}">
                            <button type="submit"><i class="fa fa-caret-right" aria-hidden="true"></i></button>
                        </div>
                        <select name="order" onchange="orderPridce()">
                            <option value="">Lọc sắp xếp</option>
                            <option value="asc" {{ request()->order == 'asc' ? 'selected' : '' }}>Giá [Thấp - Cao]</option>
                            <option value="desc" {{ request()->order == 'desc' ? 'selected' : '' }}>Giá [Cao - Thấp]</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- 			End select 			 -->

    <!-- 			Products           -->
    <div class="container p-top20">
        <div class="row">
            @foreach ($data as $item)
                @include('web.components._product', [
                    'category' => $category,
                    'product' => $item,
                ])
            @endforeach
        </div>
    </div>
    <!-- 			End Products           -->

    <div class="text-center">
        {{ $data->links() }}
    </div>
@endsection

@section('script')
    <script>
        function orderPridce() {
            $("#from-order").submit();
        }
</script>
@endsection