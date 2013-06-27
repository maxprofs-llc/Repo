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
echo "bröd";
exit;
}

require("dbas/dbas.php");

$sortera = $_POST['sortera'];
$nysort = $_POST['nysort'];

if($sortera == null)
{
$query = "select *
	 from sm_anmalda
 	 order by No desc
	 ";
}

if($sortera == 'namn')
{
	 $query = "select *
	 from sm_anmalda
 	 order by Lastname asc
 	 ";
}

if($sortera == 'tag')
{
	$query = "select *
	 from sm_anmalda
 	 order by Tag asc
 	 ";
}

if($sortera == 'hemort')
{
	 $query = "select *
	 from sm_anmalda
 	 order by City asc
 	 ";
}

if($sortera == 'sedan')
{
$query = "select *
	 from sm_anmalda
 	 order by Date desc
	 ";
}

if($sortera == 'betalat')
{
$query = "select *
	 from sm_anmalda
 	 order by Paid desc
	 ";
}

if ($sortera=='frem')
{	
	
	 $query = "select *
	 from sm_anmalda
 	 order by QualG1 desc
 	 ";
}

if ($sortera=='frekv')
{	
	
	 $query = "select *
	 from sm_anmalda
 	 order by QualG2 desc
 	 ";
}

if ($sortera=='lofm')
{	
	
	 $query = "select *
	 from sm_anmalda
 	 order by QualG3 desc
 	 ";
}

if ($sortera=='loem')
{	
	
	 $query = "select *
	 from sm_anmalda
 	 order by QualG4 desc
 	 ";
}

if ($sortera=='lokv')
{	
	
	 $query = "select *
	 from sm_anmalda
 	 order by QualG5 desc
 	 ";
}


$result = mysql_query($query) or die("<p>SQL: $query <br>".mysql_error()); 
$num_results = mysql_num_rows($result);

for ($i=0; $i < $num_results; $i++)
{
	$row = mysql_fetch_array($result);
        $id = htmlspecialchars( stripslashes($row["No"]));
        $tag = htmlspecialchars( stripslashes($row["Tag"]));
	if(isset($_POST[$id])) 
	{
	$query10 = "update sm_anmalda 
   	SET Paid = '1'
   	where No = '$id'"; 
	$result10 = mysql_query($query10) or die("<p>SQL: $query10 <br>".mysql_error()); 
 	} 
	else
	{
	$query10 = "update sm_anmalda 
   	SET Paid = '0'
   	where No = '$id'"; 
	$result10 = mysql_query($query10) or die("<p>SQL: $query10 <br>".mysql_error()); 
	}
}
header("Location: anmalda_admin.php?sortera=$sortera&nysort=$nysort");

?>
