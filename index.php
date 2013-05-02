<?php

   include('login.php');
   //include('addDropFunctions.php');
   //include('add_drop_functions.php');
   //include('enroll.php');

   if(!isset($_SESSION)){
      session_start();
   }

   if(!isset($_SESSION['student_auth'])){
      $_SESSION['student_auth'] = false;
      $_SESSION['faculty_auth'] = false;
      $_SESSION['gs_auth'] = false;
      $_SESSION['type'] = '';
      $_SESSION['username'] = 0;
      $_SESSION['password'] = '';
      $_SESSION['name'] = '';
      $_SESSION['register'] = '';
      $_SESSION['reg_error'] = array('error' => false, 'code' => 0);
   }

   //defaults to index unless otherwise specified
   $view = empty($_GET['view']) ? 'index' : $_GET['view'];

   //controller variable used for layouts
   $controller = 'browse';

   switch($view) {
      case "index":
         header('Location: title_page.html');   
      break;
   
   
      case "title_page":
         header('Location: title_page.html');   

      break;
      
      case "authenticate":
         //$type = $_POST['type'];  
         //mysql_query("RAWR") or die($_POST['username'].' '.$_POST['password']);
         $username = $_POST['username'];
         $password = $_POST['password'];
         
         $type = get_type($username);
         //mysql_query("RAWR") or die('Getting the type fine...'.' '.$type);

         if($type == 'false'){
            header('Location: index.php?view=universal_login');
         }

         dispatch($type, $username, $password);


      break;
      
      case "register":
         if(isset($_SESSION['register'])){
            unset($_SESSION['register']);
         }
         $_SESSION['register'] = $_POST['course'];         
         $_SESSION['reg_error'] = array('error' => false, 'code' => 0);
         
         
         //add_course($_SESSION['register']);
         $dbc = db_connect();
         $error = 0;
   
         $cid = mysql_real_escape_string($_POST['course']);
         $query1 = "SELECT ctitle, cday, ctime, credits FROM courses WHERE cid = '$cid'";
         $result = mysql_query($query1);
         $row = mysql_fetch_assoc($result);
         
         $cday = mysql_real_escape_string($row['cday']);
         $ctime = mysql_real_escape_string($row['ctime']);         
         $credit = mysql_real_escape_string($row['credits']);
         $student = mysql_real_escape_string($_SESSION['username']);
         $cname = mysql_real_escape_string($row['ctitle']);
         
         //for checking if already registered for the course
         $query2 = "SELECT transcripts.sid, transcripts.cid FROM transcripts WHERE transcripts.sid = '$student' AND transcripts.cid = '$cid'";
         $result2 = mysql_query($query2) or die(mysql_error());
         $num_results = mysql_num_rows($result2);
         
         //for checking for same time course
         $testquery = mysql_query("SELECT transcripts.sid, transcripts.ctime, transcripts.cday, courses.ctime, courses.cday
                                   FROM courses, transcripts 
                                   WHERE transcripts.sid = '$student' AND courses.cid = '$cid' AND transcripts.cday = courses.cday AND transcripts.ctime = courses.ctime
                                  ") or die($student.' '.$cid.' '.$error.' '.mysql_error());
         $numrows = mysql_num_rows($testquery);        

         if($numrows > 0){
            $error = 1;
         }
         
         //for checking for overlapping time course
         $time_query = "SELECT cday, ctime FROM transcripts WHERE sid = '$student'";
         $time_result = mysql_query($time_query) or die($time_query.' '.mysql_error());
         while($time_rows = mysql_fetch_assoc($time_result)){
            //mysql_query("RAWR") or die($row['cday'].' other day '.$time_rows['cday']); 
            if($row['cday'] == $time_rows['cday']){
               //mysql_query("RAWR") or die($row['ctime'].' '.$time_rows['ctime']);
               if((($row['ctime'] == '4-6:30 PM') && ($time_rows['ctime'] == '6-8:30 PM')) || 
                  (($row['ctime'] == '6-8:30 PM') && ($time_rows['ctime'] == '4-6:30 PM')) ){
                  $error = 1;
               }
               else if((($row['ctime'] == '3-5:30 PM') && ($time_rows['ctime'] == '4-6:30 PM')) || 
                       (($row['ctime'] == '4-6:30 PM') && ($time_rows['ctime'] == '3-5:30 PM')) ){
                  $error = 1;
               }
            }            
         }
         
         //for checking for prerequisites
         $q1 = "SELECT mpr, spr FROM courses WHERE courses.cid = '$cid'";
         $mprvalue = mysql_query($q1)
  	         or die('Query Error '.mysql_error());
  	
         $req_vals = mysql_fetch_assoc($mprvalue);
         $check_mpr = $req_vals['mpr'];
         $check_spr = $req_vals['spr'];

         if ($check_mpr == 'none'){
            //mysql_query("RAWR") or die($check_mpr);
            //proceed to registration
         }
         else {
            //mysql_query("RAWR") or die($check_mpr);
            //check for mpr match in transcripts
            $check_mpr = $req_vals['mpr'];
            $mpr_query = "SELECT * FROM transcripts, courses
                          WHERE courses.cid = transcripts.cid AND transcripts.sid = '$student' AND courses.cnum = '$check_mpr' ";
            $mpr_result = mysql_query($mpr_query) or die($mpr_query.' '.mysql_error());
            //no match in transcripts
            $mpr_test = mysql_num_rows($mpr_result);
            if(($mpr_test < 1) && ($check_spr == 'none')){
               //if($mpr_test > 0)
               //set error code, skip registration
               $error = 2;
               //mysql_query("RAWR") or die($mpr_test.' '.$error);
            }
            else {
               if($req_vals['spr'] != 'none') {
                  //check if spr match in transcripts
                  $spr_query = "SELECT * FROM transcripts, courses
                                WHERE transcripts.cid = courses.cid AND transcripts.sid = '$student' AND courses.cnum = '$check_spr'";
                  $spr_result = mysql_query($spr_query) or die($mpr_query.' '.mysql_error());
                  //no match in transcripts
                  $spr_test = mysql_num_rows($spr_result);
                  if($spr_test < 1){
                     $error = 2;
                     
                  }         
               }
            }
         }
         
         if($num_results > 0) {
            $_SESSION['reg_error']['error'] = true;
            $_SESSION['reg_error']['code'] = 2;
            header('Location: index.php?view=add_drop');
         } 
         else if ($error == 1) {
            $_SESSION['reg_error']['error'] = true;
            $_SESSION['reg_error']['code'] = 1;
            header('Location: index.php?view=add_drop');
         } 
         else if ($error == 2) {
            $_SESSION['reg_error']['error'] = true;
            $_SESSION['reg_error']['code'] = 3;
            header('Location: index.php?view=add_drop');
         } else {
   
            $query5 = "INSERT INTO transcripts VALUES ('$student', '$cid', '$cname', '$credit', 'IP', '$cday', '$ctime')";
            $result5 = mysql_query($query5) or die(mysql_error());
   
            mysql_close($dbc);
         
            header('Location: index.php?view=add_drop');
         }
      
      break;
      
      case "drop_course":
         if(isset($_SESSION['register'])){
            unset($_SESSION['register']);
         }
         $_SESSION['register'] = $_POST['course']; 
         
         $dbc = db_connect();
         $cid = mysql_real_escape_string($_POST['course']);
         $sid = $_SESSION['username'];
         
         $query = "DELETE FROM transcripts WHERE cid = '$cid' AND sid = '$sid'";
         mysql_query($query) or die(mysql_error());
         
         header('Location: index.php?view=transcript');
      break;
      
      case "student_login":
         if($_SESSION['student_auth'] == true) {
            header('Location: index.php?view=student_page');
         } 
      break;
      
      case "faculty_login":
         if($_SESSION['faculty_auth'] == true) {
            header('Location: index.php?view=faculty_page');
         } 
      break;
      
      case "gs_login":
         if($_SESSION['gs_auth'] == true) {
            header('Locatoin: index.php?view=gs_page');
         } 
      break;
   
      case "faculty_update":
         $mydbc = db_connect();
         $index = $_POST['index'];
         for ($i=1; $i<=$index; $i++){
            //update the grade
            $cid = $_POST['course'.$i];
            $sid = $_POST['student'.$i];
            $grade = $_POST['grade'.$i];
            $query = "UPDATE transcripts SET grades = '$grade' WHERE sid = '$sid' AND cid = '$cid' ";
            mysql_query($query) or die($grade.' '.$sid.' '.$cid.' '.mysql_query());
         }
         mysql_close($mydbc);
         header('Location: index.php?view=faculty_page');
      break;

   
      case "gs_update":
         $mydbc = db_connect();
         $index = $_POST['index'];
         for ($i=1; $i<=$index; $i++){
            //update the grade
            $cid = $_POST['course'.$i];
            $sid = $_POST['student'.$i];
            $grade = $_POST['grade'.$i];
            $query = "UPDATE transcripts SET grades = '$grade' WHERE sid = '$sid' AND cid = '$cid' ";
            mysql_query($query) or die($grade.' '.$sid.' '.$cid.' '.mysql_query());
         }
         mysql_close($mydbc);
         header('Location: index.php?view=gs_page');     	
      break;
      

      case "transcript":
      	
      break;
      
      case "logout":
         $_SESSION['student_auth'] = false;
         $_SESSION['faculty_auth'] = false;
         $_SESSION['faculty_auth'] = false;
         
         session_destroy();
         
         header('Location: index.php?view=index');
      break;

      case "app_checklogin":
         $dbc = db_connect();
         // username and password sent from form 
         $student_NO=$_POST['username']; 
         $password=$_POST['password'];

         //mysql_query("RAWR") or die ($_POST['username'].' '.$_POST['password']); 
         //mysql_query("RAWR") or die ('HI '.$student_NO.' '.$password); 

         // To protect MySQL injection (more detail about MySQL injection)
         $student_NO = stripslashes($student_NO);
         $password = stripslashes($password);
         $student_NO = mysql_real_escape_string($_POST['username']);
         $password = mysql_real_escape_string($_POST['password']);
         $_SESSION['student_NO'] = $student_NO;

         //mysql_query("RAWR") or die ('HI '.$student_NO.' '.$password); 

         //Table we want to select from:
         //$table_name="applicant";
         //mysql_query("RAWR") or die ('HI '.$student_NO.' '.$password); 
         $sql="SELECT * FROM applicant WHERE studentNO='$student_NO' and password='$password';";
         $result=mysql_query($sql);

         // Mysql_num_row is counting table row
         $count=mysql_num_rows($result);

         // If result matched $myusername and $mypassword, table row must be 1 row
         if($count==1){ 
            header("location: index.php?view=welcome");
         }
         else {
            echo "Wrong Username or Password";
            //echo "student: $student_NO";
            //echo "<br/>";
            //echo "password: $password";
            echo "<br/>";
            echo "<a href=\"applicant_login.php\">Go Back</a><br />";
         }

      break;

            
   }
   
   //includes the layout for the controller
   include "views/layouts/".$controller.".php";
   
?>