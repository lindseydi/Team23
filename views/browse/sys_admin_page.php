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
   if($_POST['submitted'] == 1){
      $id = $_POST['sid'];
      $name = $_POST['sname'];
      $eaddr = $_POST['eaddr'];
      $addr = $_POST['addr'];
      $addr2 = $_POST['addr2'];
      $CT = $_POST['city'];
      $ST = $_POST['state'];
      $ZC = $_POST['zip'];
      $PN = $_POST['pn'];
      $pw = $_POST['pw'];
      $q1 ="INSERT INTO students VALUES ('$id', '$name', '$eaddr', '$addr', '$addr2', '$CT', '$ST', '$ZC', '$PN', '$pw');";
      $r1 = mysql_query($q1) or die('Error querying database.'  . mysql_error());
   }
   //gsecretary
   else if($_POST['submitted'] == 2){
      $id = $_POST['ID'];
      $name = $_POST['Name'];
      $pw = $_POST['PW'];   
   
      $q1 ="INSERT INTO gsecretary VALUES ('$id', '$name', '$pw');";
      $r1 = mysql_query($q1) or die('Error querying database.'  . mysql_error());
   }
   //cac
   else if($_POST['submitted'] == 3){
      $name = $_POST['Name'];
      $id = $_POST['ID'];
      $eaddr = $_POST['EAddr'];
      $pw = $_POST['PW'];   
   
      $q1 ="INSERT INTO cac VALUES ('$name', '$id', 'eaddr', '$pw');";
      $r1 = mysql_query($q1) or die('Error querying database.'  . mysql_error());
   }
   //fcommittee
   else if($_POST['submitted'] == 4){
      $name = $_POST['Name'];
      $id = $_POST['ID'];
      $eaddr = $_POST['EAddr'];
      $pw = $_POST['PW'];   
   
      $q1 ="INSERT INTO cac VALUES ('$name', '$id', 'eaddr', '$pw');";
      $r1 = mysql_query($q1) or die('Error querying database.'  . mysql_error());
   }
   //faculty
   else if($_POST['submitted'] == 5){
      $id = $_POST['ID'];
      $name = $_POST['Name'];
      $cid = $_POST['CID'];
      $pw = $_POST['PW'];   
   
      $q1 ="INSERT INTO faculty VALUES ('$id', '$name', '$cid', '$pw');";
      $r1 = mysql_query($q1) or die('Error querying database.'  . mysql_error());
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

   <?php } else if($_SESSION['admin_add_person'] == student){ ?>
   <div class='container'>
      <form action="index.php?view=sys_admin_page" method='POST' >
         <div class='short explanation'>*required fields</div>
         <input type='hidden' name='submitted' value='1'/>
         Student ID*: <input type="text" name="sid"  maxlength="20" required><br />
         Student Name*: <input type="text" name="sname"  maxlength="50" required><br />
         Email Address*: <input type="text" name="eaddr"  maxlength="50" required><br />
         Address*: <input type="text" name="addr"  maxlength="100" required><br />
         Address 2: <input type="text" name="addr2"  maxlength="100" ><br />
         City*: <input type="text" name="city"  maxlength="50" required><br />
         State*: <input type="text" name="state"  maxlength="20" required><br />
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
         <input type="text" name="ID"  maxlength="20" required><br />
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
         <input type="text" name="ID"  maxlength="20" required><br />
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
         <input type="text" name="ID"  maxlength="20" required><br />
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
         <input type="text" name="ID"  maxlength="20" required><br />
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


