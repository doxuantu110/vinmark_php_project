@extends('layouts.admin')

@section('title', 'Quản lý danh mục')

@section('content')
    <div class="right_col" role="main">

        <div class="page-title">
            <div class="title_left">
                <h3>Quản lý danh mục</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel disabled-panel">
                    <div class="x_title">
                        <h2>Danh sách danh mục</h2>
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
                                            <th>Tên danh mục</th>
                                            <th>Slug</th>
                                            <th>Hình ảnh</th>
                                            <th>Mô tả</th>
                                            <th>Chỉnh sửa</th>
                                            <th>Xóa</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->slug }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/' . $category->image) }}"
                                                        alt="{{ $category->name }}" class="image-category">
                                                </td>
                                                <td>{{ $category->description }}</td>

                                                <td>
                                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#modalUpdate-{{ $category->id }}">
                                                        <i class="fa fa-edit"></i> Chỉnh sửa
                                                    </button>
                                                </td>

                                                <td>
                                                    <button class="btn btn-danger btn-delete-category"
                                                        data-category-id="{{ $category->id }}">
                                                        <i class="fa fa-close"></i> Xóa
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- ========================
                                MODALS (đặt ngoài table)
                            =========================== --}}
                            @foreach ($categories as $category)
                                <div class="modal fade" id="modalUpdate-{{ $category->id }}" tabindex="-1"
                                    aria-labelledby="modalLabel-{{ $category->id }}" aria-hidden="true">

                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                            <!-- Header -->
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalLabel-{{ $category->id }}">
                                                    Chỉnh sửa danh mục: {{ $category->name }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body">
                                                <form id="form-update-{{ $category->id }}">
                                                    <input type="hidden" class="category-id" value="{{ $category->id }}">

                                                    <div class="mb-3">
                                                        <label class="form-label">Tên danh mục</label>
                                                        <input type="text" class="form-control category-name"
                                                            value="{{ $category->name }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Mô tả</label>
                                                        <textarea class="form-control category-desc" rows="3">{{ $category->description }}</textarea>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Hình ảnh hiện tại</label><br>
                                                        <img src="{{ asset('storage/' . $category->image) }}"
                                                            width="80" class="rounded">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Chọn ảnh mới</label>
                                                        <input type="file" class="form-control"
                                                            id="category-image-{{ $category->id }}"
                                                            data-id="{{ $category->id }}">
                                                    </div>
                                                </form>
                                            </div>

                                            <!-- Footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Đóng</button>
                                                <button type="button"
                                                    class="btn btn-primary btn-update-submit-category">Lưu thay đổi</button>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            @endforeach
                            {{-- END MODALS --}}

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
