<?php
/* 
register script 
this is to be called as a function via AJAX via POST
IN --> 
requested username 
userEmail
password
RETURNS: success code as follows:
1: successfully added
0: username already taken

*/
//--------------------------
//echo ($_REQUEST['userID']);
//echo ("hello");
session_start();

$taken = checkUsernameAvail($_REQUEST['userID']);
if ($taken){
	echo("0");
	}
	else{//not taken
//	echo("available");
	echo addUserRecord();
	//username is available, so create record in users table
	//and send success mssg back to caller	
	}
//echo $taken;
//-----------------------------
function addUserRecord(){
//do sql insert to create user record
// set userID = $_REQUEST['userID']
// set password = $_REQUEST['password']
	require 'creds.php';
	$link = mysql_connect($dbhost, $dbuser, $dbpass)
	    or die('Could not connect: ' . mysql_error());
    //echo 'Connected successfully';
    mysql_select_db($dbName) or die('Could not select database');
    $query = sprintf("insert into users (userID, userEmail, userPass) VALUES('%s', '%s', '%s')",
    mysql_real_escape_string($_REQUEST["userID"]),
    mysql_real_escape_string($_REQUEST["userEmail"]),
    mysql_real_escape_string($_REQUEST["userPass"])
    );
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    mysql_free_result($result);// Closing connection
    mysql_close($link);

//     return $query;
//     return '1';
     return ('resultx='.$result);

	}
//---------------------------
function checkUsernameAvail($desiredUserID){
	require 'creds.php';

	$link = mysql_connect($dbhost, $dbuser, $dbpass)
    or die('Could not connect: ' . mysql_error());
    //echo 'Connected successfully';
    mysql_select_db($dbName) or die('Could not select database');
    $query = sprintf("SELECT count(*) as count from users WHERE userID='%s'",
    mysql_real_escape_string($desiredUserID) );    

    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    $num_rows = mysql_num_rows($result);    
//	$qrycount = "okay";
//	$qrycount = 'num_rows = '.$num_rows;
	if($num_rows > 0 ){
		$row_curr = 1;
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		$qrycount = $row["count"];
		}//end if num_rows > 0
		else{
			$qrycount = "problem";
		}//end else
    mysql_free_result($result);// Closing connection
    mysql_close($link);
    return $qrycount;
} //end func check()	
?>
