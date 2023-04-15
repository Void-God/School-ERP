  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header modal_bk_color">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center;">NOTES</h4>
        </div>
        <div class="modal-body" style="height:500px;overflow-y:auto;">
          <br/><br/> <div id="fixheadertableA" class="table-responsive table_to_fix_with_device" >          
            <table  class="table" >
              <thead style="background-color: #009879;">
                <tr >
                  <th style="text-align:center;width:33%">File</th>
                  <th style="text-align:center;width:33%">Subject</th>
                  <th style="text-align:center">DOWNLOAD</th>
                </tr>
              </thead style="background-color: #009879">
              <tbody class="color_do" style="text-align:center;">
                <?php 
                    error_reporting(0);
                  require "config.inc.php";
                  $query = "SELECT class_section FROM students WHERE user_ID = '".$_SESSION['user_ID']."'";
                  $query_run = mysqli_query($con,$query);
                  $class = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
                  $query = "SELECT note_ID, file_name, subject, classes, comment FROM notes";
                  $query_run = mysqli_query($con,$query);
                  while($rows = mysqli_fetch_assoc($query_run)){
                    $classes = explode(',', $rows['classes']);
                    if(in_array($class['class_section'], $classes))
                    {
                      echo '
                        <tr>
                          <th style="text-align:center;width:33%">'.$rows['comment'].'</th>
                          <th style="text-align:center;width:33%">'.$rows['subject'].'</th>
                          <th style="text-align:center"><a href="include/notes/'.$rows['file_name'].'" download="'.$rows['comment'].'"><button class="btn btn-default">DOWNLOAD</button></a></th>
                        </tr>
                      ';
                    }
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



  <div id="myModal00" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header notice_back_to_all">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body  modal_bk_color" style="height:500px;overflow-y:auto;padding:10%">
          <?php 
            require "config.inc.php";
            $query = "SELECT info FROM notice";
            $query_run = mysqli_query($con,$query);
            $row = mysqli_fetch_array($query_run);
            echo "<p style='font-size:20px;text-align:justify;font-weight:100'><b>".$row['info']."</b><p>";
           ?>  
        </div>
        <div class="modal-footer" style="background-color:black">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> 

  <script type="text/javascript">
      document.getElementById("fixheadertableA").addEventListener("scroll", function(){
   var translate = "translate(0,"+this.scrollTop+"px)";
   this.querySelector("thead").style.transform = translate;
});
    </script>
