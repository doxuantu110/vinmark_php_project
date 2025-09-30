$(document).ready(function () {
    // **********************************************
    // Register Form Submission
    // **********************************************
    // Validate and submit the registration form
    console.log("Custom JS loaded");
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
                if (msg.trim() !== "") toastr.error(msg, 'Lỗi đăng ký');
            });
            event.preventDefault();
        }
    });
});
