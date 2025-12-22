$(document).ready(function () {
    // **********************************************
    // User Management
    // **********************************************

    // upgrade user to staff
    $(document).on('click', '.upgradeStaff', function () {

        let button = $(this);
        let userId = button.data('user-id');

        $.ajax({
            type: "POST",
            url: "/admin/user/upgrade",
            data: {
                user_id: userId
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.status) {
                    toastr.success(response.message);

                    // Cập nhật UI
                    button.closest('.profile_view').find('.brief i').text('STAFF');
                    button.closest('.profile_view').find('.changeStatus').hide();
                    button.hide();
                } else {
                    toastr.error(response.message);
                }
            },
            error: function (xhr, status, error) {
                alert("Lỗi: " + error);
            }
        });
    });

    // change user status (active/banned/deleted)
    // Change user status (active / banned / deleted)
    $(document).on('click', '.changeStatus', function () {
        let button = $(this);
        let userId = button.data('user-id');
        let newStatus = button.data('status');

        $.ajax({
            type: "POST",
            url: "/admin/user/updateStatus",
            data: {
                user_id: userId,
                status: newStatus
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {

                if (response.status) {
                    toastr.success(response.message);

                    // Cập nhật lại nội dung nút ngay lập tức
                    switch (newStatus) {
                        case 'banned':
                            button.text('Đã chặn');
                            button.removeClass().addClass("btn btn-warning btn-sm");
                            break;

                        case 'deleted':
                            button.text('Đã xóa');
                            button.removeClass().addClass("btn btn-danger btn-sm");
                            break;

                        case 'active':
                            button.text('Đã khôi phục');
                            button.removeClass().addClass("btn btn-success btn-sm");
                            break;
                    }

                    // Disable nút để tránh bấm liên tục
                    button.prop('disabled', true);

                    // OPTION: tự reload UI sau 1.2s để hiển thị các nút mới
                    setTimeout(() => {
                        location.reload();
                    }, 1200);

                } else {
                    toastr.error(response.message);
                }
            },

            error: function (xhr, status, error) {
                toastr.error("Lỗi: " + error);
            }
        });
    });

    /* ************************************
     *     MANAGEMENT CATEGORIES
     ************************************/

    $("#category-image").change(function () {
        let file = this.files[0];
        let preview = $('#preview-image');

        if (file) {
            let reader = new FileReader();
            reader.onload = function (e) {
                preview.attr('src', e.target.result);
                preview.css('display', 'block'); // Quan trọng!
            };
            reader.readAsDataURL(file);
        } else {
            preview.attr('src', '');
            preview.css('display', 'none');
        }
    });

    // reset button
    $('.btn-reset').on('click', function () {
        $('#preview-image').attr('src', '').css('display', 'none');
    });


    // Bắt sự kiện change trên các input có id bắt đầu bằng "category-image-"
    $('input[id^="category-image-"]').change(function () {
        let file = this.files[0];
        let categoryId = $(this).data('id');

        if (file) {
            let reader = new FileReader();

            reader.onload = function (e) {
                $('#modalUpdate-' + categoryId).find('img.rounded').attr('src', e.target.result);
            };

            reader.readAsDataURL(file);
        }
    });

    // Update category submit
    $(document).on('click', '.btn-update-submit-category', function (e) {
        e.preventDefault();
        let button = $(this);
        let modal = button.closest('.modal');

        // Lấy dữ liệu dựa trên các class vừa thêm ở bước 1
        let categoryId = modal.find('.category-id').val();
        let categoryName = modal.find('.category-name').val();
        let categoryDesc = modal.find('.category-desc').val(); // Lấy thêm mô tả

        // Lấy file ảnh
        let categoryImageInput = modal.find('#category-image-' + categoryId)[0];
        let categoryImageFile = categoryImageInput ? categoryImageInput.files[0] : null;

        let formData = new FormData();
        formData.append('category_id', categoryId);
        formData.append('category_name', categoryName);
        formData.append('category_description', categoryDesc); // Gửi thêm mô tả lên server

        if (categoryImageFile) {
            formData.append('category_image', categoryImageFile);
        }

        $.ajax({
            type: "POST",
            // Lưu ý: Đảm bảo route update của bạn nhận đúng phương thức POST (hoặc thêm _method: PUT nếu dùng Resource)
            url: "/admin/categories/update",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                button.prop('disabled', true);
                button.text('Đang cập nhật...'); // Sửa lại text cho tự nhiên
            },
            success: function (response) {
                // Reset nút bấm dù thành công hay thất bại để tránh bị treo nút nếu user không reload trang
                button.prop('disabled', false);
                button.text('Lưu thay đổi');

                if (response.status) {
                    toastr.success(response.message);
                    setTimeout(() => {
                        location.reload();
                    }, 1200);
                } else {
                    toastr.error(response.message);
                }
            },
            error: function (xhr, status, error) {
                button.prop('disabled', false);
                button.text('Lưu thay đổi');

                // Xử lý hiển thị lỗi validation từ Laravel (nếu có)
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        toastr.error(value[0]);
                    });
                } else {
                    toastr.error("Lỗi hệ thống: " + error);
                }
            }
        });
    });
    // Delete category
    $(document).on('click', '.btn-delete-category', function (e) {
        e.preventDefault();
        let button = $(this);
        let categoryId = button.data('category-id');
        if (confirm('Bạn có chắc chắn muốn xóa danh mục này không?')) {
            $.ajax({
                type: "POST",
                url: "/admin/categories/delete",
                data: {
                    category_id: categoryId
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.status) {
                        toastr.success(response.message);
                        setTimeout(() => {
                            location.reload();
                        }, 1200);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    toastr.error("Lỗi: " + error);
                }
            });
        }
    });

    $(document).ready(function () {

        /* ===============================
         *  PREVIEW ẢNH KHI THÊM SẢN PHẨM
         =============================== */
        $(document).on("change", "#product-image", function () {

            $("#multiplePreview").html("");

            let files = this.files;

            if (files && files.length > 0) {
                Array.from(files).forEach(file => {
                    let reader = new FileReader();

                    reader.onload = function (e) {
                        let img = `
                        <img src="${e.target.result}" 
                             class="img-thumbnail"
                             style="width:120px; height:120px; object-fit:cover; border-radius:8px;">
                    `;
                        $("#multiplePreview").append(img);
                    };

                    reader.readAsDataURL(file);
                });
            }
        });


        /* ===============================
        *  PREVIEW ẢNH KHI SỬA SẢN PHẨM
            =============================== */
        $(document).on('change', '.product-images', function () {

            const input = this;
            const files = input.files;
            const $modal = $(this).closest('.modal'); // tìm modal hiện tại
            const $preview = $modal.find('#new-image-preview-' + $modal.find('.product-id').val()); // trùng với id trong Blade

            $preview.empty(); // Xóa preview cũ nếu chọn lại

            if (!files || files.length === 0) return;

            Array.from(files).forEach(file => {
                if (!file.type.startsWith('image/')) return; // chỉ preview file ảnh

                const reader = new FileReader();
                reader.onload = function (evt) {
                    const html = `
                <div class="preview-thumb" style="width:100px; height:100px; position: relative;">
                    <img src="${evt.target.result}" style="width:100%; height:100%; object-fit:cover; border:1px solid #ddd; border-radius:4px;">
                </div>
            `;
                    $preview.append(html);
                };
                reader.readAsDataURL(file);
            });
        });

        /* ===============================
         * RESET MODAL KHI ĐÓNG
         =============================== */
        $(document).on('hidden.bs.modal', '[id^="modalUpdate-"]', function () {
            const modal = $(this);

            // 1. Reset input file
            modal.find('.product-images').val("");

            // 2. Chỉ xóa preview ảnh MỚI (New Preview)
            // Lưu ý: selector selector khớp với ID ta đặt trong Blade
            modal.find('[id^="new-image-preview-"]').empty();

            // 3. TUYỆT ĐỐI KHÔNG đụng vào [id^="existing-images-"]
            // Để khi mở lại modal, ảnh cũ vẫn còn đó.
        });

    });

    $(document).ready(function () {

        // ... (Giữ nguyên phần xử lý preview ảnh ở bài trước) ...

        /* ===============================
            *  AJAX CẬP NHẬT SẢN PHẨM
        =============================== */
        $(document).on('click', '.btn-update-submit-product', function (e) {
            e.preventDefault();

            let button = $(this);
            let $modal = button.closest('.modal'); // modal hiện tại
            let form = $modal.find('form')[0]; // lấy form DOM
            let formData = new FormData(form); // tạo FormData từ form

            $.ajax({
                type: "POST",
                url: "/admin/products/update", // route cập nhật sản phẩm
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function () {
                    button.prop('disabled', true);
                    button.text('Đang cập nhật...');
                },
                success: function (response) {
                    button.prop('disabled', false);
                    button.text('Lưu thay đổi');
                    if (response.status) {
                        toastr.success(response.message);
                        $modal.modal('hide'); // ẩn modal sau khi lưu
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        toastr.error(response.message || 'Cập nhật thất bại');
                    }
                },
                error: function (xhr) {
                    button.prop('disabled', false);
                    button.text('Lưu thay đổi');

                    if (xhr.status === 422) { // lỗi validate
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            toastr.error(value[0]);
                        });
                    } else {
                        toastr.error("Lỗi hệ thống: " + xhr.statusText);
                        console.log(xhr.responseText);
                    }
                }
            });
        });

    });
    /* ===============================
     * XÓA SẢN PHẨM
     =============================== */
    $(document).on('click', '.btn-delete-product', function (e) {
        e.preventDefault();
        let button = $(this);
        let productId = button.data('product-id');
        if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')) {
            $.ajax({
                type: "POST",
                url: "/admin/products/delete",
                data: {
                    id: productId
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.status) {
                        toastr.success(response.message);
                        setTimeout(() => {
                            location.reload();
                        }, 1200);

                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    toastr.error("Lỗi: " + error);
                }
            });
        }
    });

    /* ************************************
     *     MANAGEMENT ORDERS
     ************************************/
    $(document).on('click', '.dropdown-item[data-id]', function () {

        let orderId = $(this).data('id');
        let row = $(this).closest('tr');

        if (!confirm("Bạn có chắc muốn xác nhận đơn hàng này?")) {
            return;
        }

        $.ajax({
            url: "/admin/orders/confirm",
            type: "POST",
            data: {
                id: orderId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (res) {
                if (res.status) {
                    toastr.success(res.message);
                    row.find('.order-status').html('<span class="badge bg-info">Đang giao</span>');

                } else {
                    toastr.error(res.message);
                }
            },
            error: function () {
                alert("Có lỗi xảy ra, thử lại sau!");
            }
        });
    });

    // Send mail to customer
    $(document).on("click", ".send-invoice-mail", function (e) {
        e.preventDefault();

        let button = $(this);
        let orderId = button.data("id");

        // Thiết lập CSRF Token (quan trọng để không bị lỗi 419 Page Expired trong Laravel)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/admin/orders-detail/send-invoice",
            data: {
                id: orderId
            },
            success: function (response) {
                if (response.status) {
                    toastr.success(response.message);
                    // Xóa nút bấm sau khi gửi thành công để tránh bấm nhiều lần
                    button.remove();
                } else {
                    toastr.error(response.message);
                }
            },
            error: function (xhr, status, error) {
                // Hiển thị lỗi ra alert hoặc console để debug
                alert("An error occurred: " + error);
                console.log(xhr.responseText);
            }
        });
    });

    // Cancel order
    $(document).on("click", ".cancel-order", function (e) {
        e.preventDefault();
        let button = $(this);

        let orderId = button.data("id")
        $.ajaxSetup({
            headers: {
                // Lấy giá trị của CSRF Token từ thẻ meta có tên 'csrf-token'
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            }
        });

        // Thực hiện yêu cầu AJAX để hủy đơn hàng
        $.ajax({
            type: "POST",
            url: "/admin/orders/cancel-order",
            data: {
                id: orderId,
            },

            // Xử lý khi yêu cầu thành công
            success: function (response) {
                if (response.status) {
                    toastr.success(response.message);

                    button.remove();
                } else {
                    toastr.error(response.message);
                }
            },

            // Xử lý khi yêu cầu thất bại (lỗi mạng, lỗi server 5xx, 4xx...)
            error: function (xhr, status, error) {
                // Hiển thị một thông báo cảnh báo đơn giản
                alert("An error occurred: " + error);
            },
        });
    });
    //********************************************
    //     MANAGEMENT CONTACTS
    // ************************************//
    if ($("#editor-contact").length) {
        CKEDITOR.replace("editor-contact");
    }

    $(document).on("click", ".contact-item", function () {

        let contactName = $(this).data("name");
        let contactEmail = $(this).data("email");
        let contactMessage = $(this).data("message");
        let contactId = $(this).data("id");
        let isReplied = $(this).data("is_replyed");

        $(".mail_view .sender-info strong:first").text(contactName);
        $(".mail_view .sender-info span").text(contactEmail);
        $(".mail_view .view-mail p").html(contactMessage);

        $(".mail_view").show();

        if (isReplied == 0) $(".compose").show();
        else $(".compose").hide();

        $(".send-reply-contact")
            .data("email", contactEmail)
            .data("id", contactId);
    });

    $(document).on("click", ".send-reply-contact", function (e) {
        e.preventDefault();

        let button = $(this);
        let email = button.data("email");
        let contactId = button.data("id");

        let message = CKEDITOR.instances["editor-contact"].getData();

        if (!message.trim()) {
            toastr.warning("Vui lòng nhập nội dung phản hồi!");
            return;
        }

        $.ajax({
            type: "POST",
            url: "/admin/contact/reply",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                email: email,
                message: message,
                contact_id: contactId
            },
            beforeSend: function () {
                button.prop('disabled', true).text('Đang gửi...');
            },
            success: function (response) {
                if (response.status) {

                    $("#status-" + contactId).html(`
                    <i class="fa fa-check-circle" style="color: green;"></i>
                `);

                    toastr.success(response.message);

                    updateContactStatus(contactId);

                    $(".mail_view").hide();
                    $(".compose").hide();

                    CKEDITOR.instances["editor-contact"].setData("");
                    $('#editor-contact').val("");
                } else {
                    toastr.error(response.message);
                }
            },
            error: function () {
                toastr.error("Gửi mail thất bại!");
            },
            complete: function () {
                button.prop('disabled', false).text('Gửi');
            }
        });
    });

    function updateContactStatus(id) {
        let item = $('.contact-item[data-id="' + id + '"]');

        item.find(".status-text")
            .text("Đã phản hồi")
            .removeClass("bg-danger")
            .addClass("bg-success")
            .css("color", "white");

        item.find(".status-text i")
            .removeClass("fa-times-circle text-danger")
            .addClass("fa-check-circle")
            .css("color", "white");

        item.data("is_replyed", 1);
    }

    //********************************************
    //     MANAGEMENT PROFILES
    // ************************************//

    $(document).ready(function () {
        // --- 1. Hàm xử lý AJAX dùng chung (Mang ra ngoài cùng) ---
        function sendUpdateProfile(formData) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "profile/update", // Nên dùng route('profile.update') nếu viết trong file blade, hoặc để url cứng
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.status) {
                        toastr.success(response.message);

                        // Cập nhật giao diện Profile
                        if (formData.get('type') === "profile") {
                            $("#user-name").text(formData.get("name"));
                            $("#user-address").text(formData.get("address"));
                            $("#user-email").text(formData.get("email"));
                            $("#phone_number").text(formData.get("phone")); // Sửa ID khớp với Blade
                        }

                        // Reset form mật khẩu
                        if (formData.get('type') === "password") {
                            $("#change-password")[0].reset();
                            $("#change-password").hide();
                            $(".form-change-pass").text("Đổi mật khẩu");
                        }

                        // Cập nhật Avatar (lấy URL từ server trả về để chắc chắn)
                        if (formData.get('type') === "avatar") {
                            $("#avatar-preview").attr("src", response.avatar_url);
                        }
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function (xhr) {
                    toastr.error("Có lỗi xảy ra, vui lòng thử lại.");
                    console.log(xhr.responseText);
                }
            });
        }

        // --- 2. Xử lý Đổi mật khẩu ---
        $(".form-change-pass").on("click", function (e) {
            e.preventDefault();
            $("#change-password").toggle();
            if ($("#change-password").is(":visible")) {
                $(this).text("Đóng");
            } else {
                $(this).text("Đổi mật khẩu");
            }
        });

        $("#change-password").submit(function (e) {
            e.preventDefault();
            let valid = true;
            let current_password = $('#current_password').val().trim();
            let new_password = $('#new_password').val().trim();
            let confirm_password = $('#confirm_password').val().trim();

            if (current_password === "") {
                toastr.error("Bạn cần nhập mật khẩu hiện tại.");
                valid = false;
            }
            if (new_password.length < 6) {
                toastr.error("Mật khẩu mới phải có ít nhất 6 ký tự.");
                valid = false;
            }
            if (new_password !== confirm_password) {
                toastr.error("Mật khẩu xác nhận không khớp.");
                valid = false;
            }

            if (valid) {
                let formData = new FormData();
                formData.append('type', 'password');
                formData.append('current_password', current_password);
                formData.append('new_password', new_password);
                formData.append('confirm_password', confirm_password);

                // Gọi hàm đã định nghĩa ở trên
                sendUpdateProfile(formData);
            }
        });

        // --- 3. Xử lý Avatar (Tự động upload khi chọn ảnh) ---
        $('.update-avatar').on('click', function (e) {
            e.preventDefault();
            $('#avatar').trigger('click');
        });

        $('#avatar').on('change', function (e) {
            let file = e.target.files[0];
            if (file) {
                // Preview ảnh (tùy chọn, vì server sẽ trả về ảnh mới)
                let reader = new FileReader();
                reader.onload = function (e) {
                    $('#avatar-preview').attr('src', e.target.result);
                };
                reader.readAsDataURL(file);

                // Gửi ảnh lên server NGAY LẬP TỨC
                let formData = new FormData();
                formData.append('type', 'avatar');
                formData.append('avatar', file);

                sendUpdateProfile(formData);
            }
        });

        // --- 4. Xử lý Update Profile ---
        $("#update-profile").submit(function (e) {
            e.preventDefault();
            let valid = true;
            let name = $('#name').val().trim();
            let phone = $('#phone').val().trim();
            let address = $('#address').val().trim();
            let email = $('#email').val().trim();

            if (name.length < 3) {
                toastr.error("Họ và tên phải có ít nhất 3 ký tự.");
                valid = false;
            }
            let phoneRegex = /^0\d{9}$/;
            if (!phoneRegex.test(phone)) {
                toastr.error("Số điện thoại không hợp lệ (10 số, bắt đầu bằng 0).");
                valid = false;
            }
            if (address === "") {
                toastr.error("Địa chỉ không được để trống.");
                valid = false;
            }

            if (valid) {
                let formData = new FormData();
                formData.append('type', "profile");
                formData.append('name', name);
                formData.append('email', email);
                formData.append('phone', phone);
                formData.append('address', address);

                sendUpdateProfile(formData);
            }
        });
    });

    //********************************************
    //     MANAGEMENT NOTIFICATIONS
    // ************************************//
    $(document).on('click', '.notification-item', function (e) {

        let noti_id = $(this).data('id');

        $.ajax({
            url: "notifications/mark-as-read",
            type: "POST",
            data: {
                id: noti_id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
            },
            error: function () {
                alert("Có lỗi xảy ra, thử lại sau!");
            }
        });
    });

});
