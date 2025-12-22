 <!-- HEADER AREA START (header-5) -->
 <header class="ltn__header-area ltn__header-5 ltn__header-transparent-- gradient-color-4---">
     <!-- ltn__header-middle-area start -->
     <div
         class="ltn__header-middle-area ltn__header-sticky ltn__sticky-bg-white sticky-active-into-mobile ltn__logo-right-menu-option plr--9---">
         <div class="container">
             <div class="row">
                 <div class="col">
                     <div class="site-logo-wrap">
                         <div class="site-logo">
                             <a href="\"><img src="{{ asset('assets/clients/img/logo3.png') }}" alt="Logo"></a>
                         </div>
                     </div>
                 </div>
                 <div class="col header-menu-column menu-color-white---">
                     <div class="header-menu d-none d-xl-block">
                         <nav>
                             <div class="ltn__main-menu">
                                 <ul>
                                     <li class="menu-icon"><a
                                             href="\">Trang chủ</a> </li>
                                     <li class="menu-icon"><a
                                                 href="javascript:void(0)">Về chúng tôi</a>
                                             <ul>
                                                 <li><a href="{{ route('about') }}">Về chúng tôi</a></li>
                                                 <li><a href="{{ route('service') }}">Dịch vụ</a></li>
                                                 <li><a href="{{ route('team') }}">Team</a></li>
                                                 <li><a href="{{ route('about') }}">FAQ</a></li>
                                             </ul>
                                     </li>
                                     <li class="menu-icon"><a href="{{ route('products.index') }}">Cửa hàng</a>
                                     </li>
                                     <li><a href="{{ route('contact.index') }}">Liên hệ</a></li>
                                     <li class="special-link"><a href="{{ route('contact.index') }}">Nhận phản hồi</a>
                                     </li>
                                 </ul>
                             </div>
                         </nav>
                     </div>
                 </div>
                 <div class="ltn__header-options ltn__header-options-2 mb-sm-20">
                     <!-- header-search-1 -->
                     <div class="header-search-wrap">
                        <div class="header-search-1">
                             <div class="search-icon">
                                 <i class="icon-search for-search-show"></i>
                                 <i class="icon-cancel  for-search-close"></i>
                             </div>
                        </div>
                        <div class="header-search-1-form">
                             <form id="#" method="GET" action="{{ route('search') }}">
                                 <input type="text" name="keyword" value="" placeholder="Tìm kiếm..." />
                                 <button type="submit">
                                     <span><i class="icon-search"></i></span>
                                 </button>
                             </form>
                        </div>
                     </div>
                     <!-- user-menu -->
                     <div class="ltn__drop-menu user-menu">
                         <ul>
                             <li>
                                 <a href="#"><i class="icon-user"></i></a>
                                 <ul>
                                     @if (Auth::check())
                                         <li><a href="{{ route('account') }}">Tài khoản</a></li>
                                         <li><a href="{{ route('wishlist.index') }}">Yêu thích</a></li>
                                         <li><a href="{{ route('logout') }}">Đăng xuất</a></li>
                                     @else
                                         <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                                     @endif

                                 </ul>
                             </li>
                         </ul>
                     </div>
                     <!-- mini-cart -->
                     <div class="mini-cart-icon">
                         <a href="#ltn_utilize-cart-menu" class="ltn_utilize-toggle">
                             <i class="icon-shopping-cart"></i>
                             <sup id="cart_count">
                                 @auth
                                     {{ \App\Models\CartItem::where('user_id', auth()->id())->count() }}
                                 @else
                                     {{ session('cart') ? count(session('cart')) : 0 }}
                                 @endauth
                             </sup>

                         </a>
                     </div>
                     <!-- /mini-cart -->

                     <!-- Mobile Menu Button -->
                     <div class="mobile-menu-toggle d-xl-none">
                         <a href="#ltn__utilize-mobile-menu" class="ltn__utilize-toggle">
                             <svg viewBox="0 0 800 600">
                                 <path
                                     d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200"
                                     id="top"></path>
                                 <path d="M300,320 L540,320" id="middle"></path>
                                 <path
                                     d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190"
                                     id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) ">
                                 </path>
                             </svg>
                         </a>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- ltn__header-middle-area end -->
 </header>
 <!-- HEADER AREA END -->

 <!-- Utilize Cart Menu Start -->
 <div id="ltn__utilize-cart-menu" class="ltn__utilize ltn__utilize-cart-menu">
     <div class="ltn__utilize-menu-inner ltn__scrollbar">
         @include('clients.components.include.mini-cart')
     </div>
 </div>

{{-- <script src="{{ asset('assets/clients/js/main.js') }}"></script> --}}
<!-- PAYPAL SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id={{ config('PAYPAL_CLIENT_ID') }}"
        data-sdk-integration-source="buttons"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
 <!-- Utilize Cart Menu End -->
 @include('clients.partials.utlize_mobile')
 <div class="ltn__utilize-overlay"></div>
