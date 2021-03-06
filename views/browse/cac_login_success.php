<?php

include('../../login.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Welcome CAC</title>
  <style type='text/css'>
    div.container{
      width:600px;
      margin-left:auto;
      margin-right:auto;
      text-align:left;
    }
    h2{ text-align:center; }
  </style>
</head>
<body>
  <h2>Welcome CAC!</h2>
  <div class='container'>
  <p>Here is the list of applicants that need review: </p>

<?php

 //connect to mysql and select the database to use
  $dbc = db_connect();

  $query = "SELECT applicant.studentNO FROM applicant, application WHERE app_status='5' AND applicant.studentNO=application.studentNO AND EXISTS(SELECT * FROM review WHERE review.studentNO=applicant.studentNO) ORDER BY date_submitted ASC;";
//echo $query;
$data = mysql_query($query);
//echo mysql_num_rows($data);
if (mysql_num_rows($data) < 1){
  echo "There are no students that need review at this time.";
}


//List links to the student review pages
while(list($studentNO) = mysql_fetch_row($data)){
  echo "<br />";
  echo "<a href=\"CACview.php?student_no=$studentNO \">Applicant $studentNO</a>";
  echo "<br />";
}

  ?>
  </div>
</body>
</html>
