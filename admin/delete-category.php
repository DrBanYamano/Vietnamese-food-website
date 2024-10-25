
<?php
 include('../config/constants.php');
 //check whether the id and iamge_name value is not
 if(isset($_GET['id']) AND isset($_GET['image_name'])){
    //Get the value and Delete
    $id=$_GET['id'];
    $image_name= $_GET['image_name'];

    
    //Remove the Physical image file is avaiable
    if($image_name!=""){
        $path="../images/category/".$image_name;
        
        $remove= unlink($path);

        if($remove==false){
            $_SESSION['remove']="<div class='error'>Faile to Remove Category Image.</div>";

            header('location:'.SITEURL.'admin/manage-category.php');

            die();
        }
    }
    //Delete Data from Database
    $sql="DELETE FROM tbl_category WHERE id=$id";
   //execute the query
    $res= mysqli_query($conn,$sql);
    //check whether the data is delete from database or not
    if($res==true){
        //Set success message and redirect
        $_SESSION['delete']="<div class='success'>Category Deleted Successfully.</div>";
        //redirect to manage category
        header('location:'.SITEURL.'admin/manage-category.php');
       } 
    else{
        //set fail message and redirect
       $_SESSION['delete']="<div class='error'>Failed to Delete Category.</div>"; 
       //redirect to manage category

       header('location:'.SITEURL.'admin/manage-category.php');
    }

}
    else{
       //redirect to index page
       header('location:'.SITEURL.'admin/manage-category.php');
    }
?>