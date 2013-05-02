<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Welcome CAC</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h2>Welcome CAC!</h2>

  <p>Here is the list of applicants that need review: </p>

<?php

 //connect to mysql and select the database to use
  $dbc = mysql_connect("localhost", "mikey_W", "s3cr3t201e")
    or die('Error connecting to MySQL server.');
  mysql_select_db("mikey_W", $dbc);

  $query = "SELECT studentNO FROM applicant WHERE app_status='5' AND EXISTS(SELECT * FROM review WHERE review.studentNO=applicant.studentNO);";
//echo $query;
$data = mysql_query($query);
//echo mysql_num_rows($data);
if (mysql_num_rows($data) < 1){
  echo "There are no students that need review at this time.";
}


//List links to the student review pages
while(list($studentNO) = mysql_fetch_row($data))
{
  echo "<br />";
  echo "<a href=\"CACview.php?student_no=$studentNO \">Applicant $studentNO</a>";
  echo "<br />";
 }

 ?>
  
</body>
</html>
