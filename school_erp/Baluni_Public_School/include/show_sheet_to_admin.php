<?php 
  error_reporting(0);
require "config.inc.php";
$test = $_POST['post_name']."@".$_POST['post_class'];
$number = $_POST['post_number'];
$class = $_POST['post_class'];

echo '<br/><h4 class="color_white">'.$test.'</h4>';
echo '<div style="height:350px;width:95%;overflow-y:auto;">';     
          echo '<form action="include/submit_marks_by_admin.php" method="post">';
          echo '<input type="hidden" name="number_of_subject" value="'.$number.'">
                <input type="hidden" name="name_of_test" value="'.$test.'">';
            // $query = "SELECT subject FROM subjects";
            // echo "<div class='row' style='border:1px solid black;margin:5px;padding:5px'>";
            //   for($i=1;$i<=$number;$i++){
            //       echo "<span class='color_white'>Subject :".$i."</span>";
            //       echo "<select>";
            //       $query_run =mysqli_query($con,$query); 
            //         while($rows = mysqli_fetch_assoc($query_run)){
            //           echo "<option value='".$rows['subject']."'>".$rows['subject']."</option>";
            //         }
            //       echo "</select>";
            //   }
            // echo "</div>";
            $query = "SELECT user_Name,user_ID FROM teachers";
            $query1 = "SELECT user_Name,user_ID FROM admins"; 
            echo "<div class='row' style='border:1px solid black;margin:5px;padding:5px'>";
             for($i=1;$i<=$number;$i++){
                  echo "<span class='color_white'>Teacher ".$i.": </span>";
                  echo "<select name='teacher".$i."'>";
                  $query_run =mysqli_query($con,$query); 
                    while($rows = mysqli_fetch_assoc($query_run)){
                      echo "<option value='".$rows['user_ID']."'>".$rows['user_Name']."</option>";
                    }
                  $query_run =mysqli_query($con,$query1); 
                    while($rows = mysqli_fetch_assoc($query_run)){
                      echo "<option value='".$rows['user_ID']."'>".$rows['user_Name']."</option>";
                    }
                  echo "</select><br/><br/>"; 
                  echo "<span class='color_white'> M.M.:</span>
                  <input type='number' name='M_M_T".$i."' style='width:50px;height:22px' required/>
                  <span class='color_white'> P.M.:</span>
                  <input type='number' name='P_M_T".$i."' style='width:50px;height:22px' required/><br/><br/>";                            
              }
            echo "</div>";
            $query = "SELECT user_ID, user_Name FROM students WHERE class_section = '$class' ORDER BY user_Name";
            $query_run = mysqli_query($con,$query);
            while($rows = mysqli_fetch_assoc($query_run)){
            echo "<div class='row' style='border:1px solid black;margin:5px;padding:5px'>";
              echo "<P class='color_white'>USER ID : ".$rows['user_ID']."</P>";
              echo "<P class='color_white'>NAME : ".$rows['user_Name']."</P>";
              for($i=1;$i<=$number;$i++){ 
                echo "<span class='color_white'>Subject".$i.": </span>";
                echo "<input type='text' name='sub".$i."@".$rows['user_ID']."' required/></br></br>";                           
              }
            echo "</div>";
          }
            echo "<div class='row' style='border:1px solid black;margin:5px;padding:5px'>
              <input class='btn btn-success' type='submit' name='setto0' value='UPLOAD' />              
            </div>";

          echo '</form>'; 
echo '</div>';
          echo "<p class='color_white'>2 Ways to Fill Marks</p>";
          echo "<p class='color_white'>1. M.O.(P)    M.M.(P)    M.O.(T)    M.M.(T)</p><p class='color_white'>2. M.O.(T)</p>";

?>