<?php 
if(isset($_POST['submit@03'])){
    error_reporting(0);
  session_start();
  require "config.inc.php";
  $subject = $_POST['sub'];



  $query = "INSERT INTO subjects VALUES ('$subject')";
  if(mysqli_query($con,$query))
  {
    $_SESSION['message'] = 28;
  }
  else
  {
    $_SESSION['message'] = 26;
  }
  header("Location:/Baluni_Public_School/home.php");
}
else{
  header("Location:/Baluni_Public_School/logout.php");  
}

 ?>