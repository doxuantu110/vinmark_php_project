@extends('layouts.client_home')

@section('title', 'Trang chủ')

@section('content')

    <!-- SLIDER AREA START (slider-3) -->
    <div class="ltn__slider-area ltn__slider-3  section-bg-1">
        <div class="ltn__slide-one-active slick-slide-arrow-1 slick-slide-dots-1">
            <!-- ltn__slide-item -->
            <div class="ltn__slide-item ltn__slide-item-2 ltn__slide-item-3 ltn__slide-item-3-normal bg-image"
                data-bg="{{ asset('assets/clients/img/slider/13.jpg') }}">
                <div class="ltn__slide-item-inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 align-self-center">
                                <div class="slide-item-info">
                                    <div class="slide-item-info-inner ltn__slide-animation">
                                        <div class="slide-video mb-50 d-none">
                                            <a class="ltn__video-icon-2 ltn__video-icon-2-border"
                                                href="https://www.youtube.com/embed/ATI7vfCgwXE?autoplay=1&amp;showinfo=0"
                                                data-rel="lightcase:myCollection">
                                                <i class="fa fa-play"></i>
                                            </a>
                                        </div>
                                        <h6 class="slide-sub-title animated">
                                            <img src="{{ asset('assets/clients/img/icons/icon-img/1.png') }}"
                                                alt="#">
                                            VinMark – Chợ online cho mọi nhà
                                        </h6>
                                        <h1 class="slide-title animated ">
                                            Thực phẩm tươi mỗi ngày <br>
                                            Giá tốt – Mua thật tiện
                                        </h1>
                                        <div class="slide-brief animated">
                                            <p>
                                                Đi chợ nhanh gọn với VinMark, đầy đủ thực phẩm tươi sống
                                                và hàng tiêu dùng thiết yếu cho gia đình bạn.
                                            </p>
                                        </div>
                                        <div class="btn-wrapper animated">
                                            <a href="{{ route('products.index') }}"
                                                class="theme-btn-1 btn btn-effect-1 text-uppercase">
                                                Đi chợ ngay
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="slide-item-img">
                                                                                    <img src="img/slider/21.png" alt="#">
                                                                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ltn__slide-item -->
            <div class="ltn__slide-item ltn__slide-item-2 ltn__slide-item-3 ltn__slide-item-3-normal bg-image"
                data-bg="{{ asset('assets/clients/img/slider/14.jpg') }}">
                <div class="ltn__slide-item-inner  text-right text-end">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 align-self-center">
                                <div class="slide-item-info">
                                    <div class="slide-item-info-inner ltn__slide-animation">
                                        <h6 class="slide-sub-title ltn__secondary-color animated">
                                            // Tươi ngon • An tâm • Tiết kiệm
                                        </h6>
                                        <h1 class="slide-title animated ">
                                            Chọn kỹ từ nguồn <br>
                                            Giao nhanh tận nhà
                                        </h1>
                                        <div class="slide-brief animated">
                                            <p>
                                                Sản phẩm được kiểm soát chất lượng, giá cả rõ ràng,
                                                giao hàng nhanh chóng mỗi ngày.
                                            </p>
                                        </div>
                                        <div class="btn-wrapper animated">
                                            <a href="{{ route('products.index') }}"
                                                class="theme-btn-1 btn btn-effect-1 text-uppercase">
                                                Xem sản phẩm
                                            </a>
                                            <a href="{{ route('about') }}" class="btn btn-transparent btn-effect-3">
                                                Về VinMark
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="slide-item-img slide-img-left">
                                                                                    <img src="img/slider/22.png" alt="#">
                                                                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  -->
        </div>
    </div>

    <!-- SLIDER AREA END -->

    <!-- BANNER AREA START -->
    <div class="ltn__banner-area mt-120 mb-90">
        <div class="container">
            <div class="row ltn__custom-gutter--- justify-content-center">
                <div class="col-lg-6 col-md-6">
                    <div class="ltn__banner-item">
                        <div class="ltn__banner-img">
                            <a href="{{ route('products.index') }}"><img
                                    src="{{ asset('assets/clients/img/banner/menu-banner-1.png') }}" alt="Banner Image"></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ltn__banner-item">
                                <div class="ltn__banner-img">
                                    <a href="{{ route('products.index') }}"><img
                                            src="{{ asset('assets/clients/img/banner/mua-hang-bach-hoa-xanh-gia-re-cung-ngan-uu-dai-hap-dan-khac-202304211405028637.jpg') }}"
                                            alt="Banner Image"></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="ltn__banner-item">
                                <div class="ltn__banner-img">
                                    <a href="{{ route('products.index') }}"><img
                                            src="{{ asset('assets/clients/img/banner/mung-dai-le-giam-thay-me-hang-tram-san-pham-giam-gia-den-50-202104261423208766.jpg') }}"
                                            alt="Banner Image"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BANNER AREA END -->

    {{-- Categories and product area start --}}
    <div class="ltn__category-area pt-90 pb-90" style="background:#F7F9F4">
        <div class="container">
            <!-- TITLE -->
            <div class="row mb-40">
                <div class="col-lg-12">
                    <div class="section-title-area text-center">
                        <h2 class="section-title" style="color:#1B5E20">
                            Danh mục & Sản phẩm
                        </h2>
                    </div>
                </div>
            </div>

            <!-- CATEGORY -->
            <div class="row ltn__category-slider-active slick-arrow-1 nav justify-content-center mb-50" role="tablist">
                @foreach ($categories as $index => $category)
                    <div class="col-auto">
                        <a href="#tab_{{ $category->id }}" data-bs-toggle="tab"
                            class="bhx-category-item {{ $index == 0 ? 'active' : '' }}"
                            aria-selected="{{ $index == 0 ? 'true' : 'false' }}">
                            <div class="bhx-category-card">
                                <div class="bhx-category-img">
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}">
                                    <span class="bhx-badge">Danh mục</span>
                                </div>

                                <h6 class="mt-2 mb-0">{{ $category->name }}</h6>
                                {{-- <small>{{ $category->products->count() }} sản phẩm</small> --}}
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- PRODUCT -->
            <div class="tab-content">
                @foreach ($categories as $index => $category)
                    <div class="tab-pane {{ $index == 0 ? 'active show' : '' }}" id="tab_{{ $category->id }}">

                        <div class="ltn__product-tab-content-inner bhx-product-wrapper">
                            <div class="row ltn__tab-product-slider-one-active slick-arrow-1">

                                @forelse ($category->products as $product)
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-30">
                                        <div class="ltn__product-item ltn__product-item-3 text-center bhx-product-card">

                                            <div class="product-img">
                                                <a href="{{ route('product.detail', $product->slug) }}">
                                                    <img src="{{ $product->image_url }}"
                                                        data-src="{{ $product->image_url }}" alt="{{ $product->name }}">
                                                </a>
                                            </div>
                                            <div class="product-hover-action">
                                                <ul>
                                                    <li>
                                                        <a href="#" title="Xem nhanh" data-bs-toggle="modal"
                                                            data-bs-target="#quick_view_modal-{{ $product->id }}">
                                                            <i class="far fa-eye"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" title="Thêm vào giỏ hàng"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#add_to_cart_modal-{{ $product->id }}">
                                                            <i class="fas fa-shopping-cart"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" title="Yêu thích" data-bs-toggle="modal"
                                                            data-bs-target="#liton_wishlist_modal-{{ $product->id }}">
                                                            <i class="far fa-heart"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="product-info">
                                                <div class="product-ratting">
                                                    @include('clients.components.include.rating', [
                                                        'product' => $product,
                                                    ])
                                                </div>

                                                <h2 class="product-title">
                                                    <a href="{{ route('product.detail', $product->slug) }}">
                                                        {{ $product->name }}
                                                    </a>
                                                </h2>

                                                <div class="product-price">
                                                    <span class="bhx-price">
                                                        {{ number_format($product->price, 0, '.', '.') }}₫
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center text-muted py-40">
                                        Đang cập nhật sản phẩm...
                                    </div>
                                @endforelse

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @foreach ($categories as $category)
                @foreach ($category->products as $product)
                    @include('clients.components.include.include-modal')
                @endforeach
            @endforeach
        </div>
    </div>
    {{-- Categories and product area end --}}
    <!-- COUNTER UP AREA START -->
    <div class="ltn__counterup-area bg-image bg-overlay-theme-black-80 pt-115 pb-70" data-bg="img/bg/5.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 align-self-center">
                    <div class="ltn__counterup-item-3 text-color-white text-center">
                        <div class="counter-icon"> <img src="{{ asset('assets/clients/img/icons/icon-img/2.png') }}"
                                alt="#"> </div>
                        <h1><span class="counter">733</span><span class="counterUp-icon">+</span> </h1>
                        <h6>Khách hàng thân thiết</h6>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 align-self-center">
                    <div class="ltn__counterup-item-3 text-color-white text-center">
                        <div class="counter-icon"> <img src="{{ asset('assets/clients/img/icons/icon-img/3.png') }}"
                                alt="#"> </div>
                        <h1><span class="counter">33</span><span class="counterUp-icon">+</span> </h1>
                        <h6>Đơn hàng mỗi tháng</h6>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 align-self-center">
                    <div class="ltn__counterup-item-3 text-color-white text-center">
                        <div class="counter-icon"> <img src="{{ asset('assets/clients/img/icons/icon-img/4.png') }}"
                                alt="#"> </div>
                        <h1><span class="counter">100</span><span class="counterUp-icon">+</span> </h1>
                        <h6>Ưu đãi hấp dẫn</h6>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 align-self-center">
                    <div class="ltn__counterup-item-3 text-color-white text-center">
                        <div class="counter-icon"> <img src="{{ asset('assets/clients/img/icons/icon-img/5.png') }}"
                                alt="#"> </div>
                        <h1><span class="counter">21</span><span class="counterUp-icon">+</span> </h1>
                        <h6>Tỉnh thành phục vụ</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- COUNTER UP AREA END -->

    <!-- PRODUCT AREA START (bestSelling) -->
    <div class="ltn__product-area ltn__product-gutter pt-115 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2 text-center">
                        <h1 class="section-title">Sản phẩm bán chạy nhất</h1>
                    </div>
                </div>
            </div>
            <div class="row ltn__tab-product-slider-one-active--- slick-arrow-1">
                @foreach ($bestSellingProducts as $product)
                    <!-- ltn__product-item -->
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                        <div class="ltn__product-item ltn__product-item-3 text-left">
                            <div class="product-img">
                                <a href="{{ route('product.detail', $product->slug) }}"><img
                                        src="{{ $product->image_url }}" alt="#"></a>
                                <div class="product-hover-action">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)" title="Xem nhanh" data-bs-toggle="modal"
                                                data-bs-target="#quick_view_modal-{{ $product->id }}">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" title="Thêm vào giỏ hàng" data-bs-toggle="modal"
                                                data-bs-target="#add_to_cart_modal-{{ $product->id }}">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" title="Yêu thích" class="add-to-wishlist"
                                                data-id="{{ $product->id }}">
                                                <i class="far fa-heart"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-ratting">
                                    @include('clients.components.include.rating', [
                                        'product' => $product,
                                    ])
                                </div>
                                <h2 class="product-title"><a
                                        href="{{ route('product.detail', $product->slug) }}">{{ $product->name }}</a>
                                </h2>
                                <div class="product-price">
                                    <span>{{ number_format($product->price, 0, '.', '.') }}VND</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                @endforeach
            </div>
        </div>
    </div>

    <!-- PRODUCT AREA END -->

@endsection
