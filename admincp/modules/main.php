<div class="clear"></div>
<div class="main">
    <?php
        if (isset($_GET['action']) && isset($_GET['query'])) 
        {
            $tam = $_GET['action'];
            $query = $_GET['query'];
        } 
        else 
        {
            $tam = '';
            $query = '';
        }
        if ($tam === 'quanlydanhmucsanpham' && $query === 'them') 
        {
            include("modules/quanlydanhmucsanpham/them.php");
            include("modules/quanlydanhmucsanpham/lietke.php");
        } 
        elseif ($tam === 'quanlydanhmucsanpham' && $query === 'sua_list') 
        {
            include("modules/quanlydanhmucsanpham/sua.php");
        }
        else if ($tam === 'quanlysanpham' && $query === 'them') 
        {
            include("modules/quanlysanpham/them.php");
            include("modules/quanlysanpham/lietke.php");
        }  
        elseif ($tam === 'quanlysanpham' && $query === 'sua_list') 
        {
            include("modules/quanlysanpham/sua.php");
        }
        elseif ($tam === 'quanlydonhang' && $query === 'lietke')
        {
            include("modules/quanlydonhang/lietke.php");
        }
        elseif ($tam === 'donhang' && $query === 'xemdonhang')
        {
            include("modules/quanlydonhang/xemdonhang.php");
        }
    ?>
</div>