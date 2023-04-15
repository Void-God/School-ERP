<?php
session_start();
error_reporting(0);
require "config.inc.php";
//$_SESSION['assigned_class'] 
$indicator = 1;
$date = $_POST['post_user'];
  $query = "SELECT user_ID,user_Name FROM students WHERE class_section = '".$_SESSION['assigned_class']."' ORDER BY user_Name";
  $query_run = mysqli_query($con,$query);
  $_SESSION['count'] = mysqli_num_rows($query_run);
                echo '<br/><form action="include/submit_attendance.php" method="post" onsubmit="process_pop()">';

      echo ' 
      <div id="fixheadertableAX" class="table-responsive table_to_fix_with_device" >         
          <table  class="table" >
            <thead style="background-color: #009879;width:100%">
              <tr >
                <th style="text-align:center">UserID</th>
                <th style="text-align:center">UserName</th>
                <th style="text-align:center">Status</th>
              </tr>
            </thead style="background-color: #009879">
            <tbody class="color_do" style="text-align:center;">';
        
                echo '<input type="date" name="date" value="'.date("Y-m-d", strtotime($date)).'" style="display:none" />';
                while($rows = mysqli_fetch_assoc($query_run))
                {
                  $query = "SELECT ".$rows['user_ID']." FROM attendance WHERE adate = '".date("Y-m-d", strtotime($date))."'";
                  echo "<input type='text' style='display:none;' name='".$indicator."' value='".$rows['user_ID']."'/>";
                  $query_drive = mysqli_query($con,$query);
                  $row = mysqli_fetch_array($query_drive,MYSQLI_ASSOC);
                  if($row[$rows['user_ID']] == "N/A")
                  {
                    $_SESSION['message'] = 19;
                    echo '<script type="text/javascript">alert("Restricted by Admin")</script>';
                    exit();
                  }
                  
                      if(is_null($row[$rows['user_ID']]) OR $row[$rows['user_ID']] == 'N/A')
                      {
                        echo "<tr>";
                          echo "<th class='color_white'>";
                            echo $rows['user_ID'];
                          echo "</th>";
                          echo "<th class='color_white'>";
                            echo $rows['user_Name'];
                          echo "</th>";
                          echo "<th style='color:black'>";
                        echo '<select name="att'.$rows['user_ID'].'" required>
                          <option value="P">P</option>
                          <option value="A">A</option>
                        </select><th/>';
                      }
                      else if($row[$rows['user_ID']] == 'P')
                      {
                        echo "<tr style='background-color:green'>";
                          echo "<th class='color_white'>";
                            echo $rows['user_ID'];
                          echo "</th>";
                          echo "<th class='color_white'>";
                            echo $rows['user_Name'];
                          echo "</th>";
                          echo "<th style='color:black'>";
                        echo '<select name="att'.$rows['user_ID'].'" required>
                          <option value="P">P</option>
                          <option value="A">A</option>
                        </select><th/>';
                      }
                      else if($row[$rows['user_ID']] == 'A')
                      {
                        echo "<tr style='background-color:red'>";
                          echo "<th class='color_white'>";
                            echo $rows['user_ID'];
                          echo "</th>";
                          echo "<th class='color_white'>";
                            echo $rows['user_Name'];
                          echo "</th>";
                          echo "<th style='color:black'>";
                        echo '<select name="att'.$rows['user_ID'].'" required>
                          <option value="A">A</option>
                          <option value="P">P</option>
                        </select><th/>';
                      }
                    echo "</th>";
                  echo "</tr>";
                  $indicator++;
                }            
            echo" 
            </tbody>
          </table>
          <input type='submit' class='btn btn-default' name='submit' value='Submit'/>
          </div>";
           echo "</form>";


    echo '<script type="text/javascript">
      document.getElementById("fixheadertableAX").addEventListener("scroll", function(){
       var translate = "translate(0,"+this.scrollTop+"px)";
       this.querySelector("thead").style.transform = translate;
    });
    </script>';
 ?>
