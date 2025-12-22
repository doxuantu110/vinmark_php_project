@extends('layouts.client')

@section('title', 'FAQ')
@section('breadcrumb', 'Những câu hỏi thường gặp')
@section('content')

    <!-- FAQ AREA START -->
    <div class="ltn__faq-area mb-100">
        <div class="container">
            <div class="row">
                <!-- FAQ CONTENT -->
                <div class="col-lg-8">
                    <div class="ltn__faq-inner ltn__faq-inner-2">
                        <div id="accordion_2">

                            <!-- FAQ ITEM -->
                            <div class="card">
                                <h6 class="ltn__card-title collapsed" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Làm thế nào để mua sản phẩm?
                                </h6>
                                <div id="faq1" class="collapse" data-parent="#accordion_2">
                                    <div class="card-body">
                                        <p>
                                            Bạn chỉ cần chọn sản phẩm mong muốn, thêm vào giỏ hàng và tiến hành thanh toán.
                                            Hệ thống sẽ hướng dẫn bạn từng bước cho đến khi hoàn tất đơn hàng.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ ITEM -->
                            <div class="card">
                                <h6 class="ltn__card-title" data-bs-toggle="collapse" data-bs-target="#faq2"
                                    aria-expanded="true">
                                    Tôi có thể hoàn tiền như thế nào?
                                </h6>
                                <div id="faq2" class="collapse show" data-parent="#accordion_2">
                                    <div class="card-body">
                                        <p>
                                            Trong vòng <strong>7 ngày</strong> kể từ khi nhận hàng, nếu sản phẩm có lỗi
                                            từ nhà sản xuất, bạn có thể yêu cầu hoàn tiền hoặc đổi trả.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ ITEM -->
                            <div class="card">
                                <h6 class="ltn__card-title collapsed" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Tôi là người mới, nên bắt đầu từ đâu?
                                </h6>
                                <div id="faq3" class="collapse" data-parent="#accordion_2">
                                    <div class="card-body">
                                        <p>
                                            Bạn có thể tạo tài khoản miễn phí, sau đó duyệt danh mục sản phẩm hoặc
                                            tìm kiếm theo nhu cầu để bắt đầu mua sắm.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ ITEM -->
                            <div class="card">
                                <h6 class="ltn__card-title collapsed" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    Chính sách đổi trả & bảo hành
                                </h6>
                                <div id="faq4" class="collapse" data-parent="#accordion_2">
                                    <div class="card-body">
                                        <p>
                                            Chúng tôi hỗ trợ đổi trả nếu sản phẩm bị lỗi kỹ thuật hoặc giao sai mẫu.
                                            Thời gian bảo hành tuỳ theo từng loại sản phẩm.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ ITEM -->
                            <div class="card">
                                <h6 class="ltn__card-title collapsed" data-bs-toggle="collapse" data-bs-target="#faq5">
                                    Thông tin cá nhân của tôi có được bảo mật không?
                                </h6>
                                <div id="faq5" class="collapse" data-parent="#accordion_2">
                                    <div class="card-body">
                                        <p>
                                            Tất cả thông tin cá nhân và thanh toán của bạn đều được mã hoá và bảo mật
                                            theo tiêu chuẩn an toàn.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ ITEM -->
                            <div class="card">
                                <h6 class="ltn__card-title collapsed" data-bs-toggle="collapse" data-bs-target="#faq6">
                                    Mã giảm giá không hoạt động?
                                </h6>
                                <div id="faq6" class="collapse" data-parent="#accordion_2">
                                    <div class="card-body">
                                        <p>
                                            Vui lòng kiểm tra điều kiện áp dụng và thời hạn của mã giảm giá.
                                            Nếu vẫn gặp lỗi, hãy liên hệ bộ phận hỗ trợ.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ ITEM -->
                            <div class="card">
                                <h6 class="ltn__card-title collapsed" data-bs-toggle="collapse" data-bs-target="#faq7">
                                    Tôi có thể thanh toán bằng thẻ ngân hàng không?
                                </h6>
                                <div id="faq7" class="collapse" data-parent="#accordion_2">
                                    <div class="card-body">
                                        <p>
                                            Chúng tôi hỗ trợ thanh toán bằng thẻ ATM nội địa, thẻ tín dụng và
                                            các cổng thanh toán điện tử phổ biến.
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- SUPPORT -->
                        <div class="need-support text-center mt-100">
                            <h2>Bạn vẫn cần hỗ trợ?</h2>
                            <p>Đội ngũ hỗ trợ của chúng tôi luôn sẵn sàng 24/7</p>
                            <div class="btn-wrapper mb-30">
                                <a href="{{ route('contact') }}" class="theme-btn-1 btn">
                                    Liên hệ ngay
                                </a>
                            </div>
                            <h3><i class="fas fa-phone"></i> 0123 456 789</h3>
                        </div>
                    </div>
                </div>

                <!-- SIDEBAR -->
                <div class="col-lg-4">
                    <aside class="sidebar-area ltn__right-sidebar">

                        <!-- QUICK CONTACT -->
                        <div class="widget">
                            <h4 class="ltn__widget-title">Hỗ trợ nhanh</h4>
                            <p>Nếu bạn không tìm thấy câu trả lời, hãy gửi câu hỏi cho chúng tôi.</p>
                            <a href="{{ route('contact') }}" class="theme-btn-1 btn btn-small">
                                Gửi yêu cầu hỗ trợ
                            </a>
                        </div>

                        <!-- BANNER -->
                        <div class="widget ltn__banner-widget">
                            <a href="{{ route('products.index') }}">
                                <img src="{{ asset('assets/clients/img/banner/banner-3.jpg') }}" alt="Banner">
                            </a>
                        </div>

                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- FAQ AREA END -->

@endsection
