<html>
<head>
<title></title>
</head>
<body
bgcolor="ffffff"
link="000000"
vlink="000000">

<font face="verdana">
<font color="000000">
<font size="1">

<font size="2">
<b>Meddelande:</b>
<br>
<br>
<font size="1">
<?
require("dbas/dbas.php");
$id = $_GET['id'];

$query = "select *
	 from sm07
 	 where No = '$id'";
	 
$result = mysql_query($query) or die("<p>SQL: $query <br>".mysql_error()); 
$row = mysql_fetch_array($result);
$meddelande = htmlspecialchars( stripslashes($row["Message"]));
$namn = htmlspecialchars( stripslashes($row["Firstname"]))." ".htmlspecialchars( stripslashes($row["Lastname"]));

echo "<font size='1'><b>Från:</b> $namn<br><br> $meddelande";
?>
</body>
</html>