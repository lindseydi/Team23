<?php

include('../../login.php');

function search_for_course($search_term, $course_term){
	$dbc = db_connect();
	$search_term = mysql_real_escape_string($search_term);
	$search_query = "SELECT * FROM courses 
					 WHERE term='$course_term' AND dept='$search_term' 
					 OR term='$course_term' AND cnum='$search_term' 
					 OR term='$course_term' AND ctitle='$search_term'";
	$search_result = mysql_query($search_query) or die(mysql_error());
	return $search_result;
}

function get_active_semester(){
	db_connect();
   	$active_term_query = mysql_query("SELECT DISTINCT aterm FROM sadmin") or die ("Error selecting active term. ".mysql_error());
   	$active_term_result = mysql_fetch_assoc($active_term_query);
   	$active_term = $active_term_result['aterm'];
   	return $active_term;
}

//function faculty_search($search_term)

?>