<?php
     $dbc = mysql_connect("localhost", "mikey_w", "s3cr3t201e") 
        or die(mysql_error()); 
     mysql_select_db("mikey_w", $dbc); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Welcome</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h2>Welcome! What would you like to do?</h2>

<?php
  $studnum = $_GET['student_NO'];

  $query = "SELECT app_status FROM applicant WHERE studentNO=$studnum;";
  //echo $query;

  $result = mysql_query($query)
   or die('Error querying database.'  . mysql_error());

  list($app_status) = mysql_fetch_row($result);
  //Link to continue application ONLY GET access if they have not hit submit!

  //echo $app_status;

  if($app_status < 2){
    echo "<a href=\"academic_app.php?student_no=$studnum\">Fill out your Application</a><br />";
  }else{
    echo "Your application has been submitted! Click the link below to see it's status.";
  }

  echo "<br/>";  
  echo "<br/>";

  //check admittance status 
  echo "<a href=\"check_status.php?student_no=$studnum\">Check Status</a><br />";

  echo "<br/>";  
  echo "<br/>";

  //Update personal information
  echo "<a href=\"update_personal.php?student_no=$studnum\">Update Personal Info</a><br />";

?>
  <br />


</body>
</html>