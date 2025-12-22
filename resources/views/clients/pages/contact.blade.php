@extends('layouts.client')

@section('title', 'Liên hệ')
@section('breadcrumb', 'Liên hệ')
@section('content')
    <!-- KHU VỰC THÔNG TIN LIÊN HỆ BẮT ĐẦU -->
    <div class="ltn__contact-address-area mb-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                        <div class="ltn__contact-address-icon">
                            <img src="{{ asset('assets/clients/img/icons/10.png') }}" alt="Icon Image">
                        </div>
                        <h3>Địa chỉ Email</h3>
                        <p>doxuantutlbt@gmail.com <br>
                            vinmark@gmail.com</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                        <div class="ltn__contact-address-icon">
                            <img src="{{ asset('assets/clients/img/icons/11.png') }}" alt="Icon Image">
                        </div>
                        <h3>Số điện thoại</h3>
                        <p>0358522788 <br> 023456899999</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                        <div class="ltn__contact-address-icon">
                            <img src="{{ asset('assets/clients/img/icons/12.png') }}" alt="Icon Image">
                        </div>
                        <h3>Địa chỉ văn phòng</h3>
                        <p>Cửa hàng thực phẩm sạch Vinmark <br>
                            Thủ Đức, Thành phố Hồ Chí Minh</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- KHU VỰC THÔNG TIN LIÊN HỆ KẾT THÚC -->

    <!-- KHU VỰC GỬI TIN NHẮN LIÊN HỆ BẮT ĐẦU -->
    <div class="ltn__contact-message-area mb-120 mb--100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__form-box contact-form-box box-shadow white-bg">
                        <h4 class="title-2">Nhận Liên hệ / Phản hồi</h4>
                        <form id="contact-form" action="{{ route('contact') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-item input-item-name ltn__custom-icon">
                                        <input type="text" name="name" placeholder="Nhập họ và tên" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-item input-item-phone ltn__custom-icon">
                                        <input type="text" name="phone" placeholder="Nhập số điện thoại" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-item input-item-email ltn__custom-icon">
                                        <input type="email" name="email" placeholder="Nhập địa chỉ email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="input-item input-item-textarea ltn__custom-icon">
                                <textarea name="message" placeholder="Nhập nội dung tin nhắn"></textarea required>
                                </div>
                                <div class="btn-wrapper mt-0">
                                    <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit">
                                        Gửi phản hồi
                                    </button>
                                </div>
                                <p class="form-messege mb-0 mt-20"></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- KHU VỰC GỬI TIN NHẮN LIÊN HỆ KẾT THÚC -->

        <!-- GOOGLE MAP AREA START -->
        <div class="google-map mb-120">

            {{-- <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9334.271551495209!2d-73.97198251485975!3d40.668170674982946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25b0456b5a2e7%3A0x68bdf865dda0b669!2sBrooklyn%20Botanic%20Garden%20Shop!5e0!3m2!1sen!2sbd!4v1590597267201!5m2!1sen!2sbd"
                width="100%" height="100%" frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe> --}}

                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15672.722704124455!2d106.74996878715817!3d10.873858699999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174d9003dbf2835%3A0xb2ab16e004c79c3d!2sVinmart%2B!5e0!3m2!1svi!2s!4v1766201187412!5m2!1svi!2s" width="100%" height="100%" frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
        <!-- GOOGLE MAP AREA END -->

@endsection
