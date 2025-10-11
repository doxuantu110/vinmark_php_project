<?php
@extends('layouts.client')

@section('title', 'Giỏ hàng')
@section('breadcrumb', 'Giỏ hàng')
@section('content')
<!-- SHOPPING CART AREA START -->
<div class="ltn__shoping-cart-area mb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping-cart-inner">
                    <div class="shoping-cart-table table-responsive">
                        <table class="table">
                            <tbody>
                                @forelse($cartItems as $item)
                                <tr>
                                    <td class="cart-product-remove">
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link p-0">×</button>
                                        </form>
                                    </td>
                                    <td class="cart-product-image">
                                        <a href="#">
                                            <img src="{{ $item->image ?? ($item->product->image ?? asset('assets/clients/img/product/placeholder.png')) }}" alt="{{ $item->name ?? $item->product->name }}">
                                        </a>
                                    </td>
                                    <td class="cart-product-info">
                                        <h4><a href="#">{{ $item->name ?? $item->product->name }}</a></h4>
                                    </td>
                                    <td class="cart-product-price">
                                        {{ number_format($item->price ?? $item->product->price, 0, ',', '.') }}đ
                                    </td>
                                    <td class="cart-product-quantity">
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('PUT')
                                            <div class="cart-plus-minus">
                                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="cart-plus-minus-box form-control" style="width:80px">
                                            </div>
                                            <button type="submit" class="btn btn-sm theme-btn-2 mt-2">Cập nhật</button>
                                        </form>
                                    </td>
                                    <td class="cart-product-subtotal">
                                        {{ number_format( ($item->price ?? $item->product->price) * $item->quantity, 0, ',', '.') }}đ
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Giỏ hàng đang trống.</td>
                                </tr>
                                @endforelse
                                @if($cartItems->isNotEmpty())
                                <tr class="cart-coupon-row">
                                    <td colspan="6">
                                        <div class="cart-coupon d-flex gap-2">
                                            <form action="{{ route('cart.coupon.apply') }}" method="POST" class="d-flex w-100">
                                                @csrf
                                                <input type="text" name="coupon" placeholder="Coupon code" class="form-control me-2">
                                                <button type="submit" class="btn theme-btn-2 btn-effect-2">Áp dụng</button>
                                            </form>
                                            <form action="{{ route('cart.clear') }}" method="POST" style="margin-left:8px">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-secondary">Xóa giỏ</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    @if($cartItems->isNotEmpty())
                    @php
                        $subtotal = $cartItems->sum(function($i){
                            $price = $i->price ?? ($i->product->price ?? 0);
                            return $price * ($i->quantity ?? 0);
                        });
                        $shipping = $shipping ?? 15000; // vnđ example, you can override from controller
                        $vat = $vat ?? 0;
                        $orderTotal = $subtotal + $shipping + $vat;
                    @endphp

                    <div class="shoping-cart-total mt-50">
                        <h4>Cart Totals</h4>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Tổng tiền hàng</td>
                                    <td>{{ number_format($subtotal, 0, ',', '.') }}đ</td>
                                </tr>
                                <tr>
                                    <td>Phí vận chuyển</td>
                                    <td>{{ number_format($shipping, 0, ',', '.') }}đ</td>
                                </tr>
                                <tr>
                                    <td>VAT</td>
                                    <td>{{ number_format($vat, 0, ',', '.') }}đ</td>
                                </tr>
                                <tr>
                                    <td><strong>Tổng thanh toán</strong></td>
                                    <td><strong>{{ number_format($orderTotal, 0, ',', '.') }}đ</strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="btn-wrapper text-end">
                            <a href="{{ route('checkout') }}" class="theme-btn-1 btn btn-effect-1">Tiến hành thanh toán</a>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div> 
</div>
<!-- SHOPPING CART AREA END -->
@endsection
