<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Personal Info Updated</title>
</head>
<body>

<?php
  $studentNO = $_GET['studentNO'];

  $first_name = $_POST['firstname'];
  $last_name = $_POST['lastname'];
  $address_1 = $_POST['addr1'];
  $address_2 = $_POST['addr2'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $zip = $_POST['zip'];
  $phone = $_POST['phone'];
  $phone = str_replace("-", "", $phone);
  $phone = str_replace("(", "", $phone);
  $phone = str_replace(")", "", $phone);
  $phone = str_replace(" ", "", $phone);
  $email = $_POST['email'];

  $dbc = mysql_connect("localhost", "mikey_w", "s3cr3t201e")
    or die('Error connecting to MySQL server.');
   
   mysql_select_db("mikey_w", $dbc);

  $query ="UPDATE applicant SET fname='$first_name', lname='$last_name', email='$email', addr1='$address_1', addr2='$address_2', city='$city', state='$state', zip='$zip', phoneNO='$phone' WHERE studentNO='$studentNO';";

  $result = mysql_query($query)
    or die('Error querying database.'  . mysql_error());

  echo "Thank you! Your information has been updated in our records.";

  mysql_close($dbc);

  echo '<br /><br />';
  echo "<a href='welcome.php?student_NO=$studentNO'>Go back home</a><br />";
?>

</body>
</html>
