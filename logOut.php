<?php
    session_start();
    $_SESSION = array();
    session_destroy();
  //dump the php session-cookie variables into the userAppObj variables
  echo('<script type="text/javascript" >
        userAppObj.userID = "";
        userAppObj.userUID = 0;
        documentReadyFunc();
        </script>');
 ?>
