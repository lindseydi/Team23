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

  <p>How would you like to sort applicants? </p>

<?php

 //connect to mysql and select the database to use
  $dbc = db_connect();

//for when more than one review is needed!
//$query = "SELECT DISTINCT applicant.studentNO FROM applicant, application WHERE app_status='5' AND NOT EXISTS (SELECT * FROM review WHERE email='$email' AND review.studentNO=applicant.studentNO);";


$fcid = $_SESSION['username'];

?>

<form method="post" action="index.php?view=fcommittee_sort">
<label for="sort">Chooose your field</label>
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

 *Remember student names will not be revealed!



 ?>

</body>
</html>
