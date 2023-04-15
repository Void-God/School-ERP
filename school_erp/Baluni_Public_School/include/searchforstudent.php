<?php
  error_reporting(0);
  session_start();
  require "config.inc.php";
  require "allfunction.php";
  $search = $_POST['post_user'];
  $query = "SELECT user_ID,user_Name FROM students WHERE class_section = '".$_SESSION['assigned_class']."'";
  $flag = 0;
  $query_run = mysqli_query($con,$query);
  echo "<div style='width:100%;height:450px;overflow-y:auto;overflow-x:hidden'>";
    while($row = mysqli_fetch_assoc($query_run))
  {
    if($row['user_ID'] == $search || strpos(strtolower($row['user_Name']),strtolower($search)) !== false)
    {
                attendance_data($row['user_ID']);
          percetage_data($row['user_ID']);

      echo'  <div id="fixheadertable00" class="table-responsive table_to_fix_with_device" >          
          <table  class="table" >
            <thead style="background-color: #009879;">
              <tr >
                <th style="text-align:center">Date</th>
                <th style="text-align:center">Day</th>
                <th style="text-align:center">Attendance</th>
              </tr>
            </thead style="background-color: #009879">
            <tbody class="color_do" style="text-align:center;">';
 
                  attendance_table($row['user_ID']);
        echo '
            </tbody>
          </table>
        </div>';
      $flag = 1;    
    }
  }
  echo "</div>";
  if($flag == 0)
  {
    echo '<script>alert("Student not Found!")</script>';
  }

 ?> 
