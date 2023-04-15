<?php 
  session_start();
  error_reporting(0);
  if(isset($_POST['chat_group'])){
    require "config.inc.php";
    $group = $_POST['chat_group'];
    $check = -1;
    if($_SESSION['type'] == 'teacher'){
      $query = "SELECT admin FROM discussions WHERE dis_ID = '$group'";
      $query_run = mysqli_query($conn,$query);
      $row = mysqli_fetch_array($query_run);
      if($row['admin']==$_SESSION['user_ID']){
        $check = 1;
      }
    }
    else if($_SESSION['type'] == 'student'){
      $query = "SELECT classes FROM discussions WHERE dis_ID = '$group'";
      $query_run = mysqli_query($conn,$query);
      $row = mysqli_fetch_array($query_run);
      $valid = explode(",", $row['classes']);
      if(in_array($_SESSION['class'], $valid)){
        $check = 2;
      }
    }
    else if ($_SESSION['type'] == 'admin'){
      $check = 3;
    }
    if($check == -1) {
      echo '<script>alert("Permission Denied!")</script>';
      exit();
    }    
    $query= "SELECT sender,sender_Name,msg FROM chat_$group;";
    $query_run = mysqli_query($conn,$query);
    while($rows = mysqli_fetch_assoc($query_run)){
      if($rows['sender'] == $_SESSION['user_ID']){
        echo '<div class="row">
          <div class="row_match padd_12 mine">
            <p class="color_black">'.$rows['msg'].'</p>  
          </div> 
        </div>';
      }
      else{
        echo '<div class="row">
          <div class="row_match your">
            <div class="row" style="border-bottom:1px black solid"><h6 class="text-center"><b>'.$rows['sender_Name'].'</b></h6></div>
            <p class="color_black">'.$rows['msg'].'</p>  
          </div> 
        </div>';
      }
    }
  }
?>

<!-- <script type="text/javascript">
    function change_height_now() {
      if ($('#repeat_algo').prop('scrollHeight') > 900 ){
      //if 'true', the content overflows the tab: we show the hidden link
        $("#repeat_algo").addClass("container_new_not_900");
      }
    }





  $(document).ready(function(){
          setInterval(function() {
             refresh_chat();
          }, 60000);
    })
</script> -->
