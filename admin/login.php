<?php include('../config/constants.php')?>
<html>
   <head>
    <title>Login- Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">

   </head>
    <body>
        <div class="login">
        <h1 class="text-center">Login</h1>
         <br><br>
         <?php
         if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);

         } 
         if(isset($_SESSION['no-login-message'])){
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);

         }
         ?>
         <br><br>
        <!--Login form Starts Here-->
        <form action="" method="POST" class="text-center">
            User Name:<br>
            <input type="text" name="username" placeholder="Enter Username"><br>
            Password:<br>
            <input type="password" name="password" placeholder="Enter Password"><br>
            <input type="submit" name="submit" value="login" class="btn-secondary"><br>
        </form>
        <!-- Login form Ends Here-->
        <br><br>
        <p class="text-center">Created By -<a href="https://www.facebook.com/Anthony.Do.369/">Anthony_Do</a></p>
        </div>
    </body>
</html>
<?php

//check whether the submit button is clicked or not
if(isset($_POST['submit'])){
    //process for login
    //1.get the data from login form

     $username= mysqli_real_escape_string($conn,$_POST['username']);
     $raw_password=md5($_POST['password']);
     $password= mysqli_real_escape_string($conn,$raw_password);

    //2.sql to check whether the user with username anhd password exists or not
    $sql= "SELECT*FROM tbl_admin where username='$username'and password='$password'";

    //3.execute the query
    $res = mysqli_query($conn,$sql);

    //4.Count rows to check whether the user exists or not
    $count= mysqli_num_rows($res);
    if($count==1){
        //user available and login success
        $_SESSION['login']="<div class='success'>Login Successful.</div>";
        $_SESSION['user']= $username; //To check whether the user is logged in  or not and logout will unset it
        //Redirect to Home Page/Dashboard
        header('location:'.SITEURL.'admin/');

    }else{
        //user not available and login fail
        $_SESSION['login']="<div class='error'>User or Password did not match.</div>";
        //redirect to home page/dashboard
        header('location:'.SITEURL.'admin/login.php');
    }
}
 ?>
 <?php include('partials/footer.php'); ?>

