<?php
  if(isset($_POST['submit@01'])){
    error_reporting(0);
    session_start();  
    require "config.inc.php";
    $operation = $_POST['operation'];

    if($operation == 'create') {

        $class = $_POST['class'];
        $teacher = $_POST['teacher'];    

      $query = "SELECT user_ID FROM teachers WHERE user_Name = '$teacher'";
        $query_run = mysqli_query($con,$query);
      if(mysqli_num_rows($query_run)==0)
      {
        $query = "SELECT user_ID FROM admins WHERE user_Name = '$teacher'";
        $query_run = mysqli_query($con,$query);
        $row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
      }
      else
      {
        $row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
      }
      $query = "INSERT INTO classes VALUES ('$class','$teacher','".$row['user_ID']."')";
      if(mysqli_query($con,$query))
      {
        $_SESSION['message'] = 18;
      } 
      else
      {
        $_SESSION['message'] = 15;
      }
    }
    
    else if($operation == 'delete')
    {
      $class = $_POST['class'];
      $query = "SELECT class_section FROM classes WHERE class_section = '$class'";
      $query_run = mysqli_query($con,$query);
      if(mysqli_num_rows($query_run) == 0 )
      {
        $_SESSION['message'] = 27;
      }
      else
      {
        $query = "DELETE FROM classes WHERE class_section = '$class'";
        if(mysqli_query($con,$query)){
          $_SESSION['message'] = 23;
        }
        else {
          $_SESSION['message'] = 24;
        }
      }
    }
    else {
      $class = $_POST['class'];
      $teacher = $_POST['teacher']; 
      
      $query = "UPDATE classes SET class_Teacher = '$teacher' WHERE class_section = '$class'";
      if(mysqli_query($con,$query))
      {
        $_SESSION['message']  = 25;
      }
      else {
        $_SESSION['message'] = 26;
      }

    }
    header("Location:/Baluni_Public_School/home.php");
  }
  else {
    header("Location:/Baluni_Public_School/logout.php");
  }
?>