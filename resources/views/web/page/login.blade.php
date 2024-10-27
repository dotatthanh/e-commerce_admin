@extends('web.layouts.master')
@section('content')
    <div class="container p-top50 p-bot50">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <h2 class="text-center m-bot50 h2">Đăng Nhập</h2>
                <form action="{{ route('web.login') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-3">
                                <label for="email" class="control-label">Email:</label>
                            </div>
                            <div class="col-xs-9">
                                <input type="email" class="form-control" name="email" placeholder="Nhập email">
                                {!! $errors->first('email', '<span class="text-danger d-block mt-2">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-3">
                                <label for="password" class="control-label">Mật khẩu:</label>
                            </div>
                            <div class="col-xs-9">
                                <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu">
                                {!! $errors->first('password', '<span class="text-danger d-block mt-2">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block">Đăng Nhập</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('css')
<style>
    .d-block {
        display: block;
    }
    .mt-2 {
        margin-top: 10px;
    }
</style>
@endsection