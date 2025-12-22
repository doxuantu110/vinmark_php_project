@extends('layouts.client')

@section('title', 'Đội ngũ')
@section('breadcrumb', 'Đội ngũ')

@section('content')

<!-- TEAM AREA START -->
<div class="ltn__team-area pt-110 pb-90">
    <div class="container">
        <div class="row justify-content-center">

            <!-- Team item -->
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="ltn__team-item text-center">
                    <div class="team-img">
                        <img src="{{ asset('img/team/1.jpg') }}" alt="">
                    </div>
                    <div class="team-info">
                        <h6 class="ltn__secondary-color">Nhà sáng lập</h6>
                        <h4>Đỗ Xuân Tú</h4>
                        <div class="ltn__social-media">
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team item -->
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="ltn__team-item text-center">
                    <div class="team-img">
                        <img src="{{ asset('img/team/2.jpg') }}" alt="">
                    </div>
                    <div class="team-info">
                        <h6 class="ltn__secondary-color">Giám đốc điều hành</h6>
                        <h4>Phạm Đức Trung</h4>
                        <div class="ltn__social-media">
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team item -->
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="ltn__team-item text-center">
                    <div class="team-img">
                        <img src="{{ asset('img/team/3.jpg') }}" alt="">
                    </div>
                    <div class="team-info">
                        <h6 class="ltn__secondary-color">Quản lý sản phẩm</h6>
                        <h4>Phan Đức Trí</h4>
                        <div class="ltn__social-media">
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team item -->
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="ltn__team-item text-center">
                    <div class="team-img">
                        <img src="{{ asset('img/team/4.jpg') }}" alt="">
                    </div>
                    <div class="team-info">
                        <h6 class="ltn__secondary-color">Trưởng bộ phận kinh doanh</h6>
                        <h4>Trần Duy Trường</h4>
                        <div class="ltn__social-media">
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team item -->
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="ltn__team-item text-center">
                    <div class="team-img">
                        <img src="{{ asset('img/team/5.jpg') }}" alt="">
                    </div>
                    <div class="team-info">
                        <h6 class="ltn__secondary-color">Chăm sóc khách hàng</h6>
                        <h4>Trần Minh Triết</h4>
                        <div class="ltn__social-media">
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team item -->
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="ltn__team-item text-center">
                    <div class="team-img">
                        <img src="{{ asset('img/team/6.jpg') }}" alt="">
                    </div>
                    <div class="team-info">
                        <h6 class="ltn__secondary-color">Kỹ thuật & vận hành</h6>
                        <h4>Đỗ Văn F</h4>
                        <div class="ltn__social-media">
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- TEAM AREA END -->

<!-- CALL TO ACTION START -->
<div class="ltn__service-form-wrap-area plr--5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="ltn__service-form-area ltn__service-form-1 bg-image bg-overlay-theme-black-60 pt-115 pb-95"
                     data-bg="{{ asset('img/bg/2.jpg') }}">
                    <div class="row">
                        <div class="col-xl-5 col-lg-12 align-self-center">
                            <div class="ltn__service-form-brief">
                                <div class="section-title-area ltn__section-title-2 mb-0">
                                    <h6 class="section-subtitle white-color">// Liên hệ ngay</h6>
                                    <h1 class="section-title white-color">
                                        Nhận tư vấn <br> miễn phí từ chúng tôi
                                    </h1>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-7 col-lg-12 align-self-center">
                            <div class="ltn__service-form-wrap ltn__service-form-color-white">
                                <form class="ltn__service-form-box">
                                    <ul>
                                        <li>
                                            <input type="text" placeholder="Họ và tên">
                                        </li>
                                        <li>
                                            <input type="text" placeholder="Số điện thoại">
                                        </li>
                                        <li>
                                            <div class="btn-wrapper">
                                                <button type="submit"
                                                    class="btn theme-btn-1 btn-effect-1 text-uppercase">
                                                    Gửi yêu cầu
                                                </button>
                                            </div>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CALL TO ACTION END -->

<!-- SKILL AREA START -->
<div class="ltn__progress-bar-area pt-115 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="ltn__progress-bar-wrap">
                    <div class="section-title-area ltn__section-title-2">
                        <h6 class="section-subtitle ltn__secondary-color">// năng lực</h6>
                        <h1 class="section-title">
                            Đội ngũ giàu kinh nghiệm<span>.</span>
                        </h1>
                        <p>
                            Chúng tôi không ngừng nâng cao chất lượng dịch vụ
                            và kỹ năng chuyên môn.
                        </p>
                    </div>

                    <div class="ltn__progress-bar-inner">
                        <div class="ltn__progress-bar-item">
                            <p>Tư vấn khách hàng</p>
                            <div class="progress">
                                <div class="progress-bar" style="width: 90%">
                                    <span>90%</span>
                                </div>
                            </div>
                        </div>

                        <div class="ltn__progress-bar-item">
                            <p>Quản lý & vận hành</p>
                            <div class="progress">
                                <div class="progress-bar" style="width: 85%">
                                    <span>85%</span>
                                </div>
                            </div>
                        </div>

                        <div class="ltn__progress-bar-item">
                            <p>Hỗ trợ kỹ thuật</p>
                            <div class="progress">
                                <div class="progress-bar" style="width: 80%">
                                    <span>80%</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-6 align-self-center">
                <div class="about-img-right">
                    <img src="{{ asset('img/team/t-4.jpg') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- SKILL AREA END -->

@endsection
