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
<!DOCTYPE html>
<html oncontextmenu="return false;">
<head>
  <title>
    Attendance
  </title>
    <link rel="icon" href="images/favicon/attendance.jpeg">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css"> 
    <link rel="stylesheet" type="text/css" href="css/table.css">
</head>
<body class="body_background">
  <?php 
    include "include/marquee.php";
    include "admin_navbar.php";
  ?>
  <div class="container back_img_for_att_spe" style="margin: 0 auto ; padding:38px ; background-color:wheat">

    <div class="col-md-3 content-table"  style="height:453px;padding-left:5%;padding-top:3%">
      <h1 class="color_white" style="text-align:center;">OPTIONS</h1>
      <span class="color_white">Select Class:</span> 
      <select id="classtoselect" name="monologue" onchange="calldates()">
         <option value=""></option>
        <?php
          error_reporting(0); 
          require "include/config.inc.php";
          $query = "SELECT class_section FROM classes";
          $query_run = mysqli_query($con,$query);
          while($rows = mysqli_fetch_assoc($query_run))
          {
            echo '<option value="'.$rows['class_section'].'">'.$rows['class_section'].'</option>';
          }
        ?>        
      </select></br></br>
      <span class="color_white">Search for Student:</span> <br/>
      <input id="sepictole" type="text" name="user_ID"/><br/><br/>
      <button type="button" class="btn btn-sucess" onclick="checkforstudent()">Search</button> 
    </div>


    <div id="choose_class_for_attendance" class="col-md-3" style="height:451px;margin-bottom:5%">
              
    </div>    
    
  
    <div class="col-md-6 col-xm-6 content-table text-center">
      <div style="width:100%;height:450px;" id="pasteattendance">      
      </div>
    </div>




  </div>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/onload_this.js"></script>



    <script type="text/javascript">
      
      function calldates() {
            $('#myModal_on_load').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                });
        var user = $('#classtoselect').val();
        $.post("include/admin_attendance.inc.php",{post_data:user},
        function(data) {
          $('#choose_class_for_attendance').html(data);
          $("#myModal_on_load").modal("hide");
          $("html, body").animate({ scrollTop: 600 }, "slow");
        });
    }

    </script>
    
    <script type="text/javascript">    
    function showattendance(abc) {
            $('#myModal_on_load').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                });
    $.post("include/attendance.inc.php",{post_user:abc.value},
    function(data) {
      $('#pasteattendance').html(data);
      $("#myModal_on_load").modal("hide");
      $("html, body").animate({ scrollTop: document.body.scrollHeight }, "slow");
    });
  }



    function checkforstudent() {
        var user = $('#sepictole').val();
        if(user === '')
        {
          alert('Search Box is empty!');
        }
        else {
            $('#myModal_on_load').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                });
          $.post("include/searchforstudent.php",{post_user:user},
          function(data) {
            $('#pasteattendance').html(data);
            $("#myModal_on_load").modal("hide");
            $("html, body").animate({ scrollTop: document.body.scrollHeight }, "slow");
          });
        }
    }
  </script>
</body>
</html>
