Registration Form
<hr>
<form id="registerform" class ="registerform" name="registerform">
	<!---  action="javascript:loginformSubmit();" method="post" --->
userID:<input id="registerID" name="userID" type="text" value= '' />
email:<input id="registeruseremail" name="userEmail" type="text" value= '' />
password:<input id="registeruserpass" name="userPass" type="password" value= '' />
<input type="submit" id="loginbutton" name="loginbutton" value="login" />
</form>

<script type="text/javascript" >
//since the form didn't exist at startup, submit-hook can't be set in documentReadyFunc(), 
// so use bind() here.
   $('form#registerform').bind('submit', registerformSubmit);
</script>
