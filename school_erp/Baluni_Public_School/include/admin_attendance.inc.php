<?php 
  session_start();
  error_reporting(0);
  $_SESSION['assigned_class'] = $_POST['post_data'];
  $given = $_POST['post_data'];
  echo '
  <br/><div id="fixheadertableX_Y" class="table-responsive table_to_fix_with_device">          
        <table  class="table" >
          <thead style="background-color: #009879;">
            <tr >
              <th style="text-align:center">Date</th>
            </tr>
          </thead style="background-color: #009879">
          <tbody class="color_do" style="text-align:center;">';
                  require "config.inc.php";
                  $query = "SELECT adate FROM attendance";
                  $query_run = mysqli_query($con,$query);


                  $query = "SELECT user_ID FROM students WHERE class_section = '".$_SESSION['assigned_class']."'";
                  $att_query_run  = mysqli_query($con,$query);
                  if(mysqli_num_rows($att_query_run) == 0)
                  {
                    echo '<script>alert("No STUDENT is allocated to this CLASS ")</script>';
                    exit();
                  }
                  $check = mysqli_fetch_array($att_query_run,MYSQLI_NUM);
                  

                  while($rows = mysqli_fetch_assoc($query_run))
                  {
                    $query = "SELECT ".$check[0]." FROM attendance WHERE adate = '".$rows['adate']."'";
                    // echo $query;
                    $att_query_run = mysqli_query($con,$query);
                    $check_for_av = mysqli_fetch_array($att_query_run,MYSQLI_NUM);
                    if(is_null($check_for_av[0]))
                    {
                      echo "<tr style='margin: 0 auto;background-color:red'>";
                        echo '<th><input type="button" class="btn btn-default" value="'.date("d-m-Y", strtotime($rows["adate"])).'" onclick="showattendance(this)"/></th>';
                      echo"</tr>";
                    }
                    else{
                      echo "<tr style='margin: 0 auto'>";
                        echo '<th><input type="button" class="btn btn-default" value="'.date("d-m-Y", strtotime($rows["adate"])).'" onclick="showattendance(this)"/></th>';
                      echo"</tr>";
                    }
                  }
        echo '
          </tbody>
        </table>
      </div>';


?>
<script type="text/javascript">
      document.getElementById("fixheadertableX_Y").addEventListener("scroll", function(){
       var translate = "translate(0,"+this.scrollTop+"px)";
       this.querySelector("thead").style.transform = translate;
    });
$(document).ready(function(){
    var objDiv = document.getElementById("fixheadertableX_Y");
    objDiv.scrollTop = objDiv.scrollHeight;         
  })
</script>



