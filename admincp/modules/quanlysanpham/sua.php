<?php
include('../../config/config.php'); // Kết nối cơ sở dữ liệu

// Kiểm tra nếu id_sp tồn tại trong URL
if (isset($_GET['id_sp'])) { 
    $id_sp = $_GET['id_sp']; 
    $sql_sua_sanpham = "SELECT * FROM sanpham WHERE ID_SP = '$id_sp' LIMIT 1";
    $query_sua_sanpham = mysqli_query($mysqli, $sql_sua_sanpham);
    if (mysqli_num_rows($query_sua_sanpham) > 0) {
        $row = mysqli_fetch_array($query_sua_sanpham);
    } else {
        echo "Không tìm thấy sản phẩm với ID này.";
        exit;
    }
} else {
    echo "ID sản phẩm không được xác định.";
    exit;
}

?>

<p>Sửa Sản Phẩm</p>
<table border="1" width="100%" style="border-collapse: collapse;">
    <form method="POST" action="xuly.php?" enctype="multipart/form-data">
        <tr>
            <td>Mã Sản Phẩm</td>
            <td><input type="text" name="masanpham" value="<?php echo $row['MaSP']; ?>" required></td>
        </tr>
        <tr>
    <td>Danh Mục Sản Phẩm</td>
    <td>
        <select name="danhmucsanpham">
            <?php
            $sql_danhmuc = "SELECT * FROM danhmuc ORDER BY ID_DM DESC";
            $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
            while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
            ?>
                <option value="<?php echo $row_danhmuc['ID_DM']; ?>" <?php echo $row_danhmuc['ID_DM'] == $row['ID_DM'] ? 'selected' : ''; ?>>
                    <?php echo $row_danhmuc['DanhMuc']; ?>
                </option>
            <?php
            }
            ?>
        </select>
    </td>
</tr>
<tr>
    <td>Danh Mục Con</td>
    <td>
        <select name="list_danhmucsanpham">
            <?php
            $sql_listdanhmuc = "SELECT * FROM list_danhmuc ORDER BY ID_List DESC";
            $query_listdanhmuc = mysqli_query($mysqli, $sql_listdanhmuc);
            while ($row_listdanhmuc = mysqli_fetch_array($query_listdanhmuc)) {
            ?>
                <option value="<?php echo $row_listdanhmuc['ID_List']; ?>" <?php echo $row_listdanhmuc['ID_List'] == $row['ID_List'] ? 'selected' : ''; ?>>
                    <?php echo $row_listdanhmuc['List_DM']; ?>
                </option>
            <?php
            }
            ?>
        </select>
    </td>
</tr>
        <tr>
            <td>Sản Phẩm</td>
            <td><input type="text" name="sanpham" value="<?php echo $row['SanPham']; ?>" required></td>
        </tr>
        <tr>
            <td>Hình Ảnh</td>
            <td>
                <input type="file" name="hinhanh">
                <img src="uploads/<?php echo $row['HinhAnh']; ?>" width="100px">
            </td>
        </tr>
        <tr>
            <td>Thương Hiệu</td>
            <td><input type="text" name="thuonghieu" value="<?php echo $row['ThuongHieu']; ?>" required></td>
        </tr>
        <tr>
            <td>Nơi Sản Xuất</td>
            <td><input type="text" name="noisanxuat" value="<?php echo $row['NoiSanXuat']; ?>" required></td>
        </tr>
        <tr>
            <td>Giá</td>
            <td><input type="text" name="gia" value="<?php echo $row['Gia']; ?>" required></td>
        </tr>
        <tr>
            <td>Số Lượng</td>
            <td><input type="text" name="soluong" value="<?php echo $row['SoLuong']; ?>" required></td>
        </tr>
        
        <tr>
    <td>Tóm Tắt</td>
    <td><textarea name="tomtat" rows="5" style="resize: none;"><?php echo $row['TomTat']; ?></textarea></td>
</tr>
<tr>
    <td>Nội Dung</td>
    <td><textarea name="noidung" rows="10" style="resize: none;"><?php echo $row['NoiDung']; ?></textarea></td>
</tr>

        


        <tr>
            <td>Tình Trạng</td>
            <td>
                <select name="tinhtrang">
                    <option value="1" <?php echo $row['TinhTrang'] == 1 ? 'selected' : ''; ?>>Kích Hoạt</option>
                    <option value="0" <?php echo $row['TinhTrang'] == 0 ? 'selected' : ''; ?>>Ẩn</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="hidden" name="id_sp" value="<?php echo $row['ID_SP']; ?>">
                <input type="submit" name="suasanpham" value="Sửa Sản Phẩm">
            </td>
        </tr>
    </form>
</table>
