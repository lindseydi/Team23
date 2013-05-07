<?php

include('../../login.php');

if($_SESSION['fcomm_auth'] == false){
   header('Location: index.php?view=universal_login');
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Welcome faculty committee member!</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h2>Welcome <?php echo $_SESSION['user']; ?>!</h2>

  <p>Here is the list of applicants that need review: </p><br/>

<?php

 //connect to mysql and select the database to use
  $dbc = db_connect();

//for when more than one review is needed!
//$query = "SELECT DISTINCT applicant.studentNO FROM applicant, application WHERE app_status='5' AND NOT EXISTS (SELECT * FROM review WHERE email='$email' AND review.studentNO=applicant.studentNO);";


$fcid = $_SESSION['username'];

$sort = "";
$where = "";
if ($_POST['sort'] == "GPA"){
	echo "Sorting candiates by GPA";
  	$sort = ", pr_GPA DESC, pr_GPA2 DESC ";
}else if($_POST['sort'] == "Masters"){
	echo "Showing Masters program applicants";
	$where = "AND (program='Masters' OR program='masters') ";
}else if($_POST['sort'] == "PhD"){
	$where = "AND (program='PhD' OR program='phd' OR program='Phd') ";
}else if($_POST['sort'] == "GRE_verbal"){
	echo "Sorting candiates by GRE verbal portion";
	$sort = ", GRE_verbal DESC ";
}else if($_POST['sort'] == "GRE_quant"){
	echo "Sorting candiates by GRE Quantitative Reasoning Portion";
	$sort = ", GRE_quant DESC ";
}else if($_POST['sort'] == "All"){
  echo "Showing all candidates by date application was submitted.";
  $sort = ", GRE_quant DESC ";
}else{
	echo "where am i";
}


$q = "SELECT aterm FROM sadmin";
list($aterm) = mysql_fetch_row(mysql_query($q));

echo "<br/>Currently showing the top 10 applicants from this field hoping to start " . $aterm ."<br/><br/><br/>";

$query = "SELECT DISTINCT applicant.studentNO FROM applicant, application WHERE app_status='5' AND starting_sem='$aterm' AND applicant.studentNO=application.studentNO $where AND NOT EXISTS (SELECT * FROM review WHERE review.fcid='$fcid' AND review.studentNO=applicant.studentNO) HAVING (SELECT Count(*) FROM review r2 WHERE applicant.studentNO=r2.studentNO) < 2 ORDER BY date_submitted ASC $sort ;";
//echo "<br/>" . $query . "<br/>";


$data = mysql_query($query)
or die('Error querying database.'  . mysql_error());

if(mysql_num_rows($data) == 0){
  echo "No students need review from the view at this time!<br/><br/>";
}

$i=0;
while((list($studentNO) = mysql_fetch_row($data)) && ($i<10))
{

  echo "<br />";
  echo "<a href=\"fcommittee_view.php?student_no=$studentNO&fcid=$fcid \">Applicant $studentNO</a>";
  echo "<br />";
  $i++;
 }


 ?>
<br/><br/>
 <form method="post" action="index.php?view=fcommittee_sort">
<label for="sort">Chooose a new field to sort by:</label>
    <select name="sort" required>
      <option value="GPA">GPA</option>
      <option value="PhD">PhD</option>
      <option value="Masters">Masters</option>
      <option value="GRE_verbal">GRE_verbal</option>
      <option value="GRE_quant">GRE_quant</option>
    </select>
 <br /> <br />

 <input type="submit" value="Submit" name=\"submit\"/>

<br /> <br />

</body>
</html>
