@extends('web.layouts.master')
@section('content')
    <div class="container p-top50 p-bot50">
        <div class="row">
            <h2 class="text-center m-bot50 h2">THANH TOÁN</h2>
            <form action="{{ route('web.checkout') }}" method="POST">
                @csrf
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 70px;" class="text-center">STT</th>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($stt = 1)
                            @foreach ($cart as $rowId => $item)
                                <tr>
                                    <td class="text-center">{{ $stt++ }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ number_format($item->price) }} VNĐ</td>
                                    <td>{{ number_format($item->qty * $item->price) }} VNĐ</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" class="text-right">Tổng cộng</td>
                                <td>{{ number_format($total) }} VNĐ</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="row form-group">
                    <div class="col-xs-9 col-md-3">
                        <input type="text" name="discount_code" placeholder="Nhập mã giảm giá" class="form-control">
                    </div>
                    <div class="col-xs-3 col-md-3">
                        <button tupe="submit" class="btn btn-primary">Kiểm tra</button>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xs-9 col-md-3">
                        <select name="payment_method" class="form-control">
                            <option value="Thanh toán khi nhận hàng">Thanh toán khi nhận hàng</option>
                            <option value="Thanh toán VnPay">Thanh toán VnPay</option>
                        </select>
                    </div>
                </div>
                <div class="float-right">
                    <button tupe="submit" class="btn btn-primary">Thanh toán</button>
                </div>
            </form>
        </div>
    </div>
@endsection
