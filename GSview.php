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
  <title>Student Profile</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
   <a href="index.php?view=gs_login_success">Back to Search.</a><br />


<?php
	$student_no= $_GET['student_no']; //Get the student number to pull all their info
	$fname = $_GET['fname'];
	$lname= $_GET['lname'];


	//create query to show application information
	$query = "SELECT student_status, ranking_final, transcript_recv  FROM application, processes WHERE application.studentNO='$student_no' AND processes.studentNO='$student_no';";

	echo "<br/>";
    echo "<br/>";
    echo "<h2>APPLICANT : $fname $lname</h2>";
	$data = mysql_query($query);
	//echo mysql_fetch_row($data);

	//should only iterate once
   list($student_status, $ranking_final, $transcript_recv) = mysql_fetch_row($data);

   //Create a form so that the GS has control over certain things.
	echo "<form method=\"post\" action=\"gs_update.php\">";
    echo "<label for=\"studentNO\">Input the student number</label>";
	echo "<input type=\"text\" name=\"studentNO\"/ value=" . $student_no . "><br />";
	echo "<br/>"; 

   if($student_status < 4){
	        echo "<label for=\"transcript_recv\">Transcript: </label>";
			echo "<select name=\"transcript_recv\" />";
			if($transcript_recv=='0'){
	    	    echo "<option value=\"0\" selected>Not received</option>";
		        echo "<option value=\"1\">Received</option>";
	    	}else{
		    	echo "<option value=\"0\">Not received</option>";
		        echo "<option value=\"1\" selected>Received</option>";	
	    	}
	echo "	</select>";
	echo "<br/>";
	echo "<br/>";
	echo "<label for=\"ranking_final\">Input the final decision:</label>";
	switch($ranking_final) { //decide what to do 
		case '':
			echo "<select name=\"ranking_final\" />";
			echo "  <option value=\"0\">Decision not made.</option>";
		    echo "  <option value=\"4\">Admit with Aid</option>";
		    echo "  <option value=\"3\">Admit WITHOUT Aid</option>";
		    echo "  <option value=\"1\">Reject</option>";
		break;
		case '0':
			echo "<select name=\"ranking_final\" />";
			echo "  <option value=\"0\">Decision not made.</option>";
		    echo "  <option value=\"4\">Admit with Aid</option>";
		    echo "  <option value=\"3\">Admit WITHOUT Aid</option>";
		    echo "  <option value=\"1\">Reject</option>";
		break;
	    case '4':
			echo "<select name=\"ranking_final\" />";
		    echo "  <option value=\"4\">Admit with Aid</option>";
		    echo "  <option value=\"3\">Admit WITHOUT Aid</option>";
		    echo "  <option value=\"1\">Reject</option>";
		    echo "  <option value=\"0\">Decision not made.</option>";
	    break;
	    case '3':
			echo "<select name=\"ranking_final\" />";
	    	echo "  <option value=\"3\">Admit WITHOUT Aid</option>";
		    echo "  <option value=\"4\">Admit with Aid</option>";
		    echo "  <option value=\"1\">Reject</option>";
		    echo "  <option value=\"0\">Decision not made.</option>";
	    break;
	    case '1':
			echo "<select name=\"ranking_final\" />";
		    echo "  <option value=\"1\">Reject</option>";
	    	echo "  <option value=\"3\">Admit WITHOUT Aid</option>";
		    echo "  <option value=\"4\">Admit with Aid</option>";
		    echo "  <option value=\"0\">Decision not made.</option>";
	    break;
	}
    echo "</select>";
    echo "<br />";
    echo "<input type=\"submit\" value=\"applicant\" name=\"submit\" />";
    echo "</form>";

    }else if($student_status == '4'){	
    	//This student has defered their acceptance!
    	echo "This student has chosen to defer their acceptance. Would you like to Matriculate anyways?<br/>";    	
    	echo "<input type=\"submit\" value=\"Matriculate\" name=\"submit\" /><br/>";
    	echo "No?<br/>";
    	goBack();

	}
	else if($student_status == '5'){
		//This studen has accepted their offer and needs to get the info to their student account.
		echo "This student has decided to accept GWs offer!<br/>";
		echo "<input type=\"submit\" value=\"Matriculate\" name=\"submit\" />";
	}else{
		echo "should never get here(for now)";
	}
?>
</body>
</html>

<?php
function goBack(){
  echo "<br/><br/>";
  echo "<FORM>";
  echo "<INPUT class=\"center\" Type=\"button\" VALUE=\"Go back\" onClick=\"history.go(-1);return true;\">";
  echo "</FORM>";
  echo "<br/><br/>";
}
?>


