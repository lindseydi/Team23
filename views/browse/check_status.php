<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Student Status</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<h2>Records indicate that:</h2>


<?php
    $dbc = mysql_connect("localhost", "mikey_w", "s3cr3t201e")
        or die('Error connecting to MySQL server.');

    mysql_select_db("mikey_w", $dbc);

	$student_no= $_GET['student_no']; //Get the student number to pull all their info
	//input it into the session so that it can carry over to the next page

	//create query to show application information
	$query = "SELECT student_status, app_status FROM applicant WHERE studentNO=$student_no;";
	$data = mysql_query($query);
	//echo mysql_fetch_row($data);

	//should only iterate once
   list($student_status, $app_status) = mysql_fetch_row($data);

   echo "<b>In terms of your application: </b>";
   switch($app_status){
   	case '1':
   		echo "       There is still information missing from the student application form. Be sure you have hit Submit!";
   	break;
   	case '2':
   		echo "       The office has not received your transcript or recommendation letter.";
   	break;
   	case '3':
   		echo "       The office has not received your recommenation Letter.";
   	break;
   	case '4':
   		echo "       The office has not received your transcript.";
   	break;
   	case '5':
   		echo "       Your application is complete and it's decision is pending.";
   	break;
   	case '6':
   		echo "       Your application is complete and the decision has been made.";
   		echo "<br/>";
   		echo "<b>The decision: </b>";
   		echo "<br/>";
      //echo $student_status;
   		switch($student_status){
		   	case '1':
		   		echo "      We regret to inform you that you have not been accepted to the GW graduate program.";
		   	break;
		   	case '2':
		   		echo "       Congratulations! You have been admitted!";
		   	break;
		   	case '3':
		   		echo "       Congratulations! You have been admitted with Aid!";
		   	break;
		   	case '4':
		   		echo "       You have accepted the offer and are now a student.";
		   	break;
		   }
   	break;
   }
   	echo "<br/>";
   	echo "<br/>";
    echo "<a href=\"welcome.php?student_NO=$student_no\">Back to welcome screen.</a><br />";
?>

</body>
</html>

