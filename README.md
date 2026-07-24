# ElectroShop - Hướng dẫn cài đặt và chạy dự án

## Giới thiệu

ElectroShop là một website bán hàng được phát triển bằng **Laravel 10** và sử dụng **MySQL/MariaDB** làm hệ quản trị cơ sở dữ liệu.

---

# Yêu cầu hệ thống

- Windows 10/11
- XAMPP (Apache + MySQL)
- PHP 8.2 hoặc mới hơn
- Visual Studio Code
- Composer (khuyến nghị)

---

# Bước 1. Giải nén dự án

Giải nén file:

```
electroshop.rar
```

Sau khi giải nén sẽ thu được thư mục dự án.

Copy toàn bộ thư mục vào:

```
C:\xampp\htdocs\
```

---

# Bước 2. Mở dự án

Mở Visual Studio Code.

Chọn:

```
File
→ Open Folder
```

Mở **đúng thư mục Laravel** (thư mục chứa file `artisan`).

Ví dụ:

```
C:\xampp\htdocs\electroshop\electroshop\electroshop
```

Kiểm tra bằng Terminal:

```bash
dir
```

Nếu thấy các file sau là đúng thư mục:

```
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
```

---

# Bước 3. Khởi động XAMPP

Mở **XAMPP Control Panel**.

Start:

- Apache
- MySQL

---

# Bước 4. Tạo Database

Mở trình duyệt.

Truy cập:

```
http://localhost/phpmyadmin
```

Chọn:

```
New
```

Nhập tên database:

```
ecletroshop
```

Sau đó nhấn:

```
Create
```

---

# Bước 5. Import Database

Trong phpMyAdmin:

- Chọn database **ecletroshop**
- Chọn tab **Import**
- Nhấn **Choose File**

Chọn file:

```
ecletroshop.sql
```

(file nằm trong thư mục dự án)

Nhấn:

```
Import
```

Đợi đến khi xuất hiện thông báo:

```
Import has been successfully finished.
```

---

# Bước 6. Cấu hình file .env

Mở file:

```
.env
```

Kiểm tra thông tin kết nối cơ sở dữ liệu:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecletroshop
DB_USERNAME=root
DB_PASSWORD=
```

> **Lưu ý**
>
> Nếu MySQL trên máy không sử dụng cổng mặc định (`3306`) thì thay đổi:
>
> ```env
> DB_PORT=3307
> ```
>
> hoặc cổng tương ứng với máy đang sử dụng.

---

# Bước 7. Cài đặt thư viện

Nếu thư mục **vendor** chưa có:

```bash
composer install
```

Nếu đã có thư mục **vendor** thì có thể bỏ qua bước này.

---

# Bước 8. Xóa cache cấu hình

Chạy:

```bash
php artisan optimize:clear
```

---

# Bước 9. Chạy dự án

Trong Terminal:

```bash
php artisan serve
```

Nếu thành công sẽ xuất hiện:

```
INFO  Server running on [http://127.0.0.1:8000]
```

Mở trình duyệt:

```
http://127.0.0.1:8000
```

---

# Một số lỗi thường gặp

## 1. Unknown database

```
SQLSTATE[HY000] [1049]
Unknown database 'ecletroshop'
```

### Nguyên nhân

Chưa tạo hoặc chưa import database.

### Khắc phục

- Tạo database:

```
ecletroshop
```

- Import file:

```
ecletroshop.sql
```

---

## 2. Access denied

```
SQLSTATE[HY000] [1045]
Access denied for user 'root'@'localhost'
```

### Nguyên nhân

Sai thông tin kết nối MySQL.

### Kiểm tra

File `.env`

```env
DB_HOST
DB_PORT
DB_DATABASE
DB_USERNAME
DB_PASSWORD
```

Nếu MySQL sử dụng cổng khác 3306 thì sửa:

```env
DB_PORT=<cổng MySQL>
```

Sau đó chạy:

```bash
php artisan optimize:clear
```

và chạy lại:

```bash
php artisan serve
```

---

## 3. composer không được nhận

```
composer : The term 'composer' is not recognized
```

### Khắc phục

Cài Composer:

https://getcomposer.org/download/

Sau đó kiểm tra:

```bash
composer -V
```

---

## 4. Thiếu thư mục vendor

Chạy:

```bash
composer install
```

---

# Dừng server

Nhấn:

```
Ctrl + C
```

---

# Công nghệ sử dụng

- Laravel 10
- PHP 8.2
- MySQL / MariaDB
- Bootstrap
- Blade Template
- XAMPP

---

# Quy trình chạy dự án

```
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
```
