@csrf

<div class="card">
    <div class="card-body">

        <h4 class="card-title">Thông tin cơ bản</h4>
        <p class="card-title-desc">Vui lòng điền đầy đủ thông tin bên dưới</p>

        <div class="row">
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="name">Tên sản phẩm <span class="text-danger">*</span></label>
                    <input id="name" name="name" type="text" class="form-control" placeholder="Tên sản phẩm">
                    {!! $errors->first('name', '<span class="error d-block mt-2">:message</span>') !!}
                </div>
                <div class="mb-3">
                    <label for="file_path">Ảnh sản phẩm @if ($routeType == 'create') <span class="text-danger">*</span> @endif
                    </label>
                    <input id="file_path" name="file_path" type="file" class="form-control">
                    {!! $errors->first('file_path', '<span class="error d-block mt-2">:message</span>') !!}
                </div>
                <div class="mb-3">
                    <label for="price">Giá bán <span class="text-danger">*</span></label>
                    <input id="price" name="price" type="number" class="form-control" placeholder="Giá bán">
                    {!! $errors->first('price', '<span class="error d-block mt-2">:message</span>') !!}
                </div>
            </div>

            <div class="col-sm-6">
                <div class="mb-3">
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
                <div class="mb-3">
                    <label id="categories" class="control-label">Danh mục <span class="text-danger">*</span></label>
                    <select
                        name="categories[]"
                        id="categories"
                        class="select2 select2-multiple form-control"
                        multiple
                        data-placeholder="Chọn danh mục ..."
                    >
                        @foreach ($categories as $item)
                            <option
                                {{ isset($data_edit) && in_array($item->id, $data_edit->categories->pluck('id')->toArray()) ?
                                'selected' : '' }}
                                value="{{ $item->id }}">
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                    {!! $errors->first('categories', '<span class="error d-block mt-2">:message</span>') !!}
                </div>
                <div class="mb-3">
                    <label for="sale">Khuyến mãi</label>
                    <div class="input-group">
                        <input id="sale" name="sale" type="number" class="form-control"
                            placeholder="Khuyến mãi">
                        <span class="input-group-text">%</span>
                    </div>
                    {!! $errors->first('sale', '<span class="error d-block mt-2">:message</span>') !!}
                </div>
            </div>
        </div>

    </div>
</div>

<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-3">Ảnh chi tiết sản phẩm <span class="text-danger">*</span></h4>

        <input type="text" hidden name="product_images">
        <div class="dropzone" id="dropzone">
            <div class="dz-message needsclick">
                <div class="mb-3">
                    <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                </div>

                <h4>Thả tập tin vào đây hoặc nhấn vào để tải lên.</h4>
            </div>
            @csrf
        </div>
        {!! $errors->first('product_images', '<span class="error d-block mt-2">:message</span>') !!}
    </div>

</div>

<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-3">Mô tả</h4>

        <textarea id="elm1" name="description"></textarea>
        {!! $errors->first('description', '<span class="error d-block mt-2">:message</span>') !!}
    </div>

</div>

<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-4">Biến thể <span class="text-danger">*</span></h4>
        <div class="repeater" enctype="multipart/form-data">
            <div data-repeater-list="variants">
                <div data-repeater-item class="row">
                    <div class="mb-3 col-lg-3">
                        <label>Size</label>
                        <input type="text" name="size" class="form-control" placeholder="S, M, L, XL, XXL, XXXL" />
                    </div>

                    <div class="mb-3 col-lg-3">
                        <label>Color</label>
                        <input type="text" name="color" class="form-control" id="colorpicker-default" value="#50a5f1">
                    </div>

                    <div class="col-lg-1 align-self-end mb-3">
                        <div class="d-grid">
                            <input data-repeater-delete type="button" class="btn btn-danger" value="Delete" />
                        </div>
                    </div>
                </div>

            </div>
            <input data-repeater-create type="button" class="btn btn-success mt-3 mt-lg-0" value="Add" />
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
    </div>
</div>
