<ul class="cart-container">
<?php
if (isset($_SESSION['dangky'])) {
    echo 'Xin chào: ' . '<span style="color:red">' . $_SESSION['dangky'] . '</span>';
}
?>

<?php
// Kiểm tra nếu giỏ hàng tồn tại
if (isset($_SESSION['cart'])) {

    // Xử lý thêm sản phẩm vào giỏ hàng
    if (isset($_GET['add'])) {
        $id_sanpham = $_GET['add'];
        $is_exist = false; // Biến kiểm tra sản phẩm đã có trong giỏ hay chưa
        foreach ($_SESSION['cart'] as &$cart_item) {
            if ($cart_item['id'] == $id_sanpham) {
                // Nếu sản phẩm đã có trong giỏ thì cộng thêm số lượng
                $cart_item['soluong']++;
                $is_exist = true;
                break;
            }
        }

        // Nếu sản phẩm chưa có trong giỏ, thêm mới vào giỏ
        if (!$is_exist) {
            $product = getProductById($id_sanpham); // Hàm getProductById lấy thông tin sản phẩm
            $new_item = array(
                'id' => $id_sanpham,
                'masp' => $product['masp'],
                'tensanpham' => $product['tensanpham'],
                'hinhanh' => $product['hinhanh'],
                'giasp' => $product['giasp'],
                'soluong' => 1 // Mặc định số lượng là 1
            );
            $_SESSION['cart'][] = $new_item;
        }

        header('Location: index.php?page=cart'); // Cập nhật lại đường dẫn
    }

    // Kiểm tra và cộng số lượng cho sản phẩm trong giỏ hàng
if (isset($_GET['cong'])) {
    $id_sanpham = $_GET['cong'];
    // Duyệt qua tất cả sản phẩm trong giỏ hàng để tìm sản phẩm có id trùng với id_sanpham
    foreach ($_SESSION['cart'] as &$cart_item) {
        if ($cart_item['id'] == $id_sanpham) {
            // Nếu tìm thấy sản phẩm có ID tương ứng, tăng số lượng lên
            $cart_item['soluong']++;
            break;
        }
    }
    // Sau khi thay đổi giỏ hàng, chuyển hướng lại về trang giỏ hàng
    header('Location: index.php?page=cart');
    exit();
}

    // Xử lý trừ số lượng sản phẩm
    if (isset($_GET['tru'])) {
        $id_sanpham = $_GET['tru'];
        foreach ($_SESSION['cart'] as &$cart_item) {
            if ($cart_item['id'] == $id_sanpham && $cart_item['soluong'] > 1) {
                $cart_item['soluong']--;
                break;
            }
        }
        header('Location: index.php?page=cart'); // Cập nhật lại đường dẫn
    }

    // Xử lý xóa sản phẩm
    if (isset($_GET['xoa'])) {
        $id_sanpham = $_GET['xoa'];
        foreach ($_SESSION['cart'] as $key => $cart_item) {
            if ($cart_item['id'] == $id_sanpham) {
                unset($_SESSION['cart'][$key]);
                break;
            }
        }
        header('Location: index.php?page=cart'); // Cập nhật lại đường dẫn
    }

    // Xử lý xóa tất cả sản phẩm trong giỏ hàng
    if (isset($_GET['xoatatca'])) {
        unset($_SESSION['cart']);
        header('Location: index.php?page=cart'); // Cập nhật lại đường dẫn
    }
?>

<!-- CSS cho bảng giỏ hàng -->
<style>
    table {
        width: 100%;
        text-align: center;
        border-collapse: collapse;
    }
    th, td {
        padding: 10px;
        border: 1px solid #fff;
    }
    th {
        background-color: #fff;
    }

    td img {
        max-width: 100px;
    }
    .cart-actions a {
        padding: 5px 10px;
        background-color: #4CAF50;
        color: white;
        text-decoration: none;
        margin: 0 5px;
        border-radius: 5px;
    }
    .cart-actions a:hover {
        background-color: #45a049;
    }
    .cart-actions .delete {
        background-color: #2c7a6d;
        color: #fff;

    }
    .cart-actions .delete:hover {
        background-color: #2c7a6d;
        color: #fff;

    }
    .total-price {
        font-weight: bold;
        font-size: 18px;
        color: #fff; /* Màu chữ trắng */
    }

    /* CSS cho các nút ngoài giỏ hàng */
    .btn {
        padding: 10px 20px;
        background-color: #2c7a6d;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
        display: inline-block;
        margin: 10px 5px;
        transition: background-color 0.3s;
        
    }
    .btn:hover {
        background-color: #2c7a6d;
    }
    .btn-danger {
        background-color: #2c7a6d;
    }
    .btn-danger:hover {
        background-color: #2c7a6d;
    }
</style>

<table>
    <tr>
        <th>ID</th>
        <th>Mã Sản Phẩm</th>
        <th>Tên Sản Phẩm</th>
        <th>Hình Ảnh</th>
        <th>Số Lượng</th>
        <th>Giá Sản Phẩm</th>
        <th>Thành Tiền</th>
        <th>Quản Lý</th>
    </tr>

    <?php
    $i = 0; 
    $tongtien = 0; // Tổng tiền giỏ hàng
    foreach ($_SESSION['cart'] as $cart_item) {
        $i++;
        $thanhtien = isset($cart_item['giasp']) ? $cart_item['soluong'] * $cart_item['giasp'] : 0; // Tính thành tiền
        $tongtien += $thanhtien; // Cộng vào tổng tiền
    ?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo isset($cart_item['masp']) ? htmlspecialchars($cart_item['masp']) : ''; ?></td>
        <td><?php echo isset($cart_item['tensanpham']) ? htmlspecialchars($cart_item['tensanpham']) : ''; ?></td>
        <td>
            <img src="admincp/modules/quanlysanpham/uploads/<?php echo isset($cart_item['hinhanh']) ? $cart_item['hinhanh'] : ''; ?>" alt="Hình sản phẩm">
        </td>
        <td>
            <a href="index.php?page=cart&cong=<?php echo $cart_item['id']; ?>">+</a>
            <?php echo $cart_item['soluong']; ?>
            <a href="index.php?page=cart&tru=<?php echo $cart_item['id']; ?>">-</a>
        </td>
        <td><?php echo number_format(isset($cart_item['giasp']) ? $cart_item['giasp'] : 0, 0, ',', '.') . ' VNĐ'; ?></td>
        <td><?php echo number_format($thanhtien, 0, ',', '.') . ' VNĐ'; ?></td>
        <td class="cart-actions">
            <a href="index.php?page=cart&xoa=<?php echo $cart_item['id']; ?>" class="delete">Xóa</a>
        </td>
    </tr>
    <?php
    } // Kết thúc vòng lặp
    
    ?>
    
    <tr>
    <td colspan="8">
        <p style="float:left;" class="total-price">Tổng tiền: <strong><?php echo number_format($tongtien, 0, ',', '.') . ' VNĐ'; ?></strong></p>
        <p style="float:right;">
            <a href="index.php?page=cart&xoatatca=1" class="btn btn-danger">Xóa Tất Cả</a>
        </p>
        <div style="clear:both;"></div>

        <!-- Nút quay lại -->
        <p><a href="index.php?page=category&id=1" class="btn">Quay Lại Trang Sản Phẩm</a></p>

        <?php
// Kiểm tra nếu người dùng đã đăng ký
if (isset($_SESSION['dangky'])) {
?>
    <p><a href="index.php?page=thanhtoan" class="btn">Đăng Ký Đặt Hàng</a></p>
<?php
} else {
?>
    <p><a href="pages/maincontent-default/thanhtoan.php" class="btn">Đặt Hàng</a></p>
<?php
}
?>

    </td>
</tr>

</table>

<?php
} else {
    // Trường hợp giỏ hàng trống
    echo '<p>Hiện tại giỏ hàng trống.</p>';
}
?>
