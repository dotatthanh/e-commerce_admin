@extends('layouts.master')

@section('title')
    Thêm sản phẩm
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Sản phẩm @endslot
        @slot('title') Thêm sản phẩm @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            {{-- <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data"> --}}

                @include('admin.product._form', ['routeType' => 'create'])

            {{-- </form> --}}
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
    {{-- <link href="{{ asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" /> --}}
    {{-- <link href="{{ asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css"> --}}
    <link href="{{ asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
    {{-- <link href="{{ asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css" /> --}}
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
    <script src="{{ asset('/assets/js/pages/form-repeater.int.js') }}"></script>

    <!-- colorpicker init js-->
    <script src="{{ asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.js') }}"></script>

    <script>
        $("#colorpicker-default").spectrum()
    </script>
@endsection
