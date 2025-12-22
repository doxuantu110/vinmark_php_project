@extends('layouts.admin')

@section('title', 'Thêm sản phẩm')

@section('content')
    <div class="right_col" role="main">

        <div class="page-title">
            <div class="title_left">
                <h3 class="fw-bold">Thêm sản phẩm</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row justify-content-center mt-3">
            <div class="col-md-10 col-sm-12">

                <div class="x_panel shadow-sm" style="border-radius: 10px;">
                    <div class="x_title">
                        <h2 class="fw-bold">Thông tin sản phẩm mới</h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">

                        <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data" class="mt-3">
                            @csrf

                            {{-- NAME --}}
                            <div class="form-group mb-4 row">
                                <label class="col-md-3 col-form-label fw-semibold" for="product-name">
                                    Tên sản phẩm <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-7">
                                    <input type="text" id="product-name" name="name"
                                        class="form-control border rounded" required>
                                </div>
                            </div>

                            {{-- DESCRIPTION --}}
                            <div class="form-group mb-4 row">
                                <label class="col-md-3 col-form-label fw-semibold">Mô tả <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <textarea name="description" id="product-description" class="form-control border rounded" rows="3" required></textarea>
                                </div>
                            </div>

                            {{-- PRICE --}}
                            <div class="form-group mb-4 row">
                                <label class="col-md-3 col-form-label fw-semibold" for="product-price">
                                    Giá <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-7">
                                    <input type="number" name="price" id="product-price"
                                        class="form-control border rounded" step="1000" required>
                                </div>
                            </div>

                            {{-- QUANTITY --}}
                            <div class="form-group mb-4 row">
                                <label class="col-md-3 col-form-label fw-semibold" for="product-quantity">
                                    Số lượng
                                </label>
                                <div class="col-md-7">
                                    <input type="number" name="stock" id="product-quantity"
                                        class="form-control border rounded">
                                </div>
                            </div>

                            {{-- UNIT --}}
                            <div class="form-group mb-4 row">
                                <label class="col-md-3 col-form-label fw-semibold" for="product-unit">
                                    Đơn vị <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-7">
                                    <input type="text" name="unit" id="product-unit"
                                        class="form-control border rounded" required>
                                </div>
                            </div>

                            {{-- CATEGORY --}}
                            <div class="form-group mb-4 row">
                                <label class="col-md-3 col-form-label fw-semibold">
                                    Danh mục
                                </label>
                                <div class="col-md-7">
                                    <select name="category_id" class="form-control border rounded">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- IMAGE --}}
                            <div class="form-group row">
                                <label class="col-md-3 col-sm-3 col-form-label">Hình ảnh<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="file" id="product-image" name="images[]" class="form-control" required
                                        multiple>

                                    <!-- Preview nhiều ảnh -->
                                    <div id="multiplePreview" class="d-flex flex-wrap gap-2 mt-3" style="gap:10px;">
                                    </div>
                                </div>
                            </div>


                            <div class="ln_solid"></div>

                            {{-- BUTTONS --}}
                            <div class="form-group row mt-4">
                                <div class="col-md-7 offset-md-3">
                                    <button type="reset" class="btn btn-secondary px-3">Reset</button>
                                    <button type="submit" class="btn btn-success px-4">Thêm sản phẩm</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
