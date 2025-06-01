<?php
// Kết nối tới cơ sở dữ liệu
$mysqli = new mysqli("localhost", "root", "nhom6123", "cuahang_mypham", "3306");

// Kiểm tra kết nối
if ($mysqli->connect_error) {
    die("Kết nối thất bại: " . $mysqli->connect_error);
}

// Khởi tạo biến tìm kiếm
$tukhoa = "";
if (isset($_POST['tukhoa'])) {
    $tukhoa = $mysqli->real_escape_string($_POST['tukhoa']);
}

// Truy vấn tìm kiếm sản phẩm
$sql_pro = "SELECT * FROM sanpham WHERE SanPham LIKE '%" . $tukhoa . "%'";
$query_pro = $mysqli->query($sql_pro);
?>
<div class="maincontent-default">
    <h3>Từ Khoá Tìm Kiếm: "<?php echo htmlspecialchars($tukhoa); ?>"</h3>
    <ul class="product_list2">
        <?php
        if ($query_pro->num_rows > 0) {
            while ($row = $query_pro->fetch_assoc()) {
                echo '<li class="product_item">';
                echo '<a href="index.php?page=category&subcat=3&id_sanpham=' . $row['ID_SP'] . '">';
                echo '<img src="admincp/modules/quanlysanpham/uploads/' . $row['HinhAnh'] . '" alt="' . htmlspecialchars($row['SanPham']) . '" />';
                echo '<h5>' . htmlspecialchars($row['SanPham']) . '</h5>';
                echo '</a>';
                echo '<p>' . number_format($row['Gia'], 0, ',', '.') . ' VNĐ</p>';
                echo '</li>';
            }
        } else {
            echo '<li>Không tìm thấy sản phẩm nào phù hợp.</li>';
        }
        $mysqli->close();
        ?>
    </ul>
</div>
