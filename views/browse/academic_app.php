<?php
  $dbc = mysql_connect("localhost", "mikey_w", "s3cr3t201e") 
    or die(mysql_error()); 
  mysql_select_db("mikey_w", $dbc); 
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

  <p>Fill out the following form as completely as possible:</p>
  <?php

  $student_no = $_SESSION['student_NO'];//$_GET['student_no'];

  //testing purposes
  //mysql_query("RAWR") or die('academic_app page: '.$student_no);

  $query = "SELECT * FROM application WHERE studentNO='$student_no';";
  $data = mysql_query($query)
    or die('Error querying database.'  . mysql_error());
  echo "<br/>";

  $_SESSION['fname'] = $fname;
  $_SESSION['lname'] = $lname;

  list($studentNO,$fname,$lname,$transcript_recv,$starting_sem,$prior_degree,$pr_school,$pr_GPA,$pr_year,$prior_degree2,$pr_school2,$pr_GPA2,$pr_year2,
  $GRE_analytical,$GRE_quant,$GRE_verbal,$GRE_subj1,$GRE_subj2,$prior_work1,$prior_work2,$interest,$rec_email,$rec_full_name,$date_submitted, $letter_recv) = mysql_fetch_row($data);

  ?>
  <form method="post" action="index.php?view=academic_app_success">
    <label for="studentNO">Student Number:</label>
    <?php
    echo "<input type=\"text\" id=\"studentNO\" name=\"studentNO\" value=\"$student_no\" required><br />";
    echo "<label for=\"firstname\">First name:</label>";
    echo "<input type=\"text\" id=\"firstname\" value=\"$fname\" name=\"firstname\"><br />";
    echo "<label for=\"lastname\">Last name:</label>";
    echo "<input type=\"text\" id=\"lastname\" name=\"lastname\" value=\"$lname\"><br />";
    ?>
    <label for="starting_sem">Semester you intend to start:</label>
    <select name="starting_sem" required>
    <option value="fall">Fall</option>
    <option value="spring">Spring</option>
    </select>
    <br />
    <label for="prior_degree">Any prior degrees?:</label>
    Masters: <input type="checkbox" name="prior_degree" value="masters"  /><br /> 
    PhD: <input type="checkbox" name="prior_degree" value="phd" /><br  />
    <label for="pr_school">School where the degree was earned:</label>
    <input type="text" id="pr_school" name="pr_school" /><br />
    <label for="pr_GPA">GPA Attained:</label>
    <input type="text" id="pr_GPA" name="pr_GPA" /><br />
    <label for="pr_year">Year Graduated:</label>
    <input type="text" id="pr_year" name="pr_year" /><br />
    <label for="prior_degree2">Second prior degree (if applicable):</label>
    <input type="text" id="prior_degree2" name="prior_degree2" /><br />
    <label for="pr_school2">School where second degree was earned</label>
    <input type="text" id="pr_school2" name="pr_school2" /><br />
    <label for="pr_GPA2">GPA Attained with second degree:</label>
    <input type="text" id="pr_GPA2" name="pr_GPA2" /><br />
    <label for="pr_year2">Year graduated with second degree:</label>
    <input type="text" id="pr_year2" name="pr_year2" /><br />
    <label for="GRE_analytical">GRE Analytical score:</label>
    <input type="text" id="GRE_analytical" name="GRE_analytical" /><br />
    <label for="GRE_quant">GRE Quant score:</label>
    <input type="text" id="GRE_quant" name="GRE_quant" /><br />
    <label for="GRE_verbal">GRE Verbal score:</label>
    <input type="text" id="GRE_verbal" name="GRE_verbal" /><br />
    <label for="GRE_subj1">GRE Subject 1 score:</label>
    <input type="text" id="GRE_subj1" name="GRE_subj1" /><br />
    <label for="GRE_subj2">GRE Subject 2 score:</label>
    <input type="text" id="GRE_subj2" name="GRE_subj2" /><br />
    <label for="prior_work1">Prior work experience:</label>
    <input type="text" id="prior_work1" name="prior_work1" /><br />
    <label for="prior_work2">Prior work experience Job 2:</label>
    <input type="text" id="prior_work2" name="prior_work2" /><br />
    <label for="interest">Area of interest:</label>
    <input type="text" id="interest" name="interest" /><br />
    <label for="rec_email">Email for person writing recommendation:</label>
    <input type="text" id="rec_email" name="rec_email" /><br />
    <label for="rec_full_name">Name of person writing recommendation:</label>
    <input type="text" id="rec_full_name" name"rec_full_name" /><br />
    <label for="program">Masters or PhD?:</label>
    <select name="program" required>
    <option value="masters">Masters</option>
    <option value="phd">PhD</option>
    </select>
    <br />
    <input type="submit" value="Submit" name="submit" />
     <select name="starting_sem">
      <option value="Fall 2013">Fall 2013</option>
      <option value="Spring 2014">Spring 2014</option>
      <option value="Summer 2014">Summer 2014</option>
      <option value="Fall 2014">Fall 2014</option>
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
    echo "<label for=\"GRE_analytical\">GRE Analytical score:</label>";
    echo "<input type=\"text\" id=\"GRE_analytical\" name=\"GRE_analytical\"  maxlength=\"3\" value=\"$GRE_analytical\"/><br />";
    echo "<label for=\"GRE_quant\">GRE Quant score:</label>";
    echo "<input type=\"text\" id=\"GRE_quant\" name=\"GRE_quant\"  maxlength=\"3\" value=\"$GRE_quant\"/><br />";
    echo "<label for=\"GRE_verbal\">GRE Verbal score:</label>";
    echo "<input type=\"text\" id=\"GRE_verbal\" name=\"GRE_verbal\" maxlength=\"3\" value=\"$GRE_verbal\"/><br />";
    echo "<label for=\"GRE_subj1\">GRE Subject 1 score:</label>";
    echo "<input type=\"text\" id=\"GRE_subj1\" name=\"GRE_subj1\" maxlength=\"3\" value=\"$GRE_subj1\"/><br />";
    echo "<label for=\"GRE_subj2\">GRE Subject 2 score:</label>";
    echo "<input type=\"text\" id=\"GRE_subj2\" name=\"GRE_subj2\" maxlength=\"3\" value=\"$GRE_subj2\"/><br />";
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
