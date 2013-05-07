<?php
  if($_SESSION['student_auth'] == false){
     header('Location: index.php?view=universal_login');
  }

  $dbc = mysql_connect("localhost", "mikey_w", "s3cr3t201e")
    or die('Error connecting to MySQL server.');
   mysql_select_db("mikey_w", $dbc);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Personal Info</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h2>Update your personal information</h2>

  <p>Please hit submit after updating any information that has changed.</p>

<?php

  $sid = mysql_real_escape_string($_SESSION['username']);
  echo "Student number: " . $sid . "<br/>";

  $query = "SELECT sname, email, address, address2, city, state, zipcode, phonenumber, password FROM students WHERE sid='$sid';";
  //echo $query;
  echo '<br /><br />';
  $result = mysql_query($query);

  list($sname, $email, $address, $address2, $city, $state, $zipcode, $phonenumber, $password) = mysql_fetch_row($result);


    echo "<form method=\"post\" action='index.php?view=student_update_personal_success'>";

    echo "<label for=\"sname\">Name:</label>";
    echo "<input type=\"text\" name=\"sname\"  maxlength=\"100\" value='$sname' required><br />";

    echo "<label for=\"address\">Address Line 1</label>";
    echo "<input type=\"text\", name=\"address\", value='$address', maxlength=\"200\" required><br />";

    echo "<label for=\"address2\">Address Line 2</label>";
    echo "<input type=\"text\", name=\"address2\", maxlength=\"200\", value='$address2' /><br />";

    echo "<label for=\"city\">City</label>";
    echo "<input type=\"text\" name=\"city\" maxlength=\"20\" value='$city' required><br />";

    echo "<label for=\"state\">State</label>";
    echo "<select name=\"state\" required>";
    echo "<option value=$state selected>$state</option>";
      ?>
      <option value="AL">AL</option>
      <option value="AK">AK</option>
      <option value="AZ">AZ</option>
      <option value="AR">AR</option>
      <option value="CA">CA</option>
      <option value="CO">CO</option>
      <option value="CT">CT</option>
      <option value="DC">DC</option>
      <option value="DE">DE</option>
      <option value="FL">FL</option>
      <option value="GA">GA</option>
      <option value="HI">HI</option>
      <option value="ID">ID</option>
      <option value="IL">IL</option>
      <option value="IN">IN</option>
      <option value="IA">IA</option>
      <option value="KS">KS</option>
      <option value="KY">KY</option>
      <option value="LA">LA</option>
      <option value="ME">ME</option>
      <option value="MD">MD</option>
      <option value="MA">MA</option>
      <option value="MI">MI</option>
      <option value="MN">MN</option>
      <option value="MS">MS</option>
      <option value="MO">MO</option>
      <option value="MT">MT</option>
      <option value="NE">NE</option>
      <option value="NV">NV</option>
      <option value="NH">NH</option>
      <option value="NJ">NJ</option>
      <option value="NM">NM</option>
      <option value="NY">NY</option>
      <option value="NC">NC</option>
      <option value="ND">ND</option>
      <option value="OH">OH</option>
      <option value="OK">OK</option>
      <option value="OR">OR</option>
      <option value="PA">PA</option>
      <option value="RI">RI</option>
      <option value="SC">SC</option>
      <option value="SD">SD</option>
      <option value="TN">TN</option>
      <option value="TX">TX</option>
      <option value="UT">UT</option>
      <option value="VT">VT</option>
      <option value="VA">VA</option>
      <option value="WA">WA</option>
      <option value="WV">WV</option>
      <option value="WI">WI</option>
      <option value="WY">WY</option>
    </select>
    <br />

<?php

    echo "<label for=\"zipcode\">Zip Code</label>";
    echo "<input type=\"text\" name=\"zipcode\" value='$zipcode' maxlength=\"5\" required><br /> ";

    echo "<label for=\"phonenumber\">Phone Number</label>";
    echo "<input type=\"text\" name=\"phonenumber\"  maxlength=\"12\" value='$phonenumber' required><br />";

    echo "<label for=\"email\">E-mail Address</label>";
    echo "<input type=\"text\" name=\"email\"  maxlength=\"20\" value='$email' required><br /> ";

    echo "<label for=\"password\">Password</label>";
    echo "<input type=\"text\" name=\"password\"  maxlength=\"20\" value='$password' required><br /> ";
    ?>

    <input type="submit" value="Submit" name="submit" />
  </form>
<?php
  echo '<br /><br />';
  echo "<a href='index.php?view=student_page'>Go Back</a><br />";
?>
</body>
</html>