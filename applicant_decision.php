<?php

  $dbc = mysql_connect("localhost", "mikey_w", "s3cr3t201e")
    or die('Error connecting to MySQL server.');
   
   mysql_select_db("mikey_w", $dbc);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Decision Recorded</title>
</head>
<body>

<?php
  $studentNO = $_GET['studentNO'];
  $decision = $_POST['decision'];

  $query ="UPDATE applicant SET student_status='$decision' WHERE studentNO='$studentNO';";
  $query2 = "UPDATE processes SET student_status='$decision' WHERE studentNO='$studentNO';";

  $result = mysql_query($query)
    or die('Error querying database.'  . mysql_error());

  $result2 = mysql_query($query2)
    or die('Error querying database.'  . mysql_error());

  if($decision=='4'){
    echo "Thank you for considering GW for you graduate studies. We wish you luck in your pursuits. Your account will be deleted. ";
    //delete info from system?
    //$query3= "DELETE FROM applicant, processes, appication, review WHERE studentNO='$studentNO';";

    $result3= mysql_query($result3)
      or die ('Error querying database.' . mysql_error()));

  }else if($decision=='5'){
    echo "Thank you! Your information has been updated in our records. Please check back in a few days to get your student information!";
  }

  mysql_close($dbc);

  echo '<br /><br />';
  echo "<a href='welcome.php?student_NO=$studentNO'>Go back home</a><br />";
?>

</body>
</html>
