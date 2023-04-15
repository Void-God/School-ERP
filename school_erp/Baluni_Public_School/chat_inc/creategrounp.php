<?php 
session_start();
if(isset($_POST['submit@08']))
{
  echo "wait...";
  if(!empty($_POST['class'])) {
    error_reporting(0);
    include "config.inc.php";
    $classes = join(",", $_POST['class']);
    $name = $_POST['dis_name'];
    $query = "INSERT INTO discussions(dis_Name,admin,classes,admin_Name) VALUES('".$name."','".$_SESSION['user_ID']."','".$classes."','".$_SESSION['user_Name']."')";
    if(mysqli_query($conn,$query)){
      $query = "SELECT dis_ID FROM discussions WHERE dis_Name = '".$name."' AND admin = '".$_SESSION['user_ID']."' AND classes = '".$classes."' ORDER BY dis_ID DESC";
      $query_run = mysqli_query($conn,$query);
      $row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
      $query = "CREATE TABLE chat_".$row['dis_ID']."(
        msg_num int PRIMARY KEY AUTO_INCREMENT,
        sender varchar(15) NOT NULL,
        sender_Name varchar(40) NOT NULL,
        msg varchar(500) NOT NULL
      );";
      if(mysqli_query($conn,$query)){
        $_SESSION['message'] = 47;
      }
      else{
        $_SESSION['message'] = 42;
      }
    }

    else {
      $_SESSION['message'] = 46;
    }
  }
  else{
    $_SESSION['message'] = 35;
  }
  if($_SESSION['type'] == 'teacher'){
    header("Location:/Baluni_Public_School/discussion_teacher.php");
  }
  else {
    header("Location:/Baluni_Public_School/admin_discussion.php");
  }
}

?>