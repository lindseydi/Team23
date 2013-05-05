<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
   <title>Banner</title>
   <style type="text/css">
      html #wrapper {
        width:960px;
        margin:0 auto; 
      }
   </style>
</head>

<body>

<?php if($_SESSION['student_auth'] == true){ ?>

<p style = "text-align: right">
   <a href="index.php?view=student_page">Student Home</a>
   <a href="index.php?view=logout">Logout</a>
</p>
<hr />
<?php } else if (($_SESSION['gs_auth'] == true)     ||
                 ($_SESSION['faculty_auth'] == true)||
                 ($_SESSION['fcomm_auth'] == true)  ||
                 ($_SESSION['cac_auth'] == true)){?>

<p style = "text-align: right"><a href="index.php?view=logout">Logout</a></p>
<hr />

<!-- Include the controller and all of the views -->
<?php } include "views/".$controller."/".$view.".php"; ?>

</body>
</html>