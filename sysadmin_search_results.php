<!--Search Results-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Search Results</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
   <a href="GWportal.html">Portal</a><br /> 

<?php 

 echo "<h2>Results of Search: </h2><p>"; 

//Gather the data from the search and save it in $find
 $find = $_POST['search_term']; 

 //Display an error if they did not enter a search term
 if ($find == "") 
 { 
 echo "<p>You forgot to enter a search term"; 
 exit; 
 } 

 //Reiterate what the search term was:
   echo "<b>You searched for:  </b> " . $find; 
   echo "<br />";


 $find_arr = explode(' ',$find);
 $arr_length = count($find_arr);
 
 // Connect to the database
 $dbc = mysql_connect("localhost", "mikey_w", "s3cr3t201e") 
 	or die(mysql_error()); 
 mysql_select_db("mikey_w", $dbc); 

 $query = "SELECT fname, lname, studentNO
          FROM applicant
          WHERE ";

 //Alter the search terms to be able to use it in a query
for($x=0;$x<$arr_length;$x++)
{
    $find_arr[$x] = strtoupper($find_arr[$x]); 
    $find_arr[$x] = strip_tags($find_arr[$x]); 
    $find_arr[$x] = trim ($find_arr[$x]); 

    $part = $find_arr[$x];

   //See if the search term can be found in the name, brand, color or itemid fields of an item
    if($x==0){
          $query = $query . "upper(fname) LIKE '%$part%'
          OR upper(lname) LIKE '%$part%'
          OR upper(studentNO) LIKE '%$part% '";    
    }else{
         $query = $query . "OR upper(fname) LIKE '%$part%'
   				OR upper(lname) LIKE '%$part%'
   				OR upper(studentNO) LIKE '%$part% '";
    }
 }

 $query = $query .";";
  //run the query
    echo "<br/>";

 $data = mysql_query($query);

  //Otherwise, display a link to students who match so that they can change information
   while(list($fname, $lname, $studentNO)=mysql_fetch_row($data)) 
   { 
     echo "<br/>";
     echo $fname ." " . $lname. " ";
     echo "<a href=\"GSview.php?student_no=$studentNO \"> $studentNO</a>";
     echo "<br/>";
   } 
 ?> 


</table>
<br/>
<a href="gs_login_success.php">Go back to search</a>
</body>
</html>
