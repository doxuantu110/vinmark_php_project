# Vinmark - Chợ Trực Tuyến Cho Người Việt 🇻🇳

![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-000000?style=for-the-badge&logo=mysql)

**Vinmark** là một nền tảng thương mại điện tử (E-commerce) được xây dựng bằng **Laravel 11**, hướng tới việc cung cấp trải nghiệm mua sắm trực tuyến thuận tiện cho người dùng Việt Nam. Dự án bao gồm đầy đủ các tính năng từ phía người dùng (Frontend) đến hệ thống quản trị (Backend).

## 🌟 Tính năng nổi bật

### 🛒 Phía Khách hàng (Storefront)
- **Tìm kiếm & Lọc sản phẩm:** Tìm kiếm thông minh, lọc theo danh mục, giá cả.
- **Giỏ hàng & Thanh toán:** Thêm/sửa/xóa sản phẩm, quy trình checkout tối ưu.
- **Chatbot Hỗ trợ:** Tích hợp Chatbot tự động trả lời các câu hỏi thường gặp của khách hàng.
- **Email thông báo:** Tự động gửi email hóa đơn sau khi đặt hàng thành công.
- **Tài khoản cá nhân:** Xem lịch sử đơn hàng, cập nhật thông tin profile.

### 🛠️ Phía Quản trị (Admin Dashboard)
- **Thống kê (Dashboard):** Tổng quan doanh thu, đơn hàng mới, người dùng mới.
- **Quản lý Sản phẩm & Danh mục:** CRUD sản phẩm, upload ảnh, quản lý kho.
- **Quản lý Đơn hàng:** Cập nhật trạng thái đơn hàng (Chờ xử lý, Đang giao, Hoàn thành, Hủy).
- **Quản lý Người dùng:**
  - Phân quyền (Admin, Staff, Customer).
  - Chức năng chặn/bỏ chặn tài khoản.
  - Nâng cấp tài khoản khách hàng lên nhân viên.
- **Hộp thư liên hệ:** Trả lời thắc mắc của khách hàng trực tiếp qua Email từ trang quản trị.

## 🚀 Công nghệ sử dụng

- **Framework:** Laravel 11.x
- **Ngôn ngữ:** PHP 8.2+
- **Database:** MySQL (Sử dụng Migration & Seeder để khởi tạo cấu trúc).
- **Frontend:** Blade Templates, Bootstrap, jQuery.
- **Mail Service:** SMTP (Gmail/Mailgun).
- **Khác:** Component-based architecture.

## ⚙️ Cài đặt và Triển khai

Để chạy dự án này trên máy cục bộ (Localhost), vui lòng làm theo các bước sau:

### 1. Clone dự án
```bash
git clone [https://github.com/doxuantu110/vinmark_php_project.git](https://github.com/doxuantu110/vinmark_php_project.git)
cd vinmark_php_project
