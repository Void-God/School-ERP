<?php 
  error_reporting(0); 
session_start();
require "config.inc.php";
$date = $_POST['date'];
//$_SESSION['assigned_class'];
  for($i=1;$i<=$_SESSION['count'];$i++)
  {
    $query = " UPDATE attendance SET ".$_POST[$i]." = '".$_POST['att'.$_POST[$i]]."' WHERE adate = '".$date."'";
    echo $query;
    if($query_run = mysqli_query($con,$query))
    {
      $_SESSION['message'] = 20;
    }
    else
    {
      $_SESSION['message'] = 21;
    }
  }
  if($_SESSION['type'] == 'teacher') {
    header("Location:/Baluni_Public_School/teacher_attendance.php");
  }
  else if($_SESSION['type'] == 'admin'){
    header("Location:/Baluni_Public_School/admin_attendance.php");
  }
?>