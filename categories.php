<?php include('partials-front/menu.php')?>

<!-- Categories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
           // Hiển thị tất cả các danh mục đang hoạt động
           // Truy vấn SQL
           $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

           // Thực thi truy vấn
           $res = mysqli_query($conn, $sql);

           // Đếm số dòng
           $count = mysqli_num_rows($res);

           // Kiểm tra xem có danh mục nào không
           if($count > 0){
               // Các danh mục có sẵn
               while($row = mysqli_fetch_assoc($res)){
                   // Lấy các giá trị
                   $id = $row['id'];
                   $title = $row['title'];
                   $image_name = $row['image_name'];
        ?>
        <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id;?>">
            <div class="box-3 float-container">
                <?php
                  if($image_name == ""){
                    // Hình ảnh không có sẵn
                    echo "<div class='error'>Image not found.</div>";
                  } else {
                    // Hình ảnh có sẵn
                ?>
                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                <?php
                  }
                ?>
                <h3 class="float-text text-white"><?php echo $title; ?></h3>
            </div>
        </a>
        <?php
               }
           } else {
               // Danh mục không có sẵn
               echo "<div class='error'>Category not found.</div>";
           }
        ?>
        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<?php include('partials-front/footer.php')?>
