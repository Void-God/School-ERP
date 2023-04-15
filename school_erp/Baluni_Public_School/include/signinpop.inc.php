<?php
if(isset($_POST['submit@02'])) {
    error_reporting(0);
  session_start();
  require "config.inc.php"; 
    $user_ID = $_POST['user_ID'];
    $user_Name = $_POST['user_Name'];
    $user_type = $_POST['user_type'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $mobile = (string) $_POST['mobile'];
    $mail = $_POST['mail'];
    $dob = $_POST['dob'];
    $class = $par_mobile= $subject = $father = $mother = NULL;
    if($user_type == "student")
    {
      $class = $_POST['user_class'];
      $father = $_POST['f_Name'];
      $mother = $_POST['m_Name'];
      $par_mobile = (string) $_POST['par_mobile'];
    }
    else
    {
      $subject = $_POST['subject'];
    }  
    $quary = "SELECT * FROM users WHERE user_ID = '$user_ID'";
    $quary_run = mysqli_query($con,$quary);
    if(mysqli_num_rows($quary_run)>0)
    {
      $_SESSION['message'] = 0;
    }
    else {

      if (getimagesize($_FILES['imagefile']['tmp_name']) == false) {
        $_SESSION['message'] = 1;
      } else { 
         //declare variables
        $image = $_FILES['imagefile']['tmp_name'];
        $name = $_FILES['imagefile']['name'];
        $image = base64_encode(file_get_contents(addslashes($image))); 
        if($user_type == 'student') {
          $sqlInsertimageintodb = "INSERT INTO students  VALUES ('$user_ID','$user_Name','$class','$mobile','$par_mobile','$mail','$name','$image','$dob','$address','$father','$mother','$gender')";
        }
        else{
          $sqlInsertimageintodb = "INSERT INTO $user_type"."s"."  VALUES ('$user_ID','$user_Name','$subject','$mobile','$gender','$mail','$name','$image','$dob','$address')";
        }
        #(user_ID,user_Name,class,mobile,par_mobile,mail,image_loc,image,dob)
        $quary = "INSERT INTO users VALUES('$user_ID','$mobile','$user_type')";
        mysqli_query($con,$quary) ;
        if (mysqli_query($con, $sqlInsertimageintodb)) {
          if($user_type == 'student')
          {      
            $query = "ALTER TABLE attendance ADD COLUMN $user_ID varchar(15)";
            $query_run = mysqli_query($con,$query);
            $query = "ALTER TABLE marks ADD COLUMN $user_ID varchar(15)";
            $query_run = mysqli_query($con,$query);
          }
            $_SESSION['message'] = 2;
        } else {
          require "config.inc.php";
          $query = "DELETE FROM users WHERE user_ID= '$user_ID';";
          mysqli_query($con,$query);
          $_SESSION['message'] = 3;
        } 
      }
    }
    unset($_POST['submit@02']);
  header("Location:/Baluni_Public_School/home.php");
}
else {
  header("Location:/Baluni_Public_School/logout.php");
}
?>