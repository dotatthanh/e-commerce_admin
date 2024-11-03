@extends('web.layouts.master')
@section('content')
    <div class="container p-top50 p-bot50">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <h2 class="text-center m-bot50 h2">THÔNG TIN CÁ NHÂN</h2>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td scope="row">Họ và tên :</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td scope="row">Gới tính :</td>
                                <td>{{ $user->gender }}</td>
                            </tr>
                            <tr>
                                <td scope="row">Số điện thoại :</td>
                                <td>{{ $user->phone_number }}</td>
                            </tr>
                            <tr>
                                <td scope="row">E-mail :</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td scope="row">Ngày sinh :</td>
                                <td>{{ date("d-m-Y", strtotime($user->birthday)) }}</td>
                            </tr>
                            <tr>
                                <td scope="row">Địa chỉ :</td>
                                <td>{{ $user->address }}</td>
                            </tr>
                            @if ($user->role == 'Tài xế')
                            <tr>
                                <td scope="row">Căn cước công dân :</td>
                                <td>{{ $user->citizen_id }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
