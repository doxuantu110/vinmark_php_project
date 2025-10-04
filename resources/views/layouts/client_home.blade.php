
@extends('layouts.client')

@section('title', 'Trang chủ')

@section('content')
<!-- SLIDER AREA START (slider-3) -->
<div class="ltn__slider-area ltn__slider-3 section-bg-1">
    <div class="ltn__slide-one-active slick-slide-arrow-1 slick-slide-dots-1">
        <!-- ltn__slide-item -->
        <div class="ltn__slide-item ltn__slide-item-2 ltn__slide-item-3 ltn__slide-item-3-normal bg-image"
            data-bg="{{ asset('img/slider/13.jpg') }}">
            <div class="ltn__slide-item-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 align-self-center">
                            <div class="slide-item-info">
                                <div class="slide-item-info-inner ltn__slide-animation">
                                    <h6 class="slide-sub-title animated"><img src="{{ asset('img/icons/icon-img/1.png') }}" alt="#"> 100% genuine Products</h6>
                                    <h1 class="slide-title animated">Thực phẩm tươi ngon <br> từ trang trại</h1>
                                    <div class="slide-brief animated">
                                        <p>Chúng tôi cung cấp những sản phẩm thực phẩm tươi ngon, sạch và an toàn nhất từ các trang trại uy tín.</p>
                                    </div>
                                    <div class="btn-wrapper animated">
                                        <a href="#" class="theme-btn-1 btn btn-effect-1 text-uppercase">Khám phá sản phẩm</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ltn__slide-item -->
        <div class="ltn__slide-item ltn__slide-item-2 ltn__slide-item-3 ltn__slide-item-3-normal bg-image"
            data-bg="{{ asset('img/slider/14.jpg') }}">
            <div class="ltn__slide-item-inner text-right text-end">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 align-self-center">
                            <div class="slide-item-info">
                                <div class="slide-item-info-inner ltn__slide-animation">
                                    <h6 class="slide-sub-title ltn__secondary-color animated">// CHẤT LƯỢNG & AN TOÀN</h6>
                                    <h1 class="slide-title animated">Thực phẩm hữu cơ <br> ngon & lành</h1>
                                    <div class="slide-brief animated">
                                        <p>Cam kết mang đến cho bạn những sản phẩm thực phẩm hữu cơ chất lượng cao, an toàn cho sức khỏe.</p>
                                    </div>
                                    <div class="btn-wrapper animated">
                                        <a href="#" class="theme-btn-1 btn btn-effect-1 text-uppercase">Khám phá sản phẩm</a>
                                        <a href="#" class="btn btn-transparent btn-effect-3">TÌM HIỂU THÊM</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                        <a href="#"><img src="{{ asset('img/banner/13.png') }}" alt="Banner Image"></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__banner-item">
                            <div class="ltn__banner-img">
                                <a href="#"><img src="{{ asset('img/banner/14.png') }}" alt="Banner Image"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ltn__banner-item">
                            <div class="ltn__banner-img">
                                <a href="#"><img src="{{ asset('img/banner/15.png') }}" alt="Banner Image"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BANNER AREA END -->

<!-- CATEGORY AREA START -->
<div class="ltn__category-area section-bg-1-- ltn__primary-bg before-bg-1 bg-image bg-overlay-theme-black-5--0 pt-115 pb-90" data-bg="{{ asset('img/bg/5.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2 text-center">
                    <h1 class="section-title white-color">Danh mục sản phẩm</h1>
                </div>
            </div>
        </div>
        <div class="row ltn__category-slider-active slick-arrow-1">
            <div class="col-12">
                <div class="ltn__category-item ltn__category-item-3 text-center">
                    <div class="ltn__category-item-img">
                        <a href="#">
                            <img src="{{ asset('img/icons/icon-img/category-1.png') }}" alt="Image">
                        </a>
                    </div>
                    <div class="ltn__category-item-name">
                        <h5><a href="#">Tất cả sản phẩm</a></h5>
                        <h6>(235 sản phẩm)</h6>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="ltn__category-item ltn__category-item-3 text-center">
                    <div class="ltn__category-item-img">
                        <a href="#">
                            <img src="{{ asset('img/icons/icon-img/category-2.png') }}" alt="Image">
                        </a>
                    </div>
                    <div class="ltn__category-item-name">
                        <h5><a href="#">Rau củ</a></h5>
                        <h6>(78 sản phẩm)</h6>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="ltn__category-item ltn__category-item-3 text-center">
                    <div class="ltn__category-item-img">
                        <a href="#">
                            <img src="{{ asset('img/icons/icon-img/category-3.png') }}" alt="Image">
                        </a>
                    </div>
                    <div class="ltn__category-item-name">
                        <h5><a href="#">Trái cây</a></h5>
                        <h6>(45 sản phẩm)</h6>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="ltn__category-item ltn__category-item-3 text-center">
                    <div class="ltn__category-item-img">
                        <a href="#">
                            <img src="{{ asset('img/icons/icon-img/category-4.png') }}" alt="Image">
                        </a>
                    </div>
                    <div class="ltn__category-item-name">
                        <h5><a href="#">Thịt</a></h5>
                        <h6>(15 sản phẩm)</h6>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="ltn__category-item ltn__category-item-3 text-center">
                    <div class="ltn__category-item-img">
                        <a href="#">
                            <img src="{{ asset('img/icons/icon-img/category-5.png') }}" alt="Image">
                        </a>
                    </div>
                    <div class="ltn__category-item-name">
                        <h5><a href="#">Cá</a></h5>
                        <h6>(25 sản phẩm)</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CATEGORY AREA END -->

<!-- PRODUCT TAB AREA START -->
<div class="ltn__product-tab-area ltn__product-gutter pt-115 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2 text-center">
                    <h1 class="section-title">Sản phẩm của chúng tôi</h1>
                </div>
                <div class="ltn__tab-menu ltn__tab-menu-2 ltn__tab-menu-top-right-- text-uppercase text-center">
                    <div class="nav">
                        <a class="active show" data-bs-toggle="tab" href="#liton_tab_3_1">Đồ ăn & Thức uống</a>
                        <a data-bs-toggle="tab" href="#liton_tab_3_2" class="">Rau củ</a>
                        <a data-bs-toggle="tab" href="#liton_tab_3_3" class="">Thực phẩm khô</a>
                        <a data-bs-toggle="tab" href="#liton_tab_3_4" class="">Bánh & Kẹo</a>
                        <a data-bs-toggle="tab" href="#liton_tab_3_5" class="">Cá & Thịt</a>
                    </div>
                </div>
                <div class="tab-content">
                    <!-- Tab 1: Đồ ăn & Thức uống -->
                    <div class="tab-pane fade active show" id="liton_tab_3_1">
                        <div class="ltn__product-tab-content-inner">
                            <div class="row ltn__tab-product-slider-one-active slick-arrow-1">
                                <!-- Product Item 1 -->
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                    <div class="ltn__product-item ltn__product-item-3 text-left">
                                        <div class="product-img">
                                            <a href="#"><img src="{{ asset('img/product/1.png') }}" alt="#"></a>
                                            <div class="product-badge">
                                                <ul>
                                                    <li class="sale-badge">Mới</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <h2 class="product-title"><a href="#">Nước ép cam</a></h2>
                                            <div class="product-price">
                                                <span>25.000đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product Item 2 -->
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                    <div class="ltn__product-item ltn__product-item-3 text-left">
                                        <div class="product-img">
                                            <a href="#"><img src="{{ asset('img/product/2.png') }}" alt="#"></a>
                                        </div>
                                        <div class="product-info">
                                            <h2 class="product-title"><a href="#">Cà phê hữu cơ</a></h2>
                                            <div class="product-price">
                                                <span>45.000đ</span>
                                                <del>55.000đ</del>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product Item 3 -->
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                    <div class="ltn__product-item ltn__product-item-3 text-left">
                                        <div class="product-img">
                                            <a href="#"><img src="{{ asset('img/product/3.png') }}" alt="#"></a>
                                        </div>
                                        <div class="product-info">
                                            <h2 class="product-title"><a href="#">Trà xanh</a></h2>
                                            <div class="product-price">
                                                <span>35.000đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product Item 4 -->
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                    <div class="ltn__product-item ltn__product-item-3 text-left">
                                        <div class="product-img">
                                            <a href="#"><img src="{{ asset('img/product/4.png') }}" alt="#"></a>
                                        </div>
                                        <div class="product-info">
                                            <h2 class="product-title"><a href="#">Sữa tươi</a></h2>
                                            <div class="product-price">
                                                <span>28.000đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tab 2: Rau củ -->
                    <div class="tab-pane fade" id="liton_tab_3_2">
                        <div class="ltn__product-tab-content-inner">
                            <div class="row ltn__tab-product-slider-one-active slick-arrow-1">
                                <!-- Product Item 1 -->
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                    <div class="ltn__product-item ltn__product-item-3 text-left">
                                        <div class="product-img">
                                            <a href="#"><img src="{{ asset('img/product/5.png') }}" alt="#"></a>
                                        </div>
                                        <div class="product-info">
                                            <h2 class="product-title"><a href="#">Cà rôt tươi</a></h2>
                                            <div class="product-price">
                                                <span>15.000đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product Item 2 -->
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                    <div class="ltn__product-item ltn__product-item-3 text-left">
                                        <div class="product-img">
                                            <a href="#"><img src="{{ asset('img/product/6.png') }}" alt="#"></a>
                                        </div>
                                        <div class="product-info">
                                            <h2 class="product-title"><a href="#">Bông cải xanh</a></h2>
                                            <div class="product-price">
                                                <span>22.000đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product Item 3 -->
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                    <div class="ltn__product-item ltn__product-item-3 text-left">
                                        <div class="product-img">
                                            <a href="#"><img src="{{ asset('img/product/7.png') }}" alt="#"></a>
                                        </div>
                                        <div class="product-info">
                                            <h2 class="product-title"><a href="#">Rau xà lách</a></h2>
                                            <div class="product-price">
                                                <span>12.000đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product Item 4 -->
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                    <div class="ltn__product-item ltn__product-item-3 text-left">
                                        <div class="product-img">
                                            <a href="#"><img src="{{ asset('img/product/8.png') }}" alt="#"></a>
                                        </div>
                                        <div class="product-info">
                                            <h2 class="product-title"><a href="#">Khoai tây</a></h2>
                                            <div class="product-price">
                                                <span>18.000đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tab 3: Thực phẩm khô -->
                    <div class="tab-pane fade" id="liton_tab_3_3">
                        <div class="ltn__product-tab-content-inner">
                            <div class="row ltn__tab-product-slider-one-active slick-arrow-1">
                                <!-- Product Item 1 -->
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                    <div class="ltn__product-item ltn__product-item-3 text-left">
                                        <div class="product-img">
                                            <a href="#"><img src="{{ asset('img/product/1.png') }}" alt="#"></a>
                                        </div>
                                        <div class="product-info">
                                            <h2 class="product-title"><a href="#">Gạo hữu cơ</a></h2>
                                            <div class="product-price">
                                                <span>85.000đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product Item 2 -->
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                    <div class="ltn__product-item ltn__product-item-3 text-left">
                                        <div class="product-img">
                                            <a href="#"><img src="{{ asset('img/product/2.png') }}" alt="#"></a>
                                        </div>
                                        <div class="product-info">
                                            <h2 class="product-title"><a href="#">Đậu xanh</a></h2>
                                            <div class="product-price">
                                                <span>45.000đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product Item 3 -->
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                    <div class="ltn__product-item ltn__product-item-3 text-left">
                                        <div class="product-img">
                                            <a href="#"><img src="{{ asset('img/product/3.png') }}" alt="#"></a>
                                        </div>
                                        <div class="product-info">
                                            <h2 class="product-title"><a href="#">Hạt điều</a></h2>
                                            <div class="product-price">
                                                <span>120.000đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product Item 4 -->
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                    <div class="ltn__product-item ltn__product-item-3 text-left">
                                        <div class="product-img">
                                            <a href="#"><img src="{{ asset('img/product/4.png') }}" alt="#"></a>
                                        </div>
                                        <div class="product-info">
                                            <h2 class="product-title"><a href="#">Mì gạo</a></h2>
                                            <div class="product-price">
                                                <span>32.000đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tab 4: Bánh & Kẹo -->
                    <div class="tab-pane fade" id="liton_tab_3_4">
                        <div class="ltn__product-tab-content-inner">
                            <div class="row ltn__tab-product-slider-one-active slick-arrow-1">
                                <!-- Product Item 1 -->
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                    <div class="ltn__product-item ltn__product-item-3 text-left">
                                        <div class="product-img">
                                            <a href="#"><img src="{{ asset('img/product/5.png') }}" alt="#"></a>
                                        </div>
                                        <div class="product-info">
                                            <h2 class="product-title"><a href="#">Bánh quy yến mạch</a></h2>
                                            <div class="product-price">
                                                <span>38.000đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product Item 2 -->
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                    <div class="ltn__product-item ltn__product-item-3 text-left">
                                        <div class="product-img">
                                            <a href="#"><img src="{{ asset('img/product/6.png') }}" alt="#"></a>
                                        </div>
                                        <div class="product-info">
                                            <h2 class="product-title"><a href="#">Kẹo mật ong</a></h2>
                                            <div class="product-price">
                                                <span>25.000đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product Item 3 -->
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                    <div class="ltn__product-item ltn__product-item-3 text-left">
                                        <div class="product-img">
                                            <a href="#"><img src="{{ asset('img/product/7.png') }}" alt="#"></a>
                                        </div>
                                        <div class="product-info">
                                            <h2 class="product-title"><a href="#">Bánh mì nguyên cám</a></h2>
                                            <div class="product-price">
                                                <span>22.000đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product Item 4 -->
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                    <div class="ltn__product-item ltn__product-item-3 text-left">
                                        <div class="product-img">
                                            <a href="#"><img src="{{ asset('img/product/8.png') }}" alt="#"></a>
                                        </div>
                                        <div class="product-info">
                                            <h2 class="product-title"><a href="#">Chocolate đen</a></h2>
                                            <div class="product-price">
                                                <span>65.000đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tab 5: Cá & Thịt -->
                    <div class="tab-pane fade" id="liton_tab_3_5">
                        <div class="ltn__product-tab-content-inner">
                            <div class="row ltn__tab-product-slider-one-active slick-arrow-1">
                                <!-- Product Item 1 -->
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                    <div class="ltn__product-item ltn__product-item-3 text-left">
                                        <div class="product-img">
                                            <a href="#"><img src="{{ asset('img/product/1.png') }}" alt="#"></a>
                                        </div>
                                        <div class="product-info">
                                            <h2 class="product-title"><a href="#">Cá hồi tươi</a></h2>
                                            <div class="product-price">
                                                <span>350.000đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product Item 2 -->
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                    <div class="ltn__product-item ltn__product-item-3 text-left">
                                        <div class="product-img">
                                            <a href="#"><img src="{{ asset('img/product/2.png') }}" alt="#"></a>
                                        </div>
                                        <div class="product-info">
                                            <h2 class="product-title"><a href="#">Thịt bò hữu cơ</a></h2>
                                            <div class="product-price">
                                                <span>280.000đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product Item 3 -->
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                    <div class="ltn__product-item ltn__product-item-3 text-left">
                                        <div class="product-img">
                                            <a href="#"><img src="{{ asset('img/product/3.png') }}" alt="#"></a>
                                        </div>
                                        <div class="product-info">
                                            <h2 class="product-title"><a href="#">Gà ta thả vườn</a></h2>
                                            <div class="product-price">
                                                <span>180.000đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product Item 4 -->
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                    <div class="ltn__product-item ltn__product-item-3 text-left">
                                        <div class="product-img">
                                            <a href="#"><img src="{{ asset('img/product/4.png') }}" alt="#"></a>
                                        </div>
                                        <div class="product-info">
                                            <h2 class="product-title"><a href="#">Tôm sú tươi</a></h2>
                                            <div class="product-price">
                                                <span>450.000đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- PRODUCT TAB AREA END -->

<!-- COUNTER UP AREA START -->
<div class="ltn__counterup-area bg-image bg-overlay-theme-black-80 pt-115 pb-70" data-bg="{{ asset('img/bg/5.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 align-self-center">
                <div class="ltn__counterup-item-3 text-color-white text-center">
                    <div class="counter-icon"> <img src="{{ asset('img/icons/icon-img/2.png') }}" alt="#"> </div>
                    <h1><span class="counter">733</span><span class="counterUp-icon">+</span> </h1>
                    <h6>Khách hàng tích cực</h6>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 align-self-center">
                <div class="ltn__counterup-item-3 text-color-white text-center">
                    <div class="counter-icon"> <img src="{{ asset('img/icons/icon-img/3.png') }}" alt="#"> </div>
                    <h1><span class="counter">33</span><span class="counterUp-letter">K</span><span class="counterUp-icon">+</span> </h1>
                    <h6>Ly cà phê</h6>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 align-self-center">
                <div class="ltn__counterup-item-3 text-color-white text-center">
                    <div class="counter-icon"> <img src="{{ asset('img/icons/icon-img/4.png') }}" alt="#"> </div>
                    <h1><span class="counter">100</span><span class="counterUp-icon">+</span> </h1>
                    <h6>Phần thưởng</h6>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 align-self-center">
                <div class="ltn__counterup-item-3 text-color-white text-center">
                    <div class="counter-icon"> <img src="{{ asset('img/icons/icon-img/5.png') }}" alt="#"> </div>
                    <h1><span class="counter">21</span><span class="counterUp-icon">+</span> </h1>
                    <h6>Quốc gia phủ sóng</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- COUNTER UP AREA END -->

<!-- FEATURED PRODUCTS AREA START -->
<div class="ltn__product-area ltn__product-gutter pt-115 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2 text-center">
                    <h1 class="section-title">Sản phẩm nổi bật</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Product Item 1 -->
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="ltn__product-item ltn__product-item-3 text-left">
                    <div class="product-img">
                        <a href="#"><img src="{{ asset('img/product/1.png') }}" alt="#"></a>
                        <div class="product-badge">
                            <ul>
                                <li class="sale-badge">Mới</li>
                            </ul>
                        </div>
                        <div class="product-hover-action">
                            <ul>
                                <li>
                                    <a href="#" title="Xem nhanh" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                        <i class="far fa-eye"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Thêm vào giỏ" data-bs-toggle="modal" data-bs-target="#add_to_cart_modal">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Yêu thích" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                        <i class="far fa-heart"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-ratting">
                            <ul>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                <li><a href="#"><i class="far fa-star"></i></a></li>
                            </ul>
                        </div>
                        <h2 class="product-title"><a href="#">Cà rôt tươi</a></h2>
                        <div class="product-price">
                            <span>32.000đ</span>
                            <del>46.000đ</del>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Item 2 -->
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="ltn__product-item ltn__product-item-3 text-left">
                    <div class="product-img">
                        <a href="#"><img src="{{ asset('img/product/2.png') }}" alt="#"></a>
                        <div class="product-badge">
                            <ul>
                                <li class="sale-badge sale-discount">-15%</li>
                            </ul>
                        </div>
                        <div class="product-hover-action">
                            <ul>
                                <li>
                                    <a href="#" title="Xem nhanh" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                        <i class="far fa-eye"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Thêm vào giỏ" data-bs-toggle="modal" data-bs-target="#add_to_cart_modal">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Yêu thích" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                        <i class="far fa-heart"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-ratting">
                            <ul>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="far fa-star"></i></a></li>
                            </ul>
                        </div>
                        <h2 class="product-title"><a href="#">Bông cải xanh</a></h2>
                        <div class="product-price">
                            <span>28.000đ</span>
                            <del>35.000đ</del>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Item 3 -->
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="ltn__product-item ltn__product-item-3 text-left">
                    <div class="product-img">
                        <a href="#"><img src="{{ asset('img/product/3.png') }}" alt="#"></a>
                        <div class="product-badge">
                            <ul>
                                <li class="sale-badge hot-sale">Hot</li>
                            </ul>
                        </div>
                        <div class="product-hover-action">
                            <ul>
                                <li>
                                    <a href="#" title="Xem nhanh" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                        <i class="far fa-eye"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Thêm vào giỏ" data-bs-toggle="modal" data-bs-target="#add_to_cart_modal">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Yêu thích" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                        <i class="far fa-heart"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-ratting">
                            <ul>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                            </ul>
                        </div>
                        <h2 class="product-title"><a href="#">Táo xanh</a></h2>
                        <div class="product-price">
                            <span>45.000đ</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Item 4 -->
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="ltn__product-item ltn__product-item-3 text-left">
                    <div class="product-img">
                        <a href="#"><img src="{{ asset('img/product/4.png') }}" alt="#"></a>
                        <div class="product-badge">
                            <ul>
                                <li class="sale-badge organic">Hữu cơ</li>
                            </ul>
                        </div>
                        <div class="product-hover-action">
                            <ul>
                                <li>
                                    <a href="#" title="Xem nhanh" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                        <i class="far fa-eye"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Thêm vào giỏ" data-bs-toggle="modal" data-bs-target="#add_to_cart_modal">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Yêu thích" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                        <i class="far fa-heart"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-ratting">
                            <ul>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                            </ul>
                        </div>
                        <h2 class="product-title"><a href="#">Rau xà lách</a></h2>
                        <div class="product-price">
                            <span>18.000đ</span>
                            <del>22.000đ</del>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Item 5 -->
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="ltn__product-item ltn__product-item-3 text-left">
                    <div class="product-img">
                        <a href="#"><img src="{{ asset('img/product/5.png') }}" alt="#"></a>
                        <div class="product-hover-action">
                            <ul>
                                <li>
                                    <a href="#" title="Xem nhanh" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                        <i class="far fa-eye"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Thêm vào giỏ" data-bs-toggle="modal" data-bs-target="#add_to_cart_modal">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Yêu thích" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                        <i class="far fa-heart"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-ratting">
                            <ul>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                <li><a href="#"><i class="far fa-star"></i></a></li>
                            </ul>
                        </div>
                        <h2 class="product-title"><a href="#">Chuối</a></h2>
                        <div class="product-price">
                            <span>25.000đ</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Item 6 -->
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="ltn__product-item ltn__product-item-3 text-left">
                    <div class="product-img">
                        <a href="#"><img src="{{ asset('img/product/6.png') }}" alt="#"></a>
                        <div class="product-badge">
                            <ul>
                                <li class="sale-badge sale-discount">-20%</li>
                            </ul>
                        </div>
                        <div class="product-hover-action">
                            <ul>
                                <li>
                                    <a href="#" title="Xem nhanh" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                        <i class="far fa-eye"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Thêm vào giỏ" data-bs-toggle="modal" data-bs-target="#add_to_cart_modal">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Yêu thích" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                        <i class="far fa-heart"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-ratting">
                            <ul>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="far fa-star"></i></a></li>
                            </ul>
                        </div>
                        <h2 class="product-title"><a href="#">Nho đỏ</a></h2>
                        <div class="product-price">
                            <span>80.000đ</span>
                            <del>100.000đ</del>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Item 7 -->
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="ltn__product-item ltn__product-item-3 text-left">
                    <div class="product-img">
                        <a href="#"><img src="{{ asset('img/product/7.png') }}" alt="#"></a>
                        <div class="product-hover-action">
                            <ul>
                                <li>
                                    <a href="#" title="Xem nhanh" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                        <i class="far fa-eye"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Thêm vào giỏ" data-bs-toggle="modal" data-bs-target="#add_to_cart_modal">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Yêu thích" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                        <i class="far fa-heart"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-ratting">
                            <ul>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                            </ul>
                        </div>
                        <h2 class="product-title"><a href="#">Cam tươi</a></h2>
                        <div class="product-price">
                            <span>35.000đ</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Item 8 -->
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="ltn__product-item ltn__product-item-3 text-left">
                    <div class="product-img">
                        <a href="#"><img src="{{ asset('img/product/8.png') }}" alt="#"></a>
                        <div class="product-badge">
                            <ul>
                                <li class="sale-badge new-product">Mới</li>
                            </ul>
                        </div>
                        <div class="product-hover-action">
                            <ul>
                                <li>
                                    <a href="#" title="Xem nhanh" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                        <i class="far fa-eye"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Thêm vào giỏ" data-bs-toggle="modal" data-bs-target="#add_to_cart_modal">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Yêu thích" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                        <i class="far fa-heart"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-ratting">
                            <ul>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                <li><a href="#"><i class="far fa-star"></i></a></li>
                            </ul>
                        </div>
                        <h2 class="product-title"><a href="#">Khoai tây</a></h2>
                        <div class="product-price">
                            <span>15.000đ</span>
                            <del>20.000đ</del>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- View All Products Button -->
        <div class="row">
            <div class="col-lg-12 text-center mt-50">
                <a href="#" class="theme-btn-1 btn btn-effect-1 text-uppercase">XEM TẤT CẢ SẢN PHẨM</a>
            </div>
        </div>
    </div>
</div>
<!-- FEATURED PRODUCTS AREA END -->

<!-- CALL TO ACTION START -->
<div class="ltn__call-to-action-area ltn__call-to-action-4 bg-image pt-115 pb-120" data-bg="{{ asset('img/bg/6.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="call-to-action-inner call-to-action-inner-4 text-center">
                    <div class="section-title-area ltn__section-title-2">
                        <h6 class="section-subtitle ltn__secondary-color">// Có câu hỏi  //</h6>
                        <h1 class="section-title white-color">0123-456-789</h1>
                    </div>
                    <div class="btn-wrapper">
                        <a href="tel:+0123456789" class="theme-btn-1 btn btn-effect-1">GỌI NGAY</a>
                        <a href="#" class="btn btn-transparent btn-effect-4 white-color">LIÊN HỆ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ltn__call-to-4-img-1">
        <img src="{{ asset('img/bg/12.png') }}" alt="#">
    </div>
    <div class="ltn__call-to-4-img-2">
        <img src="{{ asset('img/bg/11.png') }}" alt="#">
    </div>
</div>
<!-- CALL TO ACTION END -->

<!-- BLOG AREA START -->
<div class="ltn__blog-area pt-115 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2 text-center">
                    <h1 class="section-title white-color---">Tin tức mới nhất</h1>
                </div>
            </div>
        </div>
        <div class="row ltn__blog-slider-one-active slick-arrow-1 ltn__blog-item-3-normal">
            <!-- Blog items sẽ được load từ database -->
            <!-- Sample blog item -->
            <div class="col-lg-12">
                <div class="ltn__blog-item ltn__blog-item-3">
                    <div class="ltn__blog-img">
                        <a href="#"><img src="{{ asset('img/blog/1.jpg') }}" alt="#"></a>
                    </div>
                    <div class="ltn__blog-brief">
                        <div class="ltn__blog-meta">
                            <ul>
                                <li class="ltn__blog-author">
                                    <a href="#"><i class="far fa-user"></i>Admin</a>
                                </li>
                                <li class="ltn__blog-tags">
                                    <a href="#"><i class="fas fa-tags"></i>Dịch vụ</a>
                                </li>
                            </ul>
                        </div>
                        <h3 class="ltn__blog-title"><a href="#">Lợi ích của thực phẩm hữu cơ</a></h3>
                        <div class="ltn__blog-meta-btn">
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li class="ltn__blog-date"><i class="far fa-calendar-alt"></i>24 tháng 6, 2024</li>
                                </ul>
                            </div>
                            <div class="ltn__blog-btn">
                                <a href="#">Đọc thêm</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BLOG AREA END -->
@endsection
