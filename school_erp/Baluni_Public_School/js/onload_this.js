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
}

// window.addEventListener('beforeunload', function (e) { 
//             e.preventDefault(); 
//             e.returnValue = ''; 
//         $.ajax({
//         type: "POST",
//         url: "logout.php"
//     });
//         }); 


  var IDLE_TIMEOUT = 360; //seconds
  var _idleSecondsCounter = 0;

  document.onclick = function () {
      _idleSecondsCounter = 0;
  };

  document.onmousemove = function () {
      _idleSecondsCounter = 0;
  };

  document.onkeypress = function () {
      _idleSecondsCounter = 0;
  };
  document.onkeypress = function () {
      _idleSecondsCounter = 0;
  };
  document.onload = function () {
      _idleSecondsCounter = 0;
  };
  document.onmousedown = function () {
      _idleSecondsCounter = 0;
  };
  window.setInterval(CheckIdleTime, 1000);

  function CheckIdleTime() {
      _idleSecondsCounter++;
      var oPanel = document.getElementById("SecondsUntilExpire");
      if (oPanel)
          oPanel.innerHTML = (IDLE_TIMEOUT - _idleSecondsCounter) + "";
      if (_idleSecondsCounter >= IDLE_TIMEOUT) {
          alert("Time expired!");
          document.location.href = "logout.php";
      }
  }