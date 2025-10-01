@extends('layouts.client')

@section('title', 'Tài khoản')
@section('breadcrumb', 'Tài khoản')

@section('content')

<!-- KHU VỰC DANH SÁCH YÊU THÍCH START -->
<div class="liton__wishlist-area pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- KHU VỰC TAB SẢN PHẨM START -->
                <div class="ltn__product-tab-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="ltn__tab-menu-list mb-50">
                                    <div class="nav">
                                        <a class="active show" data-bs-toggle="tab" href="#liton_tab_dashboard">Bảng
                                            điều khiển <i class="fas fa-home"></i></a>
                                        <a data-bs-toggle="tab" href="#liton_tab_orders">Đơn hàng <i
                                                class="fas fa-file-alt"></i></a>
                                        <a data-bs-toggle="tab" href="#liton_tab_address">Địa chỉ <i
                                                class="fas fa-map-marker-alt"></i></a>
                                        <a data-bs-toggle="tab" href="#liton_tab_account">Chi tiết tài khoản <i
                                                class="fas fa-user"></i></a>
                                        <a data-bs-toggle="tab" href="#liton_tab_password">Đổi mật khẩu <i
                                                class="fas fa-lock"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="tab-content">
                                    <!-- Dashboard -->
                                    <div class="tab-pane fade active show" id="liton_tab_dashboard">
                                        <div class="ltn__myaccount-tab-content-inner">
                                            <p>Xin chào <strong>{{ $user->email }}</strong> (không phải
                                                <strong>{{ $user->email }}</strong>?
                                                <small><a href="{{route ('logout')}}">Đăng xuất</a></small>)
                                            </p>
                                            <p>Từ bảng điều khiển tài khoản của bạn, bạn có thể xem <span>các đơn hàng
                                                    gần đây</span>,
                                                quản lý <span>địa chỉ giao hàng và thanh toán</span>, và <span>chỉnh sửa
                                                    mật khẩu cùng chi tiết tài khoản</span>.
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Orders -->
                                    <div class="tab-pane fade" id="liton_tab_orders">
                                        <div class="ltn__myaccount-tab-content-inner">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Đơn hàng</th>
                                                            <th>Ngày</th>
                                                            <th>Trạng thái</th>
                                                            <th>Tổng cộng</th>
                                                            <th>Hành động</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>22 Tháng 6, 2019</td>
                                                            <td>Đang chờ xử lý</td>
                                                            <td>$3000</td>
                                                            <td><a href="cart.html">Xem</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>22 Tháng 11, 2019</td>
                                                            <td>Đã duyệt</td>
                                                            <td>$200</td>
                                                            <td><a href="cart.html">Xem</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>3</td>
                                                            <td>12 Tháng 1, 2020</td>
                                                            <td>Tạm giữ</td>
                                                            <td>$990</td>
                                                            <td><a href="cart.html">Xem</a></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Address -->
                                    <div class="tab-pane fade" id="liton_tab_address">
                                        <div class="ltn__myaccount-tab-content-inner">
                                            <p>Các địa chỉ sau sẽ được sử dụng mặc định trên trang thanh toán.</p>
                                            <div class="container">
                                                <h4>Danh sách địa chỉ</h4>
                                                <table class="table table-bordered">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Họ tên</th>
                                                            <th>Địa chỉ</th>
                                                            <th>Điện thoại</th>
                                                            <th>Loại địa chỉ</th>
                                                            <th>Hành động</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Alex Tuntuni</td>
                                                            <td>1355 Market St, Suite 900, San Francisco, CA 94103</td>
                                                            <td>(123) 456-7890</td>
                                                            <td>Thanh toán</td>
                                                            <td>
                                                                <a href="#" class="btn btn-sm btn-primary">Chỉnh sửa</a>
                                                                <a href="#" class="btn btn-sm btn-danger">Xóa</a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!-- Nút thêm địa chỉ mới -->
                                                <div class="mt-3">
                                                    <button type="button"
                                                        class="btn theme-btn-1 btn-effect-1 text-uppercase">Thêm địa chỉ
                                                        mới</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Account details -->
                                    <div class="tab-pane fade" id="liton_tab_account">
                                        <div class="ltn__myaccount-tab-content-inner">
                                            <div class="ltn__form-box">
                                                <form action="#" method="POST" id="update-account-form"
                                                    enctype="multipart/form-data">
                                                    @method('PUT')
                                                    <div class="row mb-50">
                                                        <div class="col-md-12 text-center mb-3">
                                                            <div class="profile-pic-container">
                                                                <img src="{{ $user->avatar }}" alt="Ảnh đại diện"
                                                                    class="profile-pic" id="profile-pic-preview">
                                                                <div class="overlay">
                                                                    <label for="profile-pic-input"
                                                                        class="btn btn-sm btn-primary">Chọn ảnh</label>
                                                                    <input type="file" id="profile-pic-input"
                                                                        name="profile_picture" accept="image/*"
                                                                        style="display: none;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-50">
                                                        <div class="col-md-6">
                                                            <label for="ltn__name">Họ và tên:</label>
                                                            <input type="text" name="ltn__name" id="ltn__name"
                                                                value="{{ $user->name }}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="ltn__phonenumber">Số điện thoại:</label>
                                                            <input type="number" name="ltn__phonenumber"
                                                                id="ltn__phonenumber" value="{{ $user->phone_number }}"
                                                                required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="ltn__email">Email (không được thay đổi):</label>
                                                            <input type="email" id="ltn__email"
                                                                value="{{ $user->email }}" readonly>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="ltn__address">Địa chỉ:</label>
                                                            <input type="text" name="ltn__address" id="ltn__address"
                                                                value="{{ $user->address }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="btn-wrapper">
                                                        <button type="submit"
                                                            class="btn theme-btn-1 btn-effect-1 text-uppercase">Cập
                                                            nhật</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Change password -->
                                    <div class="tab-pane fade" id="liton_tab_password">
                                        <div class="ltn__myaccount-tab-content-inner">
                                            <div class="ltn__form-box">
                                                <form action="#" method="POST" id="change-password-form">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="current_password">Mật khẩu hiện tại:</label>
                                                            <input type="password" id="current_password"
                                                                name="current_password" required>

                                                            <label for="new_password">Mật khẩu mới:</label>
                                                            <input type="password" id="new_password" name="new_password"
                                                                required>

                                                            <label for="confirm_new_password">Nhập lại mật khẩu mới:</label>
                                                            <input type="password" id="confirm_new_password"
                                                                name="confirm_new_password" autocomplete="new-password"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="btn-wrapper mt-3">
                                                        <button type="submit"
                                                            class="btn theme-btn-1 btn-effect-1 text-uppercase">
                                                            Đổi mật khẩu
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- KHU VỰC TAB SẢN PHẨM END -->
            </div>
        </div>
    </div>
</div>

<!-- KHU VỰC DANH SÁCH YÊU THÍCH END -->


@endsection
