<?php

   function add_course($cid){
      $dbc = db_connect();
   
      $cid = mysql_real_escape_string($_POST['course']);
      $query1 = "SELECT * FROM courses WHERE cid = '$cid'";
      $result = mysql_query($query1);
      $row = mysql_fetch_assoc($result);
   
      $student = mysql_real_escape_string($_SESSION['username']);
   
      $cname = mysql_real_escape_string($row['ctitle']);
   
      $query2 = "INSERT INTO transcripts VALUES ('$student', '$cid', '$cname', 3, 'IP')";
      $result2 = mysql_query($query2) or die(mysql_error());
   
      mysql_close($dbc);

   }

   function db_connect(){
      $connection = mysql_pconnect('localhost', 'mikey_w', 's3cr3t201e') or die(mysql_error());
      
      if(!$connection){
         echo mysql_error();
      }
      
      if(!mysql_select_db('mikey_w')){
         echo mysql_error();
      }
      
      return $connection;
   }

?>