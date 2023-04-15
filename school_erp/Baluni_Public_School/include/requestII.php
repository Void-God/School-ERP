<?php  
    error_reporting(0);
  echo '<div style="border : 1px solid black;padding:10px">';
    echo '<form action="include/cp.php" method="post" onsubmit="process_pop();">';
    echo '<b>Request :</b><br/> 
    UserID: <input type="text" name="user_ID"/><br/>
    Password: <input type="password" name="password"/><br/>
    Confirm Password: <input type="password" name="cpassword"/>
    <input class="btn btn-success" type="submit" name="submit" value="Upload">
    ';
    echo '</form>';
  echo '<div>';
?>
