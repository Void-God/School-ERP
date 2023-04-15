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
    $_SESSION['active'] = 2;
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
<html oncontextmenu="return false;">
  <head>
    <title>Attendance</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link rel="icon" href="images/favicon/attendance.jpeg">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css"> 
    <link rel="stylesheet" type="text/css" href="css/table.css">
  </head>
  <body  class="body_background">
    <?php 
      include "include/marquee.php";
      include "navbar.php";
    ?>
    <div class="container back_img_for_att" style="margin: 0 auto ; padding:20px ;">
      <div class = "col-md-6" style="padding-left:8%;text-align:center">
        <?php
          error_reporting(0); 
          require "include/allfunction.php";
          echo "<br><br/><br/>";
          attendance_data($_SESSION['user_ID']);
          percetage_data($_SESSION['user_ID']);
        ?> 
      </div>      
      <div class="col-md-6">
       <br/><br/> <div id="fixheadertable" class="table-responsive table_to_fix_with_device" >          
          <table  class="table" >
            <thead style="background-color: #009879;">
              <tr >
                <th style="text-align:center">Date</th>
                <th style="text-align:center">Day</th>
                <th style="text-align:center">Attendance</th>
              </tr>
            </thead style="background-color: #009879">
            <tbody class="color_do" style="text-align:center;">
                <?php 
                  error_reporting(0);
                  attendance_table($_SESSION['user_ID']);
                ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="row"><p style="text-align:center;color:white">Contact your Class Teacher for correction of Attendance before 24 Hours.</p><div/>
    </div>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/onload_this.js"></script>
    <script type="text/javascript">
      document.getElementById("fixheadertable").addEventListener("scroll", function(){
       var translate = "translate(0,"+this.scrollTop+"px)";
       this.querySelector("thead").style.transform = translate;
    });


  $(document).ready(function(){
    var objDiv = document.getElementById("fixheadertable");
    objDiv.scrollTop = objDiv.scrollHeight;         
  })
    </script> 
  </body>
</html>
