<p>Thêm Sản Phẩm</p>
<table border="1" width="100%" style="border-collapse: collapse;">
    <form method="POST" action="modules/quanlysanpham/xuly.php" enctype="multipart/form-data">
        <tr>
            <td>Mã Sản Phẩm</td>
            <td><input type="text" name="masanpham" required></td>
        </tr>
        <!-- Thêm phần Danh Mục -->
        <tr>
            <td>Danh Mục Sản Phẩm</td>
            <td>
                <select name="danhmucsanpham" required>
                    <?php
                        // Kết nối cơ sở dữ liệu
                        include('../../config/config.php');
                        $sql_danhmuc = "SELECT * FROM danhmuc ORDER BY ID_DM DESC";
                        $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
                        while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
                    ?>
                            <option value="<?php echo $row_danhmuc['ID_DM']; ?>"><?php echo $row_danhmuc['DanhMuc']; ?></option>
                    <?php
                        }
                    ?>
                </select>
            </td>
        </tr>
        <!-- Thêm phần Danh Mục Con -->
        <tr>
            <td>Danh Mục Con</td>
            <td>
                <select name="list_danhmucsanpham" required>
                    <?php
                        // Kết nối cơ sở dữ liệu
                        include('../../config/config.php');
                        $sql_listdanhmuc = "SELECT * FROM list_danhmuc ORDER BY ID_List DESC";
                        $query_listdanhmuc = mysqli_query($mysqli, $sql_listdanhmuc);
                        while ($row_listdanhmuc = mysqli_fetch_array($query_listdanhmuc)) {
                    ?>
                            <option value="<?php echo $row_listdanhmuc['ID_List']; ?>"><?php echo $row_listdanhmuc['List_DM']; ?></option>
                    <?php
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Sản Phẩm</td>
            <td><input type="text" name="sanpham" required></td>
        </tr>
        <tr>
            <td>Hình Ảnh</td>
            <td><input type="file" name="hinhanh" required></td>
        </tr>
        <tr>
            <td>Thương Hiệu</td>
            <td><input type="text" name="thuonghieu" required></td>
        </tr>
        <tr>
            <td>Nơi Sản Xuất</td>
            <td><input type="text" name="noisanxuat" required></td>
        </tr>
        <tr>
            <td>Giá</td>
            <td><input type="text" name="gia" required></td>
        </tr>
        <tr>
            <td>Số Lượng</td>
            <td><input type="text" name="soluong" required></td>
        </tr>
        
        <tr>
            <td>Tóm Tắt</td>
            <td><textarea rows="5" name="tomtat" style="resize: none" required></textarea></td>
        </tr>
        <tr>
            <td>Nội Dung</td>
            <td><textarea rows="5" name="noidung" style="resize: none" required></textarea></td>
        </tr>
        <!-- Phần Tình Trạng -->
        <tr>
            <td>Tình Trạng</td>
            <td>
                <select name="tinhtrang">
                    <option value="1">Kích Hoạt</option>
                    <option value="0">Ẩn</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="themsanpham" value="Thêm Sản Phẩm"></td>
        </tr>
    </form>
</table>
