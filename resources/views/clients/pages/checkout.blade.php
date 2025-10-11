<?php
@extends('layouts.client')

@section('title', 'Checkout')
@section('breadcrumb', 'Checkout')
@section('content')

<!-- CHECKOUT AREA START -->
<div class="ltn__checkout-area mb-105">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="ltn__checkout-inner">
                    <div class="ltn__checkout-single-content ltn__returning-customer-wrap">
                        <h5>Returning customer? <a class="ltn__secondary-color"
                                href="#ltn__returning-customer-login" data-bs-toggle="collapse">Click here to login</a></h5>
                        <div id="ltn__returning-customer-login" class="collapse ltn__checkout-single-content-info">
                            <div class="ltn_coupon-code-form ltn__form-box">
                                <p>Please login your account.</p>
                                <form action="#">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-item input-item-name ltn__custom-icon">
                                                <input type="text" name="name" placeholder="Enter your name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item input-item-email ltn__custom-icon">
                                                <input type="email" name="email" placeholder="Enter email address">
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn theme-btn-1 btn-effect-1 text-uppercase">Login</button>
                                    <label class="input-info-save mb-0"><input type="checkbox" name="agree"> Remember me</label>
                                    <p class="mt-30"><a href="#">Lost your password?</a></p>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="ltn__checkout-single-content ltn__coupon-code-wrap">
                        <h5>Have a coupon? <a class="ltn__secondary-color" href="#ltn__coupon-code"
                                data-bs-toggle="collapse">Click here to enter your code</a></h5>
                        <div id="ltn__coupon-code" class="collapse ltn__checkout-single-content-info">
                            <div class="ltn__coupon-code-form">
                                <p>If you have a coupon code, please apply it below.</p>
                                <form action="#">
                                    <input type="text" name="coupon-code" placeholder="Coupon code">
                                    <button class="btn theme-btn-2 btn-effect-2 text-uppercase">Apply Coupon</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="ltn__checkout-single-content mt-50">
                        <h4 class="title-2">Billing Details</h4>
                        <div class="ltn__checkout-single-content-info">
                            <form action="#" method="post">
                                @csrf
                                <h6>Personal Information</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-item input-item-name ltn__custom-icon">
                                            <input type="text" name="first_name" placeholder="First name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-item input-item-name ltn__custom-icon">
                                            <input type="text" name="last_name" placeholder="Last name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-item input-item-email ltn__custom-icon">
                                            <input type="email" name="email" placeholder="Email address">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-item input-item-phone ltn__custom-icon">
                                            <input type="text" name="phone" placeholder="Phone number">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-item input-item-website ltn__custom-icon">
                                            <input type="text" name="company" placeholder="Company name (optional)">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-item input-item-website ltn__custom-icon">
                                            <input type="text" name="company_address" placeholder="Company address (optional)">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <h6>Country</h6>
                                        <div class="input-item">
                                            <select class="nice-select" name="country">
                                                <option>Select Country</option>
                                                <option>Australia</option>
                                                <option>Canada</option>
                                                <option>China</option>
                                                <option>Morocco</option>
                                                <option>Saudi Arabia</option>
                                                <option>United Kingdom (UK)</option>
                                                <option>United States (US)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <h6>Address</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-item">
                                                    <input type="text" name="address" placeholder="House number and street name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-item">
                                                    <input type="text" name="address_2" placeholder="Apartment, suite, unit etc. (optional)">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <h6>Town / City</h6>
                                        <div class="input-item">
                                            <input type="text" name="city" placeholder="City">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <h6>State</h6>
                                        <div class="input-item">
                                            <input type="text" name="state" placeholder="State">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <h6>Zip</h6>
                                        <div class="input-item">
                                            <input type="text" name="zip" placeholder="Zip">
                                        </div>
                                    </div>
                                </div>

                                <p><label class="input-info-save mb-0"><input type="checkbox" name="create_account"> Create an account?</label></p>
                                <h6>Order Notes (optional)</h6>
                                <div class="input-item input-item-textarea ltn__custom-icon">
                                    <textarea name="order_notes" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PAYMENT & CART TOTAL -->
            <div class="col-lg-6">
                <div class="ltn__checkout-payment-method mt-50">
                    <h4 class="title-2">Payment Method</h4>
                    <div id="checkout_accordion_1">
                        <div class="card">
                            <h5 class="collapsed ltn__card-title" data-bs-toggle="collapse" data-bs-target="#faq-item-2-1" aria-expanded="false">
                                Check payments
                            </h5>
                            <div id="faq-item-2-1" class="collapse" data-parent="#checkout_accordion_1">
                                <div class="card-body">
                                    <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <h5 class="ltn__card-title" data-bs-toggle="collapse" data-bs-target="#faq-item-2-2" aria-expanded="true">
                                Cash on delivery <img src="{{ asset('assets/clients/img/icons/cash.png') }}" alt="#">
                            </h5>
                            <div id="faq-item-2-2" class="collapse show" data-parent="#checkout_accordion_1">
                                <div class="card-body">
                                    <p>Pay with cash upon delivery.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <h5 class="collapsed ltn__card-title" data-bs-toggle="collapse" data-bs-target="#faq-item-2-3" aria-expanded="false">
                                ApplePay <img src="{{ asset('assets/clients/img/icons/applepay.png') }}" alt="#">
                            </h5>
                            <div id="faq-item-2-3" class="collapse" data-parent="#checkout_accordion_1">
                                <div class="card-body">
                                    <p>Apple Pay is the modern way to pay.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <h5 class="collapsed ltn__card-title" data-bs-toggle="collapse" data-bs-target="#faq-item-2-4" aria-expanded="false">
                                PayPal <img src="{{ asset('assets/clients/img/icons/payment-3.png') }}" alt="#">
                            </h5>
                            <div id="faq-item-2-4" class="collapse" data-parent="#checkout_accordion_1">
                                <div class="card-body">
                                    <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ltn__payment-note mt-30 mb-30">
                        <p>Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.</p>
                    </div>
                    <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit">Place order</button>
                </div>

                <div class="shoping-cart-total mt-50">
                    <h4 class="title-2">Cart Totals</h4>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Vegetables Juices <strong>× 2</strong></td>
                                <td>$298.00</td>
                            </tr>
                            <tr>
                                <td>Orange Sliced Mix <strong>× 2</strong></td>
                                <td>$170.00</td>
                            </tr>
                            <tr>
                                <td>Red Hot Tomato <strong>× 2</strong></td>
                                <td>$150.00</td>
                            </tr>
                            <tr>
                                <td>Shipping and Handling</td>
                                <td>$15.00</td>
                            </tr>
                            <tr>
                                <td>Vat</td>
                                <td>$00.00</td>
                            </tr>
                            <tr>
                                <td><strong>Order Total</strong></td>
                                <td><strong>$633.00</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div><!-- CHECKOUT AREA END -->

<!-- FEATURE AREA START (kept single instance) -->
<div class="ltn__feature-area before-bg-bottom-2 mb--30--- plr--5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__feature-item-box-wrap ltn__border-between-column white-bg">
                    <div class="row">
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="ltn__feature-item ltn__feature-item-8">
                                <div class="ltn__feature-icon">
                                    <img src="{{ asset('assets/clients/img/icons/icon-img/11.png') }}" alt="#">
                                </div>
                                <div class="ltn__feature-info">
                                    <h4>Sản phẩm được tuyển chọn</h4>
                                    <p>Cung cấp sản phẩm được tuyển chọn kỹ lưỡng cho tất cả đơn hàng trên 100.000đ</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="ltn__feature-item ltn__feature-item-8">
                                <div class="ltn__feature-icon">
                                    <img src="{{ asset('assets/clients/img/icons/icon-img/12.png') }}" alt="#">
                                </div>
                                <div class="ltn__feature-info">
                                    <h4>Thủ công</h4>
                                    <p>Chúng tôi đảm bảo chất lượng sản phẩm là mục tiêu chính của chúng tôi</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="ltn__feature-item ltn__feature-item-8">
                                <div class="ltn__feature-icon">
                                    <img src="{{ asset('assets/clients/img/icons/icon-img/13.png') }}" alt="#">
                                </div>
                                <div class="ltn__feature-info">
                                    <h4>Thực phẩm tự nhiên</h4>
                                    <p>Đổi trả sản phẩm trong vòng 3 ngày cho bất kỳ sản phẩm nào bạn mua</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="ltn__feature-item ltn__feature-item-8">
                                <div class="ltn__feature-icon">
                                    <img src="{{ asset('assets/clients/img/icons/icon-img/14.png') }}" alt="#">
                                </div>
                                <div class="ltn__feature-info">
                                    <h4>Giao hàng tận nhà miễn phí</h4>
                                    <p>Chúng tôi đảm bảo chất lượng sản phẩm mà bạn có thể tin tưởng</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
</div><!-- FEATURE AREA END -->
@endsection
