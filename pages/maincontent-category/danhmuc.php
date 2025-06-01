<?php
$mysqli = mysqli_connect("localhost", "root", "nhom6123", "cuahang_mypham", 3306);
if (!$mysqli) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Kiểm tra nếu tham số subcat tồn tại
if (isset($_GET['subcat'])) {
    $id_list = mysqli_real_escape_string($mysqli, $_GET['subcat']);

    // Truy vấn sản phẩm theo ID_List
    $sql = "SELECT * FROM sanpham WHERE ID_List = '$id_list'";
    $result = mysqli_query($mysqli, $sql);


    if (mysqli_num_rows($result) > 0) {
        echo "<div class='maincontent-category'>"; // Thêm class cho khung chính
        echo "<ul class='product_list'>"; // Bắt đầu danh sách sản phẩm

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li>
                    <a href='index.php?page=category&subcat=" . $id_list . "&id_sanpham=" . $row['ID_SP'] . "'>
                        <img src='admincp/modules/quanlysanpham/uploads/" . $row['HinhAnh'] . "' alt='" . htmlspecialchars($row['SanPham']) . "'>
                        <p class='title_product'>" . htmlspecialchars($row['SanPham']) . "</p>
                        <p class='price_product'>" . number_format($row['Gia'], 0, ',', '.') . " VNĐ</p>
                    </a>
                </li>";
        }

        echo "</ul>"; // Kết thúc danh sách sản phẩm
        echo "</div>"; // Kết thúc khung chính
    } 
} 
?>
