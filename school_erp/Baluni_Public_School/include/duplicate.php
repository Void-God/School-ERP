<?php 
error_reporting(0);
require "config.inc.php";
$flag = 0 ;

$query = "SELECT mobile FROM students";

$query_run = mysqli_query($con,$query);

while($rows = mysqli_fetch_assoc($query_run)){
  $query = "SELECT DISTINCT user_Name,mobile,par_mobile FROM students WHERE mobile = '".$rows['mobile']."' OR par_mobile = '".$rows['mobile']."'";
  $query_run_local = mysqli_query($con,$query);
  if(mysqli_num_rows($query_run_local) > 1) {

    echo '<br/><br/><div class="table-responsive table_to_fix_with_device" style="border : 1px solid black;padding:10px;height:auto;width:auto">';
          echo '<table  class="table" >
            <thead style="background-color: #009879;">
              <tr >
                <th style="text-align:center">User Name</th>
                <th style="text-align:center">Mobile</th>
                <th style="text-align:center">Par./Guar. Mobile</th>
              </tr>
            </thead style="background-color: #009879">
            <tbody class="color_do" style="text-align:center;">';
          while($now = mysqli_fetch_assoc($query_run_local)){
            echo '
              <tr >
                <th style="text-align:center;color:red">'.$now['user_Name'].'</th>
                <th style="text-align:center;color:red">'.$now['mobile'].'</th>
                <th style="text-align:center;color:red">'.$now['par_mobile'].'</th>
              </tr>
            ';
          }                 
          echo '  </tbody>
          </table>';   
    echo '</div>';
  }
}


?>