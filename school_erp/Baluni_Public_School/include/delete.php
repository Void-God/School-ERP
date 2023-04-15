<?php 
  error_reporting(0);
  session_start();
  require "config.inc.php";
  $delete = $_POST['post_data'];
  $size = 0;
  if($delete == 'deletealldata')
  {
    $flag = 0;
    $query = "SELECT file_name FROM notes WHERE user_ID = '".$_SESSION['user_ID']."'";
    $query_run = mysqli_query($con,$query);
    while($rows = mysqli_fetch_assoc($query_run)){
      $pointer = "notes/".$rows['file_name'];
      $size = (int) ($size + (filesize($pointer)/1024));
      $query = "DELETE FROM notes WHERE file_name = '".$rows['file_name']."'";
      if(mysqli_query($con,$query))
      {
        if(file_exists($pointer)){
          unlink($pointer);
        }
        $flag++;
      }
      else
      {
        echo '<script type="text/javascript">alert("Oops! Some error has Occured. Please Try Again!")</script>';
        exit();
      }
    }
        $query = "SELECT info FROM notice WHERE notice_def = 2";
        $query_run = mysqli_query($con,$query);
        $row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
        $prev_size = (int) $row['info'];
        $new_size = $prev_size - $size;
        $query = "UPDATE notice SET info = '$new_size' WHERE notice_def = 2";
        mysqli_query($con,$query);
    echo "<script type='text/javascript'>$('#divtorefresh').load(document.URL +  ' #divtorefresh')</script>;";
    echo  '<script type="text/javascript">alert("'.$flag.' Files have been Deleted!")</script>';
  }
  else {
    $pointer = "notes/".$delete;

    $query = "DELETE FROM notes WHERE file_name = '$delete'";


    if(mysqli_query($con,$query)){
      if(file_exists($pointer)){
        $size = (int) (filesize($pointer)/1024);
        unlink($pointer);
      }
        $query = "SELECT info FROM notice WHERE notice_def = 2";
        $query_run = mysqli_query($con,$query);
        $row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
        $prev_size = (int) $row['info'];
        $new_size = $prev_size - $size;
        $query = "UPDATE notice SET info = '$new_size' WHERE notice_def = 2";
        mysqli_query($con,$query); 
      echo "<script type='text/javascript'>$('#divtorefresh').load(document.URL +  ' #divtorefresh')</script>;";
      echo '<script type="text/javascript">alert(" Files Deleted Successfully!")</script>'; 
    }
    else{
      echo '<script type="text/javascript">alert("Please Try Again...")</script>'; 
    }
  }
?>
