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
    $query1 = "DELETE FROM discussions WHERE dis_ID = '$group'";
    $query2 = "DROP TABLE chat_".$group;
    if(mysqli_query($conn,$query1) && mysqli_query($conn,$query2)){
      echo "<script type='text/javascript'>$('#divtorefresh2').load(document.URL +  ' #divtorefresh2')</script>;";
      echo '<script>$("#myModal_on_load").modal("hide")</script>';
      echo '<script>alert("Successfully Deleted!")</script>';
    }
    else {

      echo '<script>$("#myModal_on_load").modal("hide")</script>';
      echo '<script>alert("Problem Occured!")</script>';
    }
  }
  else {

      echo '<script>$("#myModal_on_load").modal("hide")</script>';
      echo '<script>alert("Problem Occured!")</script>';   
  }
}

?>