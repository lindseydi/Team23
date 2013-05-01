<?php
    $studentNO= $_GET['student_no'];
    $fname= $_GET['fname'];
    $lname= $_GET['lname'];
    $rec_email = $_GET['rec_email'];
    $rec_full_name = $_GET['rec_full_name'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Recommendation Input</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h2>Write your recommendation here:</h2>

<form method="post" action="rec_success.php">
    <label for="rec_email">Your e-mail</label>
    <?php
    echo "<input type=\"text\" id=\"rec_email\" name=\"rec_email\" value='$rec_email' required><br />";
    echo "<label for=\"rec_full_name\">Full Name:</label>";
    echo "<input type=\"text\" id=\"rec_full_name\" maxlength=\"50\" value='$rec_full_name' name=\"rec_full_name\" required><br />";
    echo "<label for=\"title\">Title:</label>";
    echo "<input type=\"text\" id=\"title\" name=\"title\" maxlength=\"30\" required><br />";
    echo "<label for=\"affiliation\">University Affiliation: </label>";
    echo "<input type=\"text\" id=\"affiliation\" name=\"affiliation\" maxlength=\"20\" required><br />";
    ?>
    <label for="rec_letter">Input your recommendation letter here:</label>
    <TEXTAREA NAME="rec_letter" ROWS=30 COLS=30 ></TEXTAREA>
    <input type="submit" value="Submit Recommendation" name="submit" />
  </form>
</body>
</html>

