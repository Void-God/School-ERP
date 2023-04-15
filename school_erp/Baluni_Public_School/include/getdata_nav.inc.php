<?php
    error_reporting(0);
  $name = $_POST['post_user'];
  if($name == 'student')
  {
    echo '
      class :';
    require "config.inc.php";
    $query = "SELECT class_section FROM classes";
    $query_run = mysqli_query($con,$query);
    echo "<select name='user_class' required>";
      echo "<option value=''></option>"; 
    while ($row = mysqli_fetch_assoc($query_run)) {                    
      echo "<option value= '".$row["class_section"]."'>".$row["class_section"]."</option>";                    
    }                  
    echo "</select><br/><br/>";
     echo '
      Name of Father:
        <input type="text" name="f_Name" required><br/><br/>
      Name of Mother:
        <input type="text" name="m_Name" required><br/><br/>
      Parent/Guardian Mobile Number:
        <input type="number" name="par_mobile" required><br/><br/>
      ';
  }
  else
  {
    echo '
    Subject:';
    require "config.inc.php";
    $query = "SELECT subject FROM subjects";
    $query_run = mysqli_query($con,$query);
    echo "<select name='subject'>";
    while ($row = mysqli_fetch_assoc($query_run)) {                    
      echo "<option value= '".$row["subject"]."'>".$row["subject"]."</option>";                    
    }                  
    echo "</select><br/><br/>";
  }
?>