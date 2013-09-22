<?
session_start();
?>
<?php
if (isset($_SESSION['ok_user']))
{
$tempuser = $_SESSION['ok_user'];
}
else
{
exit;
}

require("dbas/dbas.php");

$sortera = $_POST['sortera'];
$nysort = $_POST['nysort'];

if($sortera == null)
{
$query = "select *
	 from sm_anmalningar
 	 order by datum desc
	 ";
}

if($sortera == 'namn')
{
	 $query = "select *
	 from sm_anmalningar
 	 order by namn asc
 	 ";
}

if($sortera == 'tag')
{
	$query = "select *
	 from sm_anmalningar
 	 order by tag asc
 	 ";
}

if($sortera == 'hemort')
{
	 $query = "select *
	 from sm_anmalningar
 	 order by stad asc
 	 ";
}

if($sortera == 'sedan')
{
$query = "select *
	 from sm_anmalningar
 	 order by datum desc
	 ";
}

if($sortera == 'betalat')
{
$query = "select *
	 from sm_anmalningar
 	 order by betalat desc
	 ";
}

if ($sortera=='frem')
{	
	
	 $query = "select *
	 from sm_anmalningar
 	 order by fefter desc
 	 ";
}

if ($sortera=='frekv')
{	
	
	 $query = "select *
	 from sm_anmalningar
 	 order by fkvall desc
 	 ";
}

if ($sortera=='lofm')
{	
	
	 $query = "select *
	 from sm_anmalningar
 	 order by lform desc
 	 ";
}

if ($sortera=='loem')
{	
	
	 $query = "select *
	 from sm_anmalningar
 	 order by lefter desc
 	 ";
}

if ($sortera=='lokv')
{	
	
	 $query = "select *
	 from sm_anmalningar
 	 order by lkvall desc
 	 ";
}


$result = mysql_query($query) or die("<p>SQL: $query <br>".mysql_error()); 
$num_results = mysql_num_rows($result);

for ($i=0; $i < $num_results; $i++)
{
	$row = mysql_fetch_array($result);
        $id = htmlspecialchars( stripslashes($row["id"]));
        $tag = htmlspecialchars( stripslashes($row["tag"]));
	if(isset($_POST[$id])) 
	{
	$query10 = "update sm_anmalningar 
   	SET betalat = 'ja'
   	where id = '$id'"; 
	$result10 = mysql_query($query10) or die("<p>SQL: $query10 <br>".mysql_error()); 
 	} 
	else
	{
	$query10 = "update sm_anmalningar 
   	SET betalat = ''
   	where id = '$id'"; 
	$result10 = mysql_query($query10) or die("<p>SQL: $query10 <br>".mysql_error()); 
	}
}
header("Location: anmalda_admin.php?sortera=$sortera&nysort=$nysort");

?>
