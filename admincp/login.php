<?php 
    session_start();
    include('config/config.php');

    // Kiểm tra nếu có dữ liệu từ form đăng nhập
    if (isset($_POST['dangnhap'])) {
        $taikhoan = $_POST['TaiKhoan'];  // Lấy tên tài khoản từ form
        $matkhau = md5($_POST['MatKhau']); // Mã hóa mật khẩu bằng md5

        // Kiểm tra kết nối với cơ sở dữ liệu trước khi thực hiện truy vấn
        if (!$mysqli) {
            die("Kết nối cơ sở dữ liệu không thành công: " . mysqli_connect_error());
        }

        // Truy vấn kiểm tra tài khoản và mật khẩu
        $sql = "SELECT * FROM admin WHERE TaiKhoan = '$taikhoan' AND MatKhau = '$matkhau' LIMIT 1";
        $row = mysqli_query($mysqli, $sql);
        
        // Kiểm tra nếu có kết quả
        $count = mysqli_num_rows($row);
        
        if ($count > 0) {
            // Đăng nhập thành công, lưu tài khoản vào session và chuyển hướng đến trang chính
            $_SESSION['dangnhap'] = $taikhoan;
            header("Location:index.php");
        } else {
            // Thông báo nếu tài khoản hoặc mật khẩu không đúng
            echo '<script> alert("Tài khoản hoặc mật khẩu không đúng!");</script>';
            header("Location:login.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Admincp</title>
    <style type="text/css">
        body {
            background: #f2f2f2;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .wrapper-login {
            width: 30%;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table.table-login {
            width: 100%;
            border-spacing: 0;
        }

        table.table-login tr td {
            padding: 10px;
            font-size: 16px;
        }

        table.table-login input[type="text"],
        table.table-login input[type="password"] {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        table.table-login input[type="submit"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            color: #fff;
            background-color: #2c8c76;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        table.table-login input[type="submit"]:hover {
            background-color: #369686;
        }

        table.table-login td h3 {
            text-align: center;
            margin: 0;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="wrapper-login">
        <form action="" autocomplete="off" method="POST">
            <table id="table1" class="table-login">
                <tr>
                    <td colspan="2"><h3>Đăng nhập Admin</h3></td>
                </tr>
                <tr>
                    <td>Tài khoản</td>
                    <td><input type="text" name="TaiKhoan" required></td> 
                </tr>
                <tr>
                    <td>Mật khẩu</td>
                    <td><input type="password" name="MatKhau" required></td> 
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="dangnhap" value="Đăng nhập"></td>
                </tr>
            </table>
        </form>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</html>
