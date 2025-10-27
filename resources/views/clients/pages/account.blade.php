@extends('layouts.client')

@section('title', 'Tài khoản')
@section('breadcrumb', 'Tài khoản')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
                                        <a data-bs-toggle="tab" href="#liton_tab_address">Địa chỉ giao hàng <i
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
                                                        @foreach ($orders as $order)
                                                            <tr>
                                                            <td>#{{ $order->id }}</td>
                                                            <td>{{ $order->created_at->format('d/m/y') }}</td>
                                                            <td>
                                                                @if ($order->status == 'pending')
                                                                    <span class="badge bg-warning">Chờ xử lý</span>
                                                                @elseif($order->status == 'processing')
                                                                    <span class="badge bg-info">Đang xử lý</span>
                                                                @elseif($order->status == 'completed')
                                                                    <span class="badge bg-success">Hoàn thành</span>
                                                                @elseif($order->status == 'canceled')
                                                                    <span class="badge bg-danger">Đã hủy</span>
                                                                @endif
                                                            </td>
                                                            <td>{{ number_format($order->total_price, 0, ',', '.') }} đ</td>
                                                            <td><a href="{{ route('order.show', $order->id) }}" class="btn btn-sm btn-info">Xem chi tiết</a></td>
                                                        </tr>
                                                        @endforeach
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
                                                            <th>Họ tên</th>
                                                            <th>Địa chỉ</th>
                                                            <th>Tỉnh/ Thành phố</th>
                                                            <th>Điện thoại</th>
                                                            <th>Mặc định</th>
                                                            <th>Hành động</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($addresses as $address)
                                                            <tr>
                                                                <td>{{ $address->full_name }}</td>
                                                                <td>{{ $address->address }}</td>
                                                                <td>{{ $address->city }}</td>
                                                                <td>{{ $address->phone }}</td>
                                                                <td>
                                                                    @if($address->default == 1)
                                                                        <span class="badge bg-success">Mặc định</span>
                                                                    @else
                                                                        <form action="{{ route('account.addresses.update', $address->id)}}" method="POST" class="d-inline">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <button class="btn btn-warning btn-effect-1 ">Chọn</button>
                                                                        </form>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <form action="{{ route('account.addresses.delete', $address->id)}}" method="POST" class="d-inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-effect-1 btn-danger"
                                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa địa chỉ này ?')">
                                                                            Xóa
                                                                        </button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>

                                                <!-- Nút thêm địa chỉ mới -->
                                                <div class="mt-3">
                                                    <button type="button" class="btn theme-btn-1 btn-effect-1 text-uppercase"
                                                        data-bs-toggle="modal" data-bs-target="#addAddressModal">
                                                        Thêm địa chỉ mới
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- Modal -->
                                            <!-- Modal Thêm Địa Chỉ Mới -->
                                            <div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <!-- Header -->
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="addAddressModalLabel">Thêm địa chỉ mới</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                                                        </div>
                                                        <!-- Body -->
                                                        <div class="modal-body">
                                                            <form method="POST" action="{{ route('account.addresses.add') }}" id="addAddressForm">
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <label for="full_name" class="form-label">Tên người dùng</label>
                                                                    <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Nhập tên người dùng" required>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="address" class="form-label">Địa chỉ</label>
                                                                    <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ" required>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="city" class="form-label">Thành phố</label>
                                                                    <input type="text" class="form-control" id="city" name="city" placeholder="Nhập thành phố" required>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="phone" class="form-label">Số điện thoại</label>
                                                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" pattern="[0-9]{10}" required>
                                                                    <small class="text-muted">Vui lòng nhập 10 chữ số.</small>
                                                                </div>

                                                                <!-- Checkbox Đặt làm địa chỉ mặc định -->
                                                                <div class="form-check mb-3">
                                                                    <input class="form-check-input" type="checkbox" id="default" name="default" value="1">
                                                                    <label class="form-check-label" for="default">
                                                                        Đặt làm địa chỉ mặc định
                                                                    </label>
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <!-- Footer -->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                            <button type="submit" class="btn btn-primary" form="addAddressForm">Lưu địa chỉ</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Account details -->
                                    <div class="tab-pane fade" id="liton_tab_account">
                                        <div class="ltn__myaccount-tab-content-inner">
                                            <div class="ltn__form-box">
                                                <form action="{{ route ('account.update')}}" method="POST" id="update-account-form"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row mb-50">
                                                        <div class="col-md-12 text-center mb-3">
                                                            <div class="profile-pic-container">
                                                                <img src="{{ $user->avatar_url }}" 
                                                                            alt="Ảnh đại diện" 
                                                                            class="profile-pic" 
                                                                            id="preview-image">
                                                                <input type="file" id="avatar"
                                                                    name="avatar" accept="image/*" class="d-none"
                                                                    style="display: none;">
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
                                                <form action="{{ route ('account.change-password')}}" method="POST" id="change-password-form">
                                                @csrf
                                                <fieldset>
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
                                                 </fieldset>
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
<script>
    const addAddressUrl = "{{ route('account.addresses.add') }}";
</script>
<!-- KHU VỰC DANH SÁCH YÊU THÍCH END -->


@endsection
