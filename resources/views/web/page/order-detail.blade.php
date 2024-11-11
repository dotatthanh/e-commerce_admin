@extends('web.layouts.master')
@section('content')
    <div class="container p-top50 p-bot50">
        <div class="row">
            <h2 class="text-center m-bot50 h2">CHI TIẾT ĐƠN HÀNG</h2>

            <div>Mã đơn hàng: {{ $order->code }}</div>
            <div>Tên khách hàng: {{ $order->customer->name }}</div>
            <div>Phương thức thanh toán: {{ $order->payment_method }}</div>
            <div class="m-bot10">Trạng thái: {{ $order->status }}</div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 70px;" class="text-center">STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Size - Màu</th>
                            <th>Số lượng</th>
                            <th>Giá (VNĐ)</th>
                            <th>Giảm giá (VNĐ)</th>
                            <th>Thành tiền (VNĐ)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php ($stt = 1)
                        @foreach ($data as $item)
                        <tr>
                            <td class="text-center">{{ $stt++ }}</td>
                            <td>{{ $item->productVariant->product->name }}</td>
                            <td>{{ $item->productVariant->variant->size }} - {{ $item->productVariant->variant->color_name }}</td>
                            <td class="text-center">{{ number_format($item->quantity) }}</td>
                            <td class="text-center">{{ number_format($item->price) }}</td>
                            <td class="text-center">{{ number_format($item->sale) }}</td>
                            <td class="text-center">{{ number_format($item->total_money) }}</td>
                        </tr>
                        @endforeach
                        <tr class="font-weight-bold">
                            <td colspan="6" class="text-right">Tổng tiền</td>
                            <td class="fw-bold text-center">{{ number_format($order->total_money) }}</td>
                        </tr>
                    </tbody>
                </table>
                @if ($data->isEmpty())
                    <div class="text-center">Không tìm thấy đơn hàng</div>
                @endif
            </div>
        </div>
    </div>
@endsection
