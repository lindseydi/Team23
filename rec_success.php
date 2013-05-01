<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Recorded</title>
</head>
<body>
  <h2>Your Recommendation has been recorded.</h2>

<?php
  $studentNO = $_GET['studentNO'];
  $rec_email= $_POST['rec_email'];
  $rec_full_name = $_POST['rec_full_name'];
  $title = $_POST['title'];
  $affiliation = $_POST['affiliation'];
  $rec_letter = $_POST['rec_letter'];

  $dbc = mysql_connect("localhost", "mikey_w", "s3cr3t201e")
    or die('Error connecting to MySQL server.');
   
   mysql_select_db("mikey_w", $dbc);

  $query = "INSERT INTO recommends (rec_email,rec_full_name,title,affiliation, rec_letter) VALUES ('$rec_email', '$rec_full_name', '$title', '$affiliation', '$rec_letter');";
  $query2 = "SELECT transcript_recv FROM application WHERE studentNO=$studentNO;";
  list($transcript_recv) = mysql_fetch_row(mysql_query($query2));

  if($transcript_recv=='0'){
    $query3= "UPDATE applicant SET app_status='4' WHERE studentNO=$studentNO;";
  }else{
    $query3= "UPDATE applicant SET app_status='5' WHERE studentNO=$studentNO;";
  }

  $query4 = "UPDATE application SET letter_recv='1' WHERE studentNO='$studentNO';";



  $result = mysql_query($query)
    or die('Error querying database.');
  $result3 = mysql_query($query3)
    or die('Error querying database.');
  $result4 = mysql_query($query3)
    or die('Error querying database.');

  mysql_close($dbc);

  echo 'Thanks for submitting the Recommendation.<br />';
  echo "<a href=\"rec_login_success.php?rec_email=$rec_email \">$fname $lname</a>";
  echo "<br/>";
?>

</body>
</html>
