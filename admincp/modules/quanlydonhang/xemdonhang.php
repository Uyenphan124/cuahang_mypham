<?php
    // Kiểm tra giá trị 'code' từ URL
    if (isset($_GET['code']) && !empty($_GET['code'])) {
        $code = $_GET['code']; // Lấy mã đơn hàng từ URL và gán vào biến $code

        // Câu truy vấn SQL (đã sửa lỗi WHERE và sử dụng dấu nháy kép cho biến PHP)
        $sql_lietke_donhang = "
            SELECT chitiet_giohang.*, sanpham.SanPham, sanpham.Gia 
            FROM chitiet_giohang  
            INNER JOIN sanpham ON chitiet_giohang.ID_SP = sanpham.ID_SP 
            WHERE chitiet_giohang.Code_GioHang = '$code' 
            ORDER BY chitiet_giohang.ID_chitietgiohang ASC
        ";

        // Thực thi truy vấn
        $query_lietke_donhang = mysqli_query($mysqli, $sql_lietke_donhang);

        // Kiểm tra lỗi truy vấn
        if (!$query_lietke_donhang) {
            die("Lỗi truy vấn SQL: " . mysqli_error($mysqli));
        }
    } else {
        die("Mã đơn hàng không hợp lệ hoặc không tồn tại!");
    }
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Đơn Hàng</title>
    <style>
        /* Định dạng chung cho trang */
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        /* Định dạng bảng */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #2c7a6d;
            color: white;
        }

        td {
            background-color: white;
        }

    

        /* Định dạng cho phần thông báo */
        p {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            text-align: center;
        }

        /* Định dạng cho giá tiền */
        td:last-child {
            text-align: right;
        }

        /* Định dạng cho liên kết trong bảng */
        a {
            color: #2c7a6d;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <p>Chi Tiết Đơn Hàng</p>
    <table>
        <tr>
            <th>ID</th>
            <th>Mã Đơn Hàng</th>
            <th>Tên Sản Phẩm</th>
            <th>Số Lượng</th>
            <th>Đơn Giá</th>
            <th>Thành Tiền</th>
        </tr>
        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($query_lietke_donhang)) {
            $i++;
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo htmlspecialchars($row['Code_GioHang']); ?></td>
            <td><?php echo htmlspecialchars($row['SanPham']); ?></td>
            <td><?php echo htmlspecialchars($row['SoLuongMua']); ?></td>
            <td><?php echo htmlspecialchars(number_format($row['Gia'], 0, ',', '.')); ?> đ</td>
            <td><?php echo htmlspecialchars(number_format($row['Gia'] * $row['SoLuongMua'], 0, ',', '.')); ?> đ</td>
        </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>
