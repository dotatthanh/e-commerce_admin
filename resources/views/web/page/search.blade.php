@extends('web.layouts.master')
@section('content')
    <!-- 			Tìm kiếm SP -->
    <div class="container p-top50 p-bot50">
        <h2 class="title-category">
            <a href="#" title="">TÌM KIẾM SẢN PHẨM</a>
        </h2>
        <div class="row p-top30">
            @foreach ($data as $item)
                @include('web.components._product', [
                    'category' => $item->categories->shuffle()->first(),
                    'product' => $item
                ])
            @endforeach
        </div>

        <div class="text-center">
            {{ $data->links() }}
        </div>
    </div>
@endsection
