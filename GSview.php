<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Student Profile</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
   <a href="gs_login_success.php">Back to Search.</a><br />


<?php
    $dbc = mysql_connect("localhost", "mikey_w", "s3cr3t201e")
        or die('Error connecting to MySQL server.');

    mysql_select_db("mikey_w", $dbc);

	$student_no= $_GET['student_no']; //Get the student number to pull all their info
	//input it into the session so that it can carry over to the next page

	//create query to show application information
	$query = "SELECT student_status, ranking_final, transcript_recv  FROM application, processes WHERE application.studentNO='$student_no' AND processes.studentNO='$student_no';";

	echo "<br/>";
    echo "<br/>";
	$data = mysql_query($query);
	//echo mysql_fetch_row($data);

	//should only iterate once
   list($student_status, $ranking_final, $transcript_recv) = mysql_fetch_row($data);


//Create a form so that the GS has control over certain things.
	echo "<form method=\"post\" action=\"gs_update.php\">";
    echo "<label for=\"studentNO\">Input the student number</label>";
	echo "<input type=\"text\" name=\"studentNO\"/ value=" . $student_no . "><br />";
	echo "<br/>";
	echo "Current records indicate that the transcript for this student ";
	switch($transcript_recv) { //decide what to do 
		case "":
	        echo "have not been received.<br/>";
	        echo "<label for=\"transcript_recv\">Now what is the state of that stuents transcript?</label>";
			echo "	<select name=\"transcript_recv\" />";
    	    echo "<option value=\"0\">Not received</option>";
	        echo "<option value=\"1\">Received</option>";
	    break;
	    case "1":
	        echo "have been received, please check their folder.<br/>"; 
	        echo "<label for=\"transcript_recv\">Now what is the state of that stuents transcript?</label>";
			echo "	<select name=\"transcript_recv\" />";
	        echo "<option value=\"1\">Received</option>";
	        echo "<option value=\"0\">Not received</option>";
	    break;
	    case "0":
	        echo "have not been received.<br/>";
	        echo "<label for=\"transcript_recv\">Now what is the state of that stuents transcript?</label>";
			echo "	<select name=\"transcript_recv\" />";
    	    echo "<option value=\"0\">Not received</option>";
	        echo "<option value=\"1\">Received</option>";
	    break;
	}
	echo "	</select>";
	echo "<br/>";
	echo "<br/>";
	echo "Records indicate that the final decision ";
	switch($ranking_final) { //decide what to do 
		case "":
			echo "has not been made.<br/>";
			echo "<label for=\"ranking_final\">Input the final decision:</label>";
			echo "<select name=\"ranking_final\" />";
			echo "  <option value=\"0\">Decision not made.</option>";
		    echo "  <option value=\"4\">Admit with Aid</option>";
		    echo "  <option value=\"3\">Admit WITHOUT Aid</option>";
		    echo "  <option value=\"1\">Reject</option>";
		break;
		case "0":
			echo "has not been made.<br/>";
			echo "<label for=\"ranking_final\">Input the final decision:</label>";
			echo "<select name=\"ranking_final\" />";
		    echo "  <option value=\"4\">Admit with Aid</option>";
		    echo "  <option value=\"3\">Admit WITHOUT Aid</option>";
		    echo "  <option value=\"1\">Reject</option>";
		    echo "  <option value=\"0\">Decision not made.</option>";
		break;
	    case "4":
	        echo "is Admit with Aid<br/>";
			echo "<label for=\"ranking_final\">Input the final decision:</label>";
			echo "<select name=\"ranking_final\" />";
		    echo "  <option value=\"4\">Admit with Aid</option>";
		    echo "  <option value=\"3\">Admit WITHOUT Aid</option>";
		    echo "  <option value=\"1\">Reject</option>";
		    echo "  <option value=\"0\">Decision not made.</option>";
	    break;
	    case "3":
	        echo "is admitted.<br/>";
			echo "<label for=\"ranking_final\">Input the final decision:</label>";
			echo "<select name=\"ranking_final\" />";
	    	echo "  <option value=\"3\">Admit WITHOUT Aid</option>";
		    echo "  <option value=\"4\">Admit with Aid</option>";
		    echo "  <option value=\"1\">Reject</option>";
		    echo "  <option value=\"0\">Decision not made.</option>";
	    break;
	    case "1":
	        echo "is rejected.<br/>";
	        echo "<label for=\"ranking_final\">Input the final decision:</label>";
			echo "<select name=\"ranking_final\" />";
		    echo "  <option value=\"1\">Reject</option>";
	    	echo "  <option value=\"3\">Admit WITHOUT Aid</option>";
		    echo "  <option value=\"4\">Admit with Aid</option>";
		    echo "  <option value=\"0\">Decision not made.</option>";
	    break;
	}
    echo "</select>";
    echo "<br />";
    echo "<input type=\"submit\" value=\"Submit\" name=\"submit\" />";
    echo "</form>";
    ?>

</body>
</html>


