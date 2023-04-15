<?php 

if(isset($_POST['post_marks'])){
  error_reporting(0);
  require "config.inc.php";


  $marks = $_POST['post_marks'];
  $id = $_POST['post_id'];
  $test_id = $_POST['post_testId'];

  

  $add_dots = explode(" ", $marks);
  if(count($add_dots) == 2) {
      for($i=0;$i<2;$i++) {
        if(!(is_numeric($add_dots[$i])))
        {
          echo "<script>alert('Wrong Input! Try Again...')</script>";
          exit(); 
        }
      }

    $query = "UPDATE marks SET ".$id." = '".$add_dots[0]."/".$add_dots[1]."' WHERE paper_id = '".$test_id."'"; 
    if(mysqli_query($con,$query)){
       echo "<script>alert('Successfully Uploaded!')</script>";
    }
    else{
      echo "<script>alert('Oops! Some problem Occured Please Try Again!')</script>";
    }
  }
  else if(count($add_dots) == 4) {
      for($i=0;$i<4;$i++) {
        if(!(is_numeric($add_dots[$i])))
        {
          echo "<script>alert('Wrong Input! Try Again...')</script>";
          exit(); 
        }
      }
    $query = "UPDATE marks SET ".$id." = '".$add_dots[0]."/".$add_dots[1].",".$add_dots[2]."/".$add_dots[3]."' WHERE paper_id = '".$test_id."'"; 
    if(mysqli_query($con,$query)){
       echo "<script>alert('Successfully Uploaded!')</script>";
    }
    else{
      echo "<script>alert('Oops! Some problem Occured Please Try Again!')</script>";
    }
  }
  else {
    echo "<script>alert('Wrong Number of Input! Try Again...')</script>";
  }

}
else {
  echo "do not touch";
}

?>