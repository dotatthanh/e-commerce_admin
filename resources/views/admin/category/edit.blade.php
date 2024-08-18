@extends('layouts.master')

@section('title')
    Cập nhật danh mục sản phẩm
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Danh mục sản phẩm
        @endslot
        @slot('title')
            Cập nhật danh mục sản phẩm
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Cập nhật danh mục sản phẩm</h4>

                    <form method="POST" action="{{ route('categories.update', $data_edit->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @include('admin.category._form', ['routeType' => 'edit'])

                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection

@section('script')
    <!-- datepicker css -->
    <script src="{{ asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- select 2 plugin -->
    <script src="{{ asset('assets\libs\select2\select2.min.js') }}"></script>

    <!-- init js -->
    <script src="{{ asset('assets\js\pages\ecommerce-select2.init.js') }}"></script>
@endsection

@section('css')
    <!-- datepicker css -->
    <link href="{{ asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <!-- select2 css -->
    <link href="{{ asset('assets\libs\select2\select2.min.css') }}" rel="stylesheet" type="text/css">
@endsection
