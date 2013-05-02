<?php

include('../../login.php');

if($_SESSION['gs_auth'] == false){
   header('Location: index.php?view=universal_login');
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Welcome</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h2>Welcome Graduate Secretary!</h2>

  <p>Which student are you looking for? 

  </br>

    You may put in a name or student number.

  </br>

    Please separate search terms with a space.

</br>
</br>

    EX: firstname lastname or 232343 lastname</p>

    </br>


  <form name="search" method="post" action="index.php?view=gs_search_results">

  <!--<label for="search_term">Search:</label>-->
  <input type="text" name="search_term" />

  <!--<input type="hidden" name="searching" value="yes" />-->
  <input type="submit" name="submit" value="Search" />
</form>
</body>
</html>
