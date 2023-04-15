<?php 
  error_reporting(0);
require "config.inc.php";
$id = $_POST['id_post'];
$class = $_POST['class_post'];
$query = "ALTER TABLE attendance ADD COLUMN ".$id." varchar(15)";
if(mysqli_query($con,$query)){
  $query = "ALTER TABLE marks ADD COLUMN ".$id." varchar(15)";
  if(mysqli_query($con,$query)){
    $mos = "abc";
  }
  else {
    require "config.inc.php";
    $query = "ALTER TABLE attendance DROP ".$id;
    echo '<script>alert("Some Problem Occured! Please Try Again")</script>';
    exit();
  }
}
else {
  echo '<script>alert("Some Problem Occured! Please Try Again")</script>';
  exit();
}

$query = 'UPDATE students SET class_section = "'.$class.'" WHERE user_ID = "'.$id.'"';

if(mysqli_query($con,$query)) {
  echo '<script>alert("Class Changed Successfully!")</script>';
}
else {
  echo '<script>alert("Some Problem Occured Please Try Again!")</script>';
}



?>