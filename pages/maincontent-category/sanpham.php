<?php
// Kết nối tới cơ sở dữ liệu
$mysqli = new mysqli("localhost", "root", "nhom6123", "cuahang_mypham", "3306");

// Kiểm tra kết nối
if ($mysqli->connect_error) {
    die("Kết nối thất bại: " . $mysqli->connect_error);
}

// Kiểm tra nếu tham số id_sanpham tồn tại trong URL
if (isset($_GET['id_sanpham'])) {
    $id_sanpham = $_GET['id_sanpham']; // Lấy ID sản phẩm từ URL
    $id_sanpham = mysqli_real_escape_string($mysqli, $id_sanpham); // Bảo mật tham số ID sản phẩm

    // Truy vấn SQL để lấy chi tiết sản phẩm theo ID_SP
    $sql_chi_tiet_sanpham = "
        SELECT SP.*, DM.DanhMuc, LDM.List_DM 
        FROM sanpham SP 
        LEFT JOIN danhmuc DM ON SP.ID_DM = DM.ID_DM 
        LEFT JOIN list_danhmuc LDM ON SP.ID_List = LDM.ID_List 
        WHERE SP.ID_SP = '$id_sanpham'";

    $query_chi_tiet_sanpham = mysqli_query($mysqli, $sql_chi_tiet_sanpham);
    $sanpham = mysqli_fetch_array($query_chi_tiet_sanpham);

    if ($sanpham) {
        // Hiển thị chi tiết sản phẩm
        echo '<div class="sanpham-container">';
        
        // Tiêu đề sản phẩm
        echo "<h3>Chi Tiết Sản Phẩm: " . htmlspecialchars($sanpham['SanPham']) . "</h3>";
        
        // Bắt đầu phần chứa ảnh và thông tin sản phẩm
        echo '<div class="sanpham-content">';
        
        // Hiển thị hình ảnh sản phẩm
        $imagePath = "admincp/modules/quanlysanpham/uploads/" . $sanpham['HinhAnh'];
        echo "<div class='sanpham-image'><img src='$imagePath' alt='" . htmlspecialchars($sanpham['SanPham']) . "' width='200'></div>";
        
        // Hiển thị thông tin sản phẩm
        echo "<div class='sanpham-info'>";
        echo "<p><strong>Thương Hiệu:</strong> " . htmlspecialchars($sanpham['ThuongHieu']) . "</p>";
        echo "<p><strong>Nơi Sản Xuất:</strong> " . htmlspecialchars($sanpham['NoiSanXuat']) . "</p>";
        echo "<p><strong>Giá:</strong> " . number_format($sanpham['Gia'], 0, ',', '.') . " VNĐ</p>";
        echo "<p><strong>Số Lượng:</strong> " . $sanpham['SoLuong'] . "</p>";
        echo "<p><strong>Tóm Tắt:</strong> " . htmlspecialchars($sanpham['TomTat']) . "</p>";
        echo "<p><strong>Nội Dung:</strong> " . nl2br(htmlspecialchars($sanpham['NoiDung'])) . "</p>";
        echo '</div>'; // Kết thúc phần thông tin sản phẩm
        
        echo '</div>'; // Kết thúc phần chứa ảnh và thông tin sản phẩm

        // Form Thêm Giỏ Hàng
        echo '<div class="add-to-cart">'; 
        
        echo '<form action="pages/maincontent-category/themgiohang.php" method="POST">
                <input type="hidden" name="id_sanpham" value="' . $sanpham['ID_SP'] . '">
                <button class="btn-add-to-cart">Thêm Giỏ Hàng</button>
              </form>';
        
        echo '</div>';

        echo '</div>'; // Kết thúc khung chi tiết sản phẩm
        
    } else {
        echo "<p>Không tìm thấy sản phẩm này.</p>";
    }
} else {
    echo "<p>Vui lòng chọn sản phẩm để xem chi tiết.</p>";
}

$mysqli->close();
?>
<?php
if (isset($_GET['subcat'])) {
    // Ẩn sidebar
    echo "<style>.sidebar { display: none; }</style>";
}
?>
