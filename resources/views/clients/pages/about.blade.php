@extends('layouts.client')

@section('breadcrumb', 'Về chúng tôi')

@section('content')
<!-- ABOUT US AREA START -->
<div class="ltn__about-us-area pt-120--- pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <div class="about-us-img-wrap about-img-left">
                    <img src="{{ asset ('assets/clients/img/others/6.png')}}" alt="About VinMark">
                </div>
            </div>
            <div class="col-lg-6 align-self-center">
                <div class="about-us-info-wrap">
                    <div class="section-title-area ltn__section-title-2">
                        <h6 class="section-subtitle ltn__secondary-color">
                            Hiểu thêm về VinMark
                        </h6>
                        <h1 class="section-title">
                            VinMark – Chợ trực tuyến <br class="d-none d-md-block">
                            cho người Việt
                        </h1>
                        <p>
                            VinMark là nền tảng chợ trực tuyến giúp người Việt dễ dàng
                            mua bán các sản phẩm thiết yếu mỗi ngày, đặc biệt là
                            thực phẩm tươi sống và hàng tiêu dùng chất lượng.
                        </p>
                    </div>

                    <p>
                        Chúng tôi kết nối người bán uy tín với người tiêu dùng thông qua
                        một hệ sinh thái mua sắm minh bạch, tiện lợi và an toàn.
                        VinMark hướng đến việc xây dựng một cộng đồng mua bán
                        dựa trên sự tin cậy, chất lượng và trải nghiệm thân thiện.
                    </p>

                    <div class="about-author-info d-flex">
                        <div class="author-name-designation align-self-center">
                            <h4 class="mb-0">Đội ngũ VinMark</h4>
                            <small>/ Nền tảng chợ trực tuyến</small>
                        </div>
                        {{-- <div class="author-sign">
                            <img src="{{ asset('assets/clients/img/icons/icon-img/author-sign.png') }}" alt="VinMark Sign">
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ABOUT US AREA END -->

<!-- FEATURE AREA START -->
<div class="ltn__feature-area section-bg-1 pt-115 pb-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2 text-center">
                    <h6 class="section-subtitle ltn__secondary-color">// giá trị cốt lõi //</h6>
                    <h1 class="section-title">Vì sao chọn VinMark<span>.</span></h1>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="ltn__feature-item ltn__feature-item-7">
                    <div class="ltn__feature-icon-title">
                        <div class="ltn__feature-icon">
                            <span><img src="img/icons/icon-img/21.png" alt="#"></span>
                        </div>
                        <h3>Đa dạng sản phẩm</h3>
                    </div>
                    <div class="ltn__feature-info">
                        <p>
                            VinMark cung cấp nhiều nhóm sản phẩm từ thực phẩm tươi sống,
                            hàng tiêu dùng đến các mặt hàng thiết yếu,
                            đáp ứng nhu cầu mua sắm hằng ngày.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6 col-12">
                <div class="ltn__feature-item ltn__feature-item-7">
                    <div class="ltn__feature-icon-title">
                        <div class="ltn__feature-icon">
                            <span><img src="img/icons/icon-img/22.png" alt="#"></span>
                        </div>
                        <h3>Người bán uy tín</h3>
                    </div>
                    <div class="ltn__feature-info">
                        <p>
                            Các gian hàng trên VinMark được chọn lọc kỹ lưỡng,
                            đảm bảo nguồn gốc rõ ràng, minh bạch
                            và cam kết chất lượng sản phẩm.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6 col-12">
                <div class="ltn__feature-item ltn__feature-item-7">
                    <div class="ltn__feature-icon-title">
                        <div class="ltn__feature-icon">
                            <span><img src="img/icons/icon-img/23.png" alt="#"></span>
                        </div>
                        <h3>Tiện lợi & an toàn</h3>
                    </div>
                    <div class="ltn__feature-info">
                        <p>
                            Trải nghiệm mua sắm đơn giản, thanh toán linh hoạt,
                            giao hàng nhanh chóng và chính sách hỗ trợ rõ ràng,
                            mang lại sự an tâm cho người dùng.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FEATURE AREA END -->

<!-- TEAM AREA START -->
<div class="ltn__team-area pt-115 pb-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2 text-center">
                    <h1 class="section-title white-color---">
                        Đội ngũ phát triển VinMark
                    </h1>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="ltn__team-item">
                    <div class="team-img">
                        <img src="img/team/1.jpg" alt="Team Member">
                    </div>
                    <div class="team-info">
                        <h6 class="ltn__secondary-color">// Founder //</h6>
                        <h4>VinMark Team</h4>
                        <p>Nền tảng chợ trực tuyến</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="ltn__team-item">
                    <div class="team-img">
                        <img src="img/team/2.jpg" alt="Team Member">
                    </div>
                    <div class="team-info">
                        <h6 class="ltn__secondary-color">// Development //</h6>
                        <h4>Đội ngũ kỹ thuật</h4>
                        <p>Phát triển & vận hành hệ thống</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="ltn__team-item">
                    <div class="team-img">
                        <img src="img/team/3.jpg" alt="Team Member">
                    </div>
                    <div class="team-info">
                        <h6 class="ltn__secondary-color">// Operations //</h6>
                        <h4>Đội ngũ vận hành</h4>
                        <p>Hỗ trợ người bán & người mua</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="ltn__team-item">
                    <div class="team-img">
                        <img src="img/team/4.jpg" alt="Team Member">
                    </div>
                    <div class="team-info">
                        <h6 class="ltn__secondary-color">// Customer Care //</h6>
                        <h4>Chăm sóc khách hàng</h4>
                        <p>Đồng hành cùng cộng đồng VinMark</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- TEAM AREA END -->

@endsection
