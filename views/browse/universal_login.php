<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Student Login Page</title>
      <style type="text/css">
         html #wrapper{
            width:300px;
            margin:0 auto;
         }
      </style>
</head>

   <body>
      <form id ='wrapper' action='index.php?view=authenticate' method='POST' accept-charset='UTF-8'>
         <fieldset >
            <legend>Student Login</legend>
            <div class='short_explanation'>* required fields</div>
            <input type='hidden' name='submitted' id='submitted' value='1'/>           
            <input type='hidden' name='type' id='type' value='student'/>
            
            <div class='container'>
               <label for='username' >UserName*:</label><br/>
               <input type='text' name='username' id='username' maxlength="50" required/><br/>
            </div>
               
            <div class='container'>
               <label for='password' >Password*:</label><br/>
               <input type='password' name='password' id='password' maxlength="50" required/><br/>
            </div>
            
            <div class='container'>
               <input type='submit' name='Submit' value='Submit' />
            </div>
               
         </fieldset>
      </form>
   </body>
</html>