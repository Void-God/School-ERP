<?php 
  error_reporting(0);
  require "config.inc.php";
  $search = $_POST['party'];
  $flag = 0;
  $query = "SELECT user_ID, user_Name FROM students";
  $query_run = mysqli_query($con,$query);
    while($rows = mysqli_fetch_assoc($query_run))
  {
    if($rows['user_ID'] == $search || strpos(strtolower($rows['user_Name']),strtolower($search)) !== false)
    {
      $query = "SELECT * FROM students WHERE user_ID = '".$rows['user_ID']."'";
      $query_walk = mysqli_query($con,$query);
      $personal = mysqli_fetch_array($query_walk);
      $query = "SELECT type FROM users WHERE user_ID = '".$rows['user_ID']."'";
        echo '<div style="border : 1px solid black;padding:10px">
          <div class = "row">
              <img src="data:image/jpeg;base64,'.$personal['image'].' " class="avatar-property" >          
          </div>
          <form action="include/edit_party_submit.php" method="post">
            <p>USER ID : '.$personal['user_ID'].'</p>
            <p>DOB : '.$personal['dob'].'</p>
            <input type="text" class="hide" name="userID" value="'.$rows['user_ID'].'"/>
            UserName : <input type="text" name="username" value="'.$personal['user_Name'].'" required><br/>
            Mail Address : <input type="text" name="madd" value="'.$personal['mail'].'" required><br/>
            Moblie Number of User : <input type="number" name="mobile" value="'.$personal['mobile'].'" required><br/>
            Address : <input type="text" name="address" value="'.$personal['address'].'" required><br/>
            ';
        
          echo '
          Name of Mother : <input type="text" name="mname" value="'.$personal['mother_Name'].'" required><br/>
          Name of father : <input type="text" name="fname" value="'.$personal['father_Name'].'" required><br/>
          Moblie Number of Parents : <input type="number" name="pmobile" value="'.$personal['par_mobile'].'" required><br/>
          <input type="checkbox" required/> Are you sure you want to upload the details?<br/><br/>
          <input type="submit" class="btn btn-success" name="submit" value="Upload">

          ';

        echo '</form>

        </div>';  
        $flag = 1;         
    }
  }

  $query = "SELECT user_ID, user_Name FROM teachers";
  $query_run = mysqli_query($con,$query);
    while($rows = mysqli_fetch_assoc($query_run))
  {
    if($rows['user_ID'] == $search || strpos(strtolower($rows['user_Name']),strtolower($search)) !== false)
    {
      $query = "SELECT * FROM teachers WHERE user_ID = '".$rows['user_ID']."'";
      $query_walk = mysqli_query($con,$query);
      $personal = mysqli_fetch_array($query_walk);
      $query = "SELECT type FROM users WHERE user_ID = '".$rows['user_ID']."'";
        echo '<div style="border : 1px solid black;padding:10px">
          <div class = "row">
              <img src="data:image/jpeg;base64,'.$personal['image'].' " class="avatar-property" >          
          </div>
          <form action="include/edit_party_submit.php" method="post">
            <p>USER ID : '.$personal['user_ID'].'</p>
            <p>DOB : '.$personal['dob'].'</p>
            <input type="text" class="hide" name="userID" value="'.$rows['user_ID'].'"/>
            user name : <input type="text" name="username" value="'.$personal['user_Name'].'" required><br/>
            mail adress : <input type="text" name="madd" value="'.$personal['mail'].'" required><br/>
            moblie number : <input type="number" name="mobile" value="'.$personal['mobile'].'" required><br/>
            address : <input type="text" name="address" value="'.$personal['address'].'" required><br/>
            <input type="radio" required/> Are you sure you want to upload the detail?<br/><br/>
            <input type="submit" class="btn btn-success" name="submit" value="upload">


            ';
        
                    
        echo '</form>

        </div>';  
        $flag = 1;         
    }
  }


  $query = "SELECT user_ID, user_Name FROM admins";
  $query_run = mysqli_query($con,$query);
    while($rows = mysqli_fetch_assoc($query_run))
  {
    if($rows['user_ID'] == $search || strpos(strtolower($rows['user_Name']),strtolower($search)) !== false)
    {
      $query = "SELECT * FROM admins WHERE user_ID = '".$rows['user_ID']."'";
      $query_walk = mysqli_query($con,$query);
      $personal = mysqli_fetch_array($query_walk);
      $query = "SELECT type FROM users WHERE user_ID = '".$rows['user_ID']."'";
        echo '<div style="border : 1px solid black;padding:10px">
          <div class = "row">
              <img src="data:image/jpeg;base64,'.$personal['image'].' " class="avatar-property" >          
          </div>
          <form action="include/edit_party_submit.php" method="post">
            <p>USER ID : '.$personal['user_ID'].'</p>
            <p>DOB : '.$personal['dob'].'</p>
            <input type="text" class="hide" name="userID" value="'.$rows['user_ID'].'"/>
            UserName : <input type="text" name="username" value="'.$personal['user_Name'].'" required><br/>
            Mail Address : <input type="text" name="madd" value="'.$personal['mail'].'" required><br/>
            Moblie Number of User : <input type="number" name="mobile" value="'.$personal['mobile'].'" required><br/>
            address : <input type="text" name="address" value="'.$personal['address'].'" required><br/>
            <input type="radio" required/> Are you sure you want to upload the detail?<br/><br/>
            <input type="submit" class="btn btn-success" name="submit" value="Upload">
            ';
        
                    
        echo '</form>

        </div>';  
        $flag = 1;         
    }
  }

  if($flag == 0)
  {
    echo '<script>alert("USER not found!")</script>';
  }


?>
