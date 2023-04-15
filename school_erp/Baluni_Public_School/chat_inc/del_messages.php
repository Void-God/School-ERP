<?php 
if(isset($_POST['delete_id'])){
  error_reporting(0);
  session_start();
  require "config.inc.php";
  $group = $_POST['delete_id'];
  $query = "SELECT admin FROM discussions WHERE dis_ID = '$group'";
  $query_run = mysqli_query($conn,$query);
  $row = mysqli_fetch_array($query_run);
  if($row['admin']==$_SESSION['user_ID'] OR $_SESSION['type'] == 'admin'){
    $query = "DELETE FROM chat_".$group." WHERE 1=1;";
    if(mysqli_query($conn,$query)){

      echo '<script>$("#myModal_on_load").modal("hide")</script>';
      echo '<script>alert("Successfully Deleted!")</script>';
    }
    else{
      echo '<script>$("#myModal_on_load").modal("hide")</script>';
       echo '<script>alert("Problem Occured! Please Try Again!")</script>';
    }
  }
  else {
    echo '<script>$("#myModal_on_load").modal("hide")</script>';
    echo '<script>alert("Problem Occured!")</script>';
  }
}



?>