<?php 
if(isset($_POST['submit@0001'])) {
  error_reporting(0);
  session_start();
  require "config.inc.php";
  if(!empty($_POST['date'])){
    foreach($_POST['date'] as $date){
      $query = "SELECT * FROM attendance WHERE adate = '$date'";
      $query_run = mysqli_query($con,$query);
      $row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
      foreach ($row as $key => $value) {
        if($key != 'adate'){
          $query = "UPDATE attendance SET $key = 'N/A' WHERE adate = '$date'";
          $query_run = mysqli_query($con,$query);
        }
      }
    }
    $_SESSION['message'] = 43;
  }
  else {
    $_SESSION['message'] = 44;
  }
  header("Location:/Baluni_Public_School/home.php");

}

?>