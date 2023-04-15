<?php 
  require "include/config.inc.php";
  session_start();
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
  else {
    $_SESSION['active'] = 8;
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
<html lang="en" oncontextmenu="return false;">
<head>
  <title>Chat-box</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="images/favicon/chat_box.png">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/navbar_content.css">
  <link rel="stylesheet" type="text/css" href="css/table.css">
  <style type="text/css">
        p {
      margin: 0 0 0px !important;
      }
    .row_match {
      padding: 2px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
    .padd_12 {
      padding: 12px 20px;
    }
    .your {
      margin-left:1% !important;
      margin-right:20% !important;
      margin-top:1%;
      margin-bottom:1%;
      background-color:white;
      width:auto;
      float:left;
    }
    .mine {
      margin-left:20% !important;
      margin-right:1% !important;
      margin-top:2%;      
      margin-bottom:1%;
      width:auto;
      float:right;
      background-color:#1b9a59;      
    }
    .container_new_900 {
      background-color:lightblue;
      height:900px;
      overflow-y: auto;
    }
    .container_new_not_900 {
      background-color:lightblue;
      height:auto !important;
    }


    .problem {text-align:center}
    .fixAtBottom {
      position:sticky;
      bottom:0px;
      display:block;
      margin:0 auto;
    }
    .fixAtTop {
      position:sticky;
      top:0px;
      display:block;
      margin:0 auto;
    }

    .input_style {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    .color_black {
      color:black;
    }

  .btn_div {
    width:4%;
    float:left;
    padding-top:13px;
  }
  @media only screen and (max-width: 800px) and (min-width:0px) {
    .btn_div {
    width:9%;
    }
  }

  .input_div {
    width:86%;
    float:left;
  }

  @media only screen and (max-width: 784px) and (min-width:0px) {
    .input_div {
    width:80%;
    }
  }

  .send_btn_div {
    width:9%;
    float:left;
    padding-left:2px
  }


  </style>
</head>
<body style="background-color:teal;overflow-x:hidden;">
    <?php 
      include "navbar.php";
    ?>
    <section class="fixAtTop">
      <div class="container">
        <div class="row">
          <select id="chat_group" style="width:100%;height:30px" onchange="start_chat();">
            <option value="">SELECT THE DISCUSSION GROUP</option>
            <?php 
              require "chat_inc/config.inc.php";
              $query = "SELECT admin_Name,classes,dis_ID,dis_Name FROM discussions";
              $query_run = mysqli_query($conn,$query);

              while($rows = mysqli_fetch_assoc($query_run)){
                $valid = explode(",",$rows['classes']);
                if(in_array($_SESSION['class'],$valid)){
                echo '<option value="'.$rows['dis_ID'].'">Name:'.$rows['dis_Name'].',  Admin:'.$rows['admin_Name'].',  classes:'.$rows['classes'].'</option>';
                }
              }
            ?>
          </select>
        </div>
      </div>
    </section>



  <div id="repeat_algo" class="container container_new_900">
    <!-- msges will be pasted here -->
  </div>

  <div class="container-fluid fixAtBottom" style="background-color:yellow;">
    <div class="container" style="margin-top:10px;margin-bottom:10px;">
      <div class="row">
        <div class="btn_div">
          <button onclick="start_chat();" style="background-color: #5cb85c;border-color: #4cae4c"><i class="fa fa-refresh fa-2x" aria-hidden="true"></i></button>
        </div>
        <div class="input_div" id="send_msg" >
          <input type="text" id="msg_to_send" class="input_style" placeholder="Enter Your Message"></input>
        </div>
        <divm class="send_btn_div">
          <br/><button type="button" class="btn btn-success" onclick="send_msg();">SEND</button>
        </div>
      </div>  
    </div>  
  </div>


  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/onload_this.js"></script>
  <script>
     document.onkeydown = function(e) {
      if(e.which === 123){
        return false;
      }
      if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)){
      return false;
      }
      if(e.ctrlKey && e.keyCode == 'E'.charCodeAt(0)){
      return false;
      }
      if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
      return false;
      }
      if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
      return false;
      }
      if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
      return false;
      }
      if(e.ctrlKey && e.keyCode == 'S'.charCodeAt(0)){
      return false;
      }
      if(e.ctrlKey && e.keyCode == 'H'.charCodeAt(0)){
      return false;
      }
      if(e.ctrlKey && e.keyCode == 'A'.charCodeAt(0)){
      return false;
      }
      if(e.ctrlKey && e.keyCode == 'E'.charCodeAt(0)){
      return false;
      }
      if(e.which === 13){
            send_msg();
          }      
      }
      
        function refresh_chat() {
      var group = $('#chat_group').val();
      if(group == ''){
        alert('Empty!');
      }
      else {
        $.post("chat_inc/openChat.php",{chat_group:group},
        function(data) {
          $('#repeat_algo').html(data);
          change_height();
        });
      }
    } 
    
    function change_height() {
      if ($('#repeat_algo').prop('scrollHeight') > 900 ){
      //if 'true', the content overflows the tab: we show the hidden link
        $("#repeat_algo").addClass("container_new_not_900");
      }
    }

        function to_bottom_scroll() { 
                if ($('#repeat_algo').prop('scrollHeight') > 900 ){
         $(document).scrollTop($(document).height());
      }

               
    }
    
    function start_chat() {
      var group = $('#chat_group').val();
      if(group == ''){
        alert('Empty!');
      }
      else {
            $('#myModal_on_load').modal({
                            backdrop: 'static',
                            keyboard: true, 
                            show: true
                    });
        $.post("chat_inc/openChat.php",{chat_group:group},
        function(data) {
          $('#repeat_algo').html(data);
          $("#myModal_on_load").modal("hide");
          change_height();
          to_bottom_scroll();
        });
      }
    }


    function send_msg()  {
      var group = $('#chat_group').val();
      var msg = $('#msg_to_send').val();
      document.getElementById('msg_to_send').value = '';
      if(group == ''){
        alert('No Group is Selected!');
      }
      else if(msg == ''){
        alert('Message Field is Empty!');
      }
      else {
        $.post("chat_inc/send_msg.php",{msg_given:msg,chat_group:group},
        function(data) {
          refresh_chat();
          to_bottom_scroll();
        });

      }
    }





  </script> 
</body>
</html>