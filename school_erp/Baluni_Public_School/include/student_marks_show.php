<?php 
  error_reporting(0);
  session_start();
  require "config.inc.php";
  $test = $_POST['post_data'];
  $M_M = 0;
  $S_M = 0;

  $real_test = explode("@", $test);
  echo "<br/><br/><h4 class='color_white' style='text-align:center'>".$real_test[0]."</h4>";
  $query = "SELECT subject, ".$_SESSION['user_ID']." FROM marks WHERE paper_name = '".$test."' AND ".$_SESSION['user_ID']." IS NOT NULL";
  $query_run = mysqli_query($con,$query);
  while($rows = mysqli_fetch_assoc($query_run)) {
    $check = explode(',',$rows[$_SESSION['user_ID']]);
    $num = count($check);
    if($num == 1) {
      $flag = 1;
    }
    else {
      $flag = 2;
      break;
    }
  }
  if($flag == 1) {
    echo '
            <table  class="table" style="width:90%">
              <thead style="background-color: #009879;">
                <tr >
                  <th style="text-align:center">SUBJECT</th>
                  <th style="text-align:center">M.O.</th>
                  <th style="text-align:center">M.M.</th>
                </tr>
              </thead style="background-color: #009879">
              <tbody class="color_do" style="text-align:center;">  '; 
                $query = "SELECT subject, ".$_SESSION['user_ID'].",passing_marks FROM marks WHERE paper_name = '".$test."' AND ".$_SESSION['user_ID']." IS NOT NULL";
                $query_run = mysqli_query($con,$query); 
                while($rows = mysqli_fetch_assoc($query_run)){
                  $marks = explode('/',$rows[$_SESSION['user_ID']]);
                if($rows['passing_marks'] > $marks[0])
                {
                  $bg = "red";
                }
                else{
                  $bg = "green";
                }
                echo '
                  <tr style="background-color:'.$bg.'" >
                    <th class="color_white" style="text-align:center">'.$rows['subject'].'</th>
                    <th class="color_white" style="text-align:center">'.$marks[0].'</th>
                    <th class="color_white" style="text-align:center">'.$marks[1].'</th>
                  </tr>
                ';
                $S_M += $marks[0];
                $M_M += $marks[1];  
                } 
                echo '             
                <tr style="background-color:wheat">
                    <th style="text-align:center;color:black">Total</th>
                    <th style="text-align:center;color:black">'.$S_M.'</th>
                    <th style="text-align:center;color:black">'.$M_M.'</th>
                  </tr>
                ';
           echo ' </tbody>';
  }
  else{
    echo '
            <table  class="table" style="width:90%">
              <thead style="background-color: #009879;">
                <tr >
                  <th style="text-align:center">Subject</th>
                  <th style="text-align:center">Prac</th>
                  <th style="text-align:center">Theory</th>
                  <th style="text-align:center">TOTAL</th>
                </tr>
              </thead style="background-color: #009879">
              <tbody class="color_do" style="text-align:center;">  '; 
                $query = "SELECT passing_marks, subject, ".$_SESSION['user_ID']." FROM marks WHERE paper_name = '".$test."' AND ".$_SESSION['user_ID']." IS NOT NULL";
                $query_run = mysqli_query($con,$query); 
                while($rows = mysqli_fetch_assoc($query_run)){
                  $marks = explode(',',$rows[$_SESSION['user_ID']]);
                  $num = count($marks);
                  if($num == 1){
                    $temp = explode("/",$marks[0]);
                    if($rows['passing_marks'] > $temp[0]) {$bg = "red";}
                    else {$bg = "green";}
                    echo '
                      <tr style="background-color:'.$bg.'">
                        <th class="color_white" style="text-align:center">'.$rows['subject'].'</th>
                        <th class="color_white" style="text-align:center"></th>
                        <th class="color_white" style="text-align:center">'.$marks[0].'</th>
                        <th class="color_white" style="text-align:center">'.$marks[0].'</th>
                      </tr>
                    ';
                    $S_M += $temp[0];
                    $M_M += $temp[1];
                  }
                  else {
                    $left = explode("/",$marks[0]);
                    $right = explode("/",$marks[1]);
                    $g_marks = (int) $left[0] + (int) $right[0]; 
                    $m_marks = (int) $left[1] + (int) $right[1];
                    if($rows['passing_marks'] > $g_marks){ $bg = "red";}
                    else{ $bg = "green";}
                    echo '
                      <tr style="background-color:'.$bg.'">
                        <th class="color_white" style="text-align:center">'.$rows['subject'].'</th>
                        <th class="color_white" style="text-align:center">'.$marks[0].'</th>
                        <th class="color_white" style="text-align:center">'.$marks[1].'</th>
                        <th class="color_white" style="text-align:center">'.$g_marks.'/'.$m_marks.'</th>
                      </tr>
                    ';
                    $S_M += $g_marks;
                    $M_M += $m_marks;
                  }  
                } 
                echo '             
                <tr style="background-color:wheat" >
                    <th  style="text-align:center;color:black"">Total</th>
                    <th class="color_white" style="text-align:center"></th>
                    <th class="color_white" style="text-align:center"></th>
                    <th style="text-align:center;color:black">'.$S_M."/".$M_M.'</th>
                  </tr>
                ';
           echo ' </tbody>';
  }


?>
