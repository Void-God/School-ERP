<?php 
  if(isset($_POST['submit@00'])){
      error_reporting(0);
    require "config.inc.php";
    session_start();
    if(!empty($_POST['class'])) {
      $classes = join(",", $_POST['class']);
      $comment = $_POST['comment'];
      $fileName = $_FILES['file']['name'];
      $fileSize = $_FILES['file']['size'];
      $fileExplode = explode('.', $fileName);
      $fileExt = strtolower(end($fileExplode));

      $allowed = array('mp4','pdf','docx','zip');

      if(in_array($fileExt, $allowed))
      {
        $query = "SELECT info FROM notice WHERE notice_def = 2";
        $query_run = mysqli_query($con,$query);
        $row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
        $size = (int) $row['info'];
        $new_size = (int) ($size + ($_FILES['file']['size']/1024));
        if($new_size < 52428880) {
          if($_FILES['file']['error'] === 0){
            if($_FILES['file']['size'] < 131072000){
              $newName = uniqid('',true).".".$fileExt;
              $filedes = "notes/".$newName;
              move_uploaded_file($_FILES['file']['tmp_name'] , $filedes);
              $query = "INSERT INTO notes(user_ID,subject,classes,file_name,comment) values('".$_SESSION[
                'user_ID']."','".$_SESSION['subject']."','".$classes."','".$newName."','".$comment."')";
              if(mysqli_query($con,$query))
              {  
                $query = "UPDATE notice SET info = '$new_size' WHERE notice_def = 2";
                mysqli_query($con,$query);            
                $_SESSION['message'] = 31;
              }
              else
              {
                $_SESSION['message'] = 32;
              }
            }
            else
            {
              $_SESSION['message'] = 33;
            }
          }  
          else
          {
            $_SESSION['message'] = 32;
          }
        }
        else {
          $_SESSION['message'] = 45;
        }    
      }
      else
      {
         $_SESSION['message'] = 34;
      }
    }
    else {
      $_SESSION['message'] = 35;
    }

    header("Location:/Baluni_Public_School/home.php");
    unset($_POST['submit@00']);
  }
  else {
   header("Location:/Baluni_Public_School/logout.php"); 
  }


?>