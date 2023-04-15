<?php 
  require "include/config.inc.php";
  session_start();
  if(!(isset($_SESSION['user_ID'])&&isset($_SESSION['type'])&&isset($_SESSION['pwd_@_set'])))
{    // not logged in
    header('Location:index.php');
    exit();
}
else {
  $query = "SELECT user_ID FROM users WHERE user_ID = '".$_SESSION['user_ID']."' AND pass_word = '".$_SESSION['pwd_@_set']."' AND type = '".$_SESSION['type']."'";
  $query_run = mysqli_query($con,$query);
  if(!(mysqli_num_rows($query_run) == 1)){
    header('Location:index.php');
    exit();
  }
  else {
    $_SESSION['active'] = 1;
  }
}
 if(isset($_SESSION['message']))
{
    //when alert have been set
  require "include/messages.php";
  echo '<script type="text/javascript">alert("'.$message[$_SESSION['message']].'")</script>';
  unset($_SESSION['message']);
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon/home.jpeg">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/navbar_content.css">
    <link rel="stylesheet" type="text/css" href="css/table.css">
    <style type="text/css">
      h4,h2 {
        color:green;
      }
    </style>
  </head>
  <body class="body_background">
    <?php 
      $query = "select type from users where user_ID = '".$_SESSION['user_ID']."'";
      $query_run = mysqli_query($con,$query);
      $rows = mysqli_fetch_array($query_run,MYSQLI_NUM);
      $rows = $rows[0];
      $_SESSION['type'] = $rows;
      include "include/marquee.php";
      if($_SESSION['type'] == 'admin')
      {
        include "admin_navbar.php";
      }
      else
      {
        include "navbar.php";
      }
    ?>
    <div class="container back_img_for_home" style="margin: 0 auto ; padding:75px ;background-color: url(images/back.gif)">
      <?php
        error_reporting(0);
        $query = "SELECT * FROM ".$_SESSION['type']."s WHERE user_ID = '".$_SESSION['user_ID']."'";
        $query_run = mysqli_query($con,$query);
        $rows = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
        echo '
          <div class="col-md-6 col-xm-12">
            <br/><br/><br/><div class = "row">
              <img src="data:image/jpeg;base64,'.$rows['image'].' " class="avatar-property" >          
            </div>
            <div class="row text-center">
              <h3>'.$rows["user_Name"].'</h3>';
        if ($_SESSION['type'] == 'student') {
          $query = "SELECT * from classes WHERE class_section = '".$rows['class_section']."'";
          $query_run = mysqli_query($con,$query);
          $rc = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
          echo '
              <h4 class="home_font">Class: '.$rows["class_section"].'</h4>
              <h4 class="home_font">Class Teacher: '. $rc['class_Teacher'] .' </h4>
            </div><Br/>
          </div>
          <div class="col-md-6 col-xm-12 text-center">
            <div class="row"><h2 class="home_font">Personal Details</h2></div>
            <div class="row"><h4 class="home_font">UserID: '.$rows["user_ID"].'</h4></div>
            <div class="row"><h4 class="home_font">Name of Father: '.$rows["father_Name"].'</h4></div>
            <div class="row"><h4 class="home_font">Name of Mother: '.$rows["mother_Name"].'</h4></div>
            <div class="row"><h4 class="home_font">Mobile Number of User: '.$rows["mobile"].'</h4></div>
            <div class="row"><h4 class="home_font">Mobile Number of Parents/Guardians: '.$rows["par_mobile"].'</h4></div>
            <div class="row"><h4 class="home_font">Mail Address: '.$rows["mail"].'</h4></div>
            <div class="row"><h4 class="home_font">Date of Birth: '.date("d-m-Y", strtotime($rows["dob"])).'</h4></div>
            <div class="row"><h4 class="home_font">Address: '.$rows["address"].'</h4></div>
          </div>';
          $_SESSION['class'] = $rows['class_section'];
          $_SESSION['user_Name'] = $rows['user_Name'];
        }
        else {
          echo '
              <h4 style="text-color:red" class="home_font">Subject: '. $rows['subject'] .' </h4>
            </div><Br/>
          </div>
          <div class="col-md-6 text-center">
            <br/><br/><div class="row"><h2 class="home_font">Personal Details</h2></div>
            <div class="row"><h4 class="home_font">UserID: '.$rows["user_ID"].'</h4></div>
            <div class="row"><h4 class="home_font">Mobile Number of User: '.$rows["mobile"].'</h4></div>
            <div class="row"><h4 class="home_font">Mail Address: '.$rows["mail"].'</h4></div>
            <div class="row"><h4 class="home_font">Date of Birth: '.date("d-m-Y", strtotime($rows["dob"])).'</h4></div>
            <div class="row"><h4 class="home_font">Address: '.$rows["address"].'</h4></div>
          </div>'; 
            $_SESSION['subject'] = $rows['subject'];
            $_SESSION['user_Name'] = $rows['user_Name'];
        }
      ?> 
    </div>  
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/onload_this.js"></script>
  </body>
</html>
