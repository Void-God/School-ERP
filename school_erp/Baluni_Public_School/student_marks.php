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
    $_SESSION['active'] = 3;
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
<html lang="en" oncontextmenu="return false;">
  <head>
    <title>Marks</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link rel="icon" href="images/favicon/mark.png">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css"> 
    <link rel="stylesheet" type="text/css" href="css/table.css">
    <style type="text/css">
      td {
        font-family:serif;
        color:black;
      }
    </style>
  </head>
  <body class="body_background">
    <?php 
      include "include/marquee.php";
      include "navbar.php";
    ?>
    <div class="container back_img_for_marks" style="margin: 0 auto ; padding:20px ;">
      <div class = "col-md-6" style="padding-left:8%;text-align:center">   
        <br/><br/><div id="fixheadertable" class="table-responsive table_to_fix_with_device" >          
          <table  class="table" >
            <thead style="background-color: #009879;">
              <tr >
                <th style="text-align:center">TEST</th>
                <th style="text-align:center">SUBJECT</th>
                <th style="text-align:center">RESULT</th>
              </tr>
            </thead style="background-color: #009879">
            <tbody class="color_do" style="text-align:center;">
              <?php  
                require "include/config.inc.php";
                $query = "SELECT DISTINCT paper_name FROM marks WHERE ".$_SESSION['user_ID']." IS NOT NULL";
                $query_run = mysqli_query($con,$query);
                while($rows = mysqli_fetch_assoc($query_run))
                {
                  $query = "SELECT subject FROM marks WHERE paper_name = '".$rows['paper_name']."' AND ".$_SESSION['user_ID']." IS NOT NULL";
                  $query_run_local = mysqli_query($con,$query);
                    echo "<tr>";
                    $paper_name = explode("@", $rows['paper_name']);
                    echo "<td class='color_white'>".$paper_name[0]."</td>";
                    if(mysqli_num_rows($query_run_local) > 1)
                    {
                      echo "<td class='color_white'>MULTIPLE</td>";
                    }
                    else {
                      $local = mysqli_fetch_array($query_run_local,MYSQLI_ASSOC);
                      echo "<td class='color_white'>".$local['subject']."</td>";  
                    }
                    
                    echo "<td class='color_white'><button class='btn btn-success' value='".$rows['paper_name']."' onclick='showmarks(this)'>SHOW</button></td>";
                    echo "</tr>";
                  }
              ?>
            </tbody>
          </table>
        </div>
         
      </div>      
      <div  class="col-md-6" style="padding-left:8%;text-align:center">
        <div id="showmarkswithcommand" class="table_to_fix_with_device"></div>
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
     
      function showmarks(win) {
            $('#myModal_on_load').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                });
        $.post("include/student_marks_show.php",{post_data:win.value},
        function(data) {
          $('#showmarkswithcommand').html(data);
          $("#myModal_on_load").modal("hide");
          $("html, body").animate({ scrollTop: document.body.scrollHeight }, "slow");
        });
      }
    </script>
  </body>
</html>