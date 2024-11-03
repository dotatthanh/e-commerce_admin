@extends('web.layouts.master')
@section('content')
    <div class="container p-top50 p-bot50">
        <div class="row">
            <h2 class="text-center m-bot50 h2">LỊCH SỬ MUA HÀNG</h2>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 70px;" class="text-center">STT</th>
                            <th>Mã đơn hàng</th>
                            <th>Tổng tiền (VNĐ)</th>
                            <th>Giảm giá</th>
                            <th>Phương thức thanh toán</th>
                            <th>Trạng thái</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php ($stt = 1)
                        @foreach ($data as $item)
                        <tr>
                            <td class="text-center">{{ $stt++ }}</td>
                            <td>{{ $item->code }}</td>
                            <td>{{ number_format($item->total_money) }}</td>
                            <td>{{ number_format($item->discount) }}</td>
                            <td>{{ $item->payment_method }}</td>
                            <td>{{ $item->status }}</td>
                            <td class="text-center">
                                <ul class="list-unstyled hstack gap-1 mb-0">
                                    <li>
                                        <a href="{{ route('orders.show', $item->id) }}" class="btn btn-sm bg-info text-info">
                                            Chi tiết
                                        </a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($data->isEmpty())
                    <div class="text-center">Không tìm thấy đơn hàng</div>
                @endif
            </div>
        </div>
    </div>
@endsection
