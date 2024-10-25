<?php
//Include constants.php file here
include('../config/constants.php');
//1.get the ID of Admin to be deleted 
$id=$_GET['id'];

//2.Create SQL Query to Delete Admin 
$sql="DELETE FROM tbl_admin WHERE id =$id";

//Excute the Query
$res = mysqli_query($conn,$sql);


//Check whether the query executed successfully or not
if($res==true){
    $_SESSION['delete']="<div class='success'>Admin deleted successfully.</div>";

    header('location:'.SITEURL.'admin/manage-admin.php');
}else{
    $_SESSION['delete']="<div class='error'>Failed to Delete Admin.</div>";

    header('location:'.SITEURL.'admin/mange-admin.php');
}












?>