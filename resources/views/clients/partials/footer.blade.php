<!-- FOOTER AREA START -->
<footer class="ltn__footer-area">
    <div class="footer-top-area section-bg-1 plr--5">
        <div class="container-fluid">
            <div class="row">

                <!-- ABOUT -->
                <div class="col-xl-3 col-md-6 col-sm-6 col-12">
                    <div class="footer-widget footer-about-widget">
                        <div class="footer-logo">
                            <div class="site-logo">
                                <img src="{{ asset('assets/clients/img/logo3.png') }}" alt="VinMark">
                            </div>
                        </div>
                        <p>
                            VinMark – Chợ trực tuyến kết nối người bán và người mua,
                            mang đến trải nghiệm mua sắm tiện lợi, an toàn và minh bạch.
                        </p>

                        <div class="footer-address">
                            <ul>
                                <li>
                                    <div class="footer-address-icon">
                                        <i class="icon-placeholder"></i>
                                    </div>
                                    <div class="footer-address-info">
                                        <p>TP. Hồ Chí Minh, Việt Nam</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="footer-address-icon">
                                        <i class="icon-call"></i>
                                    </div>
                                    <div class="footer-address-info">
                                        <p><a href="tel:0900123456">0900 123 456</a></p>
                                    </div>
                                </li>
                                <li>
                                    <div class="footer-address-icon">
                                        <i class="icon-mail"></i>
                                    </div>
                                    <div class="footer-address-info">
                                        <p>
                                            <a href="mailto:support@vinmark.vn">support@vinmark.vn</a>
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="ltn__social-media mt-20">
                            <ul>
                                <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#" title="Zalo"><i class="fas fa-comment-dots"></i></a></li>
                                <li><a href="#" title="Youtube"><i class="fab fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- COMPANY -->
                <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                    <div class="footer-widget footer-menu-widget clearfix">
                        <h4 class="footer-title">VinMark</h4>
                        <div class="footer-menu">
                            <ul>
                                <li><a href="{{ route('about') }}">Về chúng tôi</a></li>
                                <li><a href="{{ route('products.index') }}">Sản phẩm</a></li>
                                <li><a href="{{ route('contact') }}">Liên hệ</a></li>
                                <li><a href="{{ route('faq') }}">Câu hỏi thường gặp</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- SERVICES -->
                <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                    <div class="footer-widget footer-menu-widget clearfix">
                        <h4 class="footer-title">Dịch vụ</h4>
                        <div class="footer-menu">
                            <ul>
                                <li><a href="{{ route('account') }}">Theo dõi đơn hàng</a></li>
                                <li><a href="{{ route('wishlist.index') }}">Sản phẩm yêu thích</a></li>
                                <li><a href="{{ route('account') }}">Tài khoản</a></li>
                                <li><a href="javascript:void(0)">Điều khoản sử dụng</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- SUPPORT -->
                <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                    <div class="footer-widget footer-menu-widget clearfix">
                        <h4 class="footer-title">Hỗ trợ</h4>
                        <div class="footer-menu">
                            <ul>
                                <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                                <li><a href="{{ route('register') }}">Đăng ký</a></li>
                                <li><a href="{{ route('faq') }}">FAQ</a></li>
                                <li><a href="{{ route('contact') }}">Liên hệ hỗ trợ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- NEWSLETTER -->
                <div class="col-xl-3 col-md-6 col-sm-12 col-12">
                    <div class="footer-widget footer-newsletter-widget">
                        <h4 class="footer-title">Bản tin VinMark</h4>
                        <p>
                            Đăng ký email để nhận thông tin khuyến mãi
                            và sản phẩm mới mỗi tuần.
                        </p>

                        <div class="footer-newsletter">
                            <form action="#">
                                <input type="email" name="email" placeholder="Nhập email của bạn">
                                <div class="btn-wrapper">
                                    <button class="theme-btn-1 btn" type="submit">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <h5 class="mt-30">Phương thức thanh toán</h5>
                        <img src="{{ asset('assets/clients/img/icons/payment-4.png') }}" alt="Payment">
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- COPYRIGHT -->
    <div class="ltn__copyright-area ltn__copyright-2 section-bg-2 ltn__border-top-2--- plr--5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="ltn__copyright-design clearfix">
                        <p>
                            © <span class="current-year"></span> VinMark.
                            All Rights Reserved.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-12 align-self-center">
                    <div class="ltn__copyright-menu text-right text-end">
                        <ul>
                            <li><a href="javascript:void(0)">Điều khoản</a></li>
                            <li><a href="javascript:void(0)">Chính sách bảo mật</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- FOOTER AREA END -->
