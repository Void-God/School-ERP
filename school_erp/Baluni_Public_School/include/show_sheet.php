<?php 
  error_reporting(0);
  session_start();
  include "config.inc.php";
  $test = $_POST['post_name']."@".$_POST['post_class'];
  $class = $_POST['post_class'];
  $query = "SELECT paper_id FROM marks WHERE paper_name = '".$test."' AND teacher_ID = '".$_SESSION['user_ID']."'";
  $query_run = mysqli_query($con,$query);
  if(mysqli_num_rows($query_run) == 0 ) {
    echo "<br/><h2 class='color_white'>".$test."</h2>";
    echo "<form action='include/submit_marks.php' method='post'>";
    echo "<input type='hidden' name='set_class' value='".$class."'>
          <input type='hidden' name='name_of_test' value='".$test."' />
    ";
    echo "<span class='color_white'>Maximum Marks:</span>
          <input type='number' name='M_M_T' style='width:50px' required/><br/>
          <span class='color_white'>Passing Marks:</span>
          <input type='number' name='P_M_T' style='width:50px' required/><br/>";
    echo '<div id="fixheadertable00" style="overflow:auto;height:300px" class="table-responsive table_to_fix_with_device" >          
            <table  class="table">
              <thead style="background-color: #009879;">
                <tr >
                  <th style="text-align:center">USER ID</th>
                  <th style="text-align:center">Name</th>
                  <th style="text-align:center">M.O.</th>
                </tr>
              </thead style="background-color: #009879">
              <tbody class="color_do" style="text-align:center;">';
                $query = "SELECT user_ID, user_Name FROM students WHERE class_section = '".$class."' ORDER BY user_Name";
                $query_run = mysqli_query($con,$query);
                while ($rows = mysqli_fetch_assoc($query_run)){
                  echo '
                      <tr >
                        <th class="color_white" style="text-align:center">'.$rows['user_ID'].'</th>
                        <th class="color_white" style="text-align:center">'.$rows['user_Name'].'</th>
                        <th style="text-align:center;color:black;"><input type="number" name="MARKS'.$rows['user_ID'].'" value="" style="width:45px;" required/></th>
                      </tr>
                  ';
                }           
    echo '    </tbody>
            </table>
            <input type="submit" class="btn btn-success" value="Upload" name="submit"/>
          </div>
        </div>';

    echo "</form>";

        echo '<script>document.getElementById("fixheadertable00").addEventListener("scroll", function(){
            var translate = "translate(0,"+this.scrollTop+"px)";
            this.querySelector("thead").style.transform = translate;
          });</script>';
  }
  else {
    echo '<script type="text/javascript">alert("Try some other Name!")</script>';
  }
 


?>
