<?php 
if(isset($_POST['submit@04']) AND !($_POST['eos']=='')) {
    error_reporting(0);
  session_start();
  require "config.inc.php";
  $session = $_POST['eos'];

  $query = 'ALTER TABLE attendance RENAME TO att'.$session;
  $query1 = 'ALTER TABLE marks RENAME TO marks'.$session;
  $query_run = mysqli_query($con,$query);
  $query_run = mysqli_query($con,$query1);


  $query = 'create table attendance (
    adate date primary key
  );';
  $query1 = 'create table marks (
    paper_id int PRIMARY KEY AUTO_INCREMENT,
    paper_name varchar(50) NOT NULL,
    teacher_ID varchar(15) NOT NULL,
    subject varchar(20) NOT NULL,
    passing_marks int NOT NULL
  );';


  if(mysqli_query($con,$query)&&mysqli_query($con,$query1))
  {
    $query = "UPDATE sessions SET state = 1 WHERE session = '$session'";
    $query_run = mysqli_query($con,$query);
    $query = "UPDATE students SET class_section = 'N/A'";
    $query_run = mysqli_query($con,$query);
    $_SESSION['message'] = 41;
  }
  else
  {
    $_SESSION['message'] = 42;
  }
  header("Location:/Baluni_Public_School/home.php");
}
else {
  header("Location:/Baluni_Public_School/logout.php");
}


?>
