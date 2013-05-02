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

  <p>Here is the list of applicants that need review: </p>

<?php

 //connect to mysql and select the database to use
  $dbc = db_connect();

  //$email= $_GET['email'];
//for when more than one review is needed!
//$query = "SELECT DISTINCT applicant.studentNO FROM applicant, application WHERE app_status='5' AND NOT EXISTS (SELECT * FROM review WHERE email='$email' AND review.studentNO=applicant.studentNO);";

 //connect to mysql and select the database to use

$query = "SELECT studentNO FROM processes WHERE student_status='1';";
$data = mysql_query($query);

while(list($studentNO) = mysql_fetch_row($data))
{
  echo "<br />";
  echo "<a href=\"fcommittee_view.php?student_no=$studentNO \">Applicant $studentNO</a>";
  echo "<br />";
 }


$query = "SELECT DISTINCT applicant.studentNO FROM applicant, application WHERE app_status='5' AND NOT EXISTS (SELECT * FROM review WHERE review.studentNO=applicant.studentNO);";

//echo $query;
$data = mysql_query($query);
//$user = $_SESSION['user'];

while(list($studentNO) = mysql_fetch_row($data))
{
  echo "<br />";
  echo "<a href=\"fcommittee_view.php?student_no=$studentNO \">Applicant $studentNO</a>";
  echo "<br />";
 }

 ?>

</body>
</html>
