<div class="ltn__utilize-menu-head">
    <span class="ltn__utilize-menu-title">Cart</span>
    <button class="ltn__utilize-close">×</button>
</div>

<div class="mini-cart-product-area ltn__scrollbar">
    @if (!empty($cartItems) && count($cartItems) > 0)
        @php $subtotal = 0; @endphp
        @foreach ($cartItems as $item)
            @php
                $product = auth()->check()
                    ? \App\Models\Product::find($item['product_id'])
                    : \App\Models\Product::find($item['product_id']);
                $quantity = $item['quantity'];
                $subtotal += $product->price * $quantity;
            @endphp


            <div class="mini-cart-item clearfix">
                <div class="mini-cart-img">
                    <a href="#">
                        <img src="{{ asset(($item->product->image_url ?? 'storage/' . 'uploads/products/default-product.png')) }}"
                                                        alt="Sản phẩm"></a>
                    </a>
                    <span class="mini-cart-item-delete" data-id="{{ $product->id }}">
                        <i class="icon-cancel"></i>
                    </span>
                </div>
                <div class="mini-cart-info">
                    <h6><a href="#">{{ $product->name }}</a></h6>
                    <span class="mini-cart-quantity">{{ $quantity }} x
                        {{ number_format($product->price, 0, ',', '.') }} đ</span>
                </div>
            </div>
        @endforeach
    @else
        <p>Giỏ hàng của bạn đang trống.</p>
    @endif
</div>

<div class="mini-cart-footer">
    <div class="mini-cart-sub-total">
        <h5>Tổng tiền: <span>{{ number_format($subtotal ?? 0, 0, ',', '.') }} đ</span></h5>
    </div>
    <div class="btn-wrapper">
        <a href="{{route(('cart.index'))}}" class="theme-btn-1 btn btn-effect-1">Xem giỏ hàng</a>
        <a href="{{route('checkout')}}" class="theme-btn-2 btn btn-effect-2">Thanh toán</a>
    </div>
</div>
