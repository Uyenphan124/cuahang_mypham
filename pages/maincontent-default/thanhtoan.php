<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include($_SERVER['DOCUMENT_ROOT'] . '/cuahang_mypham/admincp/config/config.php');

// Lấy ID khách hàng từ session
$id_khachhang = $_SESSION['id_khachhang'];

// Tạo mã giỏ hàng ngẫu nhiên
$code_order = rand(0, 9999);

// Chèn dữ liệu vào bảng GioHang
$insert_cart = "INSERT INTO giohang(ID_KhachHang, Code_GioHang, TinhTrang_GioHang) 
                VALUE('$id_khachhang', '$code_order', 1)";
$cart_query = mysqli_query($mysqli, $insert_cart);

// Nếu giỏ hàng được tạo thành công
if ($cart_query) {
    // Lặp qua tất cả các sản phẩm trong giỏ hàng
    foreach ($_SESSION['cart'] as $key => $value) {
        $id_sanpham = $value['id']; // ID sản phẩm
        $soluong = $value['soluong']; // Số lượng sản phẩm

        // Chèn chi tiết giỏ hàng vào bảng ChiTiet_GioHang
        $insert_order_details = "INSERT INTO chitiet_giohang(Code_GioHang, ID_SP, SoLuongMua) 
                                 VALUE('$code_order', '$id_sanpham', '$soluong')";
        mysqli_query($mysqli, $insert_order_details);

        // Cập nhật số lượng sản phẩm trong bảng SanPham
        $update_sanpham = "UPDATE sanpham 
                           SET SoLuong = SoLuong - $soluong 
                           WHERE ID_SP = '$id_sanpham'";
        mysqli_query($mysqli, $update_sanpham);
    }

    // Xóa giỏ hàng trong session sau khi đặt hàng
    unset($_SESSION['cart']);

    // Chuyển hướng người dùng đến trang cảm ơn
    header('Location: index.php?page=camon'); // Điều hướng về camon.php
    exit();
} else {
    // Xử lý lỗi nếu giỏ hàng không được tạo thành công
    echo "Có lỗi xảy ra khi xử lý đơn hàng.";
}
?>
