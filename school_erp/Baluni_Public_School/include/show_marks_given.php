<?php 
  error_reporting(0);
if(isset($_POST['post_id'])){
  require "config.inc.php";
  $id = $_POST['post_id'];
  $paper = $_POST['post_paperid'];

  $query = "SELECT user_Name FROM students WHERE user_ID = '$id'";
  $query_run = mysqli_query($con,$query);
  if(mysqli_num_rows($query_run) == 1 ){
    $rows = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
    $query = "SELECT paper_name,subject,$id FROM marks WHERE paper_id = '$paper'";
    $query_run = mysqli_query($con,$query);
    $row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
    if(is_null($row[$id])){
      echo '<script type="text/javascript">alert("Not Available For Given Student!")</script>';
    }
    else {
      echo '<div style="border : 1px solid black;padding:10px">';
        echo '<form>';
        echo '<b>Change Marks</b> <br/> <br/>
        UserID: '.$id.'<br/><br/>
        User Name:'.$rows['user_Name'].'<br/><br/>'; 
        $marks = explode(",",$row[$id]);
        if(count($marks) == 1)
        {
          $net_marks = explode("/",$marks[0]);
          echo "Marks : <input id='markss_to_change' type='text' value='".$net_marks[0]." ".$net_marks[1]."' /><br/>";
        }
        else if(count($marks) == 2)
        {
          $left = explode("/",$marks[0]);
          $right = explode("/",$marks[1]);
          echo "Marks : <input id='markss_to_change' type='text' value='".$left[0]." ".$left[1]." ".$right[0]." ".$right[1]."' /></br>";
        }
        echo "<input id='idd_for_marks' type='hidden' value='".$id."'>
            <input id='tests_for_marks' type='hidden' value='".$paper."'>
        ";
        echo "<input id='permissiontomark' type='checkbox' value='permission'> Are You sure You Want to Change Marks?<br/>";
        echo '<button class="btn btn-success" type="button" name="submit" value="Change" onclick="changethemarks()">Change</button>
        ';
        echo '</form>';
      echo '<div>'; 
    }
  }
  else {
    echo '<script type="text/javascript">alert("Student Not Found!")</script>';
  }
}




?>