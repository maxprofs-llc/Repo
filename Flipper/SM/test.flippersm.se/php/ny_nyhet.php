<?
$av = trim($_POST['av']);
$text = trim($_POST['text']);;
require("dbas/dbas.php");

if ($av == null)
{
echo "<font face='verdana'>";
echo "<font size='1'>";
echo "Du har inte fyllt i \"Läggs in av\". Gå tillbaka i din browser och försök igen.";
exit;
}
else
{
$query = "insert into nyheter (av, text) 
   values ('$av' ,'$text')"; 
   
$result = mysql_query($query) or die("<p>SQL: $query <br>".mysql_error()); 
header("Location: nyheter2.php");
}
?>
