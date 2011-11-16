<?php
/* 
userDocCount script 
this is to be called as a function via AJAX via POST
IN --> userUID
RETURNS: count: (int)
*/
// Connecting, selecting database
session_start();
require 'creds.php';
$link = mysql_connect($dbhost, $dbuser, $dbpass)
    or die('Could not connect: ' . mysql_error());
//echo 'Connected successfully';

mysql_select_db($dbName) or die('Could not select database');

// Performing SQL query
$query = sprintf("SELECT count(*) as count from documents WHERE userUID='%s'",
    mysql_real_escape_string($_REQUEST["userUID"]) );
    
//echo 'query = '.$query;
$result = mysql_query($query) or die('Query failed: ' . mysql_error());

$num_rows = mysql_num_rows($result);
//=======================
//barf it out in JSON --------------------------
if($num_rows > 0 )
    {
    $row_curr = 0;
    //outp = json_encode($result);
    //echo(outp);
    echo("[");
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
        {$row_curr ++;
         $row = json_encode($row);
         echo($row);
         if ($row_curr < $num_rows){echo(",");}
        } 
    echo("]");}
    else
    {
    echo ("");
    }
//---------------------------

//=========================


mysql_free_result($result);

// Closing connection
mysql_close($link);
?>
