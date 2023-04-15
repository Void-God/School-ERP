<?php 
  require "include/config.inc.php";
  session_start();
  if(isset($_SESSION['alert_dd']))
  {
        //when alert have been set
      require "include/messages.php";
      echo '<script type="text/javascript">alert("'.$message[$_SESSION['alert_dd']].'")</script>';
      session_destroy();      
  }
?>
<!DOCTYPE html>
<html  oncontextmenu="return false;">
<head>
    <title>Confirm details</title>
    <link rel="stylesheet" type="text/css" href="css/confirm.css"> 
    <meta name="viewport" content="width=device-width,initial-scale=1.0">  
</head>
    <body>
    <div class="login-box">
    <img src="css/images/avatar.jpg" class="avatar">
        <h1>Confirm your details</h1>
            <form action="include/confirm_detail.php" method="post">
            <p>UserID</p>
            <input type="text" name="ID" placeholder="Enter UserID" required/>
            <p>Phone Number</p>
            <input type="number" name="mobile" placeholder="Enter Phone Number" required/>
            <p>Date of Birth</p>
            <input type="date" name="dob">
            <input type="submit" name="submit" value="Confirm Details" required/>   
            </form>       
        </div>
    <script type="text/javascript" src="js/si.js"></script>
    </body>
</html>