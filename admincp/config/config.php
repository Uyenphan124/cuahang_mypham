<?php
    $mysqli = new mysqli ("localhost", "root", "nhom6123", "cuahang_mypham", "3306");
    //Check connection
    if ($mysqli->connect_error)
    {
        echo "Lỗi Kết Nối MySQL" . $mysqli->connect_error;
        exit ();
    }
?>
