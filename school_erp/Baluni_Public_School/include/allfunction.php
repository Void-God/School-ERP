<?php 
    function percetage_data($id) {
      require "config.inc.php";
      $query_run = mysqli_query($con,"SELECT adate, $id FROM attendance");
      $present = 0;
      $absent = 0;
      $total = 0;
      while($row = mysqli_fetch_assoc($query_run)) {
        if($row[$id] == 'P')
        {
          $present++;
          $total++;
        }
        elseif($row[$id]=='A')
        {
          $absent++;
          $total++;
        }
      }
      echo '
          <div class="row"><h3>Present: '.$present.'</h3></div>
          <div class="row"><h3>Absent: '.$absent.'</h3></div>';
          if($total == 0)
          {
            $total = 1;
          }
          echo '
          <div class="row"><h3>Percentage: '.round(($present / $total)*100).'%</h3></div> <br/><br/>
          ';
    }
    function attendance_data($id)
    {
        require "config.inc.php";
          $query1 = "SELECT user_Name, class_section FROM students WHERE user_ID = '$id'";
          $query_run = mysqli_query($con,$query1);
      $row1 = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
          $query2 = "SELECT class_Teacher FROM classes WHERE class_section = '".$row1['class_section']."'";
          $query_run = mysqli_query($con,$query2);
      $row2 = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
      echo '  
        <div class="row"><h3>Name:'.$row1['user_Name'].' </h3></div>
        <div class="row"><h3>Class:'.$row1['class_section'].' </h3></div>
        <div class="row"><h3>Class Teacher:'.$row2['class_Teacher'].'</h3></div> 
        ';
    }
    function attendance_table($id)
    {
      require "config.inc.php";
      $query_run = mysqli_query($con,"SELECT adate, $id FROM attendance");
      while($row = mysqli_fetch_assoc($query_run)) {
        if(is_null($row[$id]) OR $row[$id] == 'N/A'){
          echo "<tr>";
        }
        else if($row[$id] == 'P') {
          echo "<tr style='background-color:green'>";
        }
        else if($row[$id] == 'A'){
          echo "<tr style='background-color:red'>";          
        }
          echo "<td class='color_white'>".date("d-m-Y", strtotime($row["adate"]))."</td>
                <td class='color_white'>".date('D', strtotime($row['adate']))."</td>
                <td class='color_white'>".$row[$id]."</td>";
          echo "</tr>";
      }
    }
?>
