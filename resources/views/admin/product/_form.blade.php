@csrf

<div class="card">
    <div class="card-body">

        <h4 class="card-title">Thông tin cơ bản</h4>
        <p class="card-title-desc">Vui lòng điền đầy đủ thông tin bên dưới</p>

        <div class="row">
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="name">Tên sản phẩm</label>
                    <input id="name" name="name" type="text" class="form-control" placeholder="Tên sản phẩm">
                    {!! $errors->first('name', '<span class="error d-block mt-2">:message</span>') !!}
                </div>
                <div class="mb-3">
                    <label for="file_path">Ảnh sản phẩm @if ($routeType == 'create')
                            <span class="text-danger">*</span>
                        @endif
                    </label>
                    <input id="file_path" name="file_path" type="file" class="form-control">
                    {!! $errors->first('file_path', '<span class="error d-block mt-2">:message</span>') !!}
                </div>
                <div class="mb-3">
                    <label for="price">Giá bán</label>
                    <input id="price" name="price" type="number" class="form-control" placeholder="Giá bán">
                    {!! $errors->first('price', '<span class="error d-block mt-2">:message</span>') !!}
                </div>
            </div>

            <div class="col-sm-6">
                <div class="mb-3">
                    <label class="control-label">Nhà cung cấp</label>
                    <select class="form-control select2" name="supplier_id">
                        <option>Chọn nhà cung cấp</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}"
                                {{ old('supplier_id', $data_edit->supplier_id ?? '') == $supplier->id ? 'selected' : '' }}>
                                {{ $supplier->name }}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('supplier_id', '<span class="error d-block mt-2">:message</span>') !!}
                </div>
                <div class="mb-3">
                    <label class="control-label">Danh mục</label>

                    <select class="select2 form-control select2-multiple" multiple="multiple"
                        data-placeholder="Chọn danh mục ...">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $data_edit->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('category_id', '<span class="error d-block mt-2">:message</span>') !!}
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
        <h4 class="card-title mb-3">Ảnh chi tiết sản phẩm</h4>

        <div action="#" class="dropzone">
            <div class="fallback">
                <input name="product_images" type="file" multiple="multiple">
            </div>
            <div class="dz-message needsclick">
                <div class="mb-3">
                    <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                </div>

                <h4>Thả tập tin vào đây hoặc nhấn vào để tải lên.</h4>
            </div>
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
        <h4 class="card-title mb-4">Biến thể</h4>
        <form class="repeater" enctype="multipart/form-data">
            <div data-repeater-list="group-a">
                <div data-repeater-item class="row">
                    <div class="mb-3 col-lg-3">
                        <label for="size">Size</label>
                        <input type="text" id="size" name="size" class="form-control" placeholder="S, M, L, XL, XXL, XXXL" />
                    </div>

                    <div class="mb-3 col-lg-3">
                        <label for="size">Color</label>
                        <input type="text" class="form-control" id="colorpicker-default" value="#50a5f1">
                    </div>

                    <div class="col-lg-1 align-self-end mb-3">
                        <div class="d-grid">
                            <input data-repeater-delete type="button" class="btn btn-danger" value="Delete" />
                        </div>
                    </div>
                </div>

            </div>
            <input data-repeater-create type="button" class="btn btn-success mt-3 mt-lg-0" value="Add" />
        </form>
    </div>
</div>
