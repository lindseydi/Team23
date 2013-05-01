<?php

//LETS REPLACE
//For faculty!
// Connect to server and select databse.
$dbc = mysql_connect("localhost", "mikey_w", "s3cr3t201e")
    or die('Error connecting to MySQL server.');
mysql_select_db("mikey_w", $dbc);


// username and password sent from form 
$faculty_email=$_POST['username']; 
$password=$_POST['password']; 

// To protect MySQL injection (more detail about MySQL injection)
$faculty_email = stripslashes($faculty_email);
$password = stripslashes($password);
$faculty_email = mysql_real_escape_string($faculty_email);
$password = mysql_real_escape_string($password);

//Table we want to select from:
$table_CAC="CAC";
$table_fcommittee = "fcommittee";
$table_GS = "GS";

$CAC="SELECT * FROM $table_CAC WHERE email='$faculty_email' and password='$password';";
$result_CAC=mysql_query($CAC);

$fcommittee="SELECT * FROM $table_fcommittee WHERE email='$faculty_email' and password='$password';";
$result_fcommittee=mysql_query($fcommittee);

$GS="SELECT * FROM $table_GS WHERE email='$faculty_email' and password='$password';";
$result_GS=mysql_query($GS);

// Mysql_num_row is counting table row
$count_CAC=mysql_num_rows($result_CAC);
$count_fcommittee=mysql_num_rows($result_fcommittee);
$count_GS=mysql_num_rows($result_GS);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count_CAC==1){

	// Register $myusername, $mypassword and redirect to file "login_success.php"
	session_register("faculty_email");
	session_register("password"); 
	header("location:cac_login_success.php");

} else if($count_fcommittee==1){
	header("location:fcommittee_login_success.php?email=$faculty_email");

}else if($count_GS==1){
	// Register $myusername, $mypassword and redirect to file "login_success.php"
	session_register("faculty_email");
	session_register("password"); 
	header("location:gs_login_success.php");
}else {
echo "Wrong Username or Password";
}
?>
