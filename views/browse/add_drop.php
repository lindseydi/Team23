<?php

include('../../login.php');

   if($_SESSION['student_auth'] == false){
      header('Location: index.php?view=student_login');
   }

?>

<html> 
	<head>
		<title>Student Enrollment</title>
		<style type="text/css">
			html #wrapper {
				width:960px;
				margin:0 auto;
			}
			div #error{
				width:960px;
				margin-left:0;
			}
		</style>
	</head>
	<body>
		<h1>
			<span style="font-family:georgia,serif;">Student Enrollment</span>
		</h1>
		<h2>
			Enroll
		</h2>
<?php if($_SESSION['reg_error']['error'] == true){ ?>
      <div class='short explanation'>
      <?php if($_SESSION['reg_error']['code'] == 1) { unset($_SESSION['reg_error']); ?>
         <font color='red'>*Error: Could not add this course due to time conflict</font>
      </div>
      <?php } else if($_SESSION['reg_error']['code'] == 2) { unset($_SESSION['reg_error']);?>
         <font color='red'>*Error: You are already registered for this course</font>     
      </div>
      <?php } else if($_SESSION['reg_error']['code'] == 3) { unset($_SESSION['reg_error']);?>
         <font color='red'>*Error: You do not meet the prerequisites for that course</font>     
      </div>
<?php } }?>
		<form action='index.php?view=register' method="post">
			<table border="2"> 
				<tbody>
					<tr>
						<td> Course ID                </td>
						<td> Title                    </td>
						<td> Course Number            </td>
						<td> Prerequisite             </td> 
						<td> Secondary Prerequisite   </td>
						<td> Department               </td>
						<td> Day                      </td>
						<td> Time                     </td>
						<td> Add Course               </td>
					</tr>
<?php 

$dbc = db_connect();

$query = "SELECT * FROM courses";

$result = mysql_query($query) or die(mysql_error());

while ($row = mysql_fetch_assoc($result)) { ?> 

   <tr> 
      <td><?php echo $row['cid'];   ?></td>
		<td><?php echo $row['ctitle'];?></td>
		<td><?php echo $row['cnum'];  ?></td>
		<td><?php echo $row['mpr'];   ?></td>
		<td><?php echo $row['spr'];   ?></td>
		<td><?php echo $row['dept'];  ?></td>
		<td><?php echo $row['cday'];  ?></td>
		<td><?php echo $row['ctime']; ?></td>
		<td><input type="radio" name="course" value="<?php echo $row['cid']; ?>"></td>
   </tr>

<?php } mysql_close($dbc); ?>

         </table>
      <input type="submit" value="Submit">
      </form>
   </body>
</html>

