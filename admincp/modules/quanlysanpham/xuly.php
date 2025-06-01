<?php
include('../../config/config.php'); // Kết nối cơ sở dữ liệu

// Xử lý thêm sản phẩm
if (isset($_POST['themsanpham'])) {
    $masp = $_POST['masanpham']; // Mã sản phẩm
    $id_dm = $_POST['danhmucsanpham'];  // ID Danh Mục
    $id_list = $_POST['list_danhmucsanpham'];  // ID Danh Mục Con
    $sanpham = $_POST['sanpham']; // Tên sản phẩm
    // Xử lý hình ảnh
    $hinhanh = $_FILES['hinhanh']['name']; 
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name']; 
    $hinhanh = time() . '_' . $hinhanh; // Đổi tên hình ảnh để tránh trùng lặp
    $thuonghieu = $_POST['thuonghieu']; // Thương hiệu
    $noisanxuat = $_POST['noisanxuat']; // Nơi sản xuất
    $giasp = $_POST['gia']; // Giá sản phẩm
    $soluong = $_POST['soluong']; // Số lượng
    $tomtat = $_POST['tomtat']; // Tóm tắt
    $noidung = $_POST['noidung']; // Nội dung chi tiết
    $tinhtrang = $_POST['tinhtrang']; // Tình trạng (Kích hoạt/Ẩn)

    // Câu lệnh thêm dữ liệu vào bảng SanPham
    $sql_them = "INSERT INTO sanpham (MaSP, ID_DM, ID_List, SanPham, HinhAnh, ThuongHieu, NoiSanXuat, Gia, SoLuong, TomTat, NoiDung, TinhTrang) 
    VALUES ('$masp', '$id_dm', '$id_list', '$sanpham', '$hinhanh', '$thuonghieu', '$noisanxuat', '$giasp', '$soluong', '$tomtat', '$noidung', '$tinhtrang')";
    
    if (mysqli_query($mysqli, $sql_them)) {
        // Di chuyển hình ảnh đã upload vào thư mục "uploads"
        move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh);
        header('Location: ../../index.php?action=quanlysanpham&query=them');
    } else {
        echo "Lỗi khi thêm sản phẩm: " . mysqli_error($mysqli);
    }
}

// Xử lý sửa sản phẩm
elseif (isset($_POST['suasanpham'])) {
    // Lấy dữ liệu từ form
    $id_sanpham = $_POST['id_sp'];  // Sử dụng đúng tên tham số
    $masp = $_POST['masanpham'];          // Mã sản phẩm
    $id_dm = $_POST['danhmucsanpham'];    // Danh mục
    $id_list = $_POST['list_danhmucsanpham']; // Danh mục con
    $sanpham = $_POST['sanpham'];         // Tên sản phẩm
    $giasp = $_POST['gia'];               // Giá sản phẩm
    $soluong = $_POST['soluong'];         // Số lượng
    $tomtat = $_POST['tomtat'];           // Tóm tắt
    $noidung = $_POST['noidung'];         // Nội dung chi tiết
    $tinhtrang = $_POST['tinhtrang'];     // Tình trạng (Kích hoạt/Ẩn)
    $thuonghieu = $_POST['thuonghieu'];   // Thương hiệu
    $noisanxuat = $_POST['noisanxuat'];   // Nơi sản xuất

    // Xử lý hình ảnh nếu có
    $hinhanh = $_FILES['hinhanh']['name'];
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];

    if (!empty($hinhanh)) {
        // Đổi tên file hình ảnh để tránh trùng lặp
        $hinhanh = time() . '_' . $hinhanh;

        // Lấy thông tin sản phẩm hiện tại để xóa hình ảnh cũ
        $sql_get_image = "SELECT * FROM SanPham WHERE ID_SP = '$id_sanpham' LIMIT 1";
        $query_get_image = mysqli_query($mysqli, $sql_get_image);
        while ($row = mysqli_fetch_array($query_get_image)) {
            if (!empty($row['HinhAnh'])) {
                unlink('uploads/' . $row['HinhAnh']); // Xóa hình ảnh cũ
            }
        }

        // Upload hình ảnh mới
        if (move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh)) {
            // Cập nhật sản phẩm với hình ảnh mới
            $sql_update = "UPDATE sanpham 
            SET SanPham='$sanpham', MaSP='$masp', Gia='$giasp', SoLuong='$soluong', HinhAnh='$hinhanh',
                ID_DM='$id_dm', ID_List='$id_list', ThuongHieu='$thuonghieu', NoiSanXuat='$noisanxuat',
                TomTat='$tomtat', NoiDung='$noidung', TinhTrang='$tinhtrang' 
            WHERE ID_SP='$id_sanpham'";
        } else {
            echo "Lỗi khi upload hình ảnh!";
            exit();
        }
    } else {
        // Cập nhật sản phẩm mà không thay đổi hình ảnh
        $sql_update = "UPDATE sanpham 
        SET SanPham='$sanpham', MaSP='$masp', Gia='$giasp', SoLuong='$soluong', 
            ID_DM='$id_dm', ID_List='$id_list', ThuongHieu='$thuonghieu', NoiSanXuat='$noisanxuat',
            TomTat='$tomtat', NoiDung='$noidung', TinhTrang='$tinhtrang' 
        WHERE ID_SP='$id_sanpham'";
    }

    // Thực hiện câu truy vấn
    if (mysqli_query($mysqli, $sql_update)) {
        header('Location: ../../index.php?action=quanlysanpham&query=them'); // Quay lại trang quản lý sản phẩm
    } else {
        echo "Lỗi khi sửa sản phẩm: " . mysqli_error($mysqli);
    }
}



// Xử lý xóa sản phẩm
elseif (isset($_GET['ID_SP'])) {
    $id = $_GET['ID_SP'];

    // Lấy thông tin hình ảnh để xóa file
    $sql = "SELECT * FROM sanpham WHERE ID_SP='$id' LIMIT 1";
    $query = mysqli_query($mysqli, $sql);
    while ($row = mysqli_fetch_array($query)) {
        unlink('uploads/' . $row['HinhAnh']); // Xóa file hình ảnh
    }

    $sql_xoa = "DELETE FROM sanpham WHERE ID_SP='$id'";
    mysqli_query($mysqli, $sql_xoa);
    header('Location: ../../index.php?action=quanlysanpham&query=them');
}
?>
