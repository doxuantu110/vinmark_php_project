@extends('layouts.admin')

@section('title', 'Quản lý danh mục')

@section('content')
    <div class="right_col" role="main">

        <div class="page-title">
            <div class="title_left">
                <h3>Tạo danh mục</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="x_panel">
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Thêm danh mục mới <small>different form elements</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="x_content">
                                    <br />

                                    <form id="add-category" method="POST" action="{{ route('admin.categories.add') }}"
                                        enctype="multipart/form-data" data-parsley-validate
                                        class="form-horizontal form-label-left">

                                        @csrf

                                        {{-- NAME --}}
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="category-name">
                                                Tên danh mục <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6">
                                                <input type="text" id="category-name" name="name" required="required"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        {{-- DESCRIPTION --}}
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="category-description">
                                                Mô tả <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6">
                                                <input type="text" id="category-description" name="description"
                                                    required="required" class="form-control">
                                            </div>
                                        </div>

                                        {{-- IMAGE UPLOAD --}}
                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="category-image">
                                                Hình ảnh
                                            </label>
                                            <div class="col-md-6 col-sm-6">

                                                <label class="custom-file-upload" for="category-image">
                                                    Chọn ảnh
                                                </label>

                                                <input type="file" id="category-image" name="image" accept="image/*"
                                                    class="form-control-file">

                                                {{-- Preview --}}
                                                <img src="" alt="Ảnh xem trước" id="preview-image"
                                                    class="preview-image">
                                            </div>
                                        </div>

                                        <div class="ln_solid"></div>

                                        {{-- SUBMIT BUTTONS --}}
                                        <div class="item form-group">
                                            <div class="col-md-6 col-sm-6 offset-md-3">
                                                <button class="btn btn-primary btn-reset" type="reset">Reset</button>
                                                <button type="submit" class="btn btn-success">Thêm danh mục</button>
                                            </div>
                                        </div>

                                    </form>
                                </div> {{-- x_content --}}
                            </div> {{-- x_panel --}}
                        </div> {{-- col --}}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
