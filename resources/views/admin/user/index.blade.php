@extends('layouts.master')

@section('title')
    Danh sách nhân viên
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Nhân viên
        @endslot
        @slot('title')
            Danh sách nhân viên
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body border-bottom">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Danh sách nhân viên</h4>
                        {{-- @can('Thêm nhân viên') --}}
                            <div class="flex-shrink-0">
                                <a href="{{ route('users.create') }}" class="btn btn-primary">Thêm nhân viên</a>
                                <a href="{{ route('users.index') }}" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                            </div>
                        {{-- @endcan --}}
                    </div>
                </div>

                <form method="GET" id="filter-form" action="{{ route('users.index') }}" class="card-body border-bottom">
                    <div class="row g-3">
                        <div class="col-xxl-4 col-lg-6">
                            <input type="search" name="search" class="form-control" id="search" placeholder="Nhập họ và tên" value="{{ request()->search }}">
                        </div>
                        <div class="col-xxl-2 col-lg-4">
                            <button id="btn-search" class="btn bg-secondary bg-soft text-secondary w-100"><i class="mdi mdi-filter-outline align-middle"></i> Tìm kiếm</button>
                        </div>
                    </div>
                </form>

                <div class="card-body table-responsive">
                    <table class="table table-centered table-nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 70px;" class="text-center">STT</th>
                                <th>Mã</th>
                                <th>Ảnh đại diện</th>
                                <th>Họ và tên</th>
                                <th>Vai trò</th>
                                <th>Giới tính</th>
                                <th>Số điện thoại</th>
                                <th>Ngày sinh</th>
                                <th>Địa chỉ</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php ($stt = 1)
                            @foreach ($users as $user)
                                <tr>
                                    <td class="text-center">{{ $stt++ }}</td>
                                    <td>{{ $user->code }}</td>
                                    <td>
                                        @if ($user->avatar)
                                            <div>
                                                <img class="rounded-circle avatar-xs" src="{{ asset($user->avatar) }}" alt="">
                                            </div>
                                        @else
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle text-uppercase">
                                                    {{ substr($user->name, 0, 1) }}
                                                </span>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        @foreach ($user->roles as $role)
                                            <span class="badge bg-secondary">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $user->gender }}</td>
                                    <td>{{ $user->phone_number }}</td>
                                    <td>{{ date("d-m-Y", strtotime($user->birthday)) }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td class="text-center">
                                        @if ($user->id != 1)
                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                            {{-- @can('Xem thông tin nhân viên') --}}
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Xem thông tin nhân viên">
                                                <a href="{{ route('users.show', ['user' => $user->id]) }}" class="btn btn-sm bg-primary text-primary bg-soft">
                                                    <i class="mdi mdi-eye-outline"></i>
                                                </a>
                                            </li>
                                            {{-- @endcan --}}

                                            {{-- @can('Chỉnh sửa nhân viên') --}}
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Chỉnh sửa nhân viên">
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm bg-info text-info bg-soft">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </a>
                                            </li>
                                            {{-- @endcan --}}

                                            {{-- @can('Xóa nhân viên') --}}
                                            @if (auth()->id() != $user->id)
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Xóa nhân viên">
                                                <form id="delete-user-form-{{ $user->id }}" method="post" action="{{ route('users.destroy', $user->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" data-user="{{ $user->id }}" data-bs-toggle="modal" class="btn btn-sm bg-danger text-danger bg-soft btn-delete-user">
                                                        <i class="mdi mdi-delete-outline"></i>
                                                    </button>
                                                </form>
                                            </li>
                                            @endif
                                            {{-- @endcan --}}
                                        </ul>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if ($users->isEmpty())
                        <div class="text-center">Không tìm thấy nhân viên</div>
                    @endif
                </div>

                {{ $users->links() }}
            </div>
        </div>
    </div>

    @include('components.confirm-modal', ['title' => 'Xác nhận xóa nhân viên'])
@endsection

@section('script')
<script>
    $(document).ready(function() {
        function openConfirmModal(userId) {
            console.log('==> user id', userId)
            $('#confirmModal').modal('show');
            $('#confirmButton').data('user-id', userId);
            $('#confirmButton').on('click', function() {
                var userId = $(this).data('user-id');
                $(`#delete-user-form-${userId}`).submit();
            });
        }

        $('.btn-delete-user').on('click', function() {
            var userId = $(this).data('user');
            openConfirmModal(userId);
        });

        $('#btn-search').on('click', function() {
            $('#filter-form').attr('action', `{{ route('users.index') }}`);
            $('#filter-form').submit();
        });
    });
</script>
@endsection
