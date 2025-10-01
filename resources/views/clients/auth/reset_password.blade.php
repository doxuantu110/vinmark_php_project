@extends('layouts.client')

@section('title', 'Đặt lại mật khẩu')
@section('breadcrumb', 'Đặt lại mật khẩu')

@section('content')
<div class="container">
    <h2>Đặt lại mật khẩu</h2>
    <div class="ltn_myaccount-tab-content-inner">
        <form action="{{ route('password.update') }}" method="POST" id="reset-password-form">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <fieldset>
                <div class="row">
                    <div class="col-md-12">
                        <div class="ltn__form-box contact-form-box">
                            <p>Vui lòng nhập mật khẩu mới của bạn.</p>
                            <input type="email" name="email" placeholder="Email*" value="{{ old('email') }}" required>
                            @error("email")
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <input type="password" name="password" placeholder="Mật khẩu mới*" required>
                            @error("password")
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu mới*" required>
                            @error("password_confirmation")
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="btn-wrapper mt-0">
                                <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit">Đặt lại mật khẩu</button>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
</div>

@endsection