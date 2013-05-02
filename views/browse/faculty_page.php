<?php

include('../../login.php');

if($_SESSION['faculty_auth'] == false){
   header('Location: index.php?view=universal_login');
}

?>

<html> 
	<head>
		<title>University Course Registration</title>
	</head>
	<body>
		<h1>
			<span style="font-family:georgia,serif;">Courses Taught</span>
		</h1>
		<h2>My Courses</h2>
		<form action="index.php?view=faculty_update" method="post">
			<table border="2"> 
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
	          WHERE faculty.fid = '$faculty' and faculty.cid = transcripts.cid and courses.cid = faculty.cid AND transcripts.sid = students.sid";
 	$result = mysql_query($query)
   	or die(mysql_error());
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
      <input type='submit' name='Submit'>
   </form>
   </body>
   </html>
