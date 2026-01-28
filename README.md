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

### Clone dự án
```bash
git clone [https://github.com/doxuantu110/vinmark_php_project.git](https://github.com/doxuantu110/vinmark_php_project.git)
cd vinmark_php_project
📦 Cài đặt Dependencies
1️⃣ Cài đặt thư viện Backend (PHP)
composer install


2️⃣ Cài đặt thư viện Frontend (CSS / JS)
npm install


🔐 Cấu hình môi trường
3️⃣ Tạo file .env

Sao chép file cấu hình mẫu:

cp .env.example .env


Sau đó chỉnh sửa thông tin database trong file .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=vinmark_db
DB_USERNAME=root
DB_PASSWORD=


⚠️ Lưu ý: Bạn cần tạo database vinmark_db trước trong MySQL (phpMyAdmin hoặc MySQL Workbench).

📧 Cấu hình Email (Tùy chọn)

Để hệ thống gửi email hóa đơn và phản hồi liên hệ, cấu hình SMTP trong .env:

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="Vinmark"


🔐 Khuyến nghị sử dụng Gmail App Password.
4️⃣ Tạo Application Key
php artisan key:generate

🗄️ Khởi tạo cơ sở dữ liệu
5️⃣ Chạy Migration & Seeder
php artisan migrate
php artisan db:seed


Migration: tạo cấu trúc bảng

Seeder: thêm dữ liệu mẫu (admin, sản phẩm, danh mục, …)
6️⃣ Khởi động server Laravel
php artisan serve


Truy cập ứng dụng tại:

👉 http://127.0.0.1:8000

