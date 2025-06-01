<div id="main">
    <?php 
    // Kiểm tra trang đang được truy cập và đưa ra nội dung phù hợp
    if (isset($_GET['page'])) {
        $page = $_GET['page'];

        if ($page === 'category') {
            include("sidebar/sidebar.php");
            if (isset($_GET['id_sanpham'])) {
                include("maincontent-category/sanpham.php"); 
            } else {
                include("maincontent-category/danhmuc.php"); 
            }
        } elseif ($page === 'cart') {
            include("maincontent-default/giohang.php");
        } elseif ($page === 'dangky') {
            include("maincontent-default/dangky.php");
        } elseif ($page === 'dangnhap') {
            include("maincontent-default/dangnhap.php");
        } elseif ($page === 'thanhtoan') {
            include("maincontent-default/thanhtoan.php");
        } elseif ($page === 'camon') {
            include("maincontent-default/camon.php");
        } elseif ($page === 'timkiem') {
            include("maincontent-default/timkiem.php");
        } else {
            include("maincontent-default/index.php");
        }
    } else {
        include("maincontent-default/index.php");
    }
    ?>
</div>
