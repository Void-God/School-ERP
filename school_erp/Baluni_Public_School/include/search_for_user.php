<?php
    error_reporting(0);
  $search = $_POST['post_data'];
  require "config.inc.php";
  $query = "SELECT user_ID, user_Name, class_section FROM students";
  $query_run = mysqli_query($con,$query);
  $flag = 0;

while($row = mysqli_fetch_assoc($query_run)){
  if($row['user_ID'] == $search || strpos(strtolower($row['user_Name']),strtolower($search)) !== false)
  {
    echo '<div style="border : 1px solid black;padding:10px">';
        echo "<form>";
          echo '<input type="text" style="display:none" id="data_on_set_stu_'.$flag.'" value='.$row['user_ID'].'></input>';
          echo '  UserID: '.$row['user_ID'].'<br/>
                  User Name: '.$row['user_Name'].'<br/>
                  Class: '.$row['class_section'].'<br/>
                  Class to Assign: 
                  ';
          $query = "SELECT class_section FROM classes";
          $query_for = mysqli_query($con,$query);
          echo '<select id="class_to_assign_stu_'.$flag.'" >';
          while ($rows = mysqli_fetch_assoc($query_for))
          {
            echo '<option value="'.$rows['class_section'].'">'.$rows['class_section'].'</option>';
          }
          echo '</select>';
          echo '<button class="btn btn-success" type="button" onclick="changeclassnow('.$flag.')">CHANGE</button>';

          echo '</form>';
        echo '</div>';
        $flag += 1;
  }
}

if($flag == 0)
{
  echo '<script>alert("Details does not Match!")</script>';
}


?>
