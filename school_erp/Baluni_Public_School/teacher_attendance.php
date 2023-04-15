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
<html lang="en" oncontextmenu="return false;">
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
    require "include/config.inc.php";
    $query = "SELECT class_section FROM classes WHERE user_ID = '".$_SESSION['user_ID']."'";
    $query_run = mysqli_query($con,$query);
    if((mysqli_num_rows($query_run) == 0) && ($_SESSION['type'] != 'admin'))
    {
      $_SESSION['message'] = 17;
      header("Location:index.php");
      exit();
    }
    else 
    {
      $row = mysqli_fetch_array($query_run);
      $_SESSION['assigned_class'] = $row['class_section'];
    }
    include "include/marquee.php";
    include "navbar.php";
  ?>
  <div class="container back_img_for_att_spe" style="margin: 0 auto ; padding:38px ; background-color:wheat">
    <div class="col-md-3">
      <br/><div id="fixheadertable" class="table-responsive table_to_fix_with_device" >          
        <table  class="table" >
          <thead style="background-color: #009879;">
            <tr >
              <th style="text-align:center">Date</th>
            </tr>
          </thead style="background-color: #009879">
          <tbody class="color_do" style="text-align:center;">
                <?php
                  require "include/config.inc.php";
                  $query = "SELECT adate FROM attendance";
                  $query_run = mysqli_query($con,$query);


                  $query = "SELECT user_ID FROM students WHERE class_section = '".$_SESSION['assigned_class']."'";
                  $att_query_run  = mysqli_query($con,$query);
                  if(mysqli_num_rows($att_query_run)===0)
                  {
                    $_SESSION['message'] = 22;
                    header("Location:index.php");
                    exit();
                  }
                  $check = mysqli_fetch_array($att_query_run,MYSQLI_NUM);
                  

                  while($rows = mysqli_fetch_assoc($query_run))
                  {
                    $query = "SELECT ".$check[0]." FROM attendance WHERE adate = '".$rows['adate']."'";
                    // echo $query;
                    $att_query_run = mysqli_query($con,$query);
                    $check_for_av = mysqli_fetch_array($att_query_run,MYSQLI_NUM);
                    if(is_null($check_for_av[0]))
                    {
                      echo "<tr style='margin: 0 auto;background-color:red'>";
                        echo '<th><input class="btn btn-default" type="button" value="'.date("d-m-Y", strtotime($rows["adate"])).'" onclick="showattendance(this)"/></th>';
                      echo"</tr>";
                    }
                    else{
                      echo "<tr style='margin: 0 auto'>";
                        echo '<th><input class="btn btn-default" type="button" value="'.date("d-m-Y", strtotime($rows["adate"])).'" onclick="showattendance(this)"/></th>';
                      echo"</tr>";
                    }
                  }
                ?> 
          </tbody>
        </table>
      </div>        
    </div>    
    
  
    <div class="col-md-6 col-xm-6 content-table text-center">
      <div style="width:100%;height:450px;overflow:auto" id="pasteattendance">      
      </div>
    </div>




    <div class="col-md-3 content-table"  style="height:453px">
      <h1 class="color_white text-center">OPTIONS</h1>
      <span class="color_white">Search for Student</span> <br/>
      <input id="sepictole" type="text" name="user_ID" placeholder="NAME OR ID" />
      <button class="btn btn-success" type="button" onclick="checkforstudent()">Search</button> 
    </div>
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
      $("html, body").animate({ scrollTop: 600 }, "slow");
    });
  }



    function checkforstudent() {
        var user = $('#sepictole').val();
        if(user === '')
        {
          alert('Search Box is Empty');
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
            $("html, body").animate({ scrollTop: 600 }, "slow");
          });
        }
    }
  </script>

</body>
</html>
