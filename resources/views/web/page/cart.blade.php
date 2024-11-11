@extends('web.layouts.master')
@section('content')
    <div class="container p-top50 p-bot50">
        <div class="row">
            <h2 class="text-center m-bot50 h2">GIỎ HÀNG</h2>
            <form action="{{ route('web.update-cart') }}" method="POST">
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
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($stt = 1)
                            @foreach ($cart as $rowId => $item)
                                <tr>
                                    <td class="text-center">{{ $stt++ }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td style="width: 200px">
                                        <input type="hidden" name="cart[{{ $rowId }}][product_variant_id]"
                                            value="{{ $item->id }}">
                                        <input type="text" name="cart[{{ $rowId }}][qty]" class="form-control"
                                            value="{{ $item->qty }}">
                                    </td>
                                    <td>{{ number_format($item->price) }} VNĐ</td>
                                    <td>{{ number_format($item->qty * $item->price) }} VNĐ</td>
                                    <td class="text-center">
                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                            <li>
                                                <button type="button" onclick="deleteCartItem('{{ $rowId }}')"
                                                    class="btn btn-sm bg-danger">Xóa</button>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                            @if (!$cart->isEmpty())
                                <tr>
                                    <td colspan="4" class="text-right">Tổng cộng</td>
                                    <td colspan="2">{{ number_format($total) }} VNĐ</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    <div class="float-right">
                        <button tupe="submit" class="btn btn-primary">Cập nhật</button>
                        @if (!$cart->isEmpty())
                            <a href="{{ route('web.view-checkout') }}" class="btn btn-primary">Thanh toán</a>
                        @endif
                    </div>
                    @if ($cart->isEmpty())
                        <div class="text-center">Không tìm thấy đơn hàng</div>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function deleteCartItem(rowId) {
            if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
                $.ajax({
                        url: `/xoa-san-pham-gio-hang/${rowId}`,
                        type: "POST"
                    })
                    .done(function(response) {
                        location.reload();
                    })
                    .fail(function() {
                        alert('Lỗi server! Không thể tải danh sách biến thể.');
                    });
            }
        }
    </script>
@endsection
