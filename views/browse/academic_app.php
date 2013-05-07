<?php
  $dbc = mysql_connect("localhost", "mikey_w", "s3cr3t201e") 
    or die(mysql_error()); 
  mysql_select_db("mikey_w", $dbc); 

  error_reporting(E_ALL);
  ini_set('display_errors', True);  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Academic Application</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h2>Academic Application</h2>

<?php

  $student_no = $_SESSION['student_NO'];//$_GET['student_no'];

  //testing purposes
  //mysql_query("RAWR") or die('academic_app page: '.$student_no);

  $query = "SELECT * FROM application WHERE studentNO='$student_no';";
  $data = mysql_query($query)
    or die('Error querying database.'  . mysql_error());

  list($studentNO,$fname,$lname,$transcript_recv,$starting_sem,$prior_degree,$pr_school,$pr_GPA,$pr_year,$prior_degree2,$pr_school2,$pr_GPA2,$pr_year2,
  $GRE_analytical,$GRE_quant,$GRE_verbal,$GRE_subj1,$GRE_subj2,$prior_work1,$prior_work2,$interest,$rec_email,$rec_full_name,$date_submitted, $letter_recv, $program) = mysql_fetch_row($data);

  echo "<br/>";
  echo "Welcome back <b>" .$fname." ".$lname.'</b><br/>';
  echo "Please fill out the form as completely as possible. You may save as often as you like, but once you press submit, no more changes can be made.";
  echo "<br/><br/><br/>";

 ?>
  <form method="post" action="index.php?view=academic_app_success">
   
    <?php
    /*
     html <label for="studentNO">Student Number:</label>
    echo "<input type=\"text\" id=\"studentNO\" name=\"studentNO\" value=\"$student_no\" required><br />";
    echo "<label for=\"firstname\">First name:</label>";
    echo "<input type=\"text\" id=\"firstname\" value=\"$fname\" name=\"firstname\"><br />";
    echo "<label for=\"lastname\">Last name:</label>";
    echo "<input type=\"text\" id=\"lastname\" name=\"lastname\" value=\"$lname\"><br />";
    */
    ?>
   
    <label for="program">Which program are you applying for?</label>
    <select name="program" required>
    <?php    
    echo "<option value=\"$program\">$program</option>";
    ?>
    <option value="Masters">Masters</option>
    <option value="PhD">PhD</option>
    </select>
    <br />
    <label for="starting_sem">Starting Semester: </label>
     <select name="starting_sem">
      <?php    
    echo "<option value=\"$starting_sem\">$starting_sem</option>";
      ?>
      <option value="Fall 13">Fall 13</option>
      <option value="Spring 14">Spring 14</option>
      <option value="Summer 14">Summer 14</option>
      <option value="Fall 14">Fall 14</option>
    </select>
<?php
    echo "<br/>";
    echo "<label for=\"prior_degree\">Any prior degrees?:</label>";
    echo "<input type=\"text\" id=\"prior_degree\" name=\"prior_degree\" placeholder=\"EX: Bachelors\" maxlength=\"10\" value=\"$prior_degree\"/><br />";
    echo "<label for=\"pr_school\">School where the degree was earned:</label>";
    echo "<input type=\"text\" id=\"pr_school\" name=\"pr_school\" maxlength=\"40\" value=\"$pr_school\"/><br />";
    echo "<label for=\"pr_GPA\">GPA Attained:</label>";
    echo "<input type=\"text\" id=\"pr_GPA\" name=\"pr_GPA\" maxlength=\"4\" value=\"$pr_GPA\"/><br />";
    echo "<label for=\"pr_year\">Year Graduated:</label>";
    echo "<input type=\"text\" id=\"pr_year\" name=\"pr_year\" maxlength=\"4\" value=\"$pr_year\" /><br />";
    echo "<label for=\"prior_degree2\">Second prior degree (if applicable):</label>";
    echo "<input type=\"text\" id=\"prior_degree2\" name=\"prior_degree2\" placeholder=\"EX: Bachelors\" maxlength=\"10\" value=\"$prior_degree2\"/><br />";
    echo "<label for=\"pr_school2\">School where second degree was earned</label>";
    echo "<input type=\"text\" id=\"pr_school2\" name=\"pr_school2\"  maxlength=\"40\" value=\"$pr_school2\"/><br />";
    echo "<label for=\"pr_GPA2\">GPA Attained with second degree:</label>";
    echo "<input type=\"text\" id=\"pr_GPA2\" name=\"pr_GPA2\"  maxlength=\"4\" value=\"$pr_GPA2\"/><br />";
    echo "<label for=\"pr_year2\">Year graduated with second degree:</label>";
    echo "<input type=\"text\" id=\"pr_year2\" name=\"pr_year2\"  maxlength=\"4\" value=\"$pr_year2\"/><br />";

    //GRE SCORES

    //Analytical
    echo "<label for=\"GRE_analytical\">GRE Analytical Writing score:</label>";
    echo "<select name=\"GRE_analytical\">";
    echo "<option value=\"$GRE_analytical\" selected>$GRE_analytical</option>";
    for($i=0; $i<7; $i+=.5){
      echo "<option value=\"$i\" >$i</option>";
    }
    echo  "</select><br/>";


    echo "<label for=\"GRE_quant\">GRE Quantitative Reasoning Score:</label>";
    echo "<select name=\"GRE_quant\">";
    echo "<option value=\"$GRE_quant\" selected>$GRE_quant</option>";
    for($i=130; $i<171; $i++){
      echo "<option value=\"$i\">$i</option>";
    }
    echo  "</select> <br/>";
    

    echo "<label for=\"GRE_verbal\">GRE Verbal Reasoning Score:</label>";
    echo "<select name=\"GRE_verbal\">";
    echo "<option value=\"$GRE_verbal\" selected>$GRE_verbal</option>";
    for($i=130; $i<171; $i++){
      echo "<option value=\"$i\">$i</option>";
    }
    echo  "</select> <br/>";
    

    echo "<FONT COLOR=\"B22222\">** Be sure to reselect the subject after each time you have saved</FONT><br/>";
    echo "<label for=\"GRE_subj1\">GRE Subject 1 score:</label>";
    echo "<select name=\"subj1\">";
      echo "<option value=\"Biochemistry\" >Biochemistry, Cell and Molecular Biology</option>";
      echo "<option value=\"Biology\">Biology</option>";
      echo "<option value=\"Chemistry\" >Chemistry</option>";
      echo "<option value=\"ComputerScience\">Computer  Science</option>";
      echo "<option value=\"LiteratureinEnglish\">Literature in English</option>";
      echo "<option value=\"Mathematics\" >Mathematics</option>";
      echo "<option value=\"Physics\">Physics</option>";
      echo "<option value=\"Psychology\" >Psychology</option>";
    echo  "</select>  ";
    echo "<select name=\"GRE_subj1\">";
    echo "<option value=\"$GRE_subj1\" selected>$GRE_subj1</option>";
    for($i=200; $i<1000; $i+=10){
      echo "<option value=\"$i\" >$i</option>";
    }
    echo  "</select> <br/>";


    echo "<label for=\"GRE_subj2\">GRE Subject 2 score:</label>";
    echo "<select name=\"subj2\">";
      echo "<option value=\"Biochemistry\" >Biochemistry, Cell and Molecular Biology</option>";
      echo "<option value=\"Biology\">Biology</option>";
      echo "<option value=\"Chemistry\" >Chemistry</option>";
      echo "<option value=\"ComputerScience\">Computer  Science</option>";
      echo "<option value=\"LiteratureinEnglish\">Literature in English</option>";
      echo "<option value=\"Mathematics\" >Mathematics</option>";
      echo "<option value=\"Physics\">Physics</option>";
      echo "<option value=\"Psychology\" >Psychology</option>";
    echo  "</select>  ";
    echo "<select name=\"GRE_subj2\">";
    echo "<option value=\"$GRE_subj2\" selected>$GRE_subj2</option>";
    for($i=200; $i<1000; $i+=10){
      echo "<option value=\"$i\" >$i</option>";
    }
    echo  "</select> <br/>";

    echo "<label for=\"prior_work1\">Prior work experience:</label>";
    echo "<input type=\"text\" id=\"prior_work1\" name=\"prior_work1\" maxlength=\"200\" value=\"$prior_work1\"/><br />";
    echo "<label for=\"prior_work2\">Prior work experience Job 2:</label>";
    echo "<input type=\"text\" id=\"prior_work2\" name=\"prior_work2\" maxlength=\"200\" value=\"$prior_work2\"/><br />";
    echo "<label for=\"interest\">Area of interest:</label>";
    echo "<input type=\"text\" id=\"interest\" name=\"interest\" maxlength=\"20\" value=\"$interest\"/><br />";

    echo "<label for=\"rec_email\">Email for person writing recommendation:</label>";
    echo "<input type=\"text\" id=\"rec_email\" name=\"rec_email\" maxlength=\"20\" value=\"$rec_email\"/><br />";

    echo "<label for=\"rec_full_name\">Name of person writing recommendation:</label>";
    echo "<input type=\"text\" id=\"rec_full_name\" name=\"rec_full_name\" maxlength=\"20\" value=\"$rec_full_name\"/><br />";

    echo "<input type=\"submit\" value=\"Save\" name=\"action\" />";
    echo "<input type=\"submit\" value=\"Submit\" name=\"action\" />";
    ?>
  </form>
</body>
</html>
