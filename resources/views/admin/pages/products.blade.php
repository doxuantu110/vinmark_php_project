@extends('layouts.admin')

@section('title', 'Quản lý sản phẩm')

@section('content')
    <div class="right_col" role="main">

        {{-- Page Title --}}
        <div class="page-title">
            <div class="title_left">
                <h3>Quản lý sản phẩm</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel disabled-panel">
                    <div class="x_title">
                        <h2>Danh sách sản phẩm</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Danh mục <small>Danh sách</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Tên sản phẩm</th>
                                            <th>Slug</th>
                                            <th>Hình ảnh</th>
                                            <th>Mô tả</th>
                                            <th>Số lượng</th>
                                            <th>Giá</th>
                                            <th>Đơn vị</th>
                                            <th>Trạng thái</th>
                                            <th>Chỉnh sửa</th>
                                            <th>Xóa</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->slug }}</td>
                                                <td>
                                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                                        class="image-product">
                                                </td>
                                                <td>{{ Str::limit($product->description, 50) }}</td>
                                                <td>{{ $product->stock }}</td>
                                                <td>{{ number_format($product->price) }} đ</td>
                                                <td>{{ $product->unit }}</td>
                                                <td>
                                                    @if ($product->status == 'in_stock')
                                                        <span class="badge bg-success">Còn hàng</span>
                                                    @else
                                                        <span class="badge bg-secondary">Hết hàng</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#modalUpdate-{{ $product->id }}">
                                                        <i class="fa fa-edit"></i> Chỉnh sửa
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger btn-delete-product"
                                                        data-product-id="{{ $product->id }}">
                                                        <i class="fa fa-close"></i> Xóa
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- ========================
     MODALS UPDATE PRODUCT
============================ --}}
                            @foreach ($products as $product)
                                <div class="modal fade" id="modalUpdate-{{ $product->id }}" tabindex="-1"
                                    aria-labelledby="modalLabel-{{ $product->id }}" aria-hidden="true">

                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalLabel-{{ $product->id }}">
                                                    Chỉnh sửa sản phẩm: {{ $product->name }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <form id="form-update-{{ $product->id }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="id" class="product-id"
                                                        value="{{ $product->id }}">

                                                    <div class="mb-3">
                                                        <label class="form-label">Tên sản phẩm</label>
                                                        <input type="text" name="name"
                                                            class="form-control product-name" value="{{ $product->name }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Mô tả</label>
                                                        <textarea name="description" class="form-control product-desc" rows="3">{{ $product->description }}</textarea>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Số lượng</label>
                                                            <input type="number" name="stock"
                                                                class="form-control product-qty"
                                                                value="{{ $product->stock }}">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Đơn vị</label>
                                                            <input type="text" name="unit"
                                                                class="form-control product-unit"
                                                                value="{{ $product->unit }}">
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Giá (VNĐ)</label>
                                                        <input type="number" name="price"
                                                            class="form-control product-price"
                                                            value="{{ $product->price }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Danh mục</label>
                                                        <select name="category_id" class="form-control product-category">
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}"
                                                                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                                    {{ $category->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Trạng thái</label>
                                                        <select name="status" class="form-control product-status">
                                                            <option value="in_stock"
                                                                {{ $product->status == 'in_stock' ? 'selected' : '' }}>Còn
                                                                hàng</option>
                                                            <option value="out_stock"
                                                                {{ $product->status != 'in_stock' ? 'selected' : '' }}>Hết
                                                                hàng</option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Hình ảnh hiện tại</label>
                                                        <div id="existing-images-{{ $product->id }}"
                                                            class="d-flex gap-2 flex-wrap">
                                                            @foreach ($product->images as $img)
                                                                <img src="{{ asset('storage/' . $img->image) }}"
                                                                    alt="Ảnh sản phẩm"
                                                                    style="width: 100px; height: 100px; object-fit: cover;"
                                                                    class="rounded border">
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Chọn ảnh mới (Thêm vào)</label>
                                                        <input type="file" name="images[]"
                                                            class="form-control product-images"
                                                            id="product-images-{{ $product->id }}" multiple
                                                            accept="image/*">
                                                        <div id="new-image-preview-{{ $product->id }}"
                                                            class="d-flex gap-2 flex-wrap mt-2"></div>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Đóng</button>
                                                <button type="button"
                                                    class="btn btn-primary btn-update-submit-product">Lưu thay đổi</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{-- ========================
     END MODALS
============================ --}}



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
