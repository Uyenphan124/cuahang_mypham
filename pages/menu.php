<?php
    if (isset ($_GET ['dangxuat']) && $_GET ['dangxuat'] == 1)
    {
        unset ($_SESSION ['dangky']);
    }
?>
<div class="menu">
    <ul class="list_menu">
        <li><a href="index.php?page=home"> TRANG CHỦ </a></li>
        <li><a href="index.php?page=category&id=1"> DANH MỤC </a>
            <ul class="sublist">    
                <li><a href="index.php?page=category&subcat=dưỡng-da"> Dưỡng Da </a></li>
                <li><a href="index.php?page=category&subcat=trang-diem"> Trang Điểm </a></li>
                <li><a href="index.php?page=category&subcat=cham-soc-toc"> Chăm Sóc Tóc </a></li>
                <li><a href="index.php?page=category&subcat=duong-the"> Dưỡng Thể </a></li>
                <li><a href="index.php?page=category&subcat=nước-hoa"> Nước Hoa </a></li>
            </ul>
        <li><a href="index.php?page=cart"> GIỎ HÀNG </a></li>
        <?php
            if (isset ($_SESSION ['dangky']))
            {
        ?>
        <li><a href="index.php?dangxuat=1"> ĐĂNG XUẤT </a></li>
        <?php
            }
            else
            {
        ?>
        <li><a href="index.php?page=dangky"> ĐĂNG KÝ </a></li>
        <?php
            }
        ?>
    </ul>
    <p>
    <form action="index.php?page=timkiem" method="POST" style="position: absolute; top: 145px; right: 10px; display: flex; gap: 10px; align-items: center;">
        <input 
            type="text" 
            placeholder="Tìm Kiếm Sản Phẩm..." 
            name="tukhoa" 
            required 
            style="width: 250px; padding: 6px; font-size: 14px; border: 1px solid #ccc; border-radius: 4px;"
        >
        <input 
            type="submit" 
            name="timkiem" 
            value="Tìm Kiếm" 
            style="padding: 6px 12px; font-size: 14px; background-color: #2c7a6d; color: white; border: none; border-radius: 4px; cursor: pointer;"
        >
    </form>
</p>


</div>