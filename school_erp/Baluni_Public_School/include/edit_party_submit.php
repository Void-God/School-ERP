<?php
  error_reporting(0);
session_start();
require "config.inc.php"; 
$ID = $_POST['userID'];
$name = $_POST['username'];
$mail = $_POST['madd'];
$mobile = $_POST['mobile'];
$add = $_POST['address'];

$query = "SELECT type FROM users WHERE user_ID = '$ID'";
$query_run = mysqli_query($con,$query);
$type = mysqli_fetch_array($query_run);

if($type['type'] == 'student')
{
  $fname = $_POST['fname'];
  $mname = $_POST['mname'];
  $pmobile = $_POST['pmobile'];

  $query = "UPDATE students
SET user_Name = '$name', mail = '$mail', mobile = '$mobile', father_Name = '$fname', mother_Name = '$mname', par_mobile = '$pmobile', address = '$add' WHERE user_ID = '$ID'";
}
else if($type['type'] == 'teacher')
{
  $query = "UPDATE teachers
SET user_Name = '$name', mail = '$mail', mobile = '$mobile', address = '$add'  WHERE user_ID = '$ID'";
}

else {
  $query = "UPDATE admins
SET user_Name = '$name', mail = '$mail', mobile = '$mobile', address = '$add'  WHERE user_ID = '$ID'";
}

if(mysqli_query($con,$query))
{
  $_SESSION['message'] = 29;
}
else
{
  $_SESSION['message'] = 30;
}
header("Location:/Baluni_Public_School/home.php");

?>