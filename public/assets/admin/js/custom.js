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
        $("#product-image").on("change", function () {

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
});
