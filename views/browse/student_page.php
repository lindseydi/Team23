<?php

if($_SESSION['student_auth'] == false){
   header('Location: index.php?view=universal_login');
}

$_SESSION['register'] = false;

if(!empty($_POST)){
   if(isset($_POST['register']))
      $_SESSION['register'] = $_POST['register'];
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
   <head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Student Home Page</title>
      <style type="text/css">
         #center {
            text-align:center;
         }
      </style>
   </head>
   <body>
      <h1 style="text-align: center;"> University Registration System - Student Page</h1>
      <hr />

      <?php if ($_SESSION['register'] == false){ ?>
      <!-- This is a link that goes to the add_drop view when the button is pressed. -->
      <div id='center'>
         <form action='index.php?view=student_page' method="post">
            <input type='hidden' name='register' value='true'/>
            <input type='submit' value="Register for courses">
         </form>
      </div>

      <!-- This is a new form that goes to the transcript view when the button is pressed. -->
      <p><div id='center'>
         <form action="index.php?view=transcript" method="post">
            <input type='submit' value="Go to Transcript">
         </form>
      </div></p>

      <div id='center'>
         <form action="index.php?view=student_update_personal" method='POST'>
            <input type='hidden' name='edit' value='true'/>
            <input type='submit' value='Edit Profile'>
         </form>
      </div>



      <?php } //close the if statement
      else if($_SESSION['register'] == true) { ?>
         <div id='center'>
            <form action='index.php?view=register_course' method="post">         
               <select name='term' id='term'>
                  <option value='Fall 13'>Fall 13</option>
                  <option value='Spring 14'>Spring 14</option>
               </select>
               <input type="submit" value="Submit">
            </form>
         </div>
      <?php } ?>        

   </body>
</html>


