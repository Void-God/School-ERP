<?php 
  require "include/config.inc.php";
  session_start();
  if(!isset($_SESSION['temp@#00']))
  {
    // not logged in
    header('Location:confirm.php');
    exit();
  }
?>
<html lang="en" oncontextmenu="return false;">
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" type="text/css" href="css/confirm.css">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">   
</head>
    <body>
    <div class="login-box">
    <img src="css/images/avatar.jpg" class="avatar">
        <h1>Reset your Password</h1>
            <form action="include/sendrequest.php" method="post">
            <p> New Password</p>
            <input type="password" name="password" placeholder="Enter New Password">
            <p>Confirm New Password</p>
            <input type="password" name="cpassword" placeholder="Confirm New Password">
            <input type="submit" name="submit" value="SEND REQUEST">               
            </form>        
        </div>
    <script type="text/javascript" src="js/si.js"></script>    
    </body>
</html>