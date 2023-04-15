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






function SearchDuplicate() {
        $('#myModal_on_load').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                });
    $.post("include/duplicate.php",{},
    function(data) {
      $('#edit_user_to_paste').html(data);
      $("#myModal_on_load").modal("hide");
    });
}



function changethemarks() {
        var marks = $('#markss_to_change').val();
        var id = $('#idd_for_marks').val();
        var paper_id = $('#tests_for_marks').val();
        var permission = $('#permissiontomark').val();
        if(permission == ""){
          alert('Please Select the Checkbox!');
        }
        else{
          if(!(marks == "" || id == "" || paper_id == "")) {
              $('#myModal_on_load').modal({
                          backdrop: 'static',
                          keyboard: true, 
                          show: true
                  });
            $.post("include/change_marks_student.php",{post_marks:marks,post_id:id,post_testId:paper_id},
            function(data) {
              $('#c_s_output').html(data);
              $("#myModal_on_load").modal("hide");
            });
          }
          else {
              alert('Some Details are Incomplete!'); 
          }
        }
      }







function markchangenow() {
        var user = $('#mark_change_scheme').val();
        var userd = $('#mark_change_way').val();
        if(!(user == "" || userd == "")) {
            $('#myModal_on_load').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                });
          $.post("include/show_marks_given.php",{post_id:user,post_paperid:userd},
          function(data) {
            $('#c_s_output').html(data);
            $("#myModal_on_load").modal("hide");
          });
        }
        else {
            alert('Some Details are Incomplete!'); 
        }
      }



function class_change_eos() {
    
     var user = $('#user_class_eos').val();
     if(user == '')
     {
        alert("Search Box is Empty");
     }
     else {
            $('#myModal_on_load').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                }); 
        $.post("include/endofsession_search.php",{post_data:user},
        function(data) {
          $('#paste_users_eos').html(data);
          $("#myModal_on_load").modal("hide");
        });
      }
}




function send_notice() {
  var user = $('#notice_to_send').val();
  if(user == ''){
    alert('Notice Box is Empty');
  }
  else {
      $('#myModal_on_load').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                });
    $.post("include/send_notice.php",{whole_text:user},
      function(data){
        $('#notice_output').html(data);
        $("#myModal_on_load").modal("hide");
      })
  }
}


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


function editpartyfun() {
  var user = $('#editparty').val();
  if(user == ''){
    alert('Search Box is Empty');
  }
  else {
      $('#myModal_on_load').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                });
    $.post("include/edit_party_form.php",{party:user},
      function(data){
        $('#editpartysec').html(data);
        $("#myModal_on_load").modal("hide");
      })
  }
}

// function changeclassnow() {
//         $.post("include/changeclassnow01.php",{post_data_on_set:data_on_set,post_class_to_assign:class_to_assign},
//         function(data) {
//           console.log(data);
//         });
//     return false;
// }


function edit_class_of_user() {
    
     var user = $('#edit_user_class').val();
     if(user == '')
     {
        alert("Search Box is Empty");
     }
     else {
            $('#myModal_on_load').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                }); 
        $.post("include/search_for_user.php",{post_data:user},
        function(data) {
          $('#edit_user_to_paste').html(data);
          $("#myModal_on_load").modal("hide");
        });
      }
}


// still pending
function endofsession0000() {
 
  var user = $('#eos_name').val();
  if(user == ''){
    alert('Input Box is Empty');
  }
  else {
          $('#myModal_on_load').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                }); 
    $.post("include/endofsession0000.php",{eos:user},
      function(data){
        $('#result_eos').html(data);
        $("#myModal_on_load").modal("hide");
      })
  }
}



function endofsession0002() {
      $('#myModal_on_load').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                });
  var cal = $('#selected_class').val();
  var ses = $('#selected_session').val();
    $.post("include/endofsession0002.php",{dump_class:cal,dump_year:ses},
      function(data){
        $('#result_eos').html(data);
        $("#myModal_on_load").modal("hide");
      })
}


function operation_1(abc) {
      if(abc.value == "")
      {
        $('#pasteData01').html('');
      }
      else {
            $('#myModal_on_load').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                });
        $.post("include/operation_on_class.php",{operation:abc.value},
      function(data) {
        $('#pasteData01').html(data);
        $("#myModal_on_load").modal("hide");
      });
    }
  }






function changedata() {
  var user = $('#user_type').val();
  if(!(user == "")) {
      $('#myModal_on_load').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                });
    $.post("include/getdata_nav.inc.php",{post_user:user},
    function(data) {
      $('#pasteData').html(data);
      $("#myModal_on_load").modal("hide");
    });
  }
  else {
      $('#pasteData').html(''); 
  }
}
// function changedata01() {
//  var user = $('#user_type01').val();
//  var userd = $('#user_dtype01').val();
//   if(!(user == "" || userd == "")) {
//     $.post("include/getdata_nav01.inc.php",{post_user:user,post_userd:userd},
//     function(data) {
//       $('#pasteData01').html(data);
//     });
//   }
//   else {
//     $('#pasteData').html(""); 
//   }
// }
function changedata01() {

 var user = $('#user_type01').val();
  if(user != "") {
          $('#myModal_on_load').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                });
    $.post("include/getdata_nav01.inc.php",{post_user:user},
    function(data) {
      $('#pasteData01').html(data);
      $("#myModal_on_load").modal("hide");
    });
  }
  else {
    $('#pasteData').html(""); 
  }
}


function requestI() {
 var user = $('#user_request').val();
 if(user == '')
 {
    alert("Search Box is Empty");
 }
 else {
      $('#myModal_on_load').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                });
    $.post("include/requestI.php",{post_user:user},
    function(data) {
      $('#pasteData_request').html(data);
      $("#myModal_on_load").modal("hide");
    });
  }
}


function requestII() {
        $('#myModal_on_load').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                });
    $.post("include/requestII.php",{},
    function(data) {
      $('#pasteData_request').html(data);
      $("#myModal_on_load").modal("hide");
    });
}


function requestIII() {
        $('#myModal_on_load').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                });
    $.post("include/requestIII.php",{},
    function(data) {
      $('#pasteData_request').html(data);
      $("#myModal_on_load").modal("hide");
    });
}


function dashboard_query() {
     var user = $('#dashboard_query_ID_1').val();
     if(user == '')
     {
        alert("Search Box is Empty");
     }
     else {
            $('#myModal_on_load').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                });
        $.post("include/s_c_dashboardI.php",{post_data:user},
        function(data) {
          $('#c_s_output').html(data);
          $("#myModal_on_load").modal("hide");
        });
      }
}

document.getElementById("fixheadertable_xx").addEventListener("scroll", function(){
  var translate = "translate(0,"+this.scrollTop+"px)";
  this.querySelector("thead").style.transform = translate;
});


