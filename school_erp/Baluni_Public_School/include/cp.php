<?php
  error_reporting(0);
  session_start();
  require "config.inc.php"; 
  $user_ID = $_POST['user_ID'];
  $pass  = (string)$_POST['password'];
  $c_pass = (string )$_POST['cpassword'];
  $query = "SELECT user_ID FROM cp_request WHERE user_ID = '$user_ID'";
  $query_run = mysqli_query($con,$query);
  if(mysqli_num_rows($query_run)>0){
   $_SESSION['message'] = 6;   
  }
  else {
    if($pass == $c_pass)
    {
      $query = "UPDATE users SET pass_word = '$pass' WHERE user_ID = '$user_ID'";
      if(mysqli_query($con,$query)){
        $_SESSION['message'] = 8;
      }
      else {
        $_SESSION['message'] = 9;
      }
    }
    else 
    {
     $_SESSION['message'] = 7;
    }
  }
  header("Location:http://localhost/Baluni_Public_School/home.php");
?>