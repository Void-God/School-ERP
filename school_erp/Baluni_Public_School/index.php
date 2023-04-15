<?php 
  require "include/config.inc.php";  
?>
<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon/login.png">
    <link rel="stylesheet" type="text/css" href="css/style_h.css">
</head>
<body class="body_response">
    <div class="login-box">
      <img src="images/logo.jpeg" class="avatar">
      <h1>Login Here</h1>
      <form action="index.php" method="post">
        <p>UserID</p>
        <input type="text" name="user_ID" placeholder="Enter UserID" required>
        <p>Password</p>
        <input type="password" name="password" placeholder="Enter Password" required>
        <input type="submit" name="login" value="Login">
        <a href="confirm.php">Password Change Request</a>    
      </form>  
      <?php
        error_reporting(0);
        if(isset($_POST['login']))
        {
          $user_ID = $_POST['user_ID'];
          $password = $_POST['password'];

          $query = "SELECT type FROM users WHERE user_ID LIKE BINARY '$user_ID' AND pass_word LIKE BINARY '$password'";
          $query_run = mysqli_query($con,$query);
          $row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
          if(mysqli_num_rows($query_run)==1)
          {
            //valid
            session_start();
            $_SESSION['user_ID'] = $user_ID;
            $_SESSION['type'] = $row['type'];
            $_SESSION['pwd_@_set'] = $password;
            header("Location:home.php");
          }
          else
          {
           // echo '<script type="text/javascript">alert("either user ID or passwrod is wrong");</script>';
            unset($_POST['login']);
            echo '<script type="text/javascript">alert("Invalid Data")</script>';
          }
        }
      ?>      
    </div> 
    <script type="text/javascript" src="js/si.js"></script>
</body>
</html>
