<?php
    if(isset($_POST['dangky']))
    {
        // Lấy dữ liệu từ form
        $tenkhachhang = $_POST['hovaten'];
        $email = $_POST['email'];
        $matkhau = md5($_POST['matkhau']); // Mã hóa mật khẩu bằng MD5
        $diachi = $_POST['diachi'];
        $sodienthoai = $_POST['dienthoai'];

        // Câu lệnh SQL chèn dữ liệu vào bảng DangKy
        $sql_dangky = mysqli_query($mysqli, "
            INSERT INTO dangky (TenKhachHang, Email, MatKhau, DiaChi, SoDienThoai)
            VALUES ('$tenkhachhang', '$email', '$matkhau', '$diachi', '$sodienthoai')
        ");

        // Kiểm tra kết quả
        if($sql_dangky)
        {
            echo '<p style="color:green">Bạn đã đăng ký thành công</p>';
            $_SESSION['dangky'] = $tenkhachhang;
            $_SESSION['id_khachhang'] = mysqli_insert_id($mysqli); // Lấy ID vừa chèn
            header('Location:index.php?page=cart'); // Chuyển hướng đến trang giỏ hàng
        }
        else
        {
            echo '<p style="color:red">Đăng ký không thành công. Vui lòng thử lại!</p>';
        }
    }
?>
<style type="text/css">
    .container {
        text-align: center;
    }
    table.dangky {
        margin: auto;
        border-collapse: collapse;
    }
    table.dangky tr td {
        padding: 5px;
    }
</style>

<div class="container">
    <b><p>Đăng Ký Tài Khoản</p></b>
    <form action="" method="POST">
        <table class="dangky">
            <tr>
                <td>Họ và Tên</td>
                <td><input type="text" size="50%" name="hovaten" required></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="email" size="50%" name="email" required></td>
            </tr>
            <tr>
                <td>Mật Khẩu</td>
                <td><input type="password" size="50%" name="matkhau" required></td>
            </tr>
            <tr>
                <td>Địa Chỉ</td>
                <td><input type="text" size="50%" name="diachi" required></td>
            </tr>
            <tr>
                <td>Điện Thoại</td>
                <td><input type="text" size="50%" name="dienthoai" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="dangky" value="Đăng Ký">
                    <a class="login_link" href="index.php?page=dangnhap">Đăng nhập nếu có tài khoản</a>
                </td>
            </tr>
        </table>
    </form>
</div>
