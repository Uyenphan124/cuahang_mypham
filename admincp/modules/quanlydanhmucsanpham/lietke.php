<?php
    $sql_lietke_danhmuc = "SELECT * FROM danhmuc ORDER BY ID_DM ASC";
    $query_lietke_danhmuc = mysqli_query($mysqli, $sql_lietke_danhmuc);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liệt Kê Danh Mục Sản Phẩm</title>
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
        p {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            text-align: center;
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
    <p>Liệt Kê Danh Mục Sản Phẩm</p>
    <table>
        <tr>
            <th>ID</th>
            <th>Danh Mục</th>
            <th>List Danh Mục</th>
            <th>Quản Lý</th>
        </tr>
        <?php
            while ($row = mysqli_fetch_array($query_lietke_danhmuc)) {
                $id_dm = $row['ID_DM'];
                $sql_lietke_listdanhmuc = "SELECT * FROM list_danhmuc WHERE ID_DM = '$id_dm'";
                $query_lietke_listdanhmuc = mysqli_query($mysqli, $sql_lietke_listdanhmuc);
                $row_count = mysqli_num_rows($query_lietke_listdanhmuc);
        ?>
        <tr>
            <td rowspan="<?php echo $row_count + 1; ?>"><?php echo $row['ID_DM']; ?></td>
            <td rowspan="<?php echo $row_count + 1; ?>"><?php echo $row['DanhMuc']; ?></td>
        </tr>
        <?php
            while ($row_list = mysqli_fetch_array($query_lietke_listdanhmuc)) {
        ?>
        <tr>
            <td><?php echo $row_list['List_DM']; ?></td>
            <td>
                <a href="modules/quanlydanhmucsanpham/xuly.php?query=xoa_list&ID_List=<?php echo $row_list['ID_List']; ?>">Xóa</a> |
                <a href="?action=quanlydanhmucsanpham&query=sua_list&ID_List=<?php echo $row_list['ID_List']; ?>">Sửa</a>
            </td>
        </tr>
        <?php
            }
        }
        ?>
    </table>
</body>
</html>
