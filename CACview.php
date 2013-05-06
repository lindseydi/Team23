<?php
	include('login.php');
	include "views/layouts/browse.php";
/*
	if($_SESSION['cac_auth'] == false){
		header('Location: index.php?view=universal_login');
	}*/
	$student_no= $_GET['student_no']; //Get the student number to pull all their info
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Student Application Review</title>
	<style type='text/css'>
		div.text {
			width:600px;
			margin-left:auto;
			margin-right:auto;
			text-align:left;
		}
		div.link {
			width:600px;
			margin-left:auto;
			margin-right:auto;
			text-align:right;
		}
		h1{
			text-align:center;
		}
	</style>
</head>
<body>
	<div class='link'>
   		<a href="index.php?view=cac_login_success">Back to list of applicants.</a><br />
   	</div>
    <h1>
    	<span style="font-family:georgia,serif;">
            Student Applicant #<?php echo $student_no; ?>'s Information
        </span>
    </h1>


<?php
	$dbc = db_connect();

	$student_no= $_GET['student_no']; //Get the student number to pull all their info

	//create query to show application information
	$query = "SELECT prior_degree, pr_school, pr_GPA, pr_year, prior_degree2, pr_school2, pr_GPA2, pr_year2, GRE_analytical, GRE_verbal, GRE_quant, GRE_subj1, GRE_subj2, prior_work1, prior_work2, starting_sem, interest, program
			  FROM application 
			  WHERE studentNO='$student_no';";
	$data = mysql_query($query) or die(mysql_error());
	//echo mysql_fetch_row($data);

	//should only iterate once
   	list($prior_degree, $pr_school, $pr_GPA, $pr_year, $prior_degree2, $pr_school2, $pr_GPA2, $pr_year2, $GRE_analytical, $GRE_verbal, $GRE_quant, $GRE_subj1, $GRE_subj2, $prior_work1, $prior_work2, $starting_sem, $interest ) = mysql_fetch_row($data);
 ?>
 	<!--display application info in an easy to read format-->
 	<div class='text'>
 	<p>
 		Student is applying for the <?php echo $starting_sem; ?> semester and is interested in <?php echo $interest; ?>
 	</p>
 	<p>
 		Student is applying for the <?php echo $program; ?> program.
 	</p>
 	<p>
 		<b>Student's GRE scores:</b>
 		<ul>
 			<li>Analytical: <?php echo $GRE_analytical; ?></li>
 			<li>Vertbal: <?php echo $GRE_verbal; ?></li>
 			<li>Quantical: <?php echo $GRE_quant; ?></li>
 			<li>Subject 1: <?php echo $GRE_subj1; ?></li>
 			<li>Subject 2: <?php echo $GRE_subj2; ?></li>
 		</UL>
 	</p>
 	<p>
 		<b>Student has received the following degrees:</b>
 		<ul>
 			<li>Degree 1: <?php echo $prior_degree; ?></li>
 			<li>From: <?php echo $pr_school; ?></li>
 			<li>Graduated in: <?php echo $pr_year; ?></li>
 			<li>With a <?php echo $pr_GPA; ?></li>
 		</UL>
 		<ul>
 			<li>Degree 1: <?php echo $prior_degree2; ?></li>
 			<li>From: <?php echo $pr_school2; ?></li>
 			<li>Graduated in: <?php echo $pr_year2; ?></li>
 			<li>With a <?php echo $pr_GPA2; ?></li>
 		</UL>
 	</p>
 	<p>
 		<b>Previous work experience:</b>
 		<ol>
 			<li><?php echo $prior_work1;?></li>
 			<li><?php echo $prior_work2;?></li>
 		</ol>
 	</p>
 	<?php
		//query the recommendation
		$query2 = "SELECT recommends.rec_full_name, title, rec_letter, affiliation FROM recommends, application WHERE application.studentNO='$student_no' AND application.rec_email=recommends.rec_email;";
		$data2 = mysql_query($query2);
		//display the recommendation
   		list($rec_full_name, $title, $rec_letter, $affiliation) = mysql_fetch_row($data2);
 	?>
 	<p>
 		Recommendation From: <?php echo $rec_full_name; ?><br />
 		Job Title: <?php echo $title;?><br />
 		Affiliation to candidate: <?php echo $affiliation;?><br />
 		<?php echo $rec_letter;?>
 	</p>
 	<hr />
 <?php

	//query the fc reviews
	$query3 = "SELECT rank, advisor_rec, reason_reject, comments, letter_cred, letter_rank, lname, fname FROM review, fcommittee WHERE studentNO='$student_no';";
	$data3 = mysql_query($query3);
	//display
	list($rank, $advisor_rec, $reason_reject, $comments, $letter_cred, $letter_rank, $lname, $fname ) = mysql_fetch_row($data3);
?>
	<p>
		<b>Faculty Committee Member Review:</b>
	</p>
<?php
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
</div>
</body>
</html>


