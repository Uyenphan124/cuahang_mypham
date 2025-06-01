<?php
    $sql_lietke_donhang = "SELECT * FROM giohang, dangky WHERE giohang.ID_KhachHang = dangky.ID_DangKy ORDER BY ID_GioHang ASC";
    $query_lietke_donhang = mysqli_query($mysqli, $sql_lietke_donhang);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liệt Kê Đơn Hàng</title>
    <style>
        /* Định dạng chung cho trang */
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 20px;
        }
        p {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            text-align: center;
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

      

        /* Định dạng liên kết */
        a {
            color: #2c7a6d;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Định dạng cho phần thông báo */
        p {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <p>Liệt Kê Đơn Hàng</p>
    <table>
        <tr>
            <th>ID</th>
            <th>Mã Đơn Hàng</th>
            <th>Tên Khách Hàng</th>
            <th>Địa Chỉ</th>
            <th>Email</th>
            <th>Điện Thoại</th>
            <th>Quản Lý</th>
        </tr>
        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($query_lietke_donhang)) {
            $i++;
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['Code_GioHang']; ?></td>
            <td><?php echo $row['TenKhachHang']; ?></td>
            <td><?php echo $row['DiaChi']; ?></td>
            <td><?php echo $row['Email']; ?></td>
            <td><?php echo $row['SoDienThoai']; ?></td>
            <td>
                <a href="index.php?action=donhang&query=xemdonhang&code=<?php echo $row['Code_GioHang']; ?>">Xem Đơn Hàng</a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>
