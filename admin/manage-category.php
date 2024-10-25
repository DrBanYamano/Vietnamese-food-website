<?php include("partials/menu.php")?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br><br>
        <?php
        // Display success or error messages if they exist
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['remove'])){
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }
        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['no-category-found'])){
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }
        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if(isset($_SESSION['failed-remove'])){
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }
        ?>
        <br><br>
        <!-- Link to add a new category -->
        <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Category</a>
        <br/> <br/>

        <!-- Table to display categories -->
        <table class="tbl-full">
            <tr >
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
            // Query to fetch all categories from the database
            $sql = "SELECT * FROM tbl_category";
            // Execute the query
            $res = mysqli_query($conn, $sql);
            // Count the number of rows returned
            $count = mysqli_num_rows($res);
            // Initialize serial number variable
            $sn = 1;
            // Check if there are any categories in the database
            if($count > 0){
                // If there are categories, loop through each row and display them
                while($row = mysqli_fetch_assoc($res)){
                    $id = $row['id'];
                    $image_name = $row['image_name'];
                    $title = $row['title'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    ?>
                    <tr>
                        <!-- Display serial number -->
                        <td><?php echo $sn++;?></td>
                        <!-- Display category title -->
                        <td><?php echo $title;?></td>
                        <td>
                            <?php
                            // Check if image name is available
                            if($image_name != ""){
                                // Display the image
                                ?>
                                <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" width="100px">
                                <?php
                            } else {
                                // Display error message if no image is available
                                echo "<div class='error'>Image not Added.</div>";
                            }
                            ?>
                        </td>
                        <!-- Display category features and active status -->
                        <td><?php echo $featured;?></td>
                        <td><?php echo $active;?></td>
                        <td>
                            <!-- Link to update category -->
                            <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                            <!-- Link to delete category -->
                            <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>

                        </td>
                    </tr>
                    <?php
                }
            } else {
                // If there are no categories, display a message
                echo "<tr><td colspan='6'><div class='error'>No Category Added.</div></td></tr>";
            }
            ?>
        </table>
    </div>
</div>
<?php include("partials/footer.php") ?>
