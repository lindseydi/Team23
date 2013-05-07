<?php

include('../../login.php');
include('search.php');

if($_SESSION['faculty_auth'] == false){
   header('Location: index.php?view=universal_login');
}
db_connect();
$active_term = get_active_semester();

$_SESSION['check_search'] = false;

if(isset($_POST['check_search'])){
   	$_SESSION['check_search'] = $_POST['check_search'];
   	$_SESSION['search_term'] = $_POST['search'];
}

?>

<html> 
	<head>
		<title>University Course Registration</title>
	</head>
	<body>
		<style type='text/css'>
			div.container{
				width:98%;
				margin:1%;
			}
			table#table1 {
				text-align:center;
				width:960px;
				margin-left:auto;
				margin-right:auto;
			}
			div.container2 {
				width:960px;
				margin-left:auto;
				margin-right: auto;
				text-align:right;
			}
			div.container3 {
				width:960px;
				margin-left:auto;
				margin-right:auto;
				text-align:left;
			}
			tr,td {text-align:left;}
			h1{
				text-align:center;
			}
			h2{
				text-align:center;
			}
		</style>
		<h1>
			<span style="font-family:georgia,serif;">Courses Taught - <?php echo $_SESSION['user']; ?></span>
		</h1>
		<h2><?php echo $active_term; ?></h2>

		<div class = 'container2'>
		<?php if ($_SESSION['check_search'] == true) { ?>
			<form action='index.php?view=faculty_page' method="POST">
				<input type='submit' value='Show all courses'>
			</form>
		<?php } ?>
		<form action='index.php?view=faculty_page' method="POST">
			<input type='hidden' name='check_search' value='<?php echo true; ?>'/>
			<input style='width:350px;' type='text' name='search' placeholder='Search by course title or student name'>    
			<input type='submit' value='Search'>
		</form>
		</div>

		<form action="index.php?view=faculty_update" method="post">
			<div class='container'>
			<table id='table1' border="2"> 
				<tbody>
					<tr>
					   <td>FID           </td>
					   <td>Faculty Name  </td>
						<td>Student ID    </td>
						<td>Student Name  </td>
						<td>Course ID     </td>
						<td>Course Title  </td>
						<td>Student Grade </td>
					</tr>
<?php 

  	$dbc = db_connect();
  	$faculty = $_SESSION['username'];
	$query = "SELECT transcripts.sid, faculty.fid, faculty.cid, courses.ctitle, faculty.fname, transcripts.grades, students.sname
	          FROM courses, faculty, transcripts, students 
	          WHERE faculty.fid = '$faculty' AND faculty.cid = transcripts.cid 
	          AND courses.cid = faculty.cid AND transcripts.sid = students.sid 
	          AND transcripts.term='$active_term'";

if($_SESSION['check_search'] == true && $_SESSION['search_term'] != ''){
	//mysql_query("RAWR") or die('Got here: '.$_SESSION['search_term'].' '.$term);
	$result = faculty_search($_SESSION['search_term'], $active_term, $faculty);
}
else{
	$result = mysql_query($query) or die(mysql_error());
}	          

   $i = 1;
   $num_rows = mysql_num_rows($result);

	while ($row = mysql_fetch_assoc($result)) { ?> 
	   	<input type="hidden" name="<?php echo course.$i; ?>" value="<?php echo $row['cid']; ?>" >
	   	<input type="hidden" name="<?php echo student.$i; ?>" value="<?php echo $row['sid']; ?>" >
	   	<input type="hidden" name="index" value="<?php echo $num_rows; ?>">
		<tr> 
		   	<td><?php echo $row['fid'];      ?></td>
		   	<td><?php echo $row['fname'];    ?></td>
		   	<td><?php echo $row['sid'];      ?></td>
		   	<td><?php echo $row['sname'];    ?></td>
		   	<td><?php echo $row['cid'];      ?></td>
		   	<td><?php echo $row['ctitle'];   ?></td>
		   	<td>
		      	<select name='<?php echo grade.$i; ?>' id='grade'>
		         	<option value='<?php echo $row['grades']; ?>'><?php echo $row['grades']; ?></option>
		         	<option value='A'>A</option><option value='A-'>A-</option><option value='B+'>B+</option>
		         	<option value='B'>B</option><option value='B-'>B-</option><option value='C+'>C+</option>
		         	<option value='C'>C</option><option value='F'>F</option>
		         	<option value='IP'>IP</option>
		      	</select>
		   	</td>
		</tr>
<?php  $i++;
} 
 	mysql_close($dbc); ?>
      </table>
  </div>
  <div class='container2'>
      <input type='submit' name='Submit'>
  </div>
   </form>
   </body>
   </html>
