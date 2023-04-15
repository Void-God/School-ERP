<?php 
  error_reporting(0);
session_start();
require "config.inc.php";
 $request = $_POST['request'];
 $user_ID = $_POST['user_ID'];
 $password = (string) $_POST['password'];
 if($request == 'yes')
 {
    $query = "UPDATE users SET pass_word = '$password' WHERE user_ID = '$user_ID'";
    if(mysqli_query($con,$query)){
      $_SESSION['message'] = 4;
    }
 }
 else {
    $_SESSION['message'] = 5;
 }
 $query = "DELETE FROM cp_request WHERE user_ID = '$user_ID'";
 $query_run = mysqli_query($con,$query);
  header("Location:/Baluni_Public_School/home.php");
?>