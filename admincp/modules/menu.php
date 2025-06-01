<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Quản Lý</title>
    <style>
        /* Định dạng chung cho danh sách */
        ul.main {
            list-style-type: none; /* Loại bỏ dấu chấm mặc định */
            margin: 0;
            padding: 0;
            background-color: #2c7a6d; /* Màu nền tối cho thanh menu */
            text-align: center; /* Căn giữa các mục */
        }

        ul.main li {
            display: inline-block; /* Đặt các mục nằm ngang */
            margin: 0 10px; /* Khoảng cách giữa các mục */
        }

        ul.main li a {
            display: block;
            color: white; /* Màu chữ trắng */
            padding: 12px 20px;
            text-decoration: none; /* Loại bỏ gạch chân */
            background-color: #2c7a6d; /* Màu nền item menu */
            border-radius: 5px; /* Bo tròn góc của các item */
            font-size: 16px;
            transition: background-color 0.3s ease; /* Hiệu ứng chuyển màu nền */
        }

        /* Khi di chuột qua */
        ul.main li a:hover {
            background-color: #2c8c76; /* Màu nền khi hover */
        }

        /* Khi có liên kết đã được chọn */
        ul.main li a:active {
            background-color: #2c8c76; /* Màu nền khi chọn */
        }
    </style>
</head>
<body>

    <ul class="main">
        <li><a href="index.php?action=quanlydanhmucsanpham&&query=them">Quản Lý Danh Mục Sản Phẩm</a></li>
        <li><a href="index.php?action=quanlysanpham&&query=them">Quản Lý Sản Phẩm</a></li>
        <li><a href="index.php?action=quanlydonhang&&query=lietke">Quản Lý Đơn Hàng</a></li>
    </ul>

</body>
</html>
