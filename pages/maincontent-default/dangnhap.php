<?php 
    if(isset($_POST['dangnhap'])) {
        $email = $_POST['email'];
        $matkhau = md5($_POST['password']); // Mã hóa mật khẩu bằng MD5

        // Sử dụng bảng `DangKy` và kiểm tra dựa trên cột `Email` và `MatKhau`
        $sql = "SELECT * FROM dangky WHERE Email = '$email' AND MatKhau = '$matkhau' LIMIT 1";
        $row = mysqli_query($mysqli, $sql);
        $count = mysqli_num_rows($row);

        if($count > 0) {
            // Lấy thông tin người dùng và lưu vào session
            $row_data = mysqli_fetch_array($row);
            $_SESSION['dangky'] = $row_data['TenKhachHang'];
            $_SESSION['id_khachhang'] = $row_data['ID_DangKy']; // ID của khách hàng
            
            header("Location:index.php?page=cart"); // Chuyển hướng đến giỏ hàng
        } else {
            echo '<p style="color:red">Mật khẩu hoặc email không chính xác</p>';
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form_container">
        <form action="" autocomplete="off" method="POST">
            <table id="table1" class="table_login">
                <tr>
                    <td colspan="2"><h3>Đăng Nhập Tài Khoản</h3></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="text" size="65" name="email" placeholder="Email..." required></td>
                </tr>
                <tr>
                    <td>Mật Khẩu</td>
                    <td><input type="password" size="65" name="password" placeholder="Mật khẩu..." required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="dangnhap" value="Đăng nhập">
                        <a href="index.php?page=dangky" class="register_link">Đăng ký tài khoản mới</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
