<!-- This file contains the thank_you view page -->
<!-- Redirects the user to the index page after 5 seconds. -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
   <head>
      <title>Banner</title>
      <style type="text/css">
         h1 {text-align: center}
         p {text-align: center}
      </style>
   </head>
<body>
   <h1>Select a term to register for courses</h1>
   <p>
      <select name='Choose a semester' id='semester'>
         <option value=''>
   </p>
</body>
</html>

		      <select name='<?php echo grade.$i; ?>' id='grade'>
		         <option value='<?php echo $row['grades']; ?>'><?php echo $row['grades']; ?></option>
		         <option value='A'>A</option><option value='A-'>A-</option><option value='B+'>B+</option>
		         <option value='B'>B</option><option value='B-'>B-</option><option value='C+'>C+</option>
		         <option value='C'>C</option><option value='F'>F</option>
		         <option value='IP'>IP</option>
		      </select>