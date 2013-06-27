<?
$id = $_GET[id];
require("dbas/dbas.php");

$query = "delete from nyheter 
   where id = '$id'";
   
$result = mysql_query($query) or die("<p>SQL: $query <br>".mysql_error()); 

if (!$result)
	{
	echo "<p>Raderingen misslyckades. Gå tillbaka och försök igen</p>";
	exit;
	}
header("Location: nyheter2.php");
?>
