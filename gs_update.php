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

  if($submit=='applicant'){
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
    echo "Matriculate button got you to the right place!";
    echo "<br/>  Student no:" . $studentNO;
    $query = "";
  }
?>
<br/>
<a href="index.php?view=gs_login_success">Back to Search.</a><br />

</body>
</html>


