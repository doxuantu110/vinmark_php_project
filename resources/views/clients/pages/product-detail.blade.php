@extends('layouts.client')

@section('title', 'Chi tiết sản phẩm')
@section('breadcrumb', 'Chi tiết sản phẩm')

@section('content')
    <!-- SHOP DETAILS AREA START -->
    <div class="ltn__shop-details-area pb-85">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__shop-details-inner mb-60">
                        <div class="row">

                            <!-- PRODUCT IMAGES -->
                            <div class="col-md-6">
                                <div class="ltn__shop-details-img-gallery">

                                    <!-- ẢNH LỚN -->
                                    <div class="ltn__shop-details-large-img slick-arrow-1">
                                        @foreach ($product->images as $item)
                                            <div class="single-large-img">
                                                <a href="{{ asset('storage/' . $item->image) }}"
                                                    data-rel="lightcase:productGallery">
                                                    <img src="{{ asset('storage/' . $item->image) }}"
                                                        alt="{{ $product->name }}">
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- THUMBNAIL -->
                                    <div class="ltn__shop-details-small-img slick-arrow-2">
                                        @foreach ($product->images as $item)
                                            <div class="single-small-img">
                                                <img src="{{ asset('storage/' . $item->image) }}"
                                                    alt="{{ $product->name }}">
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>


                            <!-- PRODUCT INFO -->
                            <div class="col-md-6">
                                <div class="modal-product-info shop-details-info pl-0">

                                    <!-- RATING -->
                                    <div class="product-ratting mb-10">
                                        @include('clients.components.include.rating', [
                                            'product' => $product,
                                        ])
                                    </div>

                                    <!-- NAME -->
                                    <h2 class="product-title">{{ $product->name }}</h2>

                                    <!-- PRICE -->
                                    <div class="product-price mb-10">
                                        <span class="price">
                                            {{ number_format($product->price, 0, ',', '.') }} đ
                                        </span>
                                    </div>

                                    <!-- CATEGORY -->
                                    <div class="modal-product-meta ltn__product-details-menu-1 mb-10">
                                        <ul>
                                            <li>
                                                <strong>Danh mục:</strong>
                                                <span>
                                                    <a href="javascript:void(0)">
                                                        {{ $product->category->name }}
                                                    </a>
                                                </span>
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- QUANTITY & ADD TO CART -->
                                    <div class="ltn__product-details-menu-2">
                                        <ul>
                                            <li>
                                                <div class="cart-plus-minus">
                                                    <div class="dec qtybutton">-</div>
                                                    <input type="text" value="1" name="qtybutton"
                                                        class="cart-plus-minus-box" readonly
                                                        data-max="{{ $product->stock }}">
                                                    <div class="inc qtybutton">+</div>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)"
                                                    class="theme-btn-1 btn btn-effect-1 add-to-cart-btn"
                                                    title="Thêm vào giỏ hàng" data-id="{{ $product->id }}">
                                                    <i class="fas fa-shopping-cart"></i>
                                                    <span>Thêm vào giỏ</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- WISHLIST -->
                                    <div class="ltn__product-details-menu-3">
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0)" title="Yêu thích" data-bs-toggle="modal"
                                                    data-bs-target="#liton_wishlist_modal">
                                                    <i class="far fa-heart"></i>
                                                    <span>Thêm vào yêu thích</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <hr>
                                    <!-- SOCIAL SHARE -->
                                    <div class="ltn__social-media">
                                        <ul>
                                            <li>Chia sẻ:</li>
                                            <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                                            </li>
                                            <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#" title="LinkedIn"><i class="fab fa-linkedin"></i></a></li>
                                            <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                                            </li>
                                        </ul>
                                    </div>

                                    <hr>

                                    <!-- SAFE CHECKOUT -->
                                    <div class="ltn__safe-checkout">
                                        <h5>Thanh toán an toàn & bảo mật</h5>
                                        <img src="{{ asset('assets/clients/img/icons/payment-2.png') }}"
                                            alt="Phương thức thanh toán">
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- PRODUCT TABS -->
                    <div class="ltn__shop-details-tab-inner ltn__shop-details-tab-inner-2">
                        <div class="ltn__shop-details-tab-menu">
                            <div class="nav">
                                <a class="active show" data-bs-toggle="tab" href="#liton_tab_details_description">
                                    Mô tả sản phẩm
                                </a>
                                <a data-bs-toggle="tab" href="#liton_tab_details_1_2">
                                    Đánh giá
                                </a>
                            </div>
                        </div>

                        <div class="tab-content">

                            <!-- DESCRIPTION TAB -->
                            <div class="tab-pane fade active show" id="liton_tab_details_description">
                                <div class="ltn__shop-details-tab-content-inner">
                                    <h4 class="title-2">Thông tin chi tiết</h4>
                                    <div class="product-description">
                                        {!! nl2br(e($product->description)) !!}
                                    </div>
                                </div>
                            </div>

                            <!-- REVIEW TAB -->
                            <div class="tab-pane fade" id="liton_tab_details_1_2">
                                <div class="ltn__shop-details-tab-content-inner">
                                    <h4 class="title-2">Đánh giá từ khách hàng</h4>

                                    <div class="product-ratting mb-20">
                                        <ul>
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= floor($averageRating))
                                                    <li><i class="fas fa-star"></i></li>
                                                @elseif($i == ceil($averageRating) && $averageRating - floor($averageRating) >= 0.5)
                                                    <li><i class="fas fa-star-half-alt"></i></li>
                                                @else
                                                    <li><i class="far fa-star"></i></li>
                                                @endif
                                            @endfor
                                            <li class="review-total">
                                                {{ $product->reviews->count() }} đánh giá
                                            </li>
                                        </ul>
                                    </div>

                                    <hr>

                                    <div class="ltn__comment-area mb-30">
                                        <div class="ltn__comment-inner">
                                            @include('clients.components.include.review-list', [
                                                'product' => $product,
                                            ])
                                        </div>
                                    </div>

                                    @if (Auth::check() && $hasPurchased && !$hasReviewed)
                                        <div class="ltn__comment-reply-area ltn__form-box mb-30">
                                            <form id="review-form" data-product-id="{{ $product->id }}">
                                                <h4 class="title-2">Gửi đánh giá của bạn</h4>
                                                <p class="text-muted mb-20">
                                                    Chia sẻ cảm nhận của bạn để giúp người khác lựa chọn tốt hơn.
                                                </p>

                                                <div class="mb-30">
                                                    <div class="add-a-review">
                                                        <h6>Đánh giá sao:</h6>
                                                        <div class="product-ratting">
                                                            <ul>
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <li>
                                                                        <a href="javascript:void(0)" class="rating-star"
                                                                            data-value="{{ $i }}">
                                                                            <i class="far fa-star"></i>
                                                                        </a>
                                                                    </li>
                                                                @endfor
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <input type="hidden" name="rating" id="rating-value" value="0">

                                                <div class="input-item input-item-textarea ltn__custom-icon">
                                                    <textarea id="review-content" placeholder="Nhận xét của bạn về sản phẩm này..."></textarea>
                                                </div>

                                                <div class="btn-wrapper">
                                                    <button class="btn theme-btn-1 btn-effect-1 text-uppercase"
                                                        type="submit">
                                                        Gửi đánh giá
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    @endif

                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- PRODUCT TABS END -->

                </div>
            </div>
        </div>
    </div>

    @include('clients.components.include.include-modal')
    <!-- SHOP DETAILS AREA END -->

    <!-- RELATED PRODUCTS -->
    <div class="ltn__product-slider-area ltn__product-gutter pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2">
                        <h6 class="section-subtitle ltn__secondary-color">
                            // Sản phẩm cùng danh mục
                        </h6>
                        <h1 class="section-title">
                            Có thể bạn sẽ thích<span>.</span>
                        </h1>
                    </div>
                </div>
            </div>

            <div class="row ltn__related-product-slider-one-active slick-arrow-1">
                @foreach ($relatedProducts as $product)
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="{{ route('product.detail', $product->slug) }}">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                                </a>
                                <div class="product-badge">
                                    <ul>
                                        <li class="sale-badge">Liên quan</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-ratting">
                                    @include('clients.components.include.rating', ['product' => $product])
                                </div>
                                <h2 class="product-title">
                                    <a href="{{ route('product.detail', $product->slug) }}">
                                        {{ $product->name }}
                                    </a>
                                </h2>
                                <div class="product-price">
                                    <span>
                                        {{ number_format($product->price, 0, ',', '.') }} đ
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @foreach ($relatedProducts as $product)
                @include('clients.components.include.include-modal')
            @endforeach
        </div>
    </div>
    <!-- RELATED PRODUCTS END -->

@endsection
