<?php 
    error_reporting(0);
  require "config.inc.php";
  $search = $_POST['post_data'];
  $flag = 0;



  $query = "SELECT user_ID, user_Name, father_Name, class_section, mobile, par_mobile FROM students";
  $query1 = "SELECT user_ID, user_Name, subject FROM teachers";

  $query_run = mysqli_query($con,$query);

  while( $row = mysqli_fetch_assoc($query_run))
  {
    if($row['user_ID'] == $search || strpos(strtolower($row['user_Name']),strtolower($search)) !== false) {
      echo '<div style="border : 1px solid black;padding:10px">';
        echo 'Details(STUDENT) :<br/>
        UserID: '.$row['user_ID'].'<br/>
        Class: '.$row['class_section'].'<br/>
        UserName: '.$row['user_Name'].'<br/>        
        Name of Father: '.$row['father_Name'].'<br/>
        Moblie Number of User: '.$row['mobile'].'<br/>
        Moblie Number of Parents/Guardian: '.$row['par_mobile'].'<br/>
        ';
      echo '</div>';
      $flag = 1;
    }
  }

  $query_run = mysqli_query($con,$query1);

  while( $row = mysqli_fetch_assoc($query_run))
  {
    if($row['user_ID'] == $search || strpos(strtolower($row['user_Name']),strtolower($search)) !== false) {
      echo '<div style="border : 1px solid black;padding:10px">';
        echo 'Details(TEACHER) :   <br/>
        <input type="text" class="hide" name="user_ID" value="'.$row['user_ID'].'"/> 
        User ID : '.$row['user_ID'].'<br/>
        User Name : '.$row['user_Name'].'<br/>
        Subject : '.$row['subject'].'<br/>';
      echo '</div><br/>';
      $flag = 1;
    }
  }
  if($flag == 0)
  {
    echo '<script>alert("Result not Found!");</script>';
  }

?>
