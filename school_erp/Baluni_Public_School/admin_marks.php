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
<html oncontextmenu="return false;">
  <head>
    <title>Marks</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link rel="icon" href="images/favicon/mark.png">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css"> 
    <link rel="stylesheet" type="text/css" href="css/table.css">
  </head>
  <body class="body_background">
    <?php 
      include "include/marquee.php";
      include "admin_navbar.php";
    ?>
    <div class="container back_img_for_marks" style="margin: 0 auto ; padding:20px ;">
      <div class = "col-md-6" style="padding-left:8%;text-align:center">   
        <br/><br/><div id="fixheadertable" class="table_to_fix_with_device" >          
          <h1 class="color_white" style="text-align:center;">OPTIONS</h1>
          <h4 class="color_white">Set Test</h4>
          <form>
            <span class="color_white">Fill Details Carefully</span><br/>
            <span class="color_white">Test Name:</span> 
            <input id="name_the_test" type="text"/><br/>
            
            <span class="color_white">Number of Subjects: </span>
            <input id="giving_number" type="number"/><br/>
            
            <span class="color_white">Class:</span>
            <select id="classtomark_byadmin">
              <?php
                require "include/config.inc.php";
                $query = "SELECT class_section FROM classes";
                $query_run = mysqli_query($con,$query) ;
                while($rows = mysqli_fetch_assoc($query_run)){
                  if($rows['class_section'] != 'N/A') {
                    echo "<option value='".$rows['class_section']."'>".$rows['class_section']."</option>";
                  }
                }
              ?>
            </select><br/>
            
            <button type="button" class="btn btn-success" onclick="showsheetnow_toadmin()">SHOW SHEET</button>
          </form><hr/>
          <span class="color_white">CHECK TEST</span><br/>
          <span class="color_white">SELECT</span>
          <select id="selected_sheet_to_show">
            <option value=""></option>
            <?php 
              require "include/config.inc.php"; 
              $query = "SELECT paper_id,paper_name,subject FROM marks ";
              $query_run = mysqli_query($con,$query);
              while($rows = mysqli_fetch_assoc($query_run)){
                echo "<option value ='".$rows['paper_id']."@".$rows['paper_name']."'>".$rows['paper_name']."@".$rows['subject']."</option>";
              } 
            ?>
          </select><br/><br/>
          <button class="btn btn-success" onclick="admin_given_marks()">SHOW RESULT</button>
        </div>         
      </div>      
      <div  class="col-md-6" style="padding-left:8%;text-align:center">
        <div id="pastesheetnow_au_admin"></div>
      </div>
    </div>
    <script type="text/javascript">
      document.getElementById("fixheadertable").addEventListener("scroll", function(){
   var translate = "translate(0,"+this.scrollTop+"px)";
   this.querySelector("thead").style.transform = translate;
});
    </script> 
    <script type="text/javascript">
      function showsheetnow_toadmin() {
        var user = $('#name_the_test').val();
        var userd = $('#giving_number').val();
        var userdd = $('#classtomark_byadmin').val();
        if(!(user == "" || userd == "" || userdd == "")) {
            $('#myModal_on_load').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                });
          $.post("include/show_sheet_to_admin.php",{post_name:user,post_number:userd,post_class:userdd},
          function(data) {
            $('#pastesheetnow_au_admin').html(data);
            $("#myModal_on_load").modal("hide");
            $("html, body").animate({ scrollTop: document.body.scrollHeight }, "slow");
          });
        }
        else {
            alert('Some Details are Incomplete!'); 
        }
      }

      function admin_given_marks() {
        var user = $('#selected_sheet_to_show').val();
        if(user == "")
        {
          alert("Select Test")
        }
        else {
            $('#myModal_on_load').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                });
            $.post("include/show_sheet_updated.php",{post_test:user},
            function(data) {
              $('#pastesheetnow_au_admin').html(data);
              $("#myModal_on_load").modal("hide");
              $("html, body").animate({ scrollTop: document.body.scrollHeight }, "slow");
            });
        }
      }
    </script>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/onload_this.js"></script>
  </body>
</html>
