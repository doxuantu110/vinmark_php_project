@extends('layouts.client')

@section('title', 'Quên mật khẩu')
@section('breadcrumb', 'Quên mật khẩu')

@section('content')

<div class="container">
    <h2>Quên mật khẩu</h2>
    <div class="ltn_myaccount-tab-content-inner">
        <form action="#" method="POST" id="forgot-password-form">
            @csrf
            <fieldset>
                <div class="row">
                    <div class="col-md-12">
                        <div class="ltn__form-box contact-form-box">
                            <p>Vui lòng nhập địa chỉ email của bạn. Bạn sẽ nhận được một liên kết để tạo mật khẩu mới qua email.</p>
                            <input type="email" name="email" placeholder="Email*" required>
                            @error("email")
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="btn-wrapper mt-0">
                                <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit">Gửi liên kết đặt lại mật khẩu</button>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>   
</div>
@endsection