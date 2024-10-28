@extends('web.layouts.master')
@section('content')
    <div class="container p-top50 p-bot50">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <h2 class="text-center m-bot50 h2">ĐỔI MẬT KHẨU</h2>
                <form action="{{ route('web.password.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-3">
                                <label for="email" class="control-label">Email: <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-xs-9">
                                <input type="email" class="form-control" name="email" placeholder="Nhập email" value="{{ old('email', $request->email) }}" autofocus>
                                {!! $errors->first('email', '<span class="text-danger d-block mt-2">:message</span>') !!}
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
                    
                    <button type="submit" class="btn btn-primary btn-block">Đổi mật khẩu</button>
                </form>
            </div>
        </div>
    </div>
@endsection
