<?php 
    error_reporting(0);
  require "config.inc.php";
  $query = "SELECT * FROM cp_request";
  $query_run = mysqli_query($con,$query);
  $count = 1;
  if(mysqli_num_rows($query_run) == 0)
  {
    echo '<script type="text/javascript">alert("No Request Found!")</script>';
    exit();
  }
  while($row = mysqli_fetch_assoc($query_run))
  {
    $query = "SELECT user_Name FROM ".$row['type']."s WHERE user_ID = '".$row['user_ID']."'";
    $query_run1 = mysqli_query($con,$query);
    $rows = mysqli_fetch_array($query_run1,MYSQLI_ASSOC);
    echo "<div class='row' style='border:1px solid black;margin:5px;padding:5px'>";
      echo '<form action="include/request_pc.php" method="post" onsubmit="process_pop();">';
      echo 'Request : '.$count .'<br/> 
      <input type="text" class="hide" name="user_ID" value="'.$row['user_ID'].'"/>
      <input type="password" class="hide" name="password" value="'.$row['pass_word'].'"/>
      UserID: '.$row['user_ID'].'<br/>
      UserName: '.$rows['user_Name'].'<br/>
      Password Requested: '.$row['pass_word'].'<br/>
      Do you want to Accept Request? : 
      <select name = "request">
        <option value="no">No</option>
        <option value="yes">Yes</option>
      </select>
      <input type="submit" name="submit" value="Perform">
      ';
      echo '</form>'; 
    echo "</div>";
    $count += 1;
  }

?>
