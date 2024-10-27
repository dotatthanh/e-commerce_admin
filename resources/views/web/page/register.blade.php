@extends('web.layouts.master')
@section('content')
    <div class="container p-top50 p-bot50">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <h2 class="text-center m-bot50 h2">ĐĂNG KÝ</h2>
                <form action="{{ route('web.register') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-3">
                                <label for="name" class="control-label">Họ và tên: <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-xs-9">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Nhập họ và tên">
                                {!! $errors->first('name', '<span class="text-danger d-block mt-2">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-3">
                                <label for="email" class="control-label">Email: <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-xs-9">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Nhập email">
                                {!! $errors->first('email', '<span class="text-danger d-block mt-2">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-3">
                                <label for="phone_number" class="control-label">Số điện thoại:</label>
                            </div>
                            <div class="col-xs-9">
                                <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Nhập số điện thoại">
                                {!! $errors->first('phone_number', '<span class="text-danger d-block mt-2">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-3">
                                <label for="address" class="control-label">Địa chỉ:</label>
                            </div>
                            <div class="col-xs-9">
                                <input type="text" class="form-control" name="address" id="address" placeholder="Nhập địa chỉ">
                                {!! $errors->first('address', '<span class="text-danger d-block mt-2">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-3">
                                <label for="birthday" class="control-label">Ngày sinh:</label>
                            </div>
                            <div class="col-xs-9">
                                <input type="date" class="form-control" name="birthday" id="birthday">
                                {!! $errors->first('birthday', '<span class="text-danger d-block mt-2">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-3">
                                <label for="gender" class="control-label">Giới tính:</label>
                            </div>
                            <div class="col-xs-9 custom-line-height">
                                <label class="radio-inline" for="male">
                                    <input type="radio" name="gender" value="Nam" id="male" checked> Nam
                                </label>
                                <label class="radio-inline" for="female">
                                    <input type="radio" name="gender" value="Nữ" id="female"> Nữ
                                </label>
                                {!! $errors->first('birthday', '<span class="text-danger d-block mt-2">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-3">
                                <label for="password" class="control-label">Mật khẩu: <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-xs-9">
                                <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu">
                                {!! $errors->first('password', '<span class="text-danger d-block mt-2">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-3">
                                <label for="password_confirmation" class="control-label">Xác nhận mật khẩu: <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-xs-9">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Nhập lại mật khẩu">
                                {!! $errors->first('password_confirmation', '<span class="text-danger d-block mt-2">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block">Đăng ký</button>
                    <a href="{{ route('web.login') }}" class="btn btn-success btn-block">Đăng nhập</a>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css')
<style>
    .custom-line-height {
        line-height: 21px;
    }
</style>
@endsection
