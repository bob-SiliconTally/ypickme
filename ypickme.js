// ypickme.js

//isIE6 = /msie|MSIE 6/.test(navigator.userAgent);
//if isIE6 {crummyBrowser = true;}
//some globals
var userAppObj = new Object();
 userAppObj.userID = 0;   // username/handle
 userAppObj.userUID = 0;  // usernumber
 userAppObj.docCount = 0;  // how many docs does user have

landingPageMode = true;
//alert("js loaded");
//---------------------------------------------------------------------
function documentReadyFunc(){
//  $('#modalbox').hide();
    doSiteEnter(userAppObj.userUID > 0);
    $("#loginform").submit(function() {
    	     loginformSubmit();
    	     return false;});
     //----------------------------------------------------------------
     //----------------------------------------------------------------
     jQuery(document).ajaxStop(function(){
          $('body').css('cursor','auto');//  alert("it is done");
          }); //end ajaxStop
}
//-----------------------
function onWindowResize(){//window resize code
}
function onWindowResizehh(){//window resize code
	if (landingPageMode){
//		alert('in Landing Mode');
		$('#padLeft').width( ($('#mainbox').width()) - ($('#panelRegister').width())  -4 );
		$('#panelRegister').top(0);
		}else{
//		alert('Not in Landing Mode');
		$('#panelLeft').width(220);
		$('#mainbox').css('width', $('#mainWrap').width() - $('#panelLeft').width() - 10 +'px');
//alert('mww='+$('#mainWrap').width());
		$('#mainbox').css('left', $('#panelLeft').width() + 5 + 'px' );
		}
//	alert('doing resizing')
	}
//-----------------------
function doSiteEnter(loggedIn){
// if no user is logged, userID ==0	
	showLogInOutButton(loggedIn);
		if (loggedIn){ //logged in
		//	  alert("Logged In");
		//get back out of "Landing-page mode
			landingPageMode = false;
			$('#panelLeft').show();
//			$('#mainbox').css('width', '75%');
			$('#mainbox').css('left', $('#panelLeft').width() + 5 + 'px');
			$('#panelLeft').html('<div class="panel" id="panelUser"></div>');
			$('#panelUser').load('pgUser.php'); //n.b.: ".load()" is ASYNCHRONOUS!
//			$('#panelSignOn2').load('pgUser.php'); //n.b.: ".load()" is ASYNCHRONOUS!
			$('#panelLeft').append('<div class="panel" id="panelContAnnot"></div>');
			$('#panelContAnnot').load('pgAddAnnot.php');
			$('#panelLeft').append('<div class="panel" id="panelContSocial"></div>');
			$('#panelContSocial').load('pgSocial.php');
			$('#mainbox').load('pgEdit.php');
			if (userAppObj.docCount == 0){
				//nope, this needs to be moved into fetchUserDocCount()
				alert("You have no documents");
				}else{
					alert('You DO have documents!');
					}
			onWindowResize();
			}//endif loggedin
			else{ //NOT logged in/
				//go 'Landing-page mode"
				landingPageMode = true;
				$('#panelLeft').hide();
				//$('#mainbox').css('width', '100%');
	  			$('#mainbox').css('left', '0');
	  			$('#mainbox').load('pgWelcome.php');
//	  			$('#panelRegister').load('pgAcctCreate.php');//move into pgWelcome due to async nature
	  			//      showLogin();
	  		}
//	  		onWindowResize();

//     $("#panelLeft").load('pgLogin.php');
}
//-----------------------
function doLogOut(){
//	alert('logging out now');
	$('#panelSignOn').load('logOut.php');//may have to put in ajaxformat to call docreadyfunc at right time
	//okay, definitely need to put in ajax form...
	userAppObj.userUID = 0;
	documentReadyFunc();
	}
//-----------------------
function fetchUserDocCount(userUID){
	z = "You have _X_ documents" ;
	//do ajax call to fetch real count
	$.ajax({
		url: "userDocCount.php",
		type: "POST",
		data:  { userUID: userUID},
		dataType:"json",
		success: function(data){
			//		alert("alert in fetchUserDocCount");
			//n.b.: "success" is true if query completes, even if 0 rows returned!
			if (data == null) {
				alert('in userCount: NULL DATA HAS COME');
			}else{
				//do some preloop stuff
				$.each(data, function(index){
					//fill the row
					docCount =data[index].count;
					userAppObj.docCount = data[index].count })
				//$('body').css('cursor','auto');
//				alert("docCount= "+ docCount);
				$('#panelUser').append('<br>docCount= '+docCount);
		}
//        documentReadyFunc();
        }, //successfunction
    error: function(msg){
        alert("fail in bogus usercount:"+ msg.status);
        }});
}
//----------------------
function loginformSubmit(){
//	alert("in loginformSubmit");
  var data = $("#logonform").serialize();
//  alert("data = " + data);
//  alert("userID:"+data[0].userID);
  $.ajax({
    url: "login.php",
    type: "POST",
    data: data,
    dataType:"json",
    success: function(data){
//n.b.: "success" is true if query completes, even if 0 rows returned!
        if (data == null) {
			alert('sorry, please try again');
	        showLogin();//do till right... hopefully not recursing...
          }else{//we has a successful login, so...
			$('#modalbox').hide();
//			alert("I can has userID data?: " + data[0].userID);
			userAppObj.userUID = data[0].userUID;
			userAppObj.userID = data[0].userID;			
		   }
        documentReadyFunc();
        }, //successfunction
    error: function(data){
        alert("fail in loginformSubmit"+ data);
        }});
	//alert("done w/ ajax");
  return false;
        
} //loginformSubmit(){}
//----------------------------------------------
function registerformSubmit(){
//	alert("in registerformSubmit");
regID = $("#registerID").val();
regPass = $("#registeruserpass").val();
  var data = $("#registerform").serialize();
//  alert("data = " + data);
//  alert("userID:"+data[0].userID);
  $.ajax({
    url: "register.php",
    type: "POST",
    data: data,
//    dataType:"json",
    success: function(data){
//n.b.: "success" is true if query completes, even if 0 rows returned!
        if (data == null) {
			alert('nulldata in registerformSubmit');
			} // end if null
			else{//check return code: 1=successful addition, 0 = username taken
//			  alert('success in registerformsubmit');
			  if (data == 0){
				  alert("username taken, please choose another");
			  }else{
				  //alert("user account created, please login");
				  //need to make fake loginformsubmit here...
				  //---------------------------------------------------
				  // jam the following into modalbox, populate it, and manually submit it
				  //----------------------------------------------------
				  $("#modalbox").html(
				  '<form id="logonform" class ="logonform" name="logonform">' +
				  '<input id="loginuserID" name="userID" type="text" value= "" />'+
				  '<input id="loginuserpass" name="userPass" type="password" value= "" />'+
				  '<input type="submit" id="loginbutton" name="loginbutton" value="login" />'+
				  '</form>');
				  //----------------------------------------------------
				  //$("#modalbox").show();
				  $("#loginuserID").val(regID);
				  $("#loginuserpass").val(regPass);
				  //alert("about to submit");
				  loginformSubmit();
			      }//end else data != 0
				} //end else (not null)
//        documentReadyFunc();
        }, //end success function
    error: function(data){
        alert("errorfail in registerformSubmit"+ data);
        }//end error func
        }); //end ajax call
  return false;
} // end registerformSubmit()
//------------------------------
function showLogin(){
//	alert("in showLogin");
	$("#modalbox").load('pgLogin.php');
	$("#modalbox").show();
	}
//-----------------------
function showLogInOutButton(loggedIn){
	//----------------------------
//	if (userAppObj.userUID == 0){
	if (loggedIn == false){
		//not logged in
		$('#panelSignOn2').hide();
		$('#panelSignOn').html(
		'<span class= "tab" id="loginTab">' + 
		'<a href="#" onclick = "javascript:showLogin();"  >Sign in</a>'+
		'</span>');
	}else{
		//yes, logged in
		$('#panelSignOn').html(
		'<span class= "tab" id="loginTab">' + 
		'<a href="#" onclick = "javascript:doLogOut();"  >Sign out</a>'+
		'</span>');
	}
} // showLogInOutButton()
//----------------------
