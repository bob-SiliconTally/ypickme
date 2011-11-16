<?php
/* 
login script 
this is to be called as a function via AJAX via POST
IN --> username password
RETURNS: a string containing the username or "" if the login fails.
*/
//echo ("Username given is: " . $_REQUEST['username'] ."<br />");
//echo ("Pass given is: " . $_REQUEST['userpass'] ."<br />" );
// Connecting, selecting database
session_start();
require 'creds.php';
$link = mysql_connect($dbhost, $dbuser, $dbpass)
    or die('Could not connect: ' . mysql_error());

//echo 'Connected successfully';
mysql_select_db($dbName) or die('Could not select database');

// Performing SQL query
//$query = 'SELECT * FROM users where ($_REQUEST["username"] = userName) ';

$query = sprintf("SELECT userUID, userID FROM users WHERE userID='%s' AND userPass='%s'",
    mysql_real_escape_string($_REQUEST["userID"]),
    mysql_real_escape_string($_REQUEST["userPass"]));

//echo 'query = '.$query;
$result = mysql_query($query) or die('Query failed: ' . mysql_error());

$num_rows = mysql_num_rows($result);
if($num_rows =1 )
    {
	echo"{";
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
        {
//        printf("ID: %s  Name: %s", $row["userID"], $row["userName"]);
        echo($row["userUID"]);
        echo($row["userID"]);
        $_SESSION['username'] = $row["userUID"];
        $_SESSION['userid'] = $row["userID"];
        }
    echo"}";
    }
    else
    {
    echo ("");
    }


// Free resultset
mysql_free_result($result);

// Closing connection
mysql_close($link);
//echo ('$num_rows = '. $num_rows. "<br />");
//zzzzif($num_rows >0 )
  //  {echo ($row["userID"]);}
    //else{echo ("");}

?>
