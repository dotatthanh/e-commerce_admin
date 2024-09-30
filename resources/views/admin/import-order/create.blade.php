@extends('layouts.master')

@section('title')
    Thêm đơn nhập hàng
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Đơn nhập hàng @endslot
        @slot('title') Thêm đơn nhập hàng @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <form method="POST" action="{{ route('import-orders.store') }}" enctype="multipart/form-data">

                @include('admin.import-order._form', ['routeType' => 'create'])

            </form>
        </div>
    </div>
    <!-- end row -->

@endsection

@section('css')
    <!-- select2 css -->
    <link href="{{ asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- dropzone css -->
    <link href="{{ asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- colorpicker css -->
    <link href="{{ asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('script')
    <!-- select 2 plugin -->
    <script src="{{ asset('/assets/libs/select2/select2.min.js') }}"></script>

    <!-- dropzone plugin -->
    <script src="{{ asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>

    <!-- init js -->
    <script src="{{ asset('/assets/js/pages/ecommerce-select2.init.js') }}"></script>

    <!--tinymce js-->
    <script src="{{ asset('/assets/libs/tinymce/tinymce.min.js') }}"></script>

    <!-- init js -->
    <script src="{{ asset('/assets/js/pages/form-editor.init.js') }}"></script>

    <!-- form repeater js -->
    <script src="{{ asset('/assets/libs/jquery-repeater/jquery-repeater.min.js') }}"></script>

    <!-- repeater init js-->
    <script src="{{ asset('/assets/js/pages/product/form-repeater.int.js') }}"></script>

    <!-- colorpicker init js-->
    <script src="{{ asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.js') }}"></script>
@endsection
