@extends('layouts.client')

@section('title', 'Đăng ký')
@section('breadcrumb', 'Đăng ký')
@section('content')
<!-- LOGIN AREA START (Register) -->
<div class="ltn__login-area pb-110">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area text-center">
                    <h1 class="section-title">Đăng ký <br>Tài khoản của bạn</h1>
                    <p>
                        Hãy tạo tài khoản của riêng bạn để bắt đầu.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="account-login-inner">
                    <form action="{{ route('post-register') }}" class="ltn__form-box contact-form-box" method="POST" id="register-form">
                        @csrf
                        <input type="text" name="name" placeholder="Họ và Tên" required>
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <input type="text" name="email" placeholder="Email*" required>
                        @error("email")
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <input type="password" name="password" placeholder="Mật khẩu*" required>
                        @error("password")
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <input type="password" name="confirmpassword" placeholder="Xác nhận mật khẩu*" required>
                        @error("confirmpassword")
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        
                        <label class="checkbox-inline">
                            <input type="checkbox" name="checkbox1" value="">
                            Tôi đồng ý cho VinMark xử lý dữ liệu cá nhân của tôi để gửi tài liệu tiếp thị cá nhân hóa
                            theo mẫu chấp thuận và chính sách bảo mật.
                            @error("checkbox1")
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="checkbox2" value="">
                            Bằng cách nhấp vào "Tạo tài khoản", tôi đồng ý với chính sách bảo mật.
                            @error("checkbox2")
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </label>
                        <div class="btn-wrapper">
                            <button class="theme-btn-1 btn reverse-color btn-block" type="submit">TẠO
                                TÀI KHOẢN</button>
                        </div>
                    </form>
                    <div class="by-agree text-center">
                        <p>Bằng cách tạo tài khoản, bạn đồng ý với:</p>
                        <p><a href="#">ĐIỀU KHOẢN SỬ DỤNG &nbsp; &nbsp; | &nbsp; &nbsp; CHÍNH SÁCH BẢO MẬT</a></p>
                        <div class="go-to-btn mt-50">
                            <a href="{{ route ('login') }}">ĐÃ CÓ TÀI KHOẢN?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- LOGIN AREA END -->
@endsection