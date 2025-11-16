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


});
