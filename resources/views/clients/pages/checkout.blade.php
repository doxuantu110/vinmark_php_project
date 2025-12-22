@extends('layouts.client')

@section('title', 'Đặt hàng')
@section('breadcrumb', 'Đặt hàng')

@section('content')
    <div class="ltn__checkout-area mb-105">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__checkout-inner">
                        <div class="ltn__checkout-single-content mt-50">
                            <h4 class="title-2">Thông tin thanh toán</h4>
                            <div class="select-address">
                                <div>
                                    <h6>Chọn địa chỉ khác:</h6>
                                </div>
                                <div>
                                    <select name="address_id" id="list_address" class="input-item">
                                        @foreach ($addresses as $address)
                                            <option value="{{ $address->id }}" {{ $address->default ? 'selected' : '' }}>
                                                {{ $address->full_name }} - {{ $address->address }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <a href="{{ route('account') }}"
                                        class="btn theme-btn-1 btn-effect-1 text-uppercase">Thêm địa chỉ mới</a>
                                </div>
                            </div>
                            <div class="ltn__checkout-single-content-info">
                                <form action="#">
                                    <h6>Thông tin cá nhân</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-item input-item-name ltn__custom-icon">
                                                <input type="text" name="ltn__name" placeholder="Họ và tên"
                                                    value="{{ $defaultAddress->full_name }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item input-item-name ltn__custom-icon">
                                                <input type="text" name="ltn__lastname" placeholder="Số điện thoại"
                                                    value="{{ $defaultAddress->phone }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <h6>Địa chỉ</h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-item">
                                                        <input type="text" name="ltn__address"
                                                            placeholder="Số nhà và tên đường"
                                                            value="{{ $defaultAddress->address }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-item">
                                                        <input type="text" name="ltn__city" placeholder="Thành phố"
                                                            value="{{ $defaultAddress->city }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h6>Ghi chú đơn hàng (không bắt buộc)</h6>
                                    <div class="input-item input-item-textarea ltn__custom-icon">
                                        <textarea name="ltn__message" placeholder="Ghi chú về đơn hàng của bạn, ví dụ: hướng dẫn giao hàng đặc biệt..."></textarea>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="ltn__checkout-payment-method mt-50">
                        <h4 class="title-2">Phương thức thanh toán</h4>
                        <form id="checkout-form" action="{{ route('checkout.placeOrder') }}" method="POST">
                            @csrf
                            <input type="hidden" name="address_id" value="{{ $defaultAddress->id }}">
                            <div id="checkout_payment">
                                {{-- COD --}}
                                <div class="card">
                                    <h5 class="collapsed ltn__card-title" data-bs-toggle="collapse"
                                        data-bs-target="#faq-item-2-4" aria-expanded="false">
                                        <input type="radio" name ="payment_method" value="cash" id="payment_cod"
                                            checked>
                                        <label for="payment_cod">
                                            Thanh toán khi nhận hàng (COD)
                                            <img src="{{ asset('assets/clients/img/icons/cash.png') }}" alt="#">
                                        </label>
                                    </h5>
                                </div>
                                {{-- /COD  --}}
                                {{-- MoMo --}}
                                <div class="card">
                                    <h5 class="collapsed ltn__card-title" data-bs-toggle="collapse"
                                        data-bs-target="#faq-item-2-5" aria-expanded="false">
                                        <input type="radio" name="payment_method" value="momo" id="payment_momo">
                                        MoMo
                                        <img src="{{ asset('assets/clients/img/icons/payment-momo.png') }}" alt="MoMo"
                                            style="width: 40px; margin-left: 10px;">
                                    </h5>
                                </div>
                                {{-- /MoMo --}}
                                {{-- Paypal --}}
                                <div class="card">
                                    <h5 class="collapsed ltn__card-title" data-bs-toggle="collapse"
                                        data-bs-target="#faq-item-2-4" aria-expanded="false">
                                        <input type="radio" name ="payment_method" value="paypal" id="payment_paypal">
                                        PayPal <img src="{{ asset('assets/clients/img/icons/payment-3.png') }}"
                                            alt="#">
                                    </h5>
                                </div>
                                {{-- /Paypal  --}}
                            </div>
                            <div class="ltn__payment-note mt-30 mb-30">
                                <p>Thông tin cá nhân của bạn sẽ được sử dụng để xử lý đơn hàng, hỗ trợ trải nghiệm trên
                                    website
                                    và cho các mục đích khác được mô tả trong chính sách bảo mật.</p>
                            </div>
                            <button class="btn theme-btn-1 btn-effect-1 text-uppercase" id="place-order-button"
                                type="submit">
                                Đặt hàng
                            </button>
                            <div id="paypal-button-container"></div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="shoping-cart-total mt-50">
                        <h4 class="title-2">Tổng đơn hàng</h4>
                        <table class="table">
                            <tbody>

                                @foreach ($cartItems as $item)
                                    <tr>
                                        <td>{{ $item->product->name }} <strong>× {{ $item->quantity }}</strong></td>
                                        <td>{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }} ₫
                                        </td>
                                @endforeach
                                </tr>
                                <tr>
                                    <td>Phí vận chuyển</td>
                                    <td>{{ number_format(25000, 0, ',', '.') }} đ</td>
                                </tr>
                                <tr>
                                    <td><strong>Tổng thanh toán</strong></td>
                                    <td><strong
                                            class="totalPrice_Checkout">{{ number_format($totalPrice + 25000, 0, ',', '.') }}
                                            đ</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection