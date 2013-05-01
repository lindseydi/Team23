<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Student Application</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
   <a href="cac_login_success.php">Back to list of applicants.</a><br />


<?php
    $dbc = mysql_connect("localhost", "mikey_w", "s3cr3t201e")
        or die('Error connecting to MySQL server.');

    mysql_select_db("mikey_w", $dbc);

	$student_no= $_GET['student_no']; //Get the student number to pull all their info

	//create query to show application information
	$query = "SELECT prior_degree, pr_school, pr_GPA, pr_year, prior_degree2, pr_school2, pr_GPA2, pr_year2, GRE_analytical, GRE_verbal, GRE_quant, GRE_subj1, GRE_subj2, prior_work1, prior_work2, starting_sem, interest, program  FROM application WHERE studentNO='$student_no';";
	$data = mysql_query($query);
	//echo mysql_fetch_row($data);

	//should only iterate once
   list($prior_degree, $pr_school, $pr_GPA, $pr_year, $prior_degree2, $pr_school2, $pr_GPA2, $pr_year2, $GRE_analytical, $GRE_verbal, $GRE_quant, $GRE_subj1, $GRE_subj2, $prior_work1, $prior_work2, $starting_sem, $interest ) = mysql_fetch_row($data);

	//display application info in an easy to read format
	echo '<br /> This is the information for student #' . $student_no .' <br />';
	echo 'They are applying for the  ' . $starting_sem . ' semester.';
	echo ' <br />     and are interested in ' . $interest . '.<br /><br /><br />';
        echo 'They are applying for the ' . $program . ' program <br /><br />';
	echo 'Here are their GRE scores: <br />';
	echo 'Analytical:   ' . $GRE_analytical . '<br />';
	echo 'Verbal:   ' . $GRE_verbal . '<br />';
	echo 'Quantical:   ' . $GRE_quant . '<br />';
	echo 'Subject 1:   ' . $GRE_subj1 . '<br />';
	echo 'Subject 2:   ' . $GRE_subj2. '<br /><br /><br />';

	echo 'They have received the following degrees:<br /><br />' ;
	echo 'Degree 1: ' . $prior_degree . '<br />';
	echo 'From: ' . $pr_school . '<br />';
	echo 'Graduated in ' . $pr_year . '<br />';
	echo 'With a ' . $pr_GPA . ' GPA <br /><br />';
	echo 'Degree 2: ' . $prior_degree2 . '<br />';
	echo 'From: ' . $pr_school2 . '<br />';
	echo 'Graduated in ' . $pr_year2 . '<br />';
	echo 'With a  ' . $pr_GPA2 . ' GPA <br /><br />';

	echo 'Following are descriptions about previous work experiences:<br /><br />' ;
	echo '1. ' . $prior_work1 . '.<br /><br />';
	echo '2. ' . $prior_work2 . '<br /><br />';
	
	//query the recommendation
	$query2 = "SELECT recommends.rec_full_name, title, rec_letter, affiliation FROM recommends, application WHERE application.studentNO='$student_no' AND application.rec_email=recommends.rec_email;";
	$data2 = mysql_query($query2);
	//display the recommendation
   list($rec_full_name, $title, $rec_letter, $affiliation) = mysql_fetch_row($data2);
	echo 'Recommendation From: ' . $rec_full_name .' <br />';
	echo 'Job Title: ' . $title . '<br/>';
	echo 'Affiliation to candidate:' . $affiliation . '.<br /><br /><br />';
	echo $rec_letter .'<br />';

	echo '<br /><br />---------------------------------------------------------------------------------------<br /><br />';

	//query the fc reviews
	$query3 = "SELECT rank, advisor_rec, reason_reject, comments, letter_cred, letter_rank, lname, fname FROM review, fcommittee WHERE studentNO='$student_no';";
	$data3 = mysql_query($query3);
	//display
	list($rank, $advisor_rec, $reason_reject, $comments, $letter_cred, $letter_rank, $lname, $fname ) = mysql_fetch_row($data3);

	echo 'Faculty Committee Member Review:<br /><br />' ;
	echo 'Rank: ' . $rank . '<br />';
	echo 'Reason for Reject: ' . $reason_reject . '<br />';
	echo 'Thought the Recommendation Letter was ' . $letter_cred . '<br />';
	echo 'and ranked the letter ' . $letter_rank . '<br />';
	echo 'Recommended ' . $advisor_rec . ' as their advisor.<br />';
	echo 'Additional Comments they left:' . $comments . '<br />';

	//assume transcripts are in a file folder in desk
	//create form for final decisiion
	echo '<br /><br /><br />' ;

	echo "<form method=\"post\" action=\"CAC_input.php\">";

	echo "<label for=\"studentNO\">Input the student number</label>";
	echo "<input type=\"text\" name=\"studentNO\" value=\"$student_no\"/><br />";
    
	echo "<label for=\"ranking_final\">Input the final decision:</label>";
	echo "<select name=\"ranking_final\" />";
    echo "<option value=\"4\">Admit with Aid</option>";
    echo "<option value=\"3\">Admit WITHOUT Aid</option>";
    echo "<option value=\"1\">Reject</option>";
    echo "</select>";
    echo "<br />";
    echo "<input type=\"submit\" value=\"Submit\" name=\"submit\" />";
    echo "</form>";
    ?>
</body>
</html>


