<?php 
  error_reporting(0);
    session_start();
    $test = $_POST['post_test'];

    $detail = explode("@", $test);
    require "config.inc.php";
    echo "<h1 class='color_white'>".$detail[1]."</h1>";

    $flag = 0;
    $query = "SELECT * FROM marks WHERE paper_id = '".$detail[0]."'";
    $query_run = mysqli_query($con,$query);
    $rows = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
      foreach ($rows as $key => $value) {
        if($key != 'passing_marks' AND $key != 'paper_id' AND $key != 'teacher_ID' AND $key != 'subject' AND $key != 'paper_name') {
          if(!(is_null($value))){
            $num = explode(',',$value);
            $count = sizeof($num);
            if($count == 1){
              $flag = 1;
            }
            else{
              $flag = 2;
              break;
            }
          }
        }
      }
    if($flag == 1)
    {
        echo'<br/><div id="fixheadertable001" style="height:300px" class="table-responsive table_to_fix_with_device" >          
          <table  class="table" >
            <thead style="background-color: #009879;">
              <tr >
                <th style="text-align:center">ID</th>
                <th style="text-align:center">STUDENT</th>
                <th style="text-align:center">RESULT</th>
              </tr>
            </thead style="background-color: #009879">
            <tbody class="color_do" style="text-align:center;">';  
            foreach ($rows as $key => $value){
              if(!(is_null($value)))
              {
                if($key != 'passing_marks' AND $key != 'paper_id' AND $key != 'teacher_ID' AND $key != 'subject' AND $key != 'paper_name') {
                  $mark = explode( "/", $value);
                  $query = "SELECT user_Name FROM students WHERE user_ID = '$key'";
                  $query_run = mysqli_query($con,$query);
                  $temp = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
                  if($rows['passing_marks'] > $mark[0]){
                    $bg = "red";
                  }
                  else{
                    $bg = "green";
                  }
                  echo '
                    <tr style="background-color:'.$bg.'" >
                      <th class="color_white" style="text-align:center;">'.$key.'</th>
                      <th class="color_white" style="text-align:center">'.$temp['user_Name'].'</th>
                      <th class="color_white" style="text-align:center">'.$value.'</th>
                    </tr>
                  ';
                }
              }
            }     
              echo'
            </tbody>
          </table>
        </div>';
        echo "<h1 class='color_white'>Passing Marks-".$rows['passing_marks']."</h1>";
    }
    else {
        echo'<br/><br/><div id="fixheadertable001" style="height:300px" class="table-responsive table_to_fix_with_device" >          
          <table  class="table" >
            <thead style="background-color: #009879;">
              <tr >
                <th style="text-align:center">UserID</th>
                <th style="text-align:center">STUDENT</th>
                <th>PRAC.</th>
                <th>THEORY</th>
                <th style="text-align:center">Total</th>
              </tr>
            </thead style="background-color: #009879">
            <tbody class="color_do" style="text-align:center;">';  
            foreach ($rows as $key => $value){
              if(!(is_null($value)))
              {
                if($key != 'passing_marks' AND $key != 'paper_id' AND $key != 'teacher_ID' AND $key != 'subject' AND $key != 'paper_name') {
                  $mark = explode( ",", $value);
                  $left = explode("/", $mark[0]);
                  $right = explode("/", $mark[1]);
                  $query = "SELECT user_Name FROM students WHERE user_ID = '$key'";
                  $query_run = mysqli_query($con,$query);
                  $temp = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
                  $g_marks = (int) $left[0] + (int) $right[0] ;
                  if($rows['passing_marks'] > $g_marks){
                    $bg = "red";
                  }
                  else{
                    $bg = "green";
                  }
                  echo '
                    <tr style="background-color:'.$bg.'">
                      <th class="color_white" style="text-align:center">'.$key.'</th>
                      <th class="color_white" style="text-align:center">'.$temp['user_Name'].'</th>
                      <th class="color_white" style="text-align:center">'.$mark[0].'</th>
                      <th class="color_white" style="text-align:center">'.$mark[1].'</th>
                      <th class="color_white" style="text-align:center">'.$g_marks.'/'. ((int) $left[1] + (int) $right[1]) .'</th>
                    </tr>
                  ';
                }
              }
            }    
              echo'
            </tbody>
          </table>
        </div>';
        echo "<h1 class='color_white'>Passing Marks-".$rows['passing_marks']."</h1>";
    }


      echo '<script>document.getElementById("fixheadertable001").addEventListener("scroll", function(){
          var translate = "translate(0,"+this.scrollTop+"px)";
          this.querySelector("thead").style.transform = translate;
        });</script>';



?>
