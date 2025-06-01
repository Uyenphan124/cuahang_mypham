<?php
include('../../config/config.php');
// Xử lý thêm danh mục và mục con (List_DanhMuc)
if (isset($_POST['danhmuc']) && isset($_POST['list_danhmuc'])) 
{
    $danhmuc = $_POST['danhmuc'];
    $list_danhmuc = $_POST['list_danhmuc'];
    if (isset($_POST['themdanhmuc'])) 
    {
        // Thêm mục con vào danh mục
        $sql_danhmuc = "SELECT ID_DM FROM danhmuc WHERE danhmuc = '$danhmuc'";
        $result_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
        if (mysqli_num_rows($result_danhmuc) > 0) 
        {
            $row = mysqli_fetch_assoc($result_danhmuc);
            $id_dm = $row['ID_DM'];
            $sql_them_list_danhmuc = "INSERT INTO list_danhmuc (ID_DM, List_DM) VALUES ('$id_dm', '$list_danhmuc')";
            if (mysqli_query($mysqli, $sql_them_list_danhmuc)) 
            {
                header('Location: ../../index.php?action=quanlydanhmucsanpham&&query=them');
            } 
            else 
            {
                echo "Lỗi khi thêm vào List_DanhMuc: " . mysqli_error($mysqli);
            }
        } 
        else 
        {
            echo "Danh mục không tồn tại trong bảng DanhMuc!";
        }
    }
}
// Xử lý xóa mục con (List_DanhMuc)
if (isset($_GET['query']) && $_GET['query'] == 'xoa_list') 
{
    $id_list = $_GET['ID_List'];
    // Xóa mục con khỏi bảng List_DanhMuc
    $sql_xoa_list_danhmuc = "DELETE FROM List_DanhMuc WHERE ID_List = '$id_list'";
    if (mysqli_query($mysqli, $sql_xoa_list_danhmuc)) 
    {
        header('Location: ../../index.php?action=quanlydanhmucsanpham&&query=them');
    } 
    else 
    {
        echo "Lỗi khi xóa mục con: " . mysqli_error($mysqli);
    }
}
// Xử lý sửa mục con (List_DanhMuc)
if (isset($_POST['sualistdanhmuc'])) 
{
    $id_list = $_POST['ID_List'];
    $list_danhmuc_moi = $_POST['list_danhmuc'];
    // Sửa tên mục con trong bảng List_DanhMuc
    $sql_sua_list_danhmuc = "UPDATE list_danhmuc SET List_DM = '$list_danhmuc_moi' WHERE ID_List = '$id_list'";
    if (mysqli_query($mysqli, $sql_sua_list_danhmuc)) 
    {
        header('Location: ../../index.php?action=quanlydanhmucsanpham&&query=them');
    } 
    else 
    {
        echo "Lỗi khi sửa mục con: " . mysqli_error($mysqli);
    }
}
?>
