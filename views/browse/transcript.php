<?php

if(!$_SESSION['student_auth'] && !$_SESSION['gs_auth']){
   header('Location: index.php?view=universal_login');
}

db_connect();
   $active_term_query = mysql_query("SELECT DISTINCT aterm FROM sadmin") or die ("Error selecting active term. ".mysql_error());
   $active_term_result = mysql_fetch_assoc($active_term_query);
   $active_term = $active_term_result['aterm'];

   $cumulative_gpa = 0;
   $cumulative_divider = 0;

?>

<html> 
   <head>
      <title>University Course Registration</title>
      <style type='text/css'>
         div.container{
            width:98%;
            margin:1%;
         }
         table#table1{
            width:800px;
            margin-left:auto;
            margin-right:auto;
            text-align:left;
         }
         div.container2{
            width:800px;
            margin-left:auto;
            margin-right:auto;
            text-align:right;
         }
         div.container3{
            width:800px;
            margin-left:auto;
            margin-right:auto;
            text-align:left;
         }
         h1{
            text-align:center;
         }
         div.container4{
            text-align:center;
         }
      </style>
   </head>
   <body>
      <h1>
         <span style="font-family:georgia,serif;">
            <?php echo $_SESSION['name']; ?>'s Transcript
         </span>
      </h1>
      <form action="index.php?view=drop_course" method="post">
         <div class='container3'>
            <b>Current Semester Courses - <?php echo $active_term; ?></b>
         </div>
         <table id='table1' border="2"> 
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

   //mysql_query("RAWR") or die ("Error getting the active term. ".$active_term);
   
   $student = mysql_real_escape_string($_SESSION['username']);
   
   $query = "SELECT transcripts.sid, students.sname, transcripts.cid, courses.ctitle, faculty.fid, transcripts.grades, faculty.fname, courses.cday, courses.ctime, courses.credits
             FROM students, courses, faculty, transcripts
             WHERE students.sid = '$student' AND faculty.cid = transcripts.cid AND courses.cid = faculty.cid and students.sid = transcripts.sid AND transcripts.term = '$active_term' ORDER BY faculty.fname";
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

   }  $final_gpa += ($gpa/$divisor); 
      $cumulative_gpa += $final_gpa; 
      $cumulative_divider++; ?>
      </table>
      <div class='container2'>
         <input type='submit' value='Drop Course'><div class='short_explanation'>Calculated GPA: <?php echo round($final_gpa,2); ?></div>
      </div>
   </form>



















<?php $get_semester_query = "SELECT DISTINCT term FROM courses";
      $get_semester_result = mysql_query($get_semester_query) or die("Error retrieving terms: ".mysql_error());
      while($semester_rows = mysql_fetch_assoc($get_semester_result)/* or die("Error getting rows of terms: ".mysql_error())*/) {
         $term = mysql_real_escape_string($semester_rows['term']) or die("Error escaping term. ".mysql_error());

   $dbc = db_connect();
   
   $student = mysql_real_escape_string($_SESSION['username']);
   
   $query = "SELECT transcripts.sid, students.sname, transcripts.cid, courses.ctitle, faculty.fid, transcripts.grades, faculty.fname, courses.cday, courses.ctime, courses.credits
             FROM students, courses, faculty, transcripts
             WHERE students.sid = '$student' AND faculty.cid = transcripts.cid AND courses.cid = faculty.cid and students.sid = transcripts.sid AND courses.term = '$term' ORDER BY faculty.fname";
   $result = mysql_query($query) or die(mysql_error());
   if(mysql_num_rows($result) == 0 || $term == $active_term){}
   else {
   $temp = 0.0;
   $credit = 0.0;
   $gpa = 0.0;
   $grade = 0;
   $final_gpa = 0;

   ?>
   <div class='container3'>
      <b><?php echo $term; ?></b>
   </div>
         <table id='table1' border="2"> 
            <tbody>
               <tr>
                  <td>Course ID     </td>
                  <td>Course Title  </td>
                  <td>Day           </td>
                  <td>Time          </td>
                  <td>Faculty Name  </td>
                  <td>My Grade      </td>
                  
               </tr>
   <?php
   while ($row = mysql_fetch_assoc($result)) { ?> 
      <tr> 
         <td><?php echo $row['cid'];   ?></td>
         <td><?php echo $row['ctitle'];?></td>
         <td><?php echo $row['cday']   ?></td>
         <td><?php echo $row['ctime']  ?></td>
         <td><?php echo $row['fname']; ?></td>
         <td><?php echo $row['grades'];?></td>
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

   }  $final_gpa += ($gpa/$divisor); 
      $cumulative_gpa += $final_gpa; 
      $cumulative_divider++; ?>
      </table>
      <div class='container2'>Calculated GPA: <?php echo round($final_gpa,2); ?></div>
      <?php } } mysql_close($dbc);
      $cumulative_gpa = round($cumulative_gpa/$cumulative_divider, 2); /* close the while loop for the tables */ ?>
      <div class='container4'><b>Cumulative GPA: <?php echo $cumulative_gpa; ?></b></div>

   </body>
</html>
