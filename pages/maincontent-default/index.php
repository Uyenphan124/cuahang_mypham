<div class="maincontent-default">
    <h4> Sản Phẩm Mới Nhất </h4>
    <ul class="product_list2">
        <?php
        // Kết nối tới cơ sở dữ liệu
        $mysqli = new mysqli("localhost", "root", "nhom6123", "cuahang_mypham", "3306");

        // Kiểm tra kết nối
        if ($mysqli->connect_error) {
            die("Kết nối thất bại: " . $mysqli->connect_error);
        }

        // Truy vấn để lấy 16 sản phẩm mới nhất dựa vào NgayThem
        $sql = "SELECT * FROM sanpham ORDER BY NgayThem DESC LIMIT 16";
        $query = $mysqli->query($sql);

        // Kiểm tra xem có sản phẩm nào không
        if ($query->num_rows > 0) {
            // Duyệt qua tất cả các sản phẩm và hiển thị chúng
            while ($row = $query->fetch_assoc()) {
                echo '<li class="product_item">';
                
                // Bao bọc cả hình ảnh và tên sản phẩm vào thẻ <a>
                echo '<a href="index.php?page=category&subcat=3&id_sanpham=' . $row['ID_SP'] . '">';
                echo '<img src="admincp/modules/quanlysanpham/uploads/' . $row['HinhAnh'] . '" alt="' . htmlspecialchars($row['SanPham']) . '" />';
                echo '<h5>' . htmlspecialchars($row['SanPham']) . '</h5>';
                echo '</a>';
                
                // Hiển thị giá sản phẩm
                echo '<p>' . number_format($row['Gia'], 0, ',', '.') . ' VNĐ</p>';
                echo '</li>';
            }
        } else {
            echo '<li>Không có sản phẩm mới.</li>';
        }

        // Đóng kết nối
        $mysqli->close();
        ?>
    </ul>
</div>
