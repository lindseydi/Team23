<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Updated</title>
</head>
<body>
Your decision has been recorded.

<?php
  $letter_cred = $_POST['letter_cred'];
  $letter_rank = $_POST['letter_rank'];
  $studentNO = $_POST['studentNO'];
  $email = $_POST['email'];
  $advisor_rec = $_POST['advisor_rec'];
  $rank = $_POST['rank'];
  $reason_reject = $_POST['reason_reject'];
  $comments = $_POST['comments'];
  

	$dbc = mysql_connect("localhost", "mikey_w", "s3cr3t201e")
    or die('Error connecting to MySQL server.');
   
   mysql_select_db("mikey_w", $dbc);

   $query = "INSERT INTO review (letter_cred, letter_rank, studentNO, email, advisor_rec, rank, reason_reject, comments) VALUES('$letter_cred', '$letter_rank', 
    '$studentNO', '$email', '$advisor_rec', '$rank', '$reason_reject', '$comments');";

  $result = mysql_query($query)
     or die('Error querying database.'  . mysql_error());

  echo "Thank you for submitting your review!";
  echo "<br/>";
  echo "<br/>";  
  echo "<a href=\"fcommittee_login_success.php?email=$email\">Back to welcome screen.</a><br />";

?>
