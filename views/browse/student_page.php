<?php

if($_SESSION['student_auth'] == false){
   header('Location: index.php?view=universal_login');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
   <head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Student Home Page</title>
   </head>
   <body>
      <h1 style="text-align: center;"> University Registration System - Student Page</h1>
      <hr />

      <!-- This is a link that goes to the add_drop view when the button is pressed. -->
      <p style="text-align:center"><a href="index.php?view=add_drop">Register for Courses</a></p>

      <!-- This is a new form that goes to the transcript view when the button is pressed. -->
      <p style="text-align:center"><a href="index.php?view=transcript">Student Transcript</a></p>               

   </body>
</html>
