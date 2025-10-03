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
