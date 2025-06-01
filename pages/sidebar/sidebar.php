<div class="sidebar">
    <ul class="list_sidebar">
        <?php
  
            // Kiểm tra giá trị của 'subcat' và hiển thị nội dung tương ứng
            if (isset($_GET['subcat'])) {
                switch ($_GET['subcat']) {
                    case 'dưỡng-da':
                        echo '<li><a href="index.php?page=category&subcat=2">Sữa Rửa Mặt</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=3">Tẩy Trang</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=4">Tẩy Tế Bào Chết</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=5">Toner</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=6">Serum</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=7">Xịt Khoáng</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=8">Lotion</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=9">Kem / Gel / Dầu Dưỡng</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=10">Kem Chống Nắng</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=11">Dưỡng Mắt</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=12">Dưỡng Môi</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=13">Mặt Nạ</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=14">Bông Tẩy Trang</a></li>';
                        break;
                    case 'trang-diem':
                        echo '<li><a href="index.php?page=category&subcat=15">Kem Lót</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=16">Kem Nền</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=17">Cushion</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=18">Che Khuyết Điểm</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=19">Má Hồng</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=20">Highlight</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=21">Phấn Phủ</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=22">Kẻ Mắt</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=23">Kẻ Mày</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=24">Phấn Mắt</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=25">Mascara</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=26">Son</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=27">Sơn Móng</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=28">Bông / Mút</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=29">Cọ</a></li>';
                        break;
                    case 'cham-soc-toc':
                        echo '<li><a href="index.php?page=category&subcat=30">Dầu Gội</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=31">Dầu Xả</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=32">Kem Ủ Tóc</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=33">Serum</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=34">Dầu Dưỡng Tóc</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=35">Xịt Dưỡng Tóc</a></li>';
                        break;
                    case 'duong-the':
                        echo '<li><a href="index.php?page=category&subcat=36">Sữa Tắm</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=37">Xà Phòng</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=38">Tẩy Tế Bào Chết Body</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=39">Dưỡng Thể</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=40">Dưỡng Da Body</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=41">Kem Chống Nắng Body</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=42">Khử Mùi</a></li>';
                        echo '<li><a href="index.php?page=category&subcat=43">Tẩy Lông</a></li>';
                        break;
                    case 'nuoc-hoa':
                        echo '<li><a href="index.php?page=category&subcat=44">Nước Hoa</a></li>';
                        break;
                    
                }
        
            }
        ?>
    </ul>
</div>
<script>
    // Kiểm tra nếu URL có tham số subcat, nếu không có thì ẩn sidebar
    if (window.location.search.indexOf('subcat') === -1) {
        document.querySelector('.sidebar').style.display = 'none';
    }
</script>
