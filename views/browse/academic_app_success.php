    <?php
    $dbc = mysql_connect("localhost", "mikey_w", "s3cr3t201e")
      or die('Error connecting to MySQL server.');

     mysql_select_db("mikey_w", $dbc);
     ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Thank you for submitting your application.</title>
</head>
<body>
  <h2>Academic Application</h2>

<?php
    $studentNO = $_SESSION['student_NO'];//$_POST['studentNO'];
    $firstname = $_SESSION['fname'];//$_POST['firstname'];
    $lastname = $_SESION['lname'];//$_POST['lastname'];
    $starting_sem = $_POST['starting_sem'];
    $prior_degree = $_POST['prior_degree'];
    $pr_school = $_POST['pr_school'];
    $pr_GPA = $_POST['pr_GPA'];
    $pr_year = $_POST['pr_year'];
    $prior_degree2 = $_POST['prior_degree2'];
    $pr_school2 = $_POST['pr_school2'];
    $pr_GPA2 = $_POST['pr_GPA2'];
    $pr_year2= $_POST['pr_year2'];
    $GRE_analytical = $_POST['GRE_analytical'];
    $GRE_quant = $_POST['GRE_quant'];
    $GRE_verbal = $_POST['GRE_verbal'];
    $GRE_subj1 = $_POST['GRE_subj1'];
    $GRE_subj2 = $_POST['GRE_subj2'];
    $prior_work1 = $_POST['prior_work1'];
    $prior_work2 = $_POST['prior_work2'];
    $interest = $_POST['interest'];
    $rec_email = $_POST['rec_email'];
    $rec_full_name = $_POST['rec_full_name'];

    if ($_POST['action'] == 'Save') {

    $query ="UPDATE application SET studentNO='$studentNO', fname='$firstname', lname='$lastname',
    starting_sem='$starting_sem', prior_degree='$prior_degree', pr_school='$pr_school', pr_GPA='$pr_GPA',
    pr_year='$pr_year', prior_degree2='$prior_degree2', pr_school2='$pr_school2', pr_GPA2='$pr_GPA2',
    pr_year2='$pr_year2', GRE_analytical='$GRE_analytical', GRE_quant='$GRE_quant', GRE_verbal='$GRE_verbal',
    GRE_subj1='$GRE_subj1', GRE_subj2='$GRE_subj2', prior_work1='$prior_work1', prior_work2='$prior_work2',
    interest='$interest', rec_email='$rec_email', rec_full_name='$rec_full_name' WHERE studentNO='$studentNO';";

    echo "<br/>";
    //echo $query;
    echo "<br/>";

    $result = mysql_query($query)
      or die('Error querying database.'  . mysql_error());

    echo "Thank you, your changes have been saved.";
    echo "<br/>";

//SUBMIT, NO CHANGES CAN BE MADE AFTER THIS!
//Consider making an "are you sure" dialog box!
  } else if (1/*$_POST['action'] == 'Submit'*/) {

//Here is where we should check that the boxes that need to be filled out are filled out!

        $query = "SELECT transcript_recv FROM application WHERE studentNO='$studentNO';";

        $data = mysql_query($query);
        list($transcript_recv) = mysql_fetch_row($data);

        //Set app status so that the application will show up to faculty committee member's list of applicants to review
        switch($transcript_recv){
          case '0':
            $app_status='2';
          break;
          case '1':
            $app_status='3';
          break;
        }

        //save this to the database;
        $query2 = "UPDATE applicant SET app_status='$app_status' WHERE studentNO='$studentNO';";

        $query3 ="UPDATE application SET studentNO='$studentNO', fname='$firstname', lname='$lastname',
        starting_sem='$starting_sem', prior_degree='$prior_degree', pr_school='$pr_school', pr_GPA='$pr_GPA',
        pr_year='$pr_year', prior_degree2='$prior_degree2', pr_school2='$pr_school2', pr_GPA2='$pr_GPA2',
        pr_year2='$pr_year2', GRE_analytical='$GRE_analytical', GRE_quant='$GRE_quant', GRE_verbal='$GRE_verbal',
        GRE_subj1='$GRE_subj1', GRE_subj2='$GRE_subj2', prior_work1='$prior_work1', prior_work2='$prior_work2',
        interest='$interest', rec_email='$rec_email', rec_full_name='$rec_full_name', date_submitted=NOW() WHERE studentNO='$studentNO';";
        
        //Generate a login for a recommender!
        //Should email them the login, but apparently this doesn't work, so i won't try
        $rec_password = get_rand_numbers(8);
        $query4 = "INSERT INTO recommender VALUES('$rec_email', '$rec_password');";

         $data2 = mysql_query($query2);
         $data3 = mysql_query($query3);
         $data4 = mysql_query($query4);

    echo "Thank you for submitting your application, please check back soon for final decision.";
    echo "<br/>";


  echo "<br/>";
  echo "<a href=\"recommends.php?student_no=$studentNO&fname=$fname&lname=&$lname&rec_email=$rec_email&rec_full_name=$rec_full_name \" target=\"_blank\">Click here if you are $rec_full_name</a>";
  echo "<br/>";
  echo "<br/>";

  }else{
    echo "Should never get here, error!";
  }
  echo "<br/>";
  echo "<br/>";
  echo "<a href=\"welcome.php?student_NO=$studentNO\">Back to welcome screen.</a><br />";
?>

</body>
</html>
<?php
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
            $num = mt_rand(0,9);
            $rand_id .= assign_rand_value($num);
        }
    }
    return $rand_id;
}
?>