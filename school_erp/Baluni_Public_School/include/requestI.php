<?php 
    error_reporting(0);
  require "config.inc.php";
  $search = $_POST['post_user'];
  $flag = 0;
  $query = "SELECT * FROM cp_request";
  $query_run = mysqli_query($con,$query);
  while($row = mysqli_fetch_assoc($query_run))
  {
    $query = "SELECT user_Name FROM ".$row['type']."s WHERE user_ID = '".$row['user_ID']."'";
    $query_run1 = mysqli_query($con,$query);
    $rows = mysqli_fetch_array($query_run1,MYSQLI_ASSOC);
    if($row['user_ID'] == $search || strpos(strtolower($rows['user_Name']),strtolower($search)) !== false)
    {
        echo '<div style="border : 1px solid black;padding:10px">';
        echo '<form action="include/request_pc.php" method="post" onsubmit="process_pop();">';
        echo 'Request :<br/>
        <input type="text" class="hide" name="user_ID" value="'.$row['user_ID'].'"/>
        <input type="text" class="hide" name="password" value="'.$row['pass_word'].'"/> 
        User ID : '.$row['user_ID'].'<br/>
        User Name : '.$rows['user_Name'].'<br/>
        Password Requested : '.$row['pass_word'].'<br/>
        Do you want to accept request : 
          <select name = "request">
          <option value="no">No</option>
          <option value="yes">Yes</option>
        </select>
        <input type="submit" name="submit" value="Perform">
        ';
        echo '</form>';
      echo '</div>';
      $flag = 1;    
    }
  }
  if($flag == 0)
  {
    echo '<script type="text/javascript">alert("Request not Found!")</script>';
  }
?>
