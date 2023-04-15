 <div id="myModalc" class="modal fade" role="dialog">
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
              require "config.inc.php";
              $counter = 0;
              $query = "SELECT class_section FROM classes WHERE class_section != 'N/A'";
              $query_run = mysqli_query($con,$query);
              while($rows = mysqli_fetch_assoc($query_run)){
                  echo '<input type="checkbox" value="'.$rows['class_section'].'" name="class[]" >';
                  echo '<span style="margin-right:18%">'.$rows['class_section'].'</span>';
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
          </table>
        </div>
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
          <h4 class="modal-title" style="text-align:center;">NOTES</h4>
        </div>
        <div id="divtorefresh" class="modal-body" style="height:500px;overflow-y:auto;">
          
          <form action="include/upload_notes.php" enctype="multipart/form-data" onsubmit="process_pop();" method="post">
            Select Classes:<br/> 
            <?php 
              require "config.inc.php";
              $counter = 0;
              $query = "SELECT class_section FROM classes WHERE class_section != 'N/A'";
              $query_run = mysqli_query($con,$query);
              while($rows = mysqli_fetch_assoc($query_run)){
                  echo '<input type="checkbox" value="'.$rows['class_section'].'" name="class[]" >';
                  echo '<span style="margin-right:18%">'.$rows['class_section'].'</span>';
                  if($counter%3==0)
                  {
                    echo '<br/>';
                  }
                  $counter++;
              }
              error_reporting(0);
            ?>
            <br/>File Name: 
            <input type="text" name="comment" required><br/>
            <input type="file" name="file" required>
            <input type="submit" name="submit@00" class="btn btn-success" value="Upload"><hr/>
          </form>
          <form>
            <div class="row">
              <button type="button" value="deletealldata" class="btn btn-success" style="margin:0 37%;text-align:center" onclick="deletedata(this)">DELETE ALL</button>
            </div>
          </form>
          <div id="delete_status"></div>
        <br/><br/> <div id="fixheadertableA" class="table-responsive table_to_fix_with_device" >          
          <table  class="table" >
            <thead style="background-color: #009879;">
              <tr >
                <th style="text-align:center;width:33%">File</th>
                <th style="text-align:center;width:33%">Class</th>
                <th style="text-align:center">DELETE</th>
              </tr>
            </thead style="background-color: #009879">
            <tbody class="color_do" style="text-align:center;">
              <?php 
                require "config.inc.php";
                $query = "SELECT classes, file_name, comment FROM notes WHERE user_ID = '".$_SESSION['user_ID']."'";
                $query_run = mysqli_query($con,$query);
                while($rows = mysqli_fetch_assoc($query_run)){
                  echo '<tr >
                <th>'.$rows['comment'].'</th>
                <th>'.$rows['classes'].'</th>
                <th style="text-align:center"><button type="button" class="btn btn-success" value="'.$rows['file_name'].'" onclick="deletedata(this)" >DELETE</button></th>
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
    
    function deletedata(win) {
        $('#myModal_on_load').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                });
        $.post("include/delete.php",{post_data:win.value},
        function(data) {
          $('#delete_status').html(data);
      $("#myModal_on_load").modal("hide");          
        });
}

  function del_discussion(detail) {
        $('#myModal_on_load').modal({
                          backdrop: 'static',
                          keyboard: true, 
                          show: true
                  });      
          $.post("chat_inc/del_discussion.php",{delete_id:detail.value},
          function(data) {
            $('#msg_status').html(data);
          });
  }


  function del_messages(detail) {
        $('#myModal_on_load').modal({
                          backdrop: 'static',
                          keyboard: true, 
                          show: true
                  });      
          $.post("chat_inc/del_messages.php",{delete_id:detail.value},
          function(data) {
            $('#msg_status').html(data);
          });
  }
  </script>


  <script type="text/javascript">
      document.getElementById("fixheadertableA").addEventListener("scroll", function(){
   var translate = "translate(0,"+this.scrollTop+"px)";
   this.querySelector("thead").style.transform = translate;
});
    </script>
