<?php  
  session_start();
  require "config.inc.php";
  $ID = $_POST['ID'];
  $mobile = (string) $_POST['mobile'];
  $dob = date("Y-m-d", strtotime($_POST['dob']));
  $query = "SELECT type FROM users WHERE user_ID = '$ID'";
  $query_run = mysqli_query($con,$query);
  $row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
  if(mysqli_num_rows($query_run)>0)                 //for id to exist
  {
    $query = "SELECT type from cp_request WHERE user_ID = '$ID'";
    $query_run = mysqli_query($con,$query);
    if(mysqli_num_rows($query_run)>0)
    {
      $_SESSION['alert_dd'] = 10;
    }
    else {
      $query = "SELECT mobile , dob FROM ".$row['type']."s WHERE user_ID = '".$ID."'";
      $query_run = mysqli_query($con,$query);
      $rows = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
      if($rows['dob']==$dob && $rows['mobile'] == $mobile)
      {
        if($row['type'] == 'admin')
        {
          $_SESSION['alert_dd'] = 11;
        }
        else
        {
          $_SESSION['temp@#00'] = $ID;
          $_SESSION['temp@#01'] = $row['type'];          
          header("Location:/Baluni_Public_School/reset.php");
          exit();
        }
      }
      else
      {
        $_SESSION['alert_dd'] = 12;
      }
    }
  }
  else
  {
    $_SESSION['alert_dd'] = 13;
  }
  header("Location:/Baluni_Public_School/confirm.php")
?>