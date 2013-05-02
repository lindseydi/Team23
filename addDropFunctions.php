<?php

include('login.php');

function add_course($cid){
   $dbc = db_connect();
   
   $cid = mysql_real_escape_string($cid);
   $query1 = "SELECT * FROM courses WHERE cid = '$cid'";
   $result = mysql_fetch_assoc(mysql_query($query1));
   
   $student = mysql_real_escape_string($_SESSION['username']);
   
   $cname = mysql_real_escape_string($result['ctitle']);
   
   $query2 = "INSERT INTO transcripts VALUES ('$student', '$cid', '$cname', 3, 'IP')";
   $result2 = mysql_query($query2) or die(mysql_error());
   
   mysql_close($dbc);
   return 0;

}
/*
function drop_course($cid){

}

function check_valid($cid){

}
*/
?>