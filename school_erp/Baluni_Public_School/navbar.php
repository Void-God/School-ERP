<?php 
  require "include/config.inc.php";
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
  <title>Responsive Navbar</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">  
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/navbar_content.css">
</head>
<body>
  <section>
    <nav class="navbar navbar-default nav-margin-zero"  style="background: rgb(85, 204, 6);">
      <div class="container-fluid" >
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false" style="margin-top:16px">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="" href="#">
            <img src="images/logo.jpeg" alt="images" style="width:83px;height:78px" class="responsive">
            <!-- <img alt="Brand" src="images/logo.jpeg" style="position:absolute;z-index:1;left:2%;width:12%;" class="responsive"> -->
          </a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right nav-adjest-auto">
            <li><a href="home.php" <?php if($_SESSION['active'] == 1){echo "style='color:yellow'";}?>>HOME</a></li>
            <?php
              if($_SESSION['type'] == 'student')
              {
                echo '<li><a href="attendance.php"';if($_SESSION['active'] == 2){echo "style='color:yellow'";} echo ' >ATTENDANCE</a></li>';
                echo '<li><a href="student_marks.php"';if($_SESSION['active'] == 3){echo "style='color:yellow'";} echo '>MARKS</a></li>';
                echo '
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">MORE
                  <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#" data-toggle="modal" data-target="#myModal">NOTES</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#myModal00">NOTICE</a></li>
                    <li><a href="stu_chat.php">DISCUSSION</a></li>
                  </ul>
                </li>';
                include "include/student_study.php";
                
              }
              else 
              {
                echo '<li><a href="teacher_attendance.php"';if($_SESSION['active'] == 2){echo "style='color:yellow'";} echo ' >ATTENDANCE</a></li>';
                echo '<li><a href="teacher_marks.php"';if($_SESSION['active'] == 3){echo "style='color:yellow'";} echo '>MARKS</a></li>';
                echo '
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">MORE
                  <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#" data-toggle="modal" data-target="#myModal">NOTES</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#myModal00">NOTICE</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#myModalc">DISCUSSION PANEL</a></li>
                    <li><a href="discussion_teacher.php">DISCUSSION</a></li>
                  </ul>
                </li>';
                include "include/teacher_up.php";
              }
            ?>
            <li><a href="logout.php">LOG OUT</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </section>

  <div id="myModal_on_load" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content" style="height:100px;width:200px;margin: 0 auto">
       <br/><br/><img src="images/loading.gif" style="height:90px;width:90px;margin-left: auto;margin-right: auto;display:block">
       <h4 style="text-align:center;color:yellow">Processing Please Wait</h4>
      </div>
    </div>
  </div>


  <script type="text/javascript">
    function process_pop() {
       $('#myModal_on_load').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                });
    }
  </script>

</body>
</html>
