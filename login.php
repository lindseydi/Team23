<?php

   function get_type($username){
      $dbc = db_connect();
      //mysql_query("RAWR") or die($username);
      $id = mysql_real_escape_string($username);
      $query = "SELECT sid FROM students WHERE sid='$id'";
      $query_result = mysql_query($query) or die(mysql_error().' '.$id);
      $row = mysql_fetch_assoc($query_result);
      if($username == $row['sid']){
         mysql_close($dbc);
         return 'student';
      }

      $query = "SELECT fid FROM faculty WHERE fid='$id'";
      $query_result = mysql_query($query) or die(mysql_error().' '.$id);
      $row = mysql_fetch_assoc($query_result);
      //mysql_query("RAWR") or die($username.' '.$row['fid']);
      if($username == $row['fid']){
         mysql_close($dbc);
         return 'faculty';
      }

      $query = "SELECT gid FROM gsecretary WHERE gid='$id'";
      $query_result = mysql_query($query) or die(mysql_error().' '.$id);
      $row = mysql_fetch_assoc($query_result);
      if($username == $row['gid']){
         mysql_close($dbc);
         return 'gsecretary';
      }

      $query = "SELECT fcid FROM fcommittee WHERE fcid='$id'";
      $query_result = mysql_query($query) or die(mysql_error().' '.$id);
      $row = mysql_fetch_assoc($query_result);
      if($username == $row['fcid']){
         mysql_close($dbc);
         return 'fcommittee';
      }

      $query = "SELECT aid FROM CAC WHERE aid='$id'";
      $query_result = mysql_query($query) or die(mysql_error().' '.$id);
      $row = mysql_fetch_assoc($query_result);
      if($username == $row['aid']){
         mysql_close($dbc);
         return 'cac';
      }
      else{
         mysql_close($dbc);
         return 'false';
      }
      
   }

   function dispatch($type, $username, $password){
      if($type == 'student') {
         if(CheckStudentLoginInDB($username, $password) == false){
            header('Location: index.php?view=universal_login');
         }
         else {
            $_SESSION['student_auth'] = true; $_SESSION['faculty_auth'] = false; 
            $_SESSION['gs_auth'] = false;     $_SESSION['fcomm_auth'] = false;
            $_SESSION['cac'] = false;
            header('Location: index.php?view=student_page');
         }
      }
      else if($type == 'faculty') {
         if(CheckFacultyLoginInDB($username, $password) == false){
            header('Location: index.php?view=universal_login');
         }
         else {
            $_SESSION['faculty_auth'] = true; $_SESSION['gs_auth'] = false; 
            $_SESSION['student_auth'] = false;$_SESSION['fcomm_auth'] = false;
            $_SESSION['cac_auth'] = false;
            header('Location: index.php?view=faculty_page');
         }
      }
      else if($type == 'gsecretary') {
         if(CheckGSLoginInDB($username, $password) == false){
            header('Location: index.php?view=universal_login');
         }
         else {
            $_SESSION['gs_auth'] = true;        $_SESSION['student_auth'] = false; 
            $_SESSION['faculty_auth'] = false;  $_SESSION['fcomm_auth'] = false;
            $_SESSION['cac_auth'] = false;
            header('Location: index.php?view=gs_login_success');
         }
      }
      else if($type == 'fcommittee') {
         if(CheckFCommLoginInDB($username, $password) == false){
            header('Location: index.php?view=universal_login');
         }
         else {
            $_SESSION['gs_auth'] = false;       $_SESSION['student_auth'] = false; 
            $_SESSION['faculty_auth'] = false;  $_SESSION['fcomm_auth'] = true;
            $_SESSION['cac_auth'] = false;
            header('Location: index.php?view=fcommittee_login_success');
         }
      }
      else if($type == 'cac') {
         if(CheckCACLoginInDB($username, $password) == false){
            header('Location: index.php?view=universal_login');
         }
         else {
            $_SESSION['gs_auth'] = false;       $_SESSION['student_auth'] = false; 
            $_SESSION['faculty_auth'] = false;  $_SESSION['fcomm_auth'] = false;
            $_SESSION['cac_auth'] = true;
            header('Location: index.php?view=cac_login_success');
         }
      }                
      else{
         header('Location: index.php?view=index');
      }
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
   
   function db_result_to_array($result){
      $result_array = array();
      
      for ($i = 0; $row = mysql_fetch_array($result); $i++){
         $result_array[$i] = $row;
      }
      
      return $result_array;
   }  

   function CheckStudentLoginInDB($user,$pass){
      $dbc = db_connect();
      
      //$pwdmd5 = md5($password);
      $query = "Select sname, sid, password from students where sid='$user' and password='$pass'";
        
      $result = mysql_query($query);
        
      if(!$result || mysql_num_rows($result) <= 0) {
         return false;
      }
        
      $row = mysql_fetch_assoc($result);
      $_SESSION['name'] = $row['sname'];
      $_SESSION['username']  = $row['sid'];
      $_SESSION['password'] = $row['password'];
      
      mysql_close($dbc);
      
      return true;
   }
   
   function CheckFacultyLoginInDB($user,$pass){
      $dbc = db_connect();

      //$pwdmd5 = md5($password);
      $query = "Select fname, fid, password from faculty where fid='$user' and password='$pass'";
        
      $result = mysql_query($query);
        
      if(!$result || mysql_num_rows($result) <= 0) {
         return false;
      }
        
      $row = mysql_fetch_assoc($result);
      $_SESSION['user'] = $row['fname'];
      $_SESSION['username']  = $row['fid'];
      $_SESSION['password'] = $row['password'];
      
      mysql_close($dbc);
      
      return true;
   }
   
   function CheckGSLoginInDB($user,$pass){
      $dbc = db_connect();

      //$pwdmd5 = md5($password);
      $query = "Select gname, gid, password from gsecretary where gid='$user' and password='$pass'";
        
      $result = mysql_query($query);
        
      if(!$result || mysql_num_rows($result) <= 0) {
         return false;
      }
        
      $row = mysql_fetch_assoc($result);
      $_SESSION['user'] = $row['gname'];
      $_SESSION['username']  = $row['gid'];
      $_SESSION['password'] = $row['password'];
      
      mysql_close($dbc);
      
      return true;
   }
   
   function CheckFCommLoginInDB($user,$pass){
      $dbc = db_connect();

      //$pwdmd5 = md5($password);
      $query = "SELECT name, fcid, password FROM fcommittee WHERE fcid='$user' and password='$pass'";
        
      $result = mysql_query($query);
        
      if(!$result || mysql_num_rows($result) <= 0) {
         return false;
      }
        
      $row = mysql_fetch_assoc($result);
      $_SESSION['user'] = $row['name'];
      $_SESSION['username']  = $row['fcid'];
      $_SESSION['password'] = $row['password'];
      
      mysql_close($dbc);
      
      return true;
   }   

   function CheckCACLoginInDB($user,$pass){
      $dbc = db_connect();

      //$pwdmd5 = md5($password);
      $query = "SELECT name, aid, password FROM CAC WHERE aid='$user' and password='$pass'";
        
      $result = mysql_query($query);
        
      if(!$result || mysql_num_rows($result) <= 0) {
         return false;
      }
        
      $row = mysql_fetch_assoc($result);
      $_SESSION['user'] = $row['name'];
      $_SESSION['username']  = $row['aid'];
      $_SESSION['password'] = $row['password'];
      
      mysql_close($dbc);
      
      return true;
   }   
    
   
?>