@extends('layouts.client')

@section('title', 'Dịch vụ')
@section('breadcrumb', 'Dịch vụ')

@section('content')

<!-- ABOUT US AREA START -->
<div class="ltn__about-us-area pb-115">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 align-self-center">
                <div class="about-us-img-wrap ltn__img-shape-left about-img-left">
                    <img src="{{ asset('assets/clients/img/service/1.Dich-vu-khach-hang.png') }}" alt="Dịch vụ của chúng tôi">
                </div>
            </div>
            <div class="col-lg-7 align-self-center">
                <div class="about-us-info-wrap">
                    <div class="section-title-area ltn__section-title-2">
                        <h6 class="section-subtitle ltn__secondary-color">// DỊCH VỤ CHUYÊN NGHIỆP</h6>
                        <h1 class="section-title">
                            Giải pháp chất lượng <br>
                            cho khách hàng<span>.</span>
                        </h1>
                        <p>
                            Chúng tôi cung cấp các dịch vụ uy tín, đảm bảo chất lượng sản phẩm
                            và trải nghiệm mua sắm tốt nhất cho khách hàng.
                        </p>
                    </div>

                    <div class="about-us-info-wrap-inner about-us-info-devide">
                        <p>
                            Với đội ngũ giàu kinh nghiệm và quy trình làm việc chuyên nghiệp,
                            chúng tôi cam kết mang đến các dịch vụ nhanh chóng, an toàn và hiệu quả.
                        </p>

                        <div class="list-item-with-icon">
                            <ul>
                                <li>Giao hàng nhanh – đúng hẹn</li>
                                <li>Đội ngũ tư vấn chuyên nghiệp</li>
                                <li>Sản phẩm đạt chuẩn chất lượng</li>
                                <li>Danh mục sản phẩm đa dạng</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ABOUT US AREA END -->

<!-- SERVICE AREA START -->
<div class="ltn__service-area section-bg-1 pt-115 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2 text-center">
                    <h1 class="section-title">Dịch vụ của chúng tôi</h1>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">

            <!-- Service item -->
            <div class="col-lg-4 col-sm-6">
                <div class="ltn__service-item-1 text-center">
                    <div class="service-item-img">
                        <img src="{{ asset('img/service/1.jpg') }}" alt="">
                    </div>
                    <div class="service-item-brief">
                        <h3>Tư vấn sản phẩm</h3>
                        <p>
                            Hỗ trợ khách hàng lựa chọn sản phẩm phù hợp với nhu cầu
                            và ngân sách.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Service item -->
            <div class="col-lg-4 col-sm-6">
                <div class="ltn__service-item-1 text-center">
                    <div class="service-item-img">
                        <img src="{{ asset('img/service/2.jpg') }}" alt="">
                    </div>
                    <div class="service-item-brief">
                        <h3>Giao hàng tận nơi</h3>
                        <p>
                            Giao hàng nhanh chóng, an toàn trên toàn quốc
                            với chi phí hợp lý.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Service item -->
            <div class="col-lg-4 col-sm-6">
                <div class="ltn__service-item-1 text-center">
                    <div class="service-item-img">
                        <img src="{{ asset('img/service/3.jpg') }}" alt="">
                    </div>
                    <div class="service-item-brief">
                        <h3>Bảo hành – đổi trả</h3>
                        <p>
                            Chính sách bảo hành rõ ràng, hỗ trợ đổi trả
                            nhanh chóng khi có sự cố.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Service item -->
            <div class="col-lg-4 col-sm-6">
                <div class="ltn__service-item-1 text-center">
                    <div class="service-item-img">
                        <img src="{{ asset('img/service/3.jpg') }}" alt="">
                    </div>
                    <div class="service-item-brief">
                        <h3>Thanh toán linh hoạt</h3>
                        <p>
                            Hỗ trợ nhiều hình thức thanh toán an toàn,
                            tiện lợi cho khách hàng.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Service item -->
            <div class="col-lg-4 col-sm-6">
                <div class="ltn__service-item-1 text-center">
                    <div class="service-item-img">
                        <img src="{{ asset('img/service/1.jpg') }}" alt="">
                    </div>
                    <div class="service-item-brief">
                        <h3>Hỗ trợ sau bán</h3>
                        <p>
                            Chăm sóc khách hàng chu đáo, hỗ trợ kỹ thuật
                            sau khi mua hàng.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Service item -->
            <div class="col-lg-4 col-sm-6">
                <div class="ltn__service-item-1 text-center">
                    <div class="service-item-img">
                        <img src="{{ asset('img/service/2.jpg') }}" alt="">
                    </div>
                    <div class="service-item-brief">
                        <h3>Dịch vụ doanh nghiệp</h3>
                        <p>
                            Giải pháp cung cấp sản phẩm số lượng lớn
                            cho doanh nghiệp.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- SERVICE AREA END -->

<!-- OUR JOURNEY AREA START -->
<div class="ltn__our-journey-area bg-image bg-overlay-theme-90 pt-280 pb-350 mb-35 plr--9"
     data-bg="{{ asset('img/bg/8.jpg') }}">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__our-journey-wrap">
                    <ul>

                        <li>
                            <span class="ltn__journey-icon">2019</span>
                            <ul>
                                <li>
                                    <div class="ltn__journey-history-item-info clearfix">
                                        <div class="ltn__journey-history-info">
                                            <h3>Thành lập</h3>
                                            <p>Khởi đầu với sứ mệnh mang sản phẩm chất lượng đến khách hàng.</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>

                        <li class="active">
                            <span class="ltn__journey-icon">2021</span>
                            <ul>
                                <li>
                                    <div class="ltn__journey-history-item-info clearfix">
                                        <div class="ltn__journey-history-info">
                                            <h3>Mở rộng dịch vụ</h3>
                                            <p>Phát triển hệ thống giao hàng và chăm sóc khách hàng.</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <span class="ltn__journey-icon">2023</span>
                            <ul>
                                <li>
                                    <div class="ltn__journey-history-item-info clearfix">
                                        <div class="ltn__journey-history-info">
                                            <h3>Khách hàng tin dùng</h3>
                                            <p>Phục vụ hàng nghìn khách hàng trên toàn quốc.</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <span class="ltn__journey-icon">2025</span>
                            <ul>
                                <li>
                                    <div class="ltn__journey-history-item-info clearfix">
                                        <div class="ltn__journey-history-info">
                                            <h3>Phát triển bền vững</h3>
                                            <p>Không ngừng cải tiến chất lượng và dịch vụ.</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- OUR JOURNEY AREA END -->

@endsection
