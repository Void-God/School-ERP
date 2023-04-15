<?php 
  error_reporting(0);
$text = $_POST['whole_text'];
require "config.inc.php";


$query = 'UPDATE notice SET info = "'.$text.'" WHERE notice_def = 1';
if(mysqli_query($con,$query)){
  echo "<script type='text/javascript'>$('#noticerefresh').load(document.URL +  ' #noticerefresh')</script>;";
  echo  '<script type="text/javascript">alert("Notice Sent!")</script>';
}
else{
  echo '<script type="text/javascript">alert("Please Try Again!")</script>';
}

?>
