<?php 
    error_reporting(0);
  $department = $_POST['post_user'];
  require "config.inc.php";
  $query = "SELECT user_Name FROM teachers WHERE department = '$department' OR department = 'both' ";
  $query_run = mysqli_query($con,$query);
  $query = "SELECT user_Name FROM admins department = '$department' OR department = 'both' ";
  $query_run1 = mysqli_query($con,$query);
  echo'
    class teacher : ';
  echo "<select name='teacher'>";
  while ($row = mysqli_fetch_assoc($query_run)) {                    
    echo "<option value= '".$row["user_Name"]."'>".$row["user_Name"]."</option>";                    
  }
  while ($row = mysqli_fetch_assoc($query_run1)) {                    
    echo "<option value= '".$row["user_Name"]."'>".$row["user_Name"]."</option>";                    
  }
  echo "</select><br></br>";
?>