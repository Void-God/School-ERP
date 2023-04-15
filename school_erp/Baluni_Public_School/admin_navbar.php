<?php 
  require "include/config.inc.php";
  if(!(isset($_SESSION['user_ID'])&&isset($_SESSION['type'])&&isset($_SESSION['pwd_@_set'])))
{    // not logged in
    header('Location:index.php');
    exit();
}
else {
  $query = "SELECT user_ID FROM users WHERE user_ID = '".$_SESSION['user_ID']."' AND pass_word = '".$_SESSION['pwd_@_set']."' AND type = '".$_SESSION['type']."'";
  $query_run = mysqli_query($con,$query);
  if(!(mysqli_num_rows($query_run) == 1)){
    header('Location:index.php');
    exit();
  }
}
 if(isset($_SESSION['message']))
{
    //when alert have been set
  require "include/messages.php";
  echo '<script type="text/javascript">alert("'.$message[$_SESSION['message']].'")</script>';
  unset($_SESSION['message']);
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>ADMIN NAVBAR</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/navbar_content.css">
</head>
<body>
  <section>
    <nav class="navbar navbar-default nav-margin-zero"  style="background: rgb(85, 204, 6);">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false" style="margin-top:16px">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="#">
            <img src="images/logo.jpeg" alt="images" style="width:83px;height:78px" class="responsive">
            <!-- <img alt="Brand" src="images/logo.jpeg" style="position:absolute;z-index:1;left:2%;width:12%;" class="responsive"> -->
          </a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right nav-adjest-auto">
            <li><a href="home.php" <?php if($_SESSION['active'] == 1){echo "style='color:yellow'";}?> >HOME</a></li>
            <li><a href="admin_attendance.php" <?php if($_SESSION['active'] == 2){echo "style='color:yellow'";}?>>ATTENDANCE</a></li>
            <li><a href="admin_marks.php" <?php if($_SESSION['active'] == 3){echo "style='color:yellow'";}?>>MARKS</a></li>
            <li><a href="#" data-toggle='modal' data-target='#myModal00'>OPTIONS</a>
            <li><a href="logout.php">LOG OUT</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </section>
  <div id="myModal00" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header modal_bk_color">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center;">OPTIONS</h4>
        </div>
        <div class="modal-body magin-botton">
          <a href="admin_discussion.php"><button class="btn btn-primary">DISCUSSION</button></a>
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal11">DISCUSSION PANEL</button>
          <button type="button" class = "btn btn-success"  data-toggle="modal" data-target="#myModal08">Notes</button>
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal10">Declare Holiday</button>
          <button type="button" class = "btn btn-success"  data-toggle="modal" data-target="#myModal02">PASSWORD REQUEST</button>
          <button type="button" class = "btn btn-success" data-toggle="modal" data-target="#myModal01">Add/Update CLASS</button>
          <button type="button" class = "btn btn-success" data-toggle="modal" data-target="#myModal">Add USER</button>
          <button type="button" class = "btn btn-success" data-toggle="modal" data-target="#myModal07">Edit USER</button>
          <button type="button" class = "btn btn-success"data-toggle="modal" data-target="#myModal03">Add SUBJECT</button>
          <button type="button" class = "btn btn-success"data-toggle="modal" data-target="#myModal04">S/C DASHBOARD</button>
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal09">NOTICE</button>
          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal05">END OF SESSION</button>

        </div>
        <div class="modal-footer modal_bk_color">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


 <div id="myModal11" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header modal_bk_color">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center;">PANEL</h4>
        </div>
        <div id="divtorefresh2" class="modal-body" style="height:500px;overflow-y:auto;">
          
          <form action="chat_inc/creategrounp.php" onsubmit="process_pop();" method="post">
            Select Classes:<br/> 
            <?php
              // error_reporting(0); 
              require "include/config.inc.php";
              $counter = 0;
              $query = "SELECT class_section FROM classes WHERE class_section != 'N/A'";
              $query_run = mysqli_query($con,$query);
              while($rows = mysqli_fetch_assoc($query_run)){
                  echo '<input type="checkbox" value="'.$rows['class_section'].'" name="class[]" >';
                  echo '<span style="margin-right:20%">'.$rows['class_section'].'</span>';
                  if($counter%3==0)
                  {
                    echo '<br/>';
                  }
                  $counter++;
              }
            ?>
            <br/>Discussion Name: 
            <input type="text" name="dis_name" required><br/>
            <input type="submit" name="submit@08" class="btn btn-success" value="Create"><hr/>
          </form>
          <div id="msg_status"></div>

        <br/><br/> <div id="fixheadertableN" class="table-responsive table_to_fix_with_device" >          
          <h5 style="text-align:center"><b>SELF</b></h5>
          <table  class="table" >
            <thead style="background-color: #009879;">
              <tr >
                <th style="text-align:center;width:33%">Discussion</th>
                <th style="text-align:center;width:33%">Del. Dis.</th>
                <th style="text-align:center">Del. mess.</th>
              </tr>
            </thead style="background-color: #009879">
            <tbody class="color_do" style="text-align:center;">
              <?php 
                require "../Baluni_Public_School/chat_inc/config.inc.php";

                $query = "SELECT dis_ID,dis_Name FROM discussions WHERE admin = '".$_SESSION['user_ID']."'";
                $query_run = mysqli_query($conn,$query);
                while($rows = mysqli_fetch_assoc($query_run)){
                     echo '<tr >
                  <th class="text-center">'.$rows['dis_Name'].'</th>
                  <th><button type="button" style="margin: 0 auto;display:block" class="btn btn-success" value = "'.$rows['dis_ID'].'" onclick="del_discussion(this);">DELETE</button></th>
                  <th><button type="button" style="margin: 0 auto;display:block" class="btn btn-success" value="'.$rows['dis_ID'].'" onclick="del_messages(this);">DELETE</button></th>
                    </tr>';                 
                  }
              ?>     
            </tbody>
          </table><br/><br/><br/>
          <h5 style="text-align:center"><b>OTHERS</b></h5>
          <table  class="table" >
            <thead style="background-color: #009879;">
              <tr >
                <th style="text-align:center;width:33%">Discussion</th>
                <th style="text-align:center;width:33%">Del. Dis.</th>
                <th style="text-align:center">Del. mess.</th>
              </tr>
            </thead style="background-color: #009879">
            <tbody class="color_do" style="text-align:center;">
              <?php 

                require "../Baluni_Public_School/chat_inc/config.inc.php";

                $query = "SELECT dis_ID,dis_Name FROM discussions WHERE admin != '".$_SESSION['user_ID']."'";
                $query_run = mysqli_query($conn,$query);
                while($rows = mysqli_fetch_assoc($query_run)){
                     echo '<tr >
                  <th class="text-center">'.$rows['dis_Name'].'</th>
                  <th><button type="button" style="margin: 0 auto;display:block" class="btn btn-success" value = "'.$rows['dis_ID'].'" onclick="del_discussion(this);">DELETE</button></th>
                  <th><button type="button" style="margin: 0 auto;display:block" class="btn btn-success" value="'.$rows['dis_ID'].'" onclick="del_messages(this);">DELETE</button></th>
                    </tr>';                 
                  }
              ?>     
            </tbody>
          </table>
        </div>
      </div>
        <div class="modal-footer modal_bk_color">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>



  <div id="myModal10" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header modal_bk_color">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center;">DECLARE HOLIDAY</h4>
        </div>
        <div class="modal-body" style="height:520px;overflow-y:auto;">
          <br/><div id="fixheadertable_xx" class="table-responsive table_to_fix_with_device" >  
            <form action="include/declear_holiday.php" method="post" onsubmit="process_pop()">       
              <table  class="table" >
                <thead style="background-color: #009879;">
                  <tr >
                    <th style="text-align:center">Select</th>
                    <th style="text-align:center">Date</th>
                  </tr>
                </thead style="background-color: #009879">
                <tbody class="color_do" style="text-align:center;">
                      <?php
                        require "include/config.inc.php";
                        $query = "SELECT adate FROM attendance";
                        $query_run = mysqli_query($con,$query);
                        while($rows = mysqli_fetch_assoc($query_run))
                        {
                            echo "<tr style='margin: 0 auto;background:green'>";
                              echo '<th><input type="checkbox" value="'.$rows["adate"].'" name="date[]"/></th>';
                              echo '<th>'.date("d-m-Y", strtotime($rows["adate"])).'</th>';
                            echo"</tr>";
                        }
                      ?> 
                </tbody>
              </table>
          </div>
            <input class="btn btn-default" type="submit" name="submit@0001" value="Declare"/>
          </form> 
        </div>
        <div class="modal-footer modal_bk_color">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>  

  <div id="myModal08" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header modal_bk_color">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center;">NOTES</h4>
        </div>
        <div id="divtorefresh" class="modal-body" style="height:500px;overflow-y:auto;">
          
            <form action="include/upload_notes.php" enctype="multipart/form-data" method="post" onsubmit="process_pop();">
              Select Classes:<br/> 
              <?php 
                require "include/config.inc.php";
                $counter = 0;
                $query = "SELECT class_section FROM classes WHERE class_section != 'N/A'";
                $query_run = mysqli_query($con,$query);
                while($rows = mysqli_fetch_assoc($query_run)){
                    echo '<input type="checkbox" value="'.$rows['class_section'].'" name="class[]" >';
                    echo '<span style="margin-right:20%">'.$rows['class_section'].'</span>';
                    if($counter%3==0)
                    {
                      echo '<br/>';
                    }
                    $counter++;
                }
              ?>
              <br/>File Name: 
              <input type="text" name="comment" required><br/>
              <input type="file" name="file" required>
              <input type="submit" name="submit@00" class="btn btn-success" value="Upload"><hr/>
            </form>
            <form>
              <div class="row">
                <button type="button" value="deletealldata" onclick="deletedata(this)" class="btn btn-success" style="margin:0% 37%;">DELETE ALL</button>
              </div>
            </form>
            <div id="delete_status"></div>
          <br/><br/> <div id="fixheadertableA" class="table-responsive table_to_fix_with_device" >  
                    
            <table  class="table" >
              <thead style="background-color: #009879;">
                <tr >
                  <th style="text-align:center;width:33%">File</th>
                  <th style="text-align:center;width:33%">Teacher</th>
                  <th style="text-align:center">DELETE</th>
                </tr>
              </thead>
              <tbody class="color_do" style="text-align:center;">
                <?php 
                  require "include/config.inc.php";
                  $query = "SELECT user_ID, file_name, comment FROM notes";
                  $query_run = mysqli_query($con,$query);
                  while($rows = mysqli_fetch_assoc($query_run)){
                    $query = "SELECT user_Name FROM teachers WHERE user_ID='".$rows['user_ID']."'";
                    $query_run_temp = mysqli_query($con,$query);
                    if(mysqli_num_rows($query_run_temp) == 0){
                      $query = "SELECT user_Name FROM admins WHERE user_ID='".$rows['user_ID']."'";
                      $query_run_temp = mysqli_query($con,$query);
                    }
                    $road = mysqli_fetch_array($query_run_temp,MYSQLI_ASSOC);
                    echo '<tr >
                  <th>'.$rows['comment'].'</th>
                  <th>'.$road['user_Name'].'</th>
                  <th style="text-align:center"><button class="btn btn-default" value="'.$rows['file_name'].'" onclick="deletedata(this)" >DELETE</button></th>
                    </tr>';
                  }

                ?>     
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer modal_bk_color">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


 <div id="myModal09" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header  notice_back_to_all">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body  modal_bk_color" style="height:500px;overflow-y:auto;overflow-x:hidden">
          <div id="notice_output">
            
          </div>
          <div class="row">
            <div style="height:auto;width:50%;display:block;margin-left:auto;margin-right:auto;">
              <form>
                <span style="font-size:15px">ENTER NOTICE: </span><br/>
                <textarea id="notice_to_send" id="userString" name="userString" maxlength="500" rows="5" cols="50"></textarea>
                <button type="button" class="btn btn-default" onclick="send_notice()">SEND</button>
              </form>
            </div>
          </div>
          <div id="noticerefresh" class="row" style="padding:10%;">
            <?php 
              require "include/config.inc.php";
              $query = "SELECT info FROM notice WHERE notice_def = 1;";
              $query_run = mysqli_query($con,$query);
              $row = mysqli_fetch_array($query_run);
              echo "<p style='font-size:20px;text-align:justify;font-weight:100'>".$row['info']."<p>";
             ?> 
            </div> 
        </div>
        <div class="modal-footer" style="background-color:black">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  
 
  <div id="myModal07" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header modal_bk_color">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center;">EDIT USER</h4>
        </div>
        <div class="modal-body" style="height:500px;overflow-y:scroll;">
          <form>
            Search for User: 
            <input id="editparty" type="text" placeholder="User Name or UserID">
            <button type="button" class="btn btn-success" onclick="editpartyfun();">SEARCH</button>
          </form>
          <div id="editpartysec"></div>
        </div>
        <div class="modal-footer modal_bk_color">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>




    <!-- pop up for add class -->

  <div id="myModal01" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header modal_bk_color">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center;">ADD/UPDATE CLASS</h4>
        </div>
        <div class="modal-body" style="height:200px">
            <form action="include/addclass.inc.php" method="post" onsubmit="process_pop();">
              Select Operation: 
              <select name="operation" onchange="operation_1(this)" required>
                <option value=""></option>
                <option value="create">Create</option>
                <option value="update">Update</option>
                <option value="delete">Delete</option>
              </select></br>                  
                <div id="pasteData01"></div>

              <input class="btn btn-success" type="submit" name="submit@01" value="Perform"/>
            </form>
        </div>
        <div class="modal-footer modal_bk_color">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>




  

  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header modal_bk_color">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center;">ADD USER</h4>
        </div>
        <div class="modal-body">
          <form action="include/signinpop.inc.php" enctype="multipart/form-data" method="post" onsubmit="process_pop();">
            UserID: 
              <input type="text" name="user_ID" pattern="[a-zA-Z]{1,3}[0-9]{1,9}" required><br/>
            UserName:
              <input type="text" name="user_Name" required><br/>
            Gender: 
              <select name="gender" required>
                <option value=""></option>
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>
            User Type: 
              <select id="user_type" name="user_type" onchange="changedata();" required>
                <option value=""></option>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
                <option value="admin">Admin</option>
              </select><br/> 
              <div id="pasteData"></div>            
 
            Mobile Number:
              <input type="number" name="mobile" required><br/>
            Mail Address:
              <input type="email" name="mail" required><br/>
            Address: 
              <input type="text" name="address"  required/><br/>
            Date of Birth:
              <input type="date" name="dob" required> <br/>
            Select User's image:
              <input type="file" name="imagefile" required>
              <br />
              <input type="submit" name="submit@02" value="Upload"/> 
          </form>
        </div>
        <div class="modal-footer modal_bk_color">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> 



  <div id="myModal02" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header modal_bk_color">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center;">PASSWORD CHANGE REQUEST</h4>
        </div>
        <div class="modal-body height-fix">
          <form> 
            Search for Request: 
            <input id="user_request" type="text" placeholder="UserName or UserID" required/>
            <input class="btn btn-success" type="button" value="SEARCH" onclick="requestI()"/><br/>
            Change Password: 
            <input class="btn btn-success" type="button" name="submit1" value="CHANGE" onclick="requestII()"/><br/><br/>
            Show all Requests: 
            <input class="btn btn-success" type="button" name="submit1" value="SHOW" onclick="requestIII()"/>
          </form>
          <div id="pasteData_request"></div>
        </div>
        <div class="modal-footer modal_bk_color">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> 
  

  <!-- pop up for add subjects -->
  <div id="myModal03" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header modal_bk_color">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center;">ADD SUBJECT</h4>
        </div>
        <div class="modal-body height-fix">
          <form action="include/subject_create.php" method="post" onsubmit="process_pop();"> 
            Subject's Name: 
            <input type="text" placeholder="Name of Subject" name="sub" required/><br/>
            <input type="submit" class="btn btn-success" name="submit@03" value="ADD" />
          </form>
        </div>
        <div class="modal-footer modal_bk_color">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> 

  <div id="myModal04" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header modal_bk_color">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center;">STUDENT/CLASS DASHBOARD</h4>
        </div>
        <div class="modal-body height-fix input_bottom_pad">

          <div id="least_bit_paste"></div>
          Check Details: 
            <input id="dashboard_query_ID_1" type="text" placeholder="UserName or UserID" required/>
            <button class="btn btn-success" type="button" value="SEARCH" onclick="dashboard_query();">SEARCH</button><br/>
          
          Edit CLASS: 
            <input id="edit_user_class" type="text" placeholder="UserID or UserName"  required/>
            <button type="button" class="btn btn-success" value= "EDIT" onclick="edit_class_of_user();">EDIT</button><br/><hr>
          Check Duplicate Phone Number : 
            <button class="btn btn-success" type="button" onclick="SearchDuplicate();">Search</button><hr/>
          Edit Marks : 
            <input id="mark_change_scheme" type="text" placeholder="UserID Only" /><br/>
            <select id="mark_change_way">
              <option value=""></option>
              <?php 
                require "include/config.inc.php";
                $query = "SELECT paper_name,paper_id,subject FROM marks";
                $query_run = mysqli_query($con,$query);
                while($rows = mysqli_fetch_assoc($query_run)){
                  echo "<option value='".$rows['paper_id']."'>".$rows['paper_name']."@".$rows['subject']."</option>";
                }
              ?>
            </select>
            <button type="button" class="btn btn-success" onclick="markchangenow()">Search</button><hr/>


          <div id="c_s_output"></div>
          <div id="edit_user_to_paste">
            
          </div>
        </div>
        <div class="modal-footer modal_bk_color">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> 





  <div id="myModal05" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header modal_bk_color">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center;">END SESSION (HANDLE CAREFULLY)</h4>
        </div>
        <div class="modal-body" style="height:565px;overflow-y:auto;">
          <div id="result_eos"></div>
          <form>
            Change Class (After End Of Session):<br/><br/>
            <input id="user_class_eos" type="text" placeholder="UserID or UserName"  required/>
            <input class="btn btn-danger" type="button" value= "Search" onclick="class_change_eos();" /><br/> 
          </form><hr/>
          <div id="paste_users_eos"></div>
          <form>
            Create Session: 
              <!-- yet to complete -->
              <input id="eos_name" type="text" name="session_name" placeholder="Name Of Session(YYYY)" required/>
              <input type="button" class="btn btn-danger" name="" value="Create" onclick="endofsession0000()" />
          </form><hr/>

          <div id="refresh_eos_now" class="row" style="padding-left:3%">
            <form>
              Dump CLASS: 
                <?php 
                  require "include/config.inc.php";
                  $query = "SELECT class_section FROM classes";
                  $query_run = mysqli_query($con,$query);
                  echo '<select id="selected_class" name="classtodump" required>';
                          echo '<option value=""></option>';
                  while($row = mysqli_fetch_assoc($query_run))
                  {
                    echo '<option values="'.$row['class_section'].'" >'.$row['class_section'].'</option>';
                  }
                  echo '</select><br/>
                  Select Session : 
                  ';
              
                  $query = "SELECT session FROM sessions";
                  $query_run = mysqli_query($con,$query);
                  echo '<select id="selected_session" name="eos" required>';
                          echo '<option value=""></option>';
                  while ($rows = mysqli_fetch_assoc($query_run)){
                    echo '<option value="'.$rows['session'].'">'.$rows['session'].'</option>';
                  }
                  echo '</select>';
                ?>
                <input type="button" class="btn btn-danger" onclick="endofsession0002()" value="DUMP" /><br/>
            </form> <hr/>
          </div>

          <button class= "btn btn-danger" style="height:50px;width:100%" data-toggle="modal" data-target="#myModal06">END OF SESSION</button>
        </div>
        <div class="modal-footer modal_bk_color">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <div id="myModal06" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          ARE YOU SURE YOU WANT TO END SESSION?
        </div>
        <div class="modal-footer" style="background-color:lightgreen">
          <form action="include/endofsession0001.php" method="post" onsubmit="process_pop()">
            Select Session's Name: 
            <?php 
              $query = "SELECT session FROM sessions WHERE state = 0";
              $query_run = mysqli_query($con,$query);
              echo '<select id="call_of_end_of_session" name="eos" required>';
                      echo '<option value=""></option>';
              while ($rows = mysqli_fetch_assoc($query_run)){
                echo '<option value="'.$rows['session'].'">'.$rows['session'].'</option>';
              }
              echo '</select>';

             ?>
            <input type="submit" class="btn btn-danger" name="submit@04" value="YES" />
            <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
          </form>
        </div>
      </div>
    </div>
  </div>




  <div id="myModal_on_load" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content" style="height:100px;width:200px;margin: 0 auto">
       <br/><br/><img src="images/loading.gif" style="height:90px;width:90px;margin-left: auto;margin-right: auto;display:block">
       <h4 style="text-align:center;color:green">Processing! Please Wait...</h4>
      </div>
    </div>
  </div>


  <script src="js/navbar.js"></script>
  <script type="text/javascript">
    function process_pop() {
       $('#myModal_on_load').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                });
    }
  </script>
  <!-- <script type="text/javascript">
    function changeclassnow(mark) {
        var specs = $('#'+mark.id).serializeArray();
        alert("working fine");
        $.post("include/changeclassnow01.php",specs,
        function(data) {
          $('#least_bit_paste').html(data);
        });
        return false;
    }
  </script> -->
<script type="text/javascript">
  function changeclassnow(flag) {
    var user_id = $('#data_on_set_stu_'+flag).val(); 
    var change = $('#class_to_assign_stu_'+flag).val();
      $('#myModal_on_load').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                });
    $.post("include/changeclassnow01.php",{id_post:user_id,class_post:change},
      function(data){
        $('#least_bit_paste').html(data);
        $("#myModal_on_load").modal("hide");
      })
  }
</script>


<script type="text/javascript">
  function changeclass_eos(flag) {
    var user_id = $('#data_on_set_eos_'+flag).val(); 
    var change = $('#class_to_assign_eos_'+flag).val();
      $('#myModal_on_load').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                });
    $.post("include/endofsession_classchange.php",{id_post:user_id,class_post:change},
      function(data){
        $('#paste_users_eos').html(data);
        $("#myModal_on_load").modal("hide");
      })
  }
</script>
</body>
</html>
