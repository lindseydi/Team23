<?php

include('login.php');
db_connect();

if(isset($_POST['reset'])){  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
   <head>
      <title>Reset</title>
      <style type="text/css">
         h1 {text-align: center}
         p {text-align: center}
      </style>
   </head>
   
<?php header("refresh: 3; url=index.php");
$u1 = "drop table if exists transcripts cascade";
$r1 = mysql_query($u1) or die('Error in Querying Database');
$u2 = "create table transcripts (
  sid       varchar(15),
  cid       varchar(6),
  ctitle     varchar(20),
  credits     varchar(10),
  grades    varchar(10) DEFAULT 'IP',
  cday     char(1),
  ctime    varchar(20),
  foreign key (sid) references students (sid),
  foreign key (credits) references courses (credits),
  foreign key (ctitle) references students (ctitle),
  foreign key (cid) references courses (cid))";
$r2 = mysql_query($u2) or die('Error in Querying Database');

$u3 = "drop table if exists students cascade";
$r3 = mysql_query($u3) 
or die('Error in Querying Database');
$u4 = "create table students (
  sid       varchar(15),
  sname     varchar(20),
  email     varchar(50),
  address     varchar(50),
  password varchar(100),
  primary key (sid))";
$r4 = mysql_query($u4) 
or die('Error in Querying Database');

$u5 =	"insert into students values
	  ('111-22-3333', 'John Coltrane', 'jct@gwu.edu', 'blues street', 'jct234')";
$r5 = mysql_query($u5) 
or die('Error in Querying Database');
$u6 = 	"insert into students values
	  ('222-22-3333', 'Miles Davis', 'mid@gwu.edu', 'jazzy lane', 'mid234')";
$r6 = mysql_query($u6) 
or die('Error in Querying Database');
$u7 =	"insert into students values
	  ('333-22-3333', 'Thelonius Monk', 'thm@gwu.edu', 'monk drive', 'thm234')";
$r7 = mysql_query($u7) 
or die('Error in Querying Database');
$u8 = 	"insert into students values
	  ('444-22-3333', 'Stan Getz', 'sgz@gwu.edu', 'nocluewho avenue', 'sgz234')";
$r8 = mysql_query($u8) 
or die('Error in Querying Database');

}
    else {
    echo" You broke my website :( ";
}
?>

<body>
   <h1>You have successfully reset Everything...!</h1>
   <p><a href="index.php">Click here if you aren't redirected in 3 seconds</a>
</body>
</html>
