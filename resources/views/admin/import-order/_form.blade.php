@csrf

<div class="card">
    <div class="card-body">

        <h4 class="card-title">Thông tin cơ bản</h4>
        <p class="card-title-desc">Vui lòng điền đầy đủ thông tin bên dưới</p>

        <div class="row">
            <div class="col-sm-6">
                <label class="control-label">Nhà cung cấp <span class="text-danger">*</span></label>
                <select class="form-control select2" name="supplier_id">
                    <option value="">Chọn nhà cung cấp</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}"
                            {{ old('supplier_id', $data_edit->supplier_id ?? '') == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->name }}</option>
                    @endforeach
                </select>
                {!! $errors->first('supplier_id', '<span class="error d-block mt-2">:message</span>') !!}
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-4">Sản phẩm <span class="text-danger">*</span></h4>
        <div class="repeater" enctype="multipart/form-data">
            <div data-repeater-list="import_orders">
                @php
                    $importOrders = old('import_orders', isset($data_edit) ? $data_edit->import_orders : [['product_id' => null, 'variant_id' => null, 'quantity' => null]]);
                @endphp
                @foreach ($importOrders as $variant)
                    <div data-repeater-item class="row">
                        <div class="mb-3 col-lg-3 col-md-6">
                            <label>Sản phẩm <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="product_id" onchange="getVariants($(this))">
                                <option value="">Chọn sản phẩm</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}"
                                        {{ old('product_id', $data_edit->product_id ?? '') == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('import_orders.*.product_id', '<span class="error d-block mt-2">:message</span>') !!}
                        </div>

                        <div class="mb-3 col-lg-4 col-md-6">
                            <label>Size và màu <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="product_variant_id">
                                <option value="">Chọn size và màu</option>
                            </select>
                            {!! $errors->first('import_orders.*.variant_id', '<span class="error d-block mt-2">:message</span>') !!}
                        </div>

                        <div class="mb-3 col-lg-3 col-md-6">
                            <label>Số lượng <span class="text-danger">*</span></label>
                            <input type="number" name="quantity" class="form-control" placeholder="Nhập số lượng">
                            {!! $errors->first('import_orders.*.quantity', '<span class="error d-block mt-2">:message</span>') !!}
                        </div>

                        <div class="col-md-2 mb-3 align-self-end">
                            <div class="d-grid">
                                <input data-repeater-delete type="button" class="btn btn-danger" value="Xóa" />
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <input data-repeater-create type="button" class="btn btn-success mt-3 mt-lg-0" value="Thêm" />
        </div>
        {!! $errors->first('import_orders', '<span class="error d-block mt-2">:message</span>') !!}
    </div>
</div>

<div class="card">
    <div class="card-body">
        <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
    </div>
</div>

@section('css')
    <!-- select2 css -->
    <link href="{{ asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('script')
    <!-- select 2 plugin -->
    <script src="{{ asset('/assets/libs/select2/select2.min.js') }}"></script>

    <!-- init js -->
    <script src="{{ asset('/assets/js/pages/ecommerce-select2.init.js') }}"></script>

    <!-- form repeater js -->
    <script src="{{ asset('/assets/libs/jquery-repeater/jquery-repeater.min.js') }}"></script>

    <!-- repeater init js-->
    <script src="{{ asset('/assets/js/pages/import-order/form-repeater.int.js') }}"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function getVariants(self) {
            const index = self.attr('name').match(/import_orders\[(\d+)\]/)[1];
            const id = self.val()
            var select = $(`select[name="import_orders[${index}][product_variant_id]"]`);
            var defaultOption = '<option value="">Chọn size và màu</option>';

            select.html(defaultOption);

            if (!id) return;

            $.ajax({
                url: `/product/get-variants/${id}`,
                type: "POST"
            })
            .done(function (response) {
                if (response.data && response.data.length) {
                    let options = response.data.map(function (item) {
                        return `<option value="${item.id}">${item.variant.size} - ${item.variant.color_name}</option>`;
                    }).join('');

                    select.html(defaultOption + options);
                }
            })
            .fail(function () {
                alert('Lỗi server! Không thể tải danh sách biến thể.');
            });
        }
    </script>
@endsection