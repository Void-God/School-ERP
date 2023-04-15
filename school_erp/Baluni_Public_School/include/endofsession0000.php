<?php 
  error_reporting(0);
require "config.inc.php";
$session = $_POST['eos'];

$query = "SELECT session FROM sessions WHERE session = '$session'";
$query_run = mysqli_query($con,$query);
if(mysqli_num_rows($query_run) == 0)
{
  $query = "INSERT INTO sessions values('$session',0)";
  if(mysqli_query($con,$query))
  {
      $query = "create table sess_".$session."(
      user_ID varchar(15) primary key,
      user_Name varchar(40) not null,
      mobile varchar(15) not null,
      mail varchar(50) not null,
      image mediumblob not null,
      address varchar(100) not null,
      father_Name varchar(40) not null,
      mother_Name varchar(40) not null
    );";
    if(mysqli_query($con,$query)){
      echo "<script type='text/javascript'>$('#refresh_eos_now').load(document.URL +  ' #refresh_eos_now')</script>;";
      echo '<script>alert("Session Created Successfully!")</script>';
    }
    else {
      echo '<script>alert("Session Creation Failed!")</script>';
    }
  }
  else {
    echo '<script>alert("Oops! Some Error has Occured. Please Try Again.")</script>';
  }
}
else{
  echo '<script>alert("Session Already Exists!")</script>';
}
?>
