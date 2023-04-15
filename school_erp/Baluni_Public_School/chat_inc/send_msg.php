<?php 
if(isset($_POST['msg_given'])){
  error_reporting(0);
  session_start();
  require "config.inc.php";
  $msg = $_POST['msg_given'];
  $group = $_POST['chat_group'];
  $query = "INSERT INTO chat_".$group." (sender,sender_Name,msg) VALUES('".$_SESSION['user_ID']."','".$_SESSION['user_Name']."','".$msg."')";
  $query_run = mysqli_query($conn,$query); 
}
?>