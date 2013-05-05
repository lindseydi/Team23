<?php

include('../../login.php');

   	if($_SESSION['student_auth'] == false){
    	header('Location: index.php?view=student_login');
   	}

   	if(!empty($_POST)){
   		$_SESSION['term'] = $_POST['term'];
   	}
   	db_connect();
   	$term = mysql_real_escape_string($_SESSION['term']);

?>

<html> 
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<style type="text/css">
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
		</style>
	</head>
	<body>
		<h1 style='text-align:center;'>
			<span style="font-family:georgia,serif;">Student Enrollment - <?php echo $term; ?></span>
		</h1>

<?php if($_SESSION['reg_error']['error'] == true){ ?>
		<div class='container3'>
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
      </div>
<?php } }?>
		<form action='index.php?view=register' method="post">
			<div class='container'>
			<table id = "table1" border="2"> 
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
//mysql_query("RAWR") or die($term.' '.$_SESSION['term'].' '.$_POST['term']);

$query = "SELECT * FROM courses WHERE term='$term' ORDER BY cid";

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
        <div class='container2'>
        	<input type="submit" value="Register">
        </div>
        </div>
    </form>
   	</body>
</html>

