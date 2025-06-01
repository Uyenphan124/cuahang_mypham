<?php
session_start(); // Khởi động session

// Kết nối tới cơ sở dữ liệu
$mysqli = new mysqli("localhost", "root", "nhom6123", "cuahang_mypham", 3306);

// Kiểm tra kết nối
if ($mysqli->connect_error) {
    die("Kết nối thất bại: " . $mysqli->connect_error);
}

// Thêm sản phẩm vào giỏ hàng
if (isset($_POST['id_sanpham'])) {
    $id_sanpham = $mysqli->real_escape_string($_POST['id_sanpham']); // Tránh SQL Injection
    $soluong = 1; // Mặc định số lượng là 1

    // Truy vấn để lấy thông tin sản phẩm từ cơ sở dữ liệu
    $sql = "SELECT * FROM sanpham WHERE ID_SP = '$id_sanpham' LIMIT 1";
    $query = $mysqli->query($sql);

    if ($query && $query->num_rows > 0) {
        $row = $query->fetch_assoc();

        // Tạo sản phẩm mới
        $new_product = [
            'tensanpham' => $row['SanPham'] ?? 'Tên sản phẩm không xác định',
            'id' => $id_sanpham,
            'soluong' => $soluong,
            'giasp' => $row['Gia'] ?? 0,
            'hinhanh' => $row['HinhAnh'] ?? '',
            'masp' => $row['MaSP'] ?? ''
        ];

        // Kiểm tra nếu giỏ hàng đã tồn tại
        if (isset($_SESSION['cart'])) {
            $found = false;

            // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
            foreach ($_SESSION['cart'] as &$cart_item) {
                if ($cart_item['id'] == $id_sanpham) {
                    $cart_item['soluong']++; // Tăng số lượng nếu sản phẩm đã có
                    $found = true;
                    break;
                }
            }

            // Nếu chưa có sản phẩm, thêm sản phẩm mới vào giỏ hàng
            if (!$found) {
                $_SESSION['cart'][] = $new_product;
            }
        } else {
            // Nếu giỏ hàng chưa tồn tại, tạo mới giỏ hàng và thêm sản phẩm
            $_SESSION['cart'] = [$new_product];
        }
    } else {
        echo "Sản phẩm không tồn tại.";
        exit(); // Kết thúc để tránh điều hướng khi sản phẩm không tồn tại
    }

    header('Location: ../../index.php?page=cart'); // Điều hướng về trang giỏ hàng
    exit(); // Dừng xử lý sau khi điều hướng
}

// Đóng kết nối cơ sở dữ liệu
$mysqli->close();
?>
