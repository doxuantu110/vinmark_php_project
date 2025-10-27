@extends('layouts.client')

@section('title', 'Giỏ hàng')
@section('breadcrumb', 'Giỏ hàng')
@section('content')
    <!-- SHOPING CART AREA START -->
    <div class="liton__shoping-cart-area mb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping-cart-inner">
                        <div class="shoping-cart-table table-responsive">
                            <table class="table">
                                <tbody>
                                    @php
                                        $cartTotal = 0;

                                    @endphp
                                    @forelse ($cartItems as $item)
                                        @php
                                            $subtotal = $item['price'] * $item['quantity'];
                                            $cartTotal += $subtotal;
                                        @endphp
                                        <tr id="cart_item_row_{{ $item['product_id'] }}">
                                            <td class="cart-product-remove">
                                                <button class="remove-from-cart"
                                                    data-id="{{ $item['product_id'] }}">x</button>
                                            </td>
                                            <td class="cart-product-image">
                                                <a href="javascript:void(0)">
                                                    <img src="{{ asset('storage/' . ($item['image'] ?? 'uploads/products/default-product.png')) }}"
                                                        alt="Sản phẩm"></a>
                                            </td>
                                            <td class="cart-product-info">
                                                <h4><a href="javascript:void(0)">{{ $item['name'] }}</a>
                                                </h4>
                                            </td>
                                            <td class="cart-product-price">
                                                {{ number_format($item['price'], 0, ',', '.') }} đ
                                            </td>
                                            <td class="cart-product-quantity">
                                                <div class="cart-plus-minus">
                                                    <div class="dec qtybutton">-</div>
                                                    <input type="text" value="{{ $item['quantity'] }}" name="qtybutton"
                                                        class="cart-plus-minus-box" readonly data-max="{{ $item['stock'] }}"
                                                        data-id="{{ $item['product_id'] }}">
                                                    <div class="inc qtybutton">+</div>
                                                </div>
                                            </td>
                                            <td class="cart-product-subtotal"
                                                id="cart_item_total_{{ $item['product_id'] }}">
                                                {{ number_format($subtotal, 0, ',', '.') }} đ
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Không có sản phẩm nào trong giỏ hàng</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                        @if (!empty($cartItems))
                            <div class="shoping-cart-total mt-50">
                                <h4>Tổng giỏ hàng</h4>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Tổng tiền hàng</td>
                                            <td id="cart_total">{{ number_format($cartTotal, 0, ',', '.') }} đ</td>
                                        </tr>
                                        <tr>
                                            <td>Phí vận chuyển</td>
                                            <td>25.000 đ</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tổng thanh toán</strong></td>
                                            <td><strong id="grand_total">{{ number_format($cartTotal + 25000, 0, ',', '.') }} đ</strong></td>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="btn-wrapper text-right text-end">
                                    <a href="{{ route('checkout') }}" class="theme-btn-1 btn btn-effect-1">Tiến hành thanh toán</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SHOPING CART AREA END -->

@endsection
