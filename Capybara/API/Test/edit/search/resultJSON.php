<?php
	include "../_define.php";

	$search=$_GET['search'];
	$class=$_GET['class'];
	$table=$_GET['table'];
	if(isset($_GET['keyvalues']))
		$keyvalues=true;
	else
		$keyvalues=false;
		
	$result=$dr->getSearchResult($search,$table,$class,$keyvalues);
	
	print $result->getJSON();
?>