<?php
    session_start();
    if (isset($_GET['dangxuat']) && $_GET['dangxuat'] == 1) {
        unset($_SESSION['dangnhap']);
        header('Location: login.php');
        exit(); // Dừng script sau khi đăng xuất
    }
?>
<p><a href="index.php?dangxuat=1"> Đăng Xuất :
    <?php 
        if (isset($_SESSION['dangnhap'])) {
            echo $_SESSION['dangnhap']; // Hiển thị tên tài khoản nếu đã đăng nhập
        }
    ?>
</a></p>
