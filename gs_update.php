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
  <title>Applicant info updated</title>
</head>
<body>


<?php
  
  $studentNO = $_POST['studentNO'];
  $submit = $_POST['submit'];

  if($submit=='Submit'){
    //more post variables that apply if the submit was from an applicant page.
    $transcript_recv = $_POST['transcript_recv'];
    $ranking_final= $_POST['ranking_final'];

    $query2= "UPDATE application SET transcript_recv='$transcript_recv' WHERE studentNO='$studentNO';";

    $materials = "SELECT app_status FROM applicant WHERE studentNO='$studentNO';";

    echo "<br/>";
    echo "Your updates have been recorded.";

    $mat_res = mysql_query($materials)
      or die('Error querying database.'  . mysql_error());

    list($app_status) = mysql_fetch_row($mat_res);


    if($transcript_recv=='1'){
      if($app_status=='2')
          $new_app_status='3';
      else if($app_status=='4')
        $new_app_status='5';
      else
        $new_app_status=$app_status;
    }else{
      $new_app_status=$app_status;
    }

    if(($new_app_status=='5') && ($ranking_final !='0')){
      $new_app_status= '6';
    }

    if($ranking_final=='0'){
        $new_student_status = '0';
    }  else if($ranking_final=='1'){
      $new_student_status= '1';
    } else if($ranking_final=='3'){
      $new_student_status= '2';
    }else if($ranking_final=='4'){
      $new_student_status = '3';
    }

    $query = "UPDATE processes SET student_status='$new_student_status', ranking_final='$ranking_final' WHERE studentNO='$studentNO';";

    $query3 = "UPDATE applicant SET app_status='$new_app_status', student_status='$new_student_status' WHERE studentNO='$studentNO';";

    $result = mysql_query($query)
      or die('Error querying database.'  . mysql_error());
    $result2 = mysql_query($query2)
      or die('Error querying database.'  . mysql_error());
    $result2 = mysql_query($query3)
      or die('Error querying database.'  . mysql_error());
  }else if($submit=='Matriculate'){
    //Here is where the applicant gets added to the Student database:
    //echo "Matriculate button got you to the right place!";
    $q = "SELECT fname, lname, addr1, addr2, city, state, zip, phoneNO FROM applicant WHERE studentNO='$studentNO';";
    $d = mysql_query($q);
    list($fname, $lname, $addr1, $addr2, $city, $state, $zip, $phoneNO) = mysql_fetch_row($d);
    $sname = $fname . " " . $lname;
    echo "For student " . $sname . "<br/>";
    $sid = randomGWID();
    $email = create_email($fname, $lname);
    echo "Email :" . $email . "<br/>";
    $password = get_rand_numbers(6);
    echo "Where the password is : " . $password . "<br/>";
    $q2 = "INSERT INTO students (sid, sname, email, address, address2, city, state, zipcode, phonenumber, password) VALUES ('$sid', '$sname', '$email', '$addr1', '$addr2', '$city', '$state', '$zip', '$phoneNO', '$password');";
    $q3 = "UPDATE applicant SET sid='$sid', student_status='6' WHERE studentNO='$studentNO';";
    $q4 = "UPDATE processes SET student_status='6' WHERE studentNO='$studentNO';";

    $r2 = mysql_query($q2)
      or die('Error querying database.'  . mysql_error());
    $r3 = mysql_query($q3)
      or die('Error querying database.'  . mysql_error());
    $r4 = mysql_query($q4)
    or die('Error querying database.'  . mysql_error());
  }
?>
<br/>
<a href="index.php?view=gs_login_success">Back to Search.</a><br />

</body>
</html>

<?php
function randomGWID(){
    $randNum = get_rand_numbers(5);
    $randNum = '6' . $randNum;
    echo "SID: " . $randNum . "<br/>";
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

function create_email($fname, $lname){
  $emailnet = strtolower($fname) . strtolower(substr($lname, 0, 2));
  $email = $emailnet . "@gwu.edu";
  if(check_notexists($email)){
    return $email;
  } else{
    return add3digits($emailnet, $fname, $lname);
  }
}

function add3digits($string, $fname, $lname){
  $three = get_rand_numbers(3);
  $email = $string . $three . "@gwu.edu";
  if(check_notexists($email)){
    return $email;
  }else{
    add3digits($string, $fname, $lname);
  }
}

function check_notexists($email){
    $q="SELECT * FROM students WHERE email='$email';";
    $result = mysql_query($q);
    if(mysql_num_rows($result) > 0){
      return false;
    }else{
      return true;
    }
}

?>
