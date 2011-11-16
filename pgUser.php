<div>User Stuff goeth here</div>
<script type="text/javascript" >
	$('#panelUser').append( "Hello, " + userAppObj.userID +"<br>");
	$('#panelUser').append('userID # '+ userAppObj.userUID +'logged in');
	$('#panelSignOn2').html('You are signed in as: '+ userAppObj.userID );
	$('#panelSignOn2').show();

	//$('#panelUser').append('<br>'+
	fetchUserDocCount(userAppObj.userUID); //js func lives in ypickme.js
</script>
