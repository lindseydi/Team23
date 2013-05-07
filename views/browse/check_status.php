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

  //input it into the session so that it can carry over to the next page
  $student_no = $_SESSION['student_NO'];
	//$student_no= $_GET['student_no']; //Get the student number to pull all their info
  
	//create query to show application information
	$query = "SELECT student_status, app_status FROM applicant WHERE studentNO='$student_no';";
	$data = mysql_query($query);
	//echo mysql_fetch_row($data);

	//should only iterate once
   list($student_status, $app_status) = mysql_fetch_row($data);

   //echo "app status: " . $app_status . "<br/>";

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
   		echo "<br/><br/>";
      //echo $student_status;
   		switch($student_status){
		   	case '1':
          echo "<b>The decision: </b>";
          echo "<br/>";
		   		echo "      We regret to inform you that you have not been accepted to the GW graduate program.";
		   	break;
		   	case '2':
          echo "<b>The decision: </b>";
          echo "<br/>";
		   		echo "       Congratulations! You have been admitted!";
          echo "<form method=\"post\" action=\"applicant_decision.php?studentNO=$student_no\">";
          echo "<input type=\"radio\" name=\"decision\" value=\"5\">Accept Offer<br>";
          echo "<input type=\"radio\" name=\"decision\" value=\"4\">Defer Offer<br>";
          echo "<input type=\"submit\" value=\"Submit decision\">";
          echo "</form>";
		   	break;
		   	case '3':
          echo "<b>The decision: </b>";
          echo "<br/>";
		   		echo "Congratulations! You have been admitted with Aid!";
          echo "<form method=\"post\" action=\"applicant_decision.php?studentNO=$student_no\">";
          echo "<input type=\"radio\" name=\"decision\" value=\"5\">Accept Offer<br>";
          echo "<input type=\"radio\" name=\"decision\" value=\"4\">Defer Offer<br>";
          echo "<input type=\"submit\" value=\"Submit decision\">";
          echo "</form>";
        break;
		   	case '4':
		   		echo "You have already chosen to defer your offer to GW's graduate program.";
          echo "Good luck in your graduate studies.";
		   	break;
        case '5':
           echo "You have already chosen to accept your offer to GW's graduate program!";
           echo " We cannot wait to have you as a student. Please allow a few days for your student account to be created and then check back to this page. Thank you for your patience!";
        break;
        case '6':
          $q = "SELECT sid FROM applicant WHERE studentNO='$student_no';";
          $r = mysql_query($q);
          list($sid) = mysql_fetch_row($r);
          $q2 = "SELECT sname, email, password FROM students WHERE sid='$sid';";
          $r2 = mysql_query($q2);
          list($sname, $email, $password) = mysql_fetch_row($r2);
          echo  $sname . " your account has been created!<br />";
          echo "Your SID: ". $sid . "<br />";
          echo "Your new email: " . $email . "<br />";
          echo "Your password: " . $password ."<br />";
          echo "<br /><br />";

         echo "<a href=\"index.php?view=universal_login\">Login to Student Account</a><br />";
          
        break;
		   }
   	break;
   }
   	echo "<br/>";
   	echo "<br/>";
    echo "<a href=\"index.php?view=welcome\">Back to welcome screen.</a><br />";
?>

</body>
</html>


