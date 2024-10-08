@extends('layouts.master')

@section('title')
    Danh sách đơn nhập hàng
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Đơn nhập hàng
        @endslot
        @slot('title')
            Danh sách đơn nhập hàng
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body border-bottom">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Danh sách đơn nhập hàng</h4>
                        {{-- @can('Thêm đơn nhập hàng') --}}
                            <div class="flex-shrink-0">
                                <a href="{{ route('import-orders.create') }}" class="btn btn-primary">Thêm đơn nhập hàng</a>
                                <a href="{{ route('import-orders.index') }}" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                            </div>
                        {{-- @endcan --}}
                    </div>
                </div>

                <form method="GET" action="{{ route('import-orders.index') }}" class="card-body border-bottom">
                    <div class="row g-3">
                        <div class="col-xxl-4 col-lg-6">
                            <input type="search" name="search" class="form-control" id="search" placeholder="Nhập tên đơn nhập hàng" value="{{ request()->search }}">
                        </div>
                        <div class="col-xxl-2 col-lg-4">
                            <button type="submit" class="btn bg-secondary bg-soft text-secondary w-100"><i class="mdi mdi-filter-outline align-middle"></i> Tìm kiếm</button>
                        </div>
                    </div>
                </form>

                <div class="card-body table-responsive">
                    <table class="table table-centered table-nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 70px;" class="text-center">STT</th>
                                <th>Mã đơn nhập hàng</th>
                                <th>Nhà cung cấp</th>
                                <th>Tổng tiền (VNĐ)</th>
                                <th>Nhân viên nhập</th>
                                <th>Ngày nhập</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php ($stt = 1)
                            @foreach ($data as $item)
                            {{-- <tr>
                                <td class="text-center">{{ $stt++ }}</td>
                                <td class="text-center">
                                    <a href="{{ route('warehouses.show', $item->id) }}" class="text-primary">{{ $item->code }}</a>
                                </td>
                                <td>{{ $item->supplier->name }}</td>
                                <td class="text-center">{{ number_format($item->total_money) }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td class="text-center">{{ date_format($item->created_at, 'd/m/Y') }}</td>
                            </tr> --}}
                            @endforeach
                        </tbody>
                    </table>

                    @if ($data->isEmpty())
                        <div class="text-center">Không tìm thấy đơn nhập hàng</div>
                    @endif
                </div>

                {{ $data->links() }}
            </div>
        </div>
    </div>

    @include('components.confirm-modal', ['title' => 'Xác nhận xóa đơn nhập hàng'])
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.btn-delete-user').on('click', function() {
                const id = $(this).data('id');
                $('#confirmModal').modal('show');
                $('#confirmButton').on('click', function() {
                    $(`#delete-form-${id}`).submit();
                });
            });
        });
    </script>
@endsection
