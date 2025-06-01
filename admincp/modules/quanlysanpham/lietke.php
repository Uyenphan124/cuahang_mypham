<?php
// Lấy tất cả sản phẩm từ bảng SanPham
$sql_lietke_sanpham = "
    SELECT SP.*, DM.DanhMuc, LDM.List_DM 
    FROM sanpham SP 
    LEFT JOIN danhmuc DM ON SP.ID_DM = DM.ID_DM 
    LEFT JOIN list_danhmuc LDM ON SP.ID_List = LDM.ID_List 
    ORDER BY SP.ID_SP ASC";
$query_lietke_sanpham = mysqli_query($mysqli, $sql_lietke_sanpham);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liệt Kê Sản Phẩm</title>
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

       

        /* Định dạng cho ảnh sản phẩm */
        td img {
            max-width: 100px;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        /* Định dạng liên kết */
        a {
            color: #2c7a6d;
            text-decoration: none;
            margin-right: 10px;
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
    <p>Liệt Kê Sản Phẩm</p>
    <table>
        <tr>
            <th>ID</th>
            <th>Mã Sản Phẩm</th>
            <th>Danh Mục</th>
            <th>Danh Mục Con</th>
            <th>Sản Phẩm</th>
            <th>Hình Ảnh</th>
            <th>Thương Hiệu</th>
            <th>Nơi Sản Xuất</th>
            <th>Giá</th>
            <th>Số Lượng</th>
            <th>Tóm Tắt</th>
            <th>Nội Dung</th>
            <th>Tình Trạng</th>
            <th>Quản Lý</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_array($query_lietke_sanpham)) {
        ?>
        <tr>
            <td><?php echo $row['ID_SP']; ?></td>
            <td><?php echo $row['MaSP']; ?></td>
            <td><?php echo $row['DanhMuc']; ?></td>
            <td><?php echo $row['List_DM']; ?></td>
            <td><?php echo $row['SanPham']; ?></td>
            <td>
                <?php
                $imagePath = "modules/quanlysanpham/uploads/" . $row['HinhAnh'];
                echo "<img src='$imagePath' alt='Product Image'>";
                ?>
            </td>
            <td><?php echo $row['ThuongHieu']; ?></td>
            <td><?php echo $row['NoiSanXuat']; ?></td>
            <td><?php echo number_format($row['Gia'], 0, ',', '.'); ?> VNĐ</td>
            <td><?php echo $row['SoLuong']; ?></td>
            <td><?php echo $row['TomTat']; ?></td>
            <td><?php echo $row['NoiDung']; ?></td>
            <td><?php echo $row['TinhTrang'] == 1 ? 'Kích Hoạt' : 'Ẩn'; ?></td>
            <td>
                <a href="modules/quanlysanpham/sua.php?id_sp=<?php echo $row['ID_SP']; ?>">Sửa</a>
                <a href="modules/quanlysanpham/xuly.php?query=xoa&ID_SP=<?php echo $row['ID_SP']; ?>"> Xóa </a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>
