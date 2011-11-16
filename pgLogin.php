Main Screen Turn On
<hr>Hello Gentlemen. You do not seem to be logged in at the monent.
please remedy this situation post-haste or I shall be forced to ask you again!
<hr>
<form id="logonform" class ="logonform" name="logonform">
	<!---  action="javascript:loginformSubmit();" method="post" --->
<input id="loginuserID" name="userID" type="text" value= '' />
<input id="loginuserpass" name="userPass" type="password" value= '' />
<input type="submit" id="loginbutton" name="loginbutton" value="login" />
</form>

<script type="text/javascript" >
//since the form didn't exist at startup, submit-hook can't be set in documentReadyFunc(), 
// so use bind() here.
   $('form#logonform').bind('submit', loginformSubmit);
</script>
