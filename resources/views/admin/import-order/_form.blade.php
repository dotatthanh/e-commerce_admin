@csrf

<div class="card">
    <div class="card-body">

        <h4 class="card-title">Thông tin cơ bản</h4>
        <p class="card-title-desc">Vui lòng điền đầy đủ thông tin bên dưới</p>

        <div class="row">
            <div class="col-sm-6 mb-3">
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
            <div data-repeater-list="variants">
                @if (old('variants'))
                    @foreach (old('variants') as $variant)
                        <div data-repeater-item class="row">
                            <div class="mb-3 col-lg-3">
                                <label>Size <span class="text-danger">*</span></label>
                                <input type="text" name="size" class="form-control"  placeholder="S, M, L, XL, XXL, XXXL" value="{{ $variant['size'] }}" />
                                {!! $errors->first('variants.*.size', '<span class="error d-block mt-2">:message</span>') !!}
                            </div>

                            <div class="mb-3 col-lg-3">
                                <label>Màu <span class="text-danger">*</span></label>
                                <input type="text" name="color" class="form-control colorpicker-default" value="{{ $variant['color'] }}" />
                                {!! $errors->first('variants.*.color', '<span class="error d-block mt-2">:message</span>') !!}
                            </div>

                            <div class="col-lg-1 align-self-end mb-3">
                                <div class="d-grid">
                                    <input data-repeater-delete type="button" class="btn btn-danger" value="Xóa" />
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div data-repeater-item class="row">
                        <div class="mb-3 col-lg-3">
                            <label>Size <span class="text-danger">*</span></label>
                            <input type="text" name="size" class="form-control"  placeholder="S, M, L, XL, XXL, XXXL" />
                        </div>

                        <div class="mb-3 col-lg-3">
                            <label>Màu <span class="text-danger">*</span></label>
                            <input type="text" name="color"  class="form-control colorpicker-default">
                        </div>

                        <div class="col-lg-1 align-self-end mb-3">
                            <div class="d-grid">
                                <input data-repeater-delete type="button" class="btn btn-danger" value="Xóa" />
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <input data-repeater-create type="button" class="btn btn-success mt-3 mt-lg-0" value="Thêm" />
        </div>
        {!! $errors->first('variants', '<span class="error d-block mt-2">:message</span>') !!}
    </div>
</div>

<div class="card">
    <div class="card-body">
        <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
    </div>
</div>
