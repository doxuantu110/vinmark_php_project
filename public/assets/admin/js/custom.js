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
            if(xhr.responseJSON && xhr.responseJSON.errors) {
                $.each(xhr.responseJSON.errors, function(key, value) {
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
});
