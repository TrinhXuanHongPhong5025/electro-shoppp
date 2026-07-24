ElectroShop - Hướng dẫn cài đặt và chạy dự án
Giới thiệu
ElectroShop là một trang web bán hàng được phát triển bằng Laravel 10 và sử dụng cơ sở dữ liệu MySQL/MariaDB .

Yêu cầu hệ thống
Windows 10/11
XAMPP (Apache + MySQL)
PHP 8.2 hoặc mới hơn
Mã Visual Studio
Nhà soạn nhạc (khuyến nghị)
Bước 1. nén dự án
Giải nén tập tin:

electroshop.rar
Sau khi giải nén sẽ thu được dự án thư mục.

Copy toàn bộ thư mục vào:

C:\xampp\htdocs\
Bước 2. Mở dự án
Mở Visual Studio Code.

Chọn:

File
→ Open Folder
Mở đúng thư mục Laravel (thư mục chứa file artisan).

Ví dụ:

C:\xampp\htdocs\electroshop\electroshop\electroshop
Kiểm tra bằng Nhà ga:

dir
Nếu các tập tin được tìm thấy sau thư mục đúng:

artisan
composer.json
vendor
app
bootstrap
config
database
public
resources
routes
storage
Bước 3. Khởi động XAMPP
Mở Bảng điều khiển XAMPP .

Bắt đầu:

Apache
MySQL
Bước 4. Tạo cơ sở dữ liệu
Mở trình duyệt.

Truy cập:

http://localhost/phpmyadmin
Chọn:

New
Cơ sở dữ liệu tên:

ecletroshop
Sau đó nhấn:

Create
Bước 5. Nhập cơ sở dữ liệu
Trong phpMyAdmin:

Chọn cơ sở dữ liệu ecletroshop
Chọn tab Nhập
Chọn tập tin
Chọn tệp:

ecletroshop.sql
(file nằm trong dự án thư mục)

—

Import
Chờ đợi khi xuất hiện thông báo:

Import has been successfully finished.
Bước 6. Cấu hình file .env
Mở tệp:

.env
Kiểm tra cơ sở dữ liệu kết nối thông tin:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecletroshop
DB_USERNAME=root
DB_PASSWORD=
Lưu ý

Nếu MySQL trên máy không sử dụng cổng mặc định ( 3306) thì thay đổi:

DB_PORT=3307
hoặc cổng tương ứng với máy đang sử dụng.

Bước 7. Cài đặt thư viện
Nếu nhà cung cấp thư mục không có:

composer install
Nếu có nhà cung cấp thư mục thì có thể bỏ qua bước này.

Bước 8. Xóa cấu hình bộ đệm
Chạy:

php artisan optimize:clear
Bước 9. Chạy dự án
Nhà ga Trong:

php artisan serve
Nếu thành công sẽ hiển thị:

INFO  Server running on [http://127.0.0.1:8000]
Mở trình duyệt:

http://127.0.0.1:8000
Một số lỗi thường gặp
1. Cơ sở dữ liệu không xác định
SQLSTATE[HY000] [1049]
Unknown database 'ecletroshop'
Nguyên nhân
Cơ sở dữ liệu chưa được tạo hoặc chưa nhập.

Khắc phục
Tạo cơ sở dữ liệu:
ecletroshop
Nhập tệp:
ecletroshop.sql
2. Quyền truy cập bị từ chối
SQLSTATE[HY000] [1045]
Access denied for user 'root'@'localhost'
Nguyên nhân
Sai kết nối thông tin MySQL.

kiểm tra
Tài liệu.env

DB_HOST
DB_PORT
DB_DATABASE
DB_USERNAME
DB_PASSWORD
Nếu MySQL sử dụng cổng khác 3306 thì hãy sửa:

DB_PORT=<cổng MySQL>
Sau đó:

php artisan optimize:clear
và lại:

php artisan serve
3. nhà soạn nhạc không được nhận
composer : The term 'composer' is not recognized
Khắc phục
Cài Composer:

https://getcomposer.org/download/

Sau đó kiểm tra:

composer -V
4. Thiếu thư mục vendor
Chạy:

composer install
máy chủ
—

Ctrl + C
Công nghệ ứng dụng
Laravel 10
PHP 8.2
MySQL / MariaDB
Bootstrap
Mẫu lưỡi dao
XAMPP
Quy trình làm dự án
Giải nén file .rar
        │
        ▼
Copy vào htdocs
        │
        ▼
Mở đúng thư mục Laravel
(thư mục chứa artisan)
        │
        ▼
Start Apache + MySQL
        │
        ▼
Tạo database ecletroshop
        │
        ▼
Import ecletroshop.sql
        │
        ▼
Kiểm tra file .env
        │
        ▼
php artisan optimize:clear
        │
        ▼
php artisan serve
        │
        ▼
Mở http://127.0.0.1:8000
