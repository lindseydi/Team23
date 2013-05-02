<?php

if($_SESSION['student_auth'] == false){
   header('Location: index.php?view=universal_login');
}

?>

<html> 
   <head>
      <title>University Course Registration</title>
   </head>
   <body>
      <h1>
         <span style="font-family:georgia,serif;">
            <?php echo $_SESSION['name']; ?>'s Transcript
         </span>
      </h1>
      <form action="index.php?view=drop_course" method="post">
         <table border="2"> 
            <tbody>
               <tr>
                  <td>Course ID     </td>
                  <td>Course Title  </td>
                  <td>Day           </td>
                  <td>Time          </td>
                  <td>Faculty Name  </td>
                  <td>My Grade      </td>
                  <td>Drop Course   </td>
                  
               </tr>
<?php 
   $dbc = db_connect();
   
   $student = mysql_real_escape_string($_SESSION['username']);
   
   $query = "SELECT transcripts.sid, students.sname, transcripts.cid, courses.ctitle, faculty.fid, transcripts.grades, faculty.fname, courses.cday, courses.ctime, courses.credits
             FROM students, courses, faculty, transcripts
             WHERE students.sid = '$student' AND faculty.cid = transcripts.cid AND courses.cid = faculty.cid and students.sid = transcripts.sid ORDER BY faculty.fname";
   $result = mysql_query($query) or die(mysql_error());
   $temp = 0.0;
   $credit = 0.0;
   $gpa = 0.0;
   $grade = 0;
   $final_gpa = 0;
   
   while ($row = mysql_fetch_assoc($result)) { ?> 
      <tr> 
         <td><?php echo $row['cid'];   ?></td>
         <td><?php echo $row['ctitle'];?></td>
         <td><?php echo $row['cday']   ?></td>
         <td><?php echo $row['ctime']  ?></td>
         <td><?php echo $row['fname']; ?></td>
         <td><?php echo $row['grades'];?></td>
         <td><input type="radio" name="course" value="<?php echo $row['cid']; ?>"></td>
      </tr>
<?php  
      $credit = $row['credits'];
      $temp = 0.0;
      if($row['grades'] != 'IP'){
         $divisor += $row['credits'];
         if($row['grades'] == 'A'){ $temp = 4.0; }
         else if($row['grades'] == 'A-'){ $temp = 3.7; }
         else if($row['grades'] == 'B+'){ $temp = 3.3; }
         else if($row['grades'] == 'B' ){ $temp = 3.0; }
         else if($row['grades'] == 'B-'){ $temp = 2.7; }
         else if($row['grades'] == 'C+'){ $temp = 2.3; }
         else if($row['grades'] == 'C' ){ $temp = 2.0; }
         else if($row['grades'] == 'F' ){ $temp = 0.0; }
      }
      $gpa += ($credit * $temp);
      //mysql_query("RAWR wargle wargle") or die($gpa.' '.$credit.' '.$temp);

   } $final_gpa += ($gpa/$divisor); 
   //mysql_query("RAWR") or die('ERROR: $gpa: '.$gpa.' $divisor: '.$divisor.' $final_gpa: '.$final_gpa);
   mysql_close($dbc); ?>
      </table>
      <input type='submit' value='Drop Course'><div class='short_explanation'>Calculated GPA: <?php echo $final_gpa; ?></div>
   </form>
   </body>
</html>
