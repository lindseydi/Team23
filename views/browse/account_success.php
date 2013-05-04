<?php
  $dbc = mysql_connect("localhost", "mikey_w", "s3cr3t201e")
    or die('Error connecting to MySQL server.');
   
   mysql_select_db("mikey_w", $dbc);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML TRUE.FALSE Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Thank you for continuing the application process.</title>
</head>
<body>

<?php
  $first_name = $_POST['firstname'];
  $last_name = $_POST['lastname'];
  $address_1 = $_POST['addr1'];
    $house_no=FALSE;
    if(startNum($address_1)){$house_no=TRUE;}
  $address_2 = $_POST['addr2'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $zip = $_POST['zip'];

      $five_numbers=FALSE;
      if(lengthOf($zip, 5)){
        $five_numbers=TRUE;
      }
      $zip_noletters=FALSE;
      if(noLetters($zip)){$zip_noletters=TRUE;}

  $phone = $_POST['phone'];
  $phone = str_replace("-", "", $phone);
  $phone = str_replace("(", "", $phone);
  $phone = str_replace(")", "", $phone);
  $phone = str_replace(" ", "", $phone);
      $ten_numbers=FALSE;
    if(lengthOf($phone, 10)){$ten_numbers=TRUE;}
      $phone_noletters=FALSE;
    if(noLetters($phone)){$phone_noletters=TRUE;}

  $email = $_POST['email1'];
  $email = $email . $_POST['email2'];
  $email = $email . $_POST['email3'];


   $student_NO = randomGWID();
   $password = get_rand_numbers(8);
   $appstatus = '1';

   //(1) Application incomplete
   //(2) Waiting on transcript and rec letter
   //(3) Waiting on rec letter
   //(4) waiting on transcript
   //(5) app pending
   //(6) decision made, check student status

   $student_status = 0;
   //(0) applicant
   //(1)reject
   //(2) admit without aid,   
   //(3) admit with aid
   //(4) student?
   if($house_no){
     if($five_numbers){
        if($zip_noletters){
          if($ten_numbers){
            if($phone_noletters){

  $query ="INSERT INTO applicant VALUES ('$student_NO', '$password', '$first_name', '$last_name', '$email', '$address_1', '$address_2', '$city', '$state', '$zip', '$phone', '$appstatus', '$student_status');";

  $query2 = "INSERT INTO processes (studentNO) VALUES ('$student_NO');";

  $query3 = "INSERT INTO application (studentNO, fname, lname, transcript_recv, letter_recv) VALUES ('$student_NO', '$first_name', '$last_name', 'FALSE', 'FALSE');";

  $result = mysql_query($query)
    or die('Error querying database.'  . mysql_error());

  $result2 = mysql_query($query2)
    or die('Error querying database.'  . mysql_error());

  $result3 = mysql_query($query3)
    or die('Error querying database.'  . mysql_error());

  mysql_close($dbc);

  echo 'Thanks for creating an account.<br />';
  echo 'Please write this information down:.<br />';
  echo 'Your student number: ' . $student_NO;
  echo '<br />';
  echo 'Your password: ' . $password;
  echo '<br />';
  echo "<a href=\"applicant_login.html\">Login to fill out Application</a><br />";

            }else{
              echo "Your phone number contains a letter. Please fix this error.";
              goBack();
            }
          }else{
            echo "Your phone number is too short!";
             goBack();
          }
        }else{
          echo "Your zip code contains letters!";
           goBack();
        }
      }else{
          echo "Zip code is not the correct length.";
           goBack();
      }
    }else{
      echo "Please include your house number in your adddress.";
      goBack();
    }
?>

</body>
</html>

<?php
//Function that returns a random string of 8 numbers
function randomGWID(){

    $randNum = get_rand_numbers(8);

    $sql = sprintf("SELECT * FROM applicant WHERE studentNO = %d", $randNum); 
   
    if(mysql_num_rows(mysql_query($sql)) > 0){
      randomGWID();
    }else{
      return $randNum;
    }
}

function assign_rand_value($num) {
 switch($num) {
  case "0" : $rand_value = "0"; break;
  case "1" : $rand_value = "1"; break;
  case "2" : $rand_value = "2"; break;
  case "3" : $rand_value = "3"; break;
  case "4" : $rand_value = "4"; break;
  case "5" : $rand_value = "5"; break;
  case "6" : $rand_value = "6"; break;
  case "7" : $rand_value = "7"; break;
  case "8" : $rand_value = "8"; break;
  case "9" : $rand_value = "9"; break;
  }
 return $rand_value;
}

//simplify??
function get_rand_numbers($length) {
    if ($length>0) {
        $rand_id="";
        for($i=1; $i<=$length; $i++) {
           // mt_srand((double)microtime() * 1000000);
            $num = mt_rand(FALSE,9);
            $rand_id .= assign_rand_value($num);
        }
    }
    return $rand_id;
}

function startNum($string){
    return strlen($string) > 0 && ctype_digit(substr($string, 0, 1));
}

function noLetters($string){
    if (preg_match('/^[0-9]+$/', $string)) {
        //echo "I am only numbers";
        //echo "  " . $string;
        return True;
    } else {
      //echo "I include letters!";
      //echo "<br/><br/>";
      //echo $string;
      return False;
    }
}
function lengthOf($string, $targetLen){
  if(strlen($string)==$targetLen){
    //echo strlen($string);
    //echo 'The string $string was length $targetLen!';
    //echo "<br/>";
    return True;
  }else{
    //echo "oops! not long enough of a string!";
    return False;
  }
}
function goBack(){
  echo "<br/><br/>";
  echo "<FORM>";
  echo "<INPUT class=\"center\" Type=\"button\" VALUE=\"Go back\" onClick=\"history.go(-1);return true;\">";
  echo "</FORM>";
  echo "<br/><br/>";
}
?>

