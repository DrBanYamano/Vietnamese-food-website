<?php include('partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
        <?php
        // Display session message if it exists
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Title of the food"></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" id="30" rows="5" placeholder="Description of the food."></textarea></td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td><input type="number" name="price"></td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php
                            // Create SQL query to fetch all active categories
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);

                            // If categories exist, display them in the dropdown
                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    echo "<option value='$id'>$title</option>";
                                }
                            } else {
                                // If no categories are found, display a default option
                                echo "<option value='0'>No Category Found</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        // Check if the form is submitted
        if (isset($_POST['submit'])) {
            // Get the data from form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $featured = isset($_POST['featured']) ? $_POST['featured'] : 'No';
            $active = isset($_POST['active']) ? $_POST['active'] : 'No';

            // Check if an image is selected for upload
            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];

                // Upload the image if it's selected
                if ($image_name != "") {
                    // Get the file extension
                    $ext = explode('.', $image_name);
                    $ext = end($ext); // Extract the file extension

                    // Rename the image
                    $image_name = "Food-Name-" . rand(0000, 9999) . "." . $ext;

                    // Get the source and destination paths
                    $src = $_FILES['image']['tmp_name'];
                    $dst = "../images/food/" . $image_name;

                    // Move the uploaded file to the destination
                    $upload = move_uploaded_file($src, $dst);

                    // Check if the image is uploaded successfully
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Failed to upload Image.</div>";
                        header('location:' . SITEURL . 'admin/add-food.php');
                        die();
                    }
                }
            } else {
                $image_name = ""; // Set default value as blank if no image is selected
            }

            // Insert food data into the database
            $sql2 = "INSERT INTO tbl_food SET
                title='$title',
                description='$description',
                price='$price',
                image_name='$image_name',
                category_id='$category',
                featured='$featured',
                active='$active'
            ";
            $res2 = mysqli_query($conn, $sql2);

            // Check if the data is inserted successfully
            if ($res2 == true) {
                $_SESSION['add'] = "<div class='success'>Food Added Successfully</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            } else {
                $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            }
        }
        ?>
    </div>
</div>
<?php include('partials/footer.php') ?>
