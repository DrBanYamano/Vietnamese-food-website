<?php
//Include constants Page
include('../config/constants.php');

if(isset($_GET['id'])&& isset($_GET['image_name'])) //either use '&&' or 'AND'
{
    //Process to delete

    //1.Get id and Image New
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];


    //2.Remove the image if available
    if($image_name != "")
    {
        //Image is vailable . So remove it
        $path = "../images/food/".$image_name;

        //Remove Image File from folder
        $remove = unlink($path);

        //check whether the image is removed or not
        if($remove==false)
        {
            //Failed to remove image
            $_SESSION['upload']= "<div class='error'>Failded to Remove Image File.</div>";
            //Redirect to manage food
            header('location:'.SITEURL.'admin/manage-food.php');
            //Stop the Process of Deleting Food
            die();

        }
    }

    //3.Delete food from database
    $sql = "DELETE FROM tbl_food WHERE id=$id";

    //Excute the Query 
    $res=mysqli_query($conn,$sql);

    //Check whether the query executed or not and set the session message respectively
    if($res==true)
    {
        //Food deleted 
        $_SESSION['delete']="<div class='success'>Food  Deleted Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
    else
    {
        //Failed to delete food
        $_SESSION['delete']="<div class='error'>Failded to Delete Food.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

    //4.Redirect to Manage Food with Session Message

}
else
{
    //Redirect to manage food page
    $_SESSION['unauthorize']="<div class='error'>Unauthorized Access.</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
}?>