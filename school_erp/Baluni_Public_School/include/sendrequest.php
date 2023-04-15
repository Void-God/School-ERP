<?php 
require "config.inc.php";
session_start();
$pass = $_POST['password'];
$cpass = $_POST['cpassword'];
if($pass != $cpass) {
  $_SESSION['alert_dd'] = 16;
}
else {
  $query = "INSERT INTO cp_request VALUES ('".$_SESSION['temp@#00']."','".$pass."','".$_SESSION['temp@#01']."')";
  if($query_run = mysqli_query($con,$query))
  {
    $_SESSION['alert_dd'] = 14;
  } 
  else {
    $_SESSION['alert_dd'] = 15;
  }
}
header("Location:/Baluni_Public_School/confirm.php");
?>