<?php
error_reporting(E_ALL);
ini_set('display_errors', True);  

  $dbc = mysql_connect("localhost", "mikey_w", "s3cr3t201e")
    or die('Error connecting to MySQL server.');

   mysql_select_db("mikey_w", $dbc);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Personal Info Updated</title>
</head>
<body>

<?php
  //$studentNO = $_SESSION['student_NO'];//$_GET['student_no'];

  $studentNO = $_GET['studentNO'];

  $first_name = $_POST['firstname'];
  $last_name = $_POST['lastname'];
  $address_1 = $_POST['addr1'];
    $allgood = startNum($address_1);
  $address_2 = $_POST['addr2'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $zip = $_POST['zip'];
    if($allgood){$allgood = noLetters($zip);}
    if($allgood){$allgood = lengthOf($zip, 5);}
  $phone = $_POST['phone'];
  $phone = str_replace("-", "", $phone);
  $phone = str_replace("(", "", $phone);
  $phone = str_replace(")", "", $phone);
  $phone = str_replace(" ", "", $phone);
    if($allgood){$allgood = noLetters($phone);}
    if($allgood){$allgood = lengthOf($phone, 10);}
  $email = $_POST['email'];
    if($allgood){$allgood = checkEmail($email);}
  $password = $_POST['password'];

if($allgood){
  $query ="UPDATE applicant SET fname='$first_name', lname='$last_name', email='$email', addr1='$address_1', addr2='$address_2', city='$city', state='$state', zip='$zip', phoneNO='$phone', password='$password' WHERE studentNO='$studentNO';";

  $result = mysql_query($query)
    or die('Error querying database.'  . mysql_error());

  echo "Thank you! Your information has been updated in our records.";

  mysql_close($dbc);


  echo '<br /><br />';
  echo "<a href=\"index.php?view=welcome\">Go back home.</a><br />";
  }
?>

</body>
</html>


<?php
function startNum($string){
   if ((strlen($string) > 0) && (ctype_digit(substr($string, 0, 1)))){
      return true;
    }else{
      echo "Your address cannot be correct without a house number!";
      goBack();
    }
}

function noLetters($string){
    if (preg_match('/^[0-9]+$/', $string)) {
      return true;
    }else{
          echo "Your input includes letters where it shouldn't";
      goBack();
    }
}

function lengthOf($string, $targetLen){
  if(strlen($string)==$targetLen){
    return true;
  }else{
      echo "Your input was not the correct length!";
      goBack();
  }
}
function check_notexists($email){
    $q="SELECT * FROM applicant WHERE email='$email';";
    $result = mysql_query($q);
    if(mysql_num_rows($result) > 0){
      "This email already exists in the system.";
      goBack();
    }else{
      return true;
    }
}

function checkEmail($email) {
//regex from devshed
  if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+).([a-zA-Z]+)+$/", $email)){
    return TRUE;
  } else{
    //return FALSE;
    echo "Be sure your e-mail is the correct format.";
    goBack();
  }
}

function goBack(){
  echo "<br/><br/>";
  echo "<FORM>";
  echo "<INPUT class=\"center\" Type=\"button\" VALUE=\"Go back\" onClick=\"history.go(-1);return true;\">";
  echo "</FORM>";
  echo "<br/><br/>";
  return false;
}
?>