<?php 
if(isset($_POST['setto0']))
{
    error_reporting(0);
  session_start();
  require "config.inc.php";
  $num = $_POST["number_of_subject"];
  $test = $_POST["name_of_test"];
  $class = explode("@",$test); //class is at 1 index



  for($i=1;$i<=$num;$i++){
    $teacher[$i] = $_POST['teacher'.$i];
  }
  $unique = array_unique($teacher);
  if(count($unique) == count($teacher)) {
    for($i=1;$i<=$num;$i++){
      $query = "SELECT subject FROM teachers WHERE user_ID = '".$teacher[$i]."'";
      $query_run = mysqli_query($con,$query);
      if(mysqli_num_rows($query_run) == 0){
        $query  = "SELECT subject FROM admins WHERE user_ID = '".$teacher[$i]."'"; 
        $query_run = mysqli_query($con,$query);
      }
      $row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
      $subject[$i] = $row['subject'];

      $query = "SELECT paper_id FROM marks WHERE paper_name = '".$test."' AND subject = '".$row['subject']."' AND teacher_ID = '".$teacher[$i]."'";
      $query_run = mysqli_query($con,$query);
      if(mysqli_num_rows($query_run) > 0 )
      {
        $_SESSION['message'] = 39;
        header("Location:/Baluni_Public_School/admin_marks.php");
        exit();
      }
    }
    for($i=1;$i<=$num;$i++){
      $query = "INSERT INTO marks(paper_name,teacher_ID,subject,passing_marks) VALUES ('".$test."', '".$teacher[$i]."','".$subject[$i]."','".$_POST['P_M_T'.$i]."')";
      $query_run = mysqli_query($con,$query);    
    } 

    $query = "SELECT user_ID FROM students WHERE class_section = '".$class[1]."'";
    $qeury_run = mysqli_query($con,$query);
    while($rows = mysqli_fetch_assoc($qeury_run)) {
      for($i=1;$i<=$num;$i++) {
        $local_marks = explode(" ", $_POST["sub".$i."@".$rows['user_ID']]) ;
          if(count($local_marks) == 1) {
            $query = "UPDATE marks SET ".$rows['user_ID']." = '".$local_marks[0]."/".$_POST['M_M_T'.$i]."' WHERE paper_name = '".$test."' AND teacher_ID = '".$teacher[$i]."'";
            echo $query;
            $query_run_one = mysqli_query($con,$query); 
          }
          else if(count($local_marks) == 4) {
            $query = "UPDATE marks SET ".$rows['user_ID']." = '".$local_marks[0]."/".$local_marks[1].",".$local_marks[2]."/".$local_marks[3]."' WHERE paper_name = '".$test."' AND teacher_ID = '".$teacher[$i]."'";
            echo $query;
            $qeury_run_four = mysqli_query($con,$query);
          }        
      }
    }

    $_SESSION['message'] = 40;
    header("Location:/Baluni_Public_School/admin_marks.php");
  }
  else{
    $_SESSION['message'] = 38;
    header("Location:/Baluni_Public_School/admin_marks.php");

  }
}



else
{
  header("Location:/Baluni_Public_School/login.php");
}


?>