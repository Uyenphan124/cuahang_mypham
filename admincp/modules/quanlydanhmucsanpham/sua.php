<?php
    if (isset($_GET['ID_List'])) {
        $id_list = $_GET['ID_List'];
        $sql_sua_listdanhmuc = "SELECT * FROM list_danhmuc WHERE ID_List = '$id_list' LIMIT 1";
        $query_sua_listdanhmuc = mysqli_query($mysqli, $sql_sua_listdanhmuc);
        $row_sua_listdanhmuc = mysqli_fetch_array($query_sua_listdanhmuc);
    }
?>
<p>Sửa List Danh Mục</p>
<form method="POST" action="modules/quanlydanhmucsanpham/xuly.php">
    <table border="1" width="50%" style="border-collapse: collapse;">
        <tr>
            <td>List Danh Mục</td>
            <td>
                <input type="text" name="list_danhmuc" value="<?php echo $row_sua_listdanhmuc['List_DM']; ?>" required>
                <input type="hidden" name="ID_List" value="<?php echo $row_sua_listdanhmuc['ID_List']; ?>">
            </td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="sualistdanhmuc" value="Sửa"></td>
        </tr>
    </table>
</form>
