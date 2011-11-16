<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>YPick.me</title>

<!--  javascript includes -->
  <script type="text/javascript" src="./ypickme.js"></script>
  <script type="text/javascript" src="/jquery/jquery.js"></script>
  <link rel="stylesheet" type="text/css" href="ypickme_base.css" />

<!---  <script type="text/javascript">
    var crummyBrowser = false;
    isIE6 = /msie|MSIE 6/.test(navigator.userAgent);
    if (isIE6) {crummyBrowser = true;}
    if (crummyBrowser) {
        alert("please update your browser soon");}
  </script>
-->

<script type="text/javascript" >
//-----------------------  
$(document).ready(
   function(){
    documentReadyFunc();
} //end document ready function
);
</script>
  <?php session_start();
  //dump the php session-cookie variables into the userAppObj variables
  echo('<script type="text/javascript" >
        userAppObj.userID = "'. $_SESSION['userID'].'";
        userAppObj.userUID = "'. $_SESSION['userUID'].'";
</script>');
 ?>


  </head>
 <body>
<?php  ?>
 <?php
    include("header.php");
//    include("tabs.php");
    /*  */ include("mainbox.php");  
    include("footer.php");
?>
        <div class="modalbox" id="modalbox" style="display:none">ggg</div> 
  </body>
</html>
