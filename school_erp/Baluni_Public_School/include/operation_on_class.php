<?php 
  error_reporting(0);
  $operation = $_POST['operation'];
  require "config.inc.php";

  if($operation == 'create' or $operation == 'update')
  {
    echo'     Name of class : ';
            if($operation == 'update')
            {
              $query = "SELECT class_section FROM classes";
              $query_run = mysqli_query($con,$query);
              echo "<select name='class' required>";
              echo " <option value='' ></option>";
              while($rows = mysqli_fetch_assoc($query_run)){
                  echo "<option value= '".$rows["class_section"]."'>".$rows["class_section"]."</option>";
              }
              echo "</select><br/><br/>";
            }
            else{
              echo '<input type="text" name="class" required/><br/><br/>';
            }
               

                  echo "Class Teacher : " ;
                  $query = "SELECT user_Name FROM teachers";
                  $query_run = mysqli_query($con,$query);
                  echo "<select name='teacher' required>";
                  echo " <option value='' ></option>";
                  while ($row = mysqli_fetch_assoc($query_run)) {                    
                  echo "<option value= '".$row["user_Name"]."'>".$row["user_Name"]."</option>";                 
                  }
                  echo "</select><br/><br/>";            
            
  }
  else 
  {
              echo'     Name of class : ';
              $query = "SELECT class_section FROM classes";
              $query_run = mysqli_query($con,$query);
              echo "<select name='class' required>";
              echo " <option value='' ></option>";
              while($rows = mysqli_fetch_assoc($query_run)){
                  echo "<option value= '".$rows["class_section"]."'>".$rows["class_section"]."</option>";
              }
  }

?>