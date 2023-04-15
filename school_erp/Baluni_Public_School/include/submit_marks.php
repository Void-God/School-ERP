<?php 
  error_reporting(0);
  session_start();
  require "config.inc.php";
  $flag = 0;
  $set_class = $_POST['set_class'];
  $test = $_POST['name_of_test'];
  $M_M = $_POST['M_M_T'];
  $P_M = $_POST['P_M_T'];
  $query = "INSERT INTO marks(paper_name, teacher_ID, subject) VALUES( '".$test."','".$_SESSION['user_ID']."','".$_SESSION['subject']."')";
  $query_run = mysqli_query($con,$query);


  $query = "SELECT user_ID FROM students WHERE class_section = '$set_class'";
  $query_run = mysqli_query($con,$query);
  while($rows = mysqli_fetch_assoc($query_run)){
    $index = 'MARKS'.$rows['user_ID'];
    $query = "UPDATE marks SET passing_marks = '".$P_M."', ".$rows['user_ID']."= '".$_POST[$index]."/".$M_M."' WHERE paper_name = '".$test."' AND  teacher_ID = '".$_SESSION['user_ID']."' AND subject = '".$_SESSION['subject']."'";
    if(mysqli_query($con,$query))
    {
      $flag += 1;
    }    
  }
  if($flag == 0)
  {
    $_SESSION['message'] = 37;
  }
  else
  {
    $_SESSION['message'] = 36;
  }
  header("Location:/Baluni_Public_School/teacher_marks.php");
?>