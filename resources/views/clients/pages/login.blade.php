@extends('layouts.client')

@section('title', 'Đăng nhập')
@section('breadcrumb', 'Đăng nhập')

@section('content')

<!-- BREADCRUMB AREA END -->
<!-- LOGIN AREA START -->
<!-- LOGIN AREA START -->
<div class="ltn__login-area pb-65">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area text-center">
                    <h1 class="section-title">Đăng nhập <br>Vào tài khoản của bạn</h1>
                    <p>Hãy đăng nhập để tiếp tục trải nghiệm các dịch vụ của chúng tôi.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Form đăng nhập -->
            <div class="col-lg-6">
                <div class="account-login-inner">
                    <form action="{{ route('post-login') }}" class="ltn__form-box contact-form-box" method="POST" id="login-form">
                        @csrf
                        <input type="text" name="email" placeholder="Email*" required>
                        @error("email")
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <input type="password" name="password" placeholder="Mật khẩu*" required>
                        @error("password")
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="btn-wrapper mt-0">
                            <button class="theme-btn-1 btn btn-block" type="submit">ĐĂNG NHẬP</button>
                        </div>
                        <div class="go-to-btn mt-20">
                            <a href="{{route ('forgot-password')}}"><small>Quên mật khẩu?</small></a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Tạo tài khoản mới -->
            <div class="col-lg-6">
                <div class="account-create text-center pt-50">
                    <h4>Bạn chưa có tài khoản?</h4>
                    <p>Hãy đăng ký ngay để lưu sản phẩm yêu thích, <br>
                        nhận gợi ý cá nhân hóa, theo dõi đơn hàng và thanh toán nhanh chóng.</p>
                    <div class="btn-wrapper">
                        <a href="{{ route ('register') }}" class="theme-btn-1 btn black-btn">TẠO TÀI KHOẢN</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- LOGIN AREA END -->

@endsection