<?php include('partials-front/menu.php');?>
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <?php
            //Get the Search Keyword
            //$search = $_POST['search'];
            
            $search = mysqli_real_escape_string($conn,$_POST['search']);
            
            
            
            ?>
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search;?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            
            //SQL Query to Get Food based on search keyword
            //$search = burger' ; DROP database name;
            //"SELECT * FROM tbl_food WHERE title LIKE '%burger'%' OR description LIKE '%burger'%'";
            $sql = "SELECT *FROM tbl_food WHERE title LIKE '%$search'or description LIKE '%$search%'";

            //Execute the Query
            $res= mysqli_query($conn,$sql);

            $count=mysqli_num_rows($res);

            //Count Rows
            if($count>0){
                
              while($row=mysqli_fetch_assoc($res)){
                //Get the details
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name']; 

                ?>
                 <div class="food-menu-box">
                  <div class="food-menu-img">
                    <?php
                    //Check whether image us available or not
                    if($image_name==""){
                        //Image not Available
                        echo "<div class='error'>Image not Available.</div>";
                    }else{
                        //Image Available
                        ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name;?>" alt="nem ran" class="img-responsive img-curve">
                        <?php
                    }
                    
                    
                    ?>
                    
                  </div>

                  <div class="food-menu-desc">
                  <h4><?php echo $title; ?></h4>
                        <p class="food-price">$<?php echo $price; ?></p>
                        <p class="food-detail"><?php echo $description; ?></p>
                    
                    <br>

                    <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>




                <?php
              }
            }else{
                //Food Not Available
                echo "<div class='error'>Food not found.</div>";
            }

            ?>


               

            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

 

    <!-- footer Section Starts Here -->
    <?php include('partials-front/footer.php')?>