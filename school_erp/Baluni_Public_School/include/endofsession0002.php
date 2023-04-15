<?php 
    error_reporting(0);
  require "config.inc.php";
  $class = $_POST['dump_class'];
  $session = $_POST['dump_year'];
  if($class == '' or $session == '')
  {
    echo '<script>alert("Either Class or Session Field is Empty!")</script>';
    exit();
  }

  $query = "SELECT user_ID FROM students WHERE class_section = '$class'";
  $query_run = mysqli_query($con,$query);
  if(mysqli_num_rows($query_run) == 0)
  {
    echo '<script>alert("No Student found in this Class!")</script>';
    exit();
  }
  

   $query = "INSERT INTO sess_".$session." (user_ID, user_Name, mobile, mail, image, address, father_Name, mother_Name)
      SELECT user_ID, user_Name, mobile, mail, image, address, father_Name, mother_Name
      FROM students WHERE class_section = '".$class."'
    ";
    if(mysqli_query($con,$query))
    {
      $query = "SELECT user_ID FROM students WHERE class_section = '$class'";
      $query_run_full = mysqli_query($con,$query);
      $query = "DELETE FROM students WHERE class_section = '$class'";
      if(mysqli_query($con,$query)){
        while($full = mysqli_fetch_assoc($query_run_full))
        { 
          $query = "DELETE FROM users WHERE user_ID = '".$full['user_ID']."'";
          $query_run = mysqli_query($con,$query);
        }
          echo '<script>alert("Successful!")</script>';
      }
      else
      {
        echo 'failll!!!';
      }

    }
    else {
      echo 'fail';
    }

 ?>
