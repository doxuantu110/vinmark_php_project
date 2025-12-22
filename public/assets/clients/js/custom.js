$(document).ready(function () {
    // **********************************************
    // Register Form Submission
    // **********************************************
    // Validate and submit the registration form
    $('#register-form').submit(function (event) {
        let name = $('input[name="name"]').val().trim();
        let email = $('input[name="email"]').val().trim();
        let password = $('input[name="password"]').val().trim();
        let confirmpassword = $('input[name="confirmpassword"]').val().trim();
        let checkbox1 = $('input[name="checkbox1"]').is(':checked');
        let checkbox2 = $('input[name="checkbox2"]').is(':checked');

        let errorMessages = "";
        if (name.length < 3) {
            errorMessages += "Tên phải có ít nhất 3 ký tự.<br>";
        }

        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            errorMessages += "Email không hợp lệ.<br>";
        }

        if (password.length < 6) {
            errorMessages += "Mật khẩu phải có ít nhất 6 ký tự.<br>";
        }

        if (password !== confirmpassword) {
            errorMessages += "Mật khẩu và xác nhận mật khẩu không khớp.<br>";
        }
        if (!checkbox1 || !checkbox2) {
            errorMessages += "Bạn phải đồng ý điều khoản trước khi đăng ký tạo tài khoản.<br>";
        }
        if (errorMessages) {
            errorMessages.split("<br>").forEach(msg => {
                if (msg.trim() !== "" && typeof toastr !== 'undefined') toastr.error(msg, 'Lỗi đăng ký');
            });
            event.preventDefault();
        }
    });
    // **********************************************

    // Login Form Submission
    // **********************************************
    // Validate and submit the login form
    $('#login-form').submit(function (event) {
        // Clear toastr messages if toastr is available
        if (typeof toastr !== 'undefined' && toastr.clear) {
            toastr.clear();
        }
        let email = $('input[name="email"]').val().trim();
        let password = $('input[name="password"]').val().trim();
        let errorMessages = "";
        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            errorMessages += "Email không hợp lệ.<br>";
        }
        if (password.length < 6) {
            errorMessages += "Mật khẩu phải có ít nhất 6 ký tự.<br>";
        }
        if (errorMessages) {
            errorMessages.split("<br>").forEach(msg => {
                if (msg.trim() !== "" && typeof toastr !== 'undefined') toastr.error(msg, 'Lỗi đăng nhập');
            });
            event.preventDefault();
        }
    });


    // reset password form]
    $('#reset-password-form').submit(function (event) {
        if (typeof toastr !== 'undefined' && toastr.clear) toastr.clear();
        let password = $('input[name="password"]').val().trim();
        let confirmpassword = $('input[name="confirmpassword"]').val().trim();
        let errorMessages = "";
        if (password.length < 6) {
            errorMessages += "Mật khẩu phải có ít nhất 6 ký tự.<br>";
        }
        if (password !== confirmpassword) {
            errorMessages += "Mật khẩu và xác nhận mật khẩu không khớp.<br>";
        }
        if (errorMessages) {
            errorMessages.split("<br>").forEach(msg => {
                if (msg.trim() !== "" && typeof toastr !== 'undefined') toastr.error(msg, 'Lỗi đặt lại mật khẩu');
            });
            event.preventDefault();
        }
    });

    // When click on the image => open input file
    $('.profile-pic').click(function () {
        $('#avatar').click();
    });

    // When selecting an image => display preview image
    $('#avatar').change(function () {
        let input = this;
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $('#preview-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    })

    // validate and submit the update account form
    // Khi chọn ảnh => hiển thị preview
    $('#avatar').change(function () {
        let input = this;
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $('#preview-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    });

    // Update account
    $('#update-account-form').on("submit", function (event) {
        event.preventDefault();

        let formData = new FormData(this);
        let urlUpdate = $(this).attr('action');

        // Nếu route dùng PUT/PATCH trong Laravel thì thêm dòng sau:
        formData.append('_method', 'PUT');

        $.ajax({
            url: urlUpdate,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                $(".btn-wrapper button")
                    .text("Đang cập nhật...")
                    .attr("disabled", true);
            },
            success: function (response) {
                if (response.success) {
                    toastr.success(response.message || "Cập nhật thành công!");
                    if (response.avatar) {
                        $('#preview-image').attr('src', response.avatar);
                    }
                } else {
                    toastr.error(response.message || "Có lỗi xảy ra khi cập nhật!");
                }
            },
            error: function (xhr) {
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        toastr.error(value[0]);
                    });
                } else {
                    toastr.error("Đã xảy ra lỗi không xác định!");
                }
            },
            complete: function () {
                $(".btn-wrapper button")
                    .text("Cập nhật")
                    .attr("disabled", false);
            }
        });
    });

    // Change password form
    $('#change-password-form').submit(function (e) {
        e.preventDefault();

        let current_password = $('input[name="current_password"]').val().trim();
        let new_password = $('input[name="new_password"]').val().trim();
        let confirm_new_password = $('input[name="confirm_new_password"]').val().trim();

        let errorMessages = "";
        if (current_password.length < 6) {
            errorMessages += "Mật khẩu hiện tại phải có ít nhất 6 ký tự.<br>";
        }
        if (new_password.length < 6) {
            errorMessages += "Mật khẩu mới phải có ít nhất 6 ký tự.<br>";
        }
        if (new_password !== confirm_new_password) {
            errorMessages += "Mật khẩu và xác nhận mật khẩu không khớp.<br>";
        }

        if (errorMessages) {
            errorMessages.split("<br>").forEach(msg => {
                if (msg.trim() !== "" && typeof toastr !== 'undefined') {
                    toastr.error(msg, 'Lỗi đặt lại mật khẩu');
                }
            });
            return; // Dừng AJAX nếu có lỗi client-side
        }

        let formData = $(this).serialize(); // hoặc new FormData(this)
        let urlUpdate = $(this).attr('action');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });

        $.ajax({
            url: urlUpdate,
            type: 'POST',
            data: formData,
            // Nếu dùng FormData thì cần:
            // processData: false,
            // contentType: false,
            beforeSend: function () {
                $(".btn-wrapper button")
                    .text("Đang đổi mật khẩu...")
                    .attr("disabled", true);
            },
            success: function (response) {
                if (response.success) {
                    toastr.success(response.message || "Đổi mật khẩu thành công!");
                    $('#change-password-form')[0].reset();
                } else {
                    toastr.error(response.message || "Có lỗi xảy ra khi đổi mật khẩu!");
                }
            },
            error: function (xhr) {
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        toastr.error(value[0]);
                    });
                } else {
                    toastr.error("Đã xảy ra lỗi không xác định!");
                }
            },
            complete: function () {
                $(".btn-wrapper button")
                    .text("Đổi mật khẩu")
                    .attr("disabled", false);
            }
        });
    });

    // Validate address form
    $('#addAddressForm').submit(function (e) {
        e.preventDefault();
        $('.error-message').remove();

        let isValid = true;
        let fullName = $('#full_name').val().trim();
        let phone = $('#phone').val().trim();
        let address = $('#address').val().trim();
        let city = $('#city').val().trim();
        let isDefault = $('#default').is(':checked') ? 1 : 0;

        if (fullName.length < 3) {
            isValid = false;
            $('#full_name').after('<p class="error-message text-danger mt-1">Họ và tên phải có ít nhất 3 ký tự.</p>');
        }

        let phoneRegex = /^[0-9]{10}$/;
        if (!phoneRegex.test(phone)) {
            isValid = false;
            $('#phone').after('<p class="error-message text-danger mt-1">Số điện thoại phải gồm 10 chữ số.</p>');
        }

        if (address.length < 5) {
            isValid = false;
            $('#address').after('<p class="error-message text-danger mt-1">Địa chỉ phải có ít nhất 5 ký tự.</p>');
        }

        if (city.length < 2) {
            isValid = false;
            $('#city').after('<p class="error-message text-danger mt-1">Vui lòng nhập tên thành phố hợp lệ.</p>');
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        if (isValid) {
            $.ajax({
                url: addAddressUrl,
                method: 'POST',
                data: {
                    full_name: fullName,
                    phone: phone,
                    address: address,
                    city: city,
                    default: isDefault
                },
                beforeSend: function () {
                    $('.btn-primary[form="addAddressForm"]').prop('disabled', true).text('Đang lưu...');
                },
                success: function (response) {
                    $('#addAddressModal').modal('hide');
                    $('#addAddressForm')[0].reset();

                    // Hiển thị thông báo toastr
                    toastr.success(response.message || 'Đã thêm địa chỉ thành công!');

                    // Reload lại trang sau 1.5 giây để cập nhật danh sách
                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                },
                error: function () {
                    toastr.error('Có lỗi xảy ra khi thêm địa chỉ!');
                },
                complete: function () {
                    $('.btn-primary[form="addAddressForm"]').prop('disabled', false).text('Lưu địa chỉ');
                }
            });
        }
    });

    // ================================
    // PAGE PRODUCT - AJAX FILTER
    // ================================
    let currentPage = 1;
    let currentCategory = ''; // '' = TẤT CẢ

    // ================================
    // PAGINATION
    // ================================
    $(document).on('click', '.pagination-link', function (e) {
        e.preventDefault();

        let href = $(this).attr('href');
        if (!href) return;

        let url = new URL(href, window.location.origin);
        currentPage = url.searchParams.get('page') || 1;

        fetchProducts();
    });

    // ================================
    // FETCH PRODUCTS
    // ================================
    // ================================
    // FETCH PRODUCTS
    // ================================
    function fetchProducts() {

        let sort_by = $('#sort-by').val() || '';
        let minPrice = 0;
        let maxPrice = 300000;

        if ($('.slider-range').hasClass('ui-slider')) {
            minPrice = $(".slider-range").slider('values', 0);
            maxPrice = $(".slider-range").slider('values', 1);
        }

        $.ajax({
            url: '/products/filter',
            type: 'GET',
            data: {
                // 🔥 FIX: Luôn lấy currentPage hiện tại
                // Khi đổi category, code click event bên dưới đã set currentPage = 1 rồi
                page: currentPage,
                category_id: currentCategory,
                min_price: minPrice,
                max_price: maxPrice,
                sort_by: sort_by
            },
            beforeSend: function () {
                $("#loading-spinner").show();
                // Có thể làm mờ danh sách sản phẩm cũ
                $("#ajax-product-container").css("opacity", "0.5");
            },
            success: function (res) {
                // 🔥 FIX: ID selector cho đúng với file Blade
                $("#ajax-product-container").html(res.products);

                // Selector này ok nếu blade pagination của bạn có class .ltn__pagination bọc ngoài
                // Nhưng an toàn nhất là target vào ID container
                $("#ajax-pagination").html(res.pagination);

                // Scroll nhẹ lên đầu danh sách sản phẩm để user thấy thay đổi
                $('html, body').animate({
                    scrollTop: $(".ltn__product-area").offset().top - 100
                }, 500);
            },
            complete: function () {
                $("#loading-spinner").hide();
                $("#ajax-product-container").css("opacity", "1");
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                // alert("Có lỗi xảy ra, vui lòng thử lại!"); // Nên dùng Toast notification đẹp hơn
            }
        });
    }

    // ================================
    // CATEGORY FILTER
    // ================================
    $(document).on('click', '.category-filter', function () {

        $('.category-filter').removeClass('active');
        $(this).addClass('active');

        currentCategory = $(this).data('id') ?? '';

        // 🔥 CỰC KỲ QUAN TRỌNG
        currentPage = 1;

        fetchProducts();
    });

    // ================================
    // SORT
    // ================================
    $('#sort-by').change(function () {
        currentPage = 1;
        fetchProducts();
    });

    // ================================
    // PRICE SLIDER
    // ================================
    $(".slider-range").slider({
        range: true,
        min: 0,
        max: 300000,
        values: [0, 300000],
        slide: function (event, ui) {
            $(".amount").val(
                ui.values[0].toLocaleString() + " ₫ - " +
                ui.values[1].toLocaleString() + " ₫"
            );
        },
        change: function () {
            currentPage = 1;
            fetchProducts();
        }
    });

    $(".amount").val(
        $(".slider-range").slider("values", 0).toLocaleString() + " ₫ - " +
        $(".slider-range").slider("values", 1).toLocaleString() + " ₫"
    );

    // **********************************************
    // Detail Product
    // **********************************************
    // Quantity plus minus button
    if (window.location.pathname != '/cart') {
        $(document).on('click', '.qtybutton', function () {
            var $button = $(this);
            var $input = $button.siblings('input');
            var oldValue = parseInt($input.val());
            var maxStock = parseInt($input.data('max'));

            if ($button.hasClass('inc')) {
                if (oldValue < maxStock) {
                    $input.val(oldValue + 1);
                }
            } else {
                if (oldValue > 1) {
                    $input.val(oldValue - 1);
                }
            }
        });
    } else {
        $(document).on('click', '.qtybutton', function () {
            let $button = $(this);
            let $input = $button.siblings('input');
            let oldValue = parseInt($input.val());
            let maxStock = parseInt($input.data('max'));
            let productId = $input.data('id');
            let newValue = oldValue;

            if ($button.hasClass('inc')) {
                if (oldValue < maxStock) {
                    newValue = oldValue + 1;
                } else {
                    toastr.warning('Số lượng vượt quá tồn kho!');
                    return;
                }
            } else {
                if (oldValue > 1) {
                    newValue = oldValue - 1;
                } else {
                    toastr.warning('Số lượng tối thiểu là 1!');
                    return;
                }
            }

            if (newValue !== oldValue) {
                updateCartQuantity(productId, newValue, $input);
            }
        });
    }
    // **********************************************
    // CART
    // **********************************************
    // Add to cart
    $(document).on('click', '.add-to-cart-btn', function (e) {
        e.preventDefault();

        let productId = $(this).data('id');
        let quantity = $(this).closest('li').prev().find('.cart-plus-minus-box').val();

        quantity = quantity ? quantity : 1;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/cart/add',
            type: "POST",
            data: {
                product_id: productId,
                quantity: quantity
            },
            success: function (response) {
                $('#add_to_cart_modal-' + productId).modal('show');
                $('#quick_view_modal-' + productId).modal('hide');
                $('#cart_count').text(response.cart_count);
            },
            error: function (xhr) {
                alert("Có lỗi xảy ra với ajax addToCart In Detail!");
            }
        });
    });


    // Mini Cart
    $('.mini-cart-icon').click(function (e) {
        e.preventDefault();
        $.ajax({
            url: '/mini-cart',
            type: 'GET',
            success: function (response) {
                if (response.status) {
                    $('#ltn__utilize-cart-menu .ltn__utilize-menu-inner').html(response.html);
                    $('#ltn__utilize-cart-menu').addClass('ltn__utilize-open');
                } else {
                    toastr.error('Không thể tải giỏ hàng!');
                }
            },
            error: function () {
                toastr.error('Lỗi kết nối đến máy chủ!');
            }
        });
    });

    // Remove item from mini-cart
    $(document).on('click', '.mini-cart-item-delete', function (e) {
        e.preventDefault();
        let rowId = $(this).data('id');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/cart/remove',
            type: 'POST',
            data: {
                product_id: rowId
            },
            success: function (response) {
                if (response.status) {
                    $('#cart_count').text(response.cart_count);
                    $('.mini-cart-icon').click(); // Tải lại mini-cart
                    toastr.success('Đã xóa sản phẩm khỏi giỏ hàng!');
                } else {
                    toastr.error('Lỗi kết nối đến máy chủ!');
                }
            }
        });
    });

    // Đóng mini-cart khi nhấn nút ×
    $(document).on('click', '.ltn__utilize-close', function (e) {
        e.preventDefault();
        $('#ltn__utilize-cart-menu').removeClass('ltn__utilize-open');
        $('.ltn__utilize-overlay').hide();
    });
    // Đóng khi click bên ngoài mini-cart
    $(document).on('click', function (e) {
        if ($(e.target).closest('#ltn__utilize-cart-menu, .mini-cart-icon').length === 0) {
            $('#ltn__utilize-cart-menu').removeClass('ltn__utilize-open');
            $('.ltn__utilize-overlay').hide();
        }
    });

    // **********************************************
    // Cart Page
    // **********************************************
    // Update cart quantity
    function updateCartQuantity(productId, quantity, $input) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/cart/update',
            type: 'POST',
            data: {
                product_id: productId,
                quantity: quantity
            },
            beforeSend: function () {
                $input.prop('disabled', true);
            },
            success: function (response) {
                if (response.status) {
                    $input.val(quantity);
                    $('#cart_count').text(response.cart_count);
                    $('#cart_total').text(response.cart_total.toLocaleString() + ' ₫');
                    $('#grand_total').text(response.grand_total.toLocaleString() + ' ₫');
                    $('#cart_item_total_' + productId).text(response.item_total.toLocaleString() + ' ₫');
                    toastr.success('Cập nhật số lượng thành công!');
                } else {
                    toastr.error(response.message || 'Không thể cập nhật số lượng!');
                }
            },
            error: function () {
                toastr.error('Lỗi kết nối đến máy chủ!');
            },
            complete: function () {
                $input.prop('disabled', false);
            }
        });
    }

    // Remove item from cart page
    $('.remove-from-cart').click(function (e) {
        e.preventDefault();
        let productId = $(this).data('id');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/cart/remove',
            type: 'POST',
            data: {
                product_id: productId
            },
            success: function (response) {
                if (response.status) {
                    $('#cart_item_row_' + productId).remove();
                    $('#cart_count').text(response.cart_count);
                    $('#cart_total').text(Math.round(response.cart_total).toLocaleString('vi-VN') + ' ₫');
                    $('#grand_total').text(Math.round(response.grand_total).toLocaleString('vi-VN') + ' ₫');
                    $('#cart_item_total_' + productId).text(Math.round(response.item_total).toLocaleString('vi-VN') + ' ₫');


                    if (response.cart_count === 0) {
                        $('tbody').html('<tr><td colspan="6" class="text-center">Không có sản phẩm nào trong giỏ hàng</td></tr>');
                        $('.shoping-cart-total').remove();
                    }

                    toastr.success('Đã xóa sản phẩm khỏi giỏ hàng!');
                } else {
                    toastr.error('Lỗi kết nối đến máy chủ!');
                }
            }
        });
    });


     // **********************************************
    // Checkout Page
    // **********************************************

    $('#list_address').change(function () {
        let addressId = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/checkout/get-address',
            type: 'GET',
            data: {
                address_id: addressId
            },
            success: function (response) {
                if (response.success) {
                    $('input[name="ltn__name"]').val(response.data.full_name);
                    $('input[name="ltn__lastname"]').val(response.data.phone);
                    $('input[name="ltn__address"]').val(response.data.address);
                    $('input[name="ltn__city"]').val(response.data.city);
                } else {
                    toastr.error(response.message);
                }
            },
            error: function () {
                toastr.error('Lỗi kết nối đến máy chủ!');
            }
        });
    });

    // Handle Paypal Button
    function togglePaypal() {
        if ($('#payment_paypal').is(':checked')) {
            $('#paypal-button-container').show();
            $('#place-order-button').hide();
        } else {
            $('#paypal-button-container').hide();
            $('#place-order-button').show();
        }
    }
    togglePaypal();
    $('input[name="payment_method"]').on('change', togglePaypal);

    var totalPriceText = $('.totalPrice_Checkout').text().replace(/[₫,.đ]/g, '').trim();
    var totalPrice = parseFloat(totalPriceText) / 24000; // chuyển sang USD

    paypal.Buttons({
        createOrder: function (data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: totalPrice.toFixed(2)
                    }
                }]
            });
        },
        onApprove: function (data, actions) {
            return actions.order.capture().then(function (details) {
                fetch('/checkout/paypal', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        body: JSON.stringify({
                            orderID: data.orderID,
                            payerID: data.payerID,
                            transactionID: details.id,
                            amount: details.purchase_units[0].amount.value,
                            address_id: $('#list_address').val(),
                            payment_method: 'paypal'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            toastr.success('Thanh toán PayPal thành công!');
                            window.location.href = '/account';
                        } else {
                            toastr.error(data.message || 'Đã xảy ra lỗi khi xử lý thanh toán PayPal.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        toastr.error('Đã xảy ra lỗi khi kết nối đến máy chủ.');
                    });
            });
        }
    }).render('#paypal-button-container');

    // Handle MoMo payment
    $('#checkout-form').on('submit', function (e) {
        const paymentMethod = $('input[name="payment_method"]:checked').val();

        if (paymentMethod === 'momo') {
            e.preventDefault(); // Chặn submit mặc định

            const addressId = $('#list_address').val();
            const totalPriceText = $('.totalPrice_Checkout').text().replace(/[₫,.đ]/g, '').trim();
            const totalPrice = parseInt(totalPriceText);

            fetch('/checkout/momo', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify({
                        amount: totalPrice,
                        address_id: addressId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.payUrl) {
                        window.location.href = data.payUrl; // Chuyển hướng đến MoMo
                    } else {
                        toastr.error(data.message || 'Không thể khởi tạo thanh toán MoMo.');
                    }
                })
                .catch(error => {
                    console.error('MoMo Error:', error);
                    toastr.error('Không thể kết nối đến máy chủ.');
                });
        }
    });


    /**********************************************
     * HANDLE RATING PRODUCT
     **********************************************/

    if (window.location.pathname.startsWith('/product/')) {
        let selectedRating = 0;

        // Handle hover on stars
        $(".rating-star").hover(
            function () {
                let value = $(this).data("value");
                highlightStars(value);
            },
            function () {
                highlightStars(selectedRating);
            }
        );

        // Handle click on stars
        $(".rating-star").click(function (e) {
            e.preventDefault();
            selectedRating = $(this).data("value");
            $("#rating-value").val(selectedRating);
            highlightStars(selectedRating);
        });

        // Function to highlight stars
        function highlightStars(value) {
            $(".rating-star i").each(function () {
                let starValue = $(this).parent().data("value");
                if (starValue <= value) {
                    $(this).removeClass("far").addClass("fas"); // Show filled star
                } else {
                    $(this).removeClass("fas").addClass("far"); // Show empty star
                }
            });
        }

        // Handle submit rating with AJAX

        $("#review-form").submit(function (e) {
            e.preventDefault();

            let productId = $(this).data("product-id");
            let rating = $("#rating-value").val();
            let content = $("#review-content").val();

            // Kiểm tra nếu chưa chọn số sao
            if (rating == 0 || rating === "") {
                $("#review-message").html(
                    '<div class="alert alert-danger">Vui lòng chọn số sao!</div>'
                );
                return;
            }

            // Cấu hình token CSRF cho AJAX
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            // Gửi dữ liệu qua AJAX
            $.ajax({
                url: "/review",
                type: "POST",
                data: {
                    product_id: productId,
                    rating: rating,
                    comment: content,
                },
                success: function (response) {
                    $("#review-content").val("");
                    highlightStars(0); // reset lại sao
                    selectedRating = 0;
                    $(".ltn__comment-reply-area").hide();
                    toastr.success("Cảm ơn bạn đã đánh giá sản phẩm!");

                    loadReviews(productId);
                },
                error: function (xhr) {
                    toastr.error("Đã xảy ra lỗi khi gửi đánh giá. Vui lòng thử lại!");
                },
            });
        });

        function loadReviews(productId) {
            $.ajax({
                url: '/review/' + productId,
                type: 'GET',
                success: function (response) {
                    $(".ltn__comment-inner").html(response);
                },
                error: function () {
                    toastr.error('Không thể tải đánh giá sản phẩm!');
                }
            });
        }
    }

    /**********************************************
     * HANDLE CONTACNT PAGE
     **********************************************/
    $(".contact-form").on("submit", function (e) {
        let name = $('input[name="name"]').val();
        let email = $('input[name="email"]').val();
        let phone = $('input[name="phone"]').val();
        let message = $('textarea[name="message"]').val();
        let errorMessage = "";

        if (name.length < 3) {
            errorMessage += "Họ và tên phải có ít nhất 3 ký tự.<br>";
        }

        if (phone.length < 10 || phone.length > 11) {
            errorMessage += "Số điện thoại phải từ 10-11 số.<br>";
        }

        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            errorMessage += "Email không hợp lệ.<br>";
        }

        if (errorMessage !== "") {
            toastr.error(errorMessage, "Lỗi");
            e.preventDefault();
        }
    });

    /**********************************************
     * HANDLE WISHLIST PAGE
     **********************************************/

    $(document).on('click', '.add-to-wishlist', function (e) {
        e.preventDefault();

        let productId = $(this).data("id");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/wishlist/add',
            type: "POST",
            data: {
                product_id: productId
            },
            success: function (response) {
                if (response.status) {
                    $("#liton_wishlist_modal-" + productId).modal("show");
                }
            },
            error: function (xhr) {
                alert("Có lỗi xảy ra với ajax addToWishList");
            }
        });
    });

    $(document).on('click', '.wishlist-product-remove', function (e) {
        e.preventDefault();
        let productId = $(this).data('id');
        let row = $(this).closest("tr");

        $.ajax({
            url: '/wishlist/remove',
            type: 'POST',
            data: {
                product_id: productId
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.status) {
                    row.remove();
                    toastr.success("Đã xóa sản phẩm khỏi danh sách yêu thích!");
                }
            },
            error: function (xhr) {
                toastr.error("Có lỗi xảy ra với ajax removeProductWishList.");
            }
        });
    });

});
