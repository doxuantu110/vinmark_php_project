<!-- FOOTER AREA START -->
<footer class="ltn__footer-area">
    <div class="footer-top-area section-bg-2 plr--5">
        <div class="container-fluid">
            <div class="row">

                <!-- GIỚI THIỆU -->
                <div class="col-xl-3 col-md-6 col-sm-6 col-12">
                    <div class="footer-widget footer-about-widget">
                        <div class="footer-logo mb-20">
                            <div class="site-logo">
                                <img src="{{ asset('assets/clients/img/logo4.png') }}" alt="Logo">
                            </div>
                        </div>

                        <p>
                            Chúng tôi chuyên cung cấp các sản phẩm thịt tươi sống,
                            đảm bảo chất lượng – an toàn – nguồn gốc rõ ràng,
                            giao hàng nhanh chóng mỗi ngày.
                        </p>

                        <div class="footer-address">
                            <ul>
                                <li>
                                    <div class="footer-address-icon">
                                        <i class="icon-placeholder"></i>
                                    </div>
                                    <div class="footer-address-info">
                                        <p>Thủ Đức, TP. Hồ Chí Minh</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="footer-address-icon">
                                        <i class="icon-call"></i>
                                    </div>
                                    <div class="footer-address-info">
                                        <p><a href="tel:+0123456789">0123 456 789</a></p>
                                    </div>
                                </li>
                                <li>
                                    <div class="footer-address-icon">
                                        <i class="icon-mail"></i>
                                    </div>
                                    <div class="footer-address-info">
                                        <p>
                                            <a href="mailto:vinmark@gmail.com">
                                                vinmark@gmail.com
                                            </a>
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="ltn__social-media mt-20">
                            <ul>
                                <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#" title="Zalo"><i class="fab fa-whatsapp"></i></a></li>
                                <li><a href="#" title="Youtube"><i class="fab fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- CÔNG TY -->
                <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                    <div class="footer-widget footer-menu-widget clearfix">
                        <h4 class="footer-title">Công ty</h4>
                        <div class="footer-menu">
                            <ul>
                                <li><a href="{{ route('about') }}">Giới thiệu</a></li>
                                <li><a href="{{ route('products.index') }}">Sản phẩm</a></li>
                                <li><a href="{{ route('faq') }}">Câu hỏi thường gặp</a></li>
                                <li><a href="{{ route('contact.index') }}">Liên hệ</a></li>
                                <li><a href="{{ route('about') }}">Chính sách & điều khoản</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- HỖ TRỢ KHÁCH HÀNG -->
                <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                    <div class="footer-widget footer-menu-widget clearfix">
                        <h4 class="footer-title">Hỗ trợ khách hàng</h4>
                        <div class="footer-menu">
                            <ul>
                                <li><a href="#">Theo dõi đơn hàng</a></li>
                                <li><a href="{{ route('wishlist.index') }}">Danh sách yêu thích</a></li>
                                <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                                <li><a href="{{ route('account') }}">Tài khoản của tôi</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- DỊCH VỤ -->
                <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                    <div class="footer-widget footer-menu-widget clearfix">
                        <h4 class="footer-title">Dịch vụ</h4>
                        <div class="footer-menu">
                            <ul>
                                <li>Giao hàng trong ngày</li>
                                <li>Đổi trả trong 24h</li>
                                <li>Thanh toán linh hoạt</li>
                                <li>Hỗ trợ 24/7</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- BẢN TIN -->
                <div class="col-xl-3 col-md-6 col-sm-12 col-12">
                    <div class="footer-widget footer-newsletter-widget">
                        <h4 class="footer-title">Nhận ưu đãi</h4>
                        <p>
                            Đăng ký email để nhận thông tin khuyến mãi
                            và sản phẩm mới mỗi tuần.
                        </p>

                        <div class="footer-newsletter">
                            <form action="#" method="post">
                                <input type="email" placeholder="Nhập email của bạn" required>
                                <button class="theme-btn-1 btn">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </form>
                        </div>

                        <h5 class="mt-30">Chấp nhận thanh toán</h5>
                        <img src="{{ asset('assets/clients/img/icons/payment-4.png') }}" alt="Payment Methods">
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- COPYRIGHT -->
    <div class="ltn__copyright-area section-bg-2 ltn__border-top-2 plr--5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-12">
                    <p>
                        © {{ date('Y') }} VinMark. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 col-12 text-end">
                    <ul class="ltn__copyright-menu">
                        <li><a href="#">Điều khoản</a></li>
                        <li><a href="#">Chính sách bảo mật</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- FOOTER AREA END -->
