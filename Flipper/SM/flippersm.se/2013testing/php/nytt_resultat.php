<?
$spelarnr = trim($_POST['spelarnr']);
$tag = trim($_POST['tag']);
$namn = trim($_POST['namn']);
$spel1 = trim($_POST['spel1']);
$pointsspel1 = trim($_POST['pointsspel1']);
$spel2 = trim($_POST['spel2']);
$pointsspel2 = trim($_POST['pointsspel2']);
$spel3 = trim($_POST['spel3']);
$pointsspel3 = trim($_POST['pointsspel3']);
$spel4 = trim($_POST['spel4']);
$pointsspel4 = trim($_POST['pointsspel4']);;
require("dbas/dbasbud.php");

if ($spelarnr == null)
{
echo "<font face='verdana'>";
echo "<font size='1'>";
echo "Du har inte fyllt i \"spelarnr\". Gå tillbaka i din browser och försök igen.";
exit;
}
else
{
$query = "insert into smkvalresultat (spelarnr, tag, namn, spel1, pointsspel1, spel2, pointsspel2, spel3, pointsspel3, spel4, pointsspel4) 
   values ('$spelarnr' ,'$tag' ,'$namn' ,'$spel1' ,'$pointsspel1' ,'$spel2' ,'$pointsspel2' ,'$spel3' ,'$pointsspel3' ,'$spel4' ,'$pointsspel4')"; 
   
$result = mysql_query($query) or die("<p>SQL: $query <br>".mysql_error()); 
header("Location: onlineresultat.php");
}
?>
