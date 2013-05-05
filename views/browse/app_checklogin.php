<?php
// Connect to server and select databse.
$dbc = mysql_connect("localhost", "mikey_w", "s3cr3t201e")
    or die('Error connecting to MySQL server.');
mysql_select_db("mikey_w", $dbc);


// username and password sent from form 
$student_NO=$_POST['username']; 
$password=$_POST['password']; 

// To protect MySQL injection (more detail about MySQL injection)
$student_NO = stripslashes($student_NO);
$password = stripslashes($password);
$student_NO = mysql_real_escape_string($student_NO);
$password = mysql_real_escape_string($password);

//Table we want to select from:
$table_name="applicant";

$sql="SELECT * FROM $table_name WHERE studentNO='$student_NO' and password='$password';";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){ 
	header("location:welcome.php?student_NO=$student_NO");
}
else {
echo "Wrong Username or Password";
echo "<br/>";
echo "<a href=\"applicant_login.html\">Go Back</a><br />";

}
?>