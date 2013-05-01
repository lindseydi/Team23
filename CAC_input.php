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
  $studentNO = $_POST['studentNO'];
  $ranking_final= $_POST['ranking_final'];

   echo "<br/>";

	$dbc = mysql_connect("localhost", "mikey_w", "s3cr3t201e")
    or die('Error connecting to MySQL server.');
   
   mysql_select_db("mikey_w", $dbc);

   switch($ranking_final){
    case '0':
      $student_status = '1';
    break;
    case '1':
      $student_status = '1';
    break;
    case '3':
      $student_status = '2';
    break;
    case '4':
      $student_status = '3';
    break;
   }
   echo "<br/>";

   $query = "UPDATE processes SET student_status='$student_status', ranking_final= '$ranking_final' WHERE studentNO='$studentNO';";
   $query2 = "UPDATE applicant SET app_status='6', student_status='$student_status' WHERE studentNO='$studentNO';";
   echo "<br/>";


   $result = mysql_query($query)
    or die('Error querying database.'  . mysql_error());
   $result2 = mysql_query($query2)
    or die('Error querying database.'  . mysql_error());

  echo "<a href=\"cac_login_success.php\">Back Home</a>";
?>

</body>
</html>
