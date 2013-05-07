<?php
include('../../login.php');
unset($_SESSION['admin_add_person']);

if($_SESSION['sadmin_auth'] == false){
   header('Location: index.php?view=universal_login');
}
if (isset($_POST['add_person'])){
   $_SESSION['admin_add_person'] = $_POST['add_person'];
}

if(isset($_POST['submitted'])){
   $dbc = db_connect();
   //student
   $allgood= true;
   if($_POST['submitted'] == 1){
      $id = $_POST['sid'];
      if($allgood){$allgood=notNull($id);}
      $name = $_POST['sname'];
      if($allgood){$allgood=notNull($name);}
      $eaddr = $_POST['eaddr'];
      if($allgood){$allgood=notNull($eaddr);}
       if($allgood){$allgood=checkEmail($eaddr);}
      $addr = $_POST['addr'];
      if($allgood){$allgood=notNull($addr);}
      $addr2 = $_POST['addr2'];
      $CT = $_POST['city'];
       if($allgood){$allgood=notNull($CT);}
      $ST = $_POST['state'];
       if($allgood){$allgood=notNull($ST);}
      $ZC = $_POST['zip'];
      if($allgood){$allgood=notNull($ZC);}
      if($allgood){$allgood=noLetters($ZC);}
      if($allgood){$allgood=lengthOf($ZC, 5);}
      $PN = $_POST['pn'];
      if($allgood){$allgood=notNull($PN);}
      if($allgood){$allgood=noLetters($PN);}
      if($allgood){$allgood=lengthOf($PN, 10);}
      $pw = $_POST['pw'];
      if($allgood){$allgood=notNull($pw);}

      if($allgood){
         $q1 ="INSERT INTO students VALUES ('$id', '$name', '$eaddr', '$addr', '$addr2', '$CT', '$ST', '$ZC', '$PN', '$pw');";
         $r1 = mysql_query($q1) or die('Error querying database.'  . mysql_error());
      }
   }
   //gsecretary
   else if($_POST['submitted'] == 2){
      $allgood= true;
      $id = $_POST['ID'];
      if($allgood){$allgood=notNull($id);}
      $name = $_POST['Name'];
      if($allgood){$allgood=notNull($name);}
      $pw = $_POST['PW'];   
      if($allgood){$allgood=notNull($pw);}
      if($allgood){
         $q1 ="INSERT INTO gsecretary VALUES ('$id', '$name', '$pw');";
         $r1 = mysql_query($q1) or die('Error querying database.'  . mysql_error());
      }else{
         echo "<br/>Try again<br/>";
      }
   }
   //cac
   else if($_POST['submitted'] == 3){
      $allgood = true;
      $name = $_POST['Name'];
      if($allgood){$allgood=notNull($name);}
      $id = $_POST['ID'];
      if($allgood){$allgood=notNull($id);}
      $eaddr = $_POST['EAddr'];
      if($allgood){$allgood=notNull($eaddr);}
       if($allgood){$allgood=checkEmail($eaddr);}
      $pw = $_POST['PW'];   
      if($allgood){$allgood=notNull($pw);}
      if($allgood){
         $q1 ="INSERT INTO cac VALUES ('$name', '$id', 'eaddr', '$pw');";
         $r1 = mysql_query($q1) or die('Error querying database.'  . mysql_error());
      }else{
         echo "<br/>Try again<br/>";
      }
   }
   //fcommittee
   else if($_POST['submitted'] == 4){
      $allgood = true;
      $name = $_POST['Name'];
      if($allgood){$allgood=notNull($name);}
      $id = $_POST['ID'];
      if($allgood){$allgood=notNull($id);}
      $eaddr = $_POST['EAddr'];
      if($allgood){$allgood=notNull($eaddr);}
       if($allgood){$allgood=checkEmail($eaddr);}
      $pw = $_POST['PW'];   
      if($allgood){$allgood=notNull($pw);}
      if($allgood){
         $q1 ="INSERT INTO cac VALUES ('$name', '$id', 'eaddr', '$pw');";
         $r1 = mysql_query($q1) or die('Error querying database.'  . mysql_error());
      }else{
         echo "<br/>Try again<br/>";
      }
   }
   //faculty
   else if($_POST['submitted'] == 5){
      $allgood = true;
      $name = $_POST['Name'];
      if($allgood){$allgood=notNull($name);}
      $id = $_POST['ID'];
      if($allgood){$allgood=notNull($id);}
      $eaddr = $_POST['EAddr'];
      //if($allgood){$allgood=notNull($eaddr);}
      if($allgood){$allgood=checkEmail($eaddr);}
      $pw = $_POST['PW'];   
      if($allgood){$allgood=notNull($pw);}
      if($allgood){
   
         $q1 ="INSERT INTO faculty VALUES ('$id', '$name', '$cid', '$pw');";
         $r1 = mysql_query($q1) or die('Error querying database.'  . mysql_error());
      }else{
         echo "<br/>Try again<br/>";
      }
   }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
   <head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Student Home Page</title>
      <style type="text/css">
         #center {
            text-align:center;
         }
         div.container {
            width:960px;
            margin-left:auto;
            margin-right:auto;
         }
      </style>
   </head>
   <body>
      <h1 style="text-align: center;">System Admin Page</h1>
      <hr />
      <?php if (!isset($_SESSION['admin_add_person'])) { ?>

      <!-- This is a link that goes to the add_drop view when the button is pressed. -->
      <div id='center'>
         <form action='index.php?view=sys_admin_page' method="post">         
            <select name='add_person'>
               <option value='cac'>CAC</option>
               <option value='student'>Student</option>
               <option value='faculty'>Faculty</option>
               <option value='gsecretary'>Grad Secretary</option>
               <option value='fcommittee'>Faculty Committee Member</option>
            </select>
            <input type="submit" value="Submit">
         </form>
      </div>

<br/><br/><br/>
<div id='center'>
<p>Which applicant are you looking for? 
  </br>
    You may put in a name or student number.
  </br>
    Please separate search terms with a space.
</br>
</br>
    EX: firstname lastname or 232343 lastname</p>
    </br>
  <form name="search" method="post" action="sysadmin_search_results.php">
  <input type="text" name="search_term" />
  <!--<input type="hidden" name="searching" value="yes" />-->
  <input type="submit" value="Search" />

   <?php } else if($_SESSION['admin_add_person'] == student){ ?>
   <div class='container'>
      <form action="index.php?view=sys_admin_page" method='POST' >
         <div class='short explanation'>*required fields</div>
         <input type='hidden' name='submitted' value='1'/>
         Student ID*: <input type="text" name="sid"  maxlength="6" required><br />
         Student Name*: <input type="text" name="sname"  maxlength="50" required><br />
         Email Address*: <input type="text" name="eaddr"  maxlength="50" required><br />
         Address*: <input type="text" name="addr"  maxlength="100" required><br />
         Address 2: <input type="text" name="addr2"  maxlength="100" ><br />
         City*: <input type="text" name="city"  maxlength="50" required><br />
         State*:     <select name="state" required>
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
         Zip Code*: <input type="text" name="zip"  maxlength="20" required><br />
         Phone Number*: <input type="text" name="pn"  maxlength="30" required><br />
         Password*: <input type="password" name="pw"  maxlength="20" required><br />
         <input type="submit" value="Submit" name="submit" />
      </form>
   </div>
   <?php } else if($_SESSION['admin_add_person'] == gsecretary) {?>
   <div class='container'>
      <form method="post" action="index.php?view=sys_admin_page">
         <div class='short explanation'>*required fields</div>
         <input type='hidden' name='submitted' value='2'/>
         <label for="ID">Graduate Secretary ID*: </label>
         <input type="text" name="ID"  maxlength="6" required><br />
         <label for="Name">GS Name*: </label>
         <input type="text" name="Name"  maxlength="100" required><br />
         <label for="PW">Password*: </label>
         <input type="password" name="PW"  maxlength="100" required><br />
         <input type="submit" value="Submit" name="submit" />
      </form>
   </div>
   <?php } else if($_SESSION['admin_add_person'] == cac) {?>
   <div class='container'>
      <form method="post" action="index.php?view=sys_admin_page">
         <div class='short explanation'>*required fields</div>
         <input type='hidden' name='submitted' value='3'/>
         <label for="Name">CAC Name*:</label>
         <input type="text" name="Name"  maxlength="100" required><br />
         <label for="ID">CAC ID*:</label>
         <input type="text" name="ID"  maxlength="6" required><br />
         <label for="EAddr">Email Address*:</label>
         <input type="text" name="EAddr"  maxlength="100" required><br />
         <label for="PW">Password*: </label>
         <input type="password" name="PW"  maxlength="100" required><br />
         <input type="submit" value="Submit" name="submit" />
      </form>
   </div>
   <?php } else if($_SESSION['admin_add_person'] == fcommittee) {?>
   <div class='container'>
      <form method="post" action="index.php?view=sys_admin_page">
         <input type='hidden' name='submitted' value='4'/>
         <label for="Name">Faculty Committee Name*: </label>
         <input type="text" name="Name"  maxlength="100" required><br />
         <label for="ID">Faculty Committee ID*: </label>
         <input type="text" name="ID"  maxlength="6" required><br />
         <label for="EAddr">Email Address*: </label>
         <input type="text" name="EAddr"  maxlength="100" required><br />
         <label for="PW">Password*: </label>
         <input type="password" name="PW"  maxlength="100" required><br />
         <input type="submit" value="Submit" name="submit" />
      </form>
   </div>
   <?php } else if($_SESSION['admin_add_person'] == faculty) {?>
   <div class='container'>
      <form method="post" action="index.php?view=sys_admin_page">
         <div class='short explanation'>*required fields</div>
         <input type='hidden' name='submitted' value='5'/>
         <label for="ID">Faculty ID*: </label>
         <input type="text" name="ID"  maxlength="6" required><br />
         <label for="Name">Faculty Name*: </label>
         <input type="text" name="Name"  maxlength="50" required><br />
         <label for="CID">Course ID*: </label>
         <input type="text" name="CID"  maxlength="50" required><br />
         <label for="PW">Password*: </label>
         <input type="password" name="PW"  maxlength="100" required><br />
         <input type="submit" value="Submit" name="submit" />
      </form>
   </div>
   <?php } ?>

   </body>
</html>


<?php
function startNum($string){
   if ((strlen($string) > 0) && (ctype_digit(substr($string, 0, 1)))){
      return true;
    }else{
      echo "Your address cannot be correct without a house number!";
    }
}

function noLetters($string){
    if (preg_match('/^[0-9]+$/', $string)) {
      return true;
    }else{
          echo "Your input includes letters where it shouldn't";
    }
}

function lengthOf($string, $targetLen){
  if(strlen($string)==$targetLen){
    return true;
  }else{
      echo "Your input was not the correct length!";
  }
}
function check_notexists($email){
    $q="SELECT * FROM applicant WHERE email='$email';";
    $result = mysql_query($q);
    if(mysql_num_rows($result) > 0){
      "This email already exists in the system.";
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
  }
}

function checkGPA($GPA) {
//regex from devshed
 //echo $GPA. "<br/>";
  if(((float)$GPA <= 4.0) || ($GPA="")){
    return TRUE;
  } else{
    //return FALSE;
    echo "Be sure your GPA is the right format. If your GPA ends with a 0, put it. EX. 3.40";
  }
}

function checkYear($year) {
//regex from devshed
  //echo $year . "n2<br/>";
  if(((int)$year>1900) && ((int)$year < 2099) || $year==""){
    return TRUE;
  } else{
    //return FALSE;
    echo "Be sure your years are valid. Only years between 1900 and 2099 will be accepted";
  }
}

function notNull($text) {
//regex from devshed
  //echo $year . "<br/>";
  if($text != ""){
    return TRUE;
  } else{
    //return FALSE;
   echo $text;
    echo "<br/>Be sure to fill out all required fields.";
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