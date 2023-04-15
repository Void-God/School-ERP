<?php 
error_reporting(0);
require "config.inc.php";
$id = $_POST['id_post'];
$class = $_POST['class_post'];

$query = "SELECT $id
FROM marks
WHERE EXISTS
(SELECT $id FROM marks) ";
if(mysqli_query($con,$query)){
  $query = 'UPDATE students SET class_section = "'.$class.'" WHERE user_ID = "'.$id.'"';

  if(mysqli_query($con,$query)) {
    echo '<script>alert("Class Changed Successfully!")</script>';
  }
  else {
    echo '<script>alert("Some Problem Occured Please Try Again!")</script>';
  }
}
else {
  echo '<script>alert("Please Change Class From End of Session!")</script>';
}



?>