<?
session_start();
?>
<?
$ip = $REMOTE_ADDR;
$tag = trim($_POST['tag']);
$namn = trim($_POST['namn']);;
$adress = trim($_POST['adress']);
$postnummer = trim($_POST['postnummer']);
$stad = trim($_POST['stad']);
$telefon = trim($_POST['telefon']);
$epost = trim($_POST['epost']);
$meddelande = trim($_POST['meddelande']);
$fefter = trim($_POST['fefter']);
$fkvall = trim($_POST['fkvall']);
$lform = trim($_POST['lform']);
$lefter = trim($_POST['lefter']);
$lkvall = trim($_POST['lkvall']);

$tag = strtoupper($tag);
$meltest1 = substr($id,0,1);
$meltest2 = substr($id,1,1);
$meltest3 = substr($id,2,1);
if (!$tag || !$namn || !$adress || !$postnummer || !$stad || !$telefon)
{
header("Location: anmal.php?tag=$tag&namn=$namn&epost=$epost&telefon=$telefon&stad=$stad&postnummer=$postnummer&meddelande=$meddelande&adress=$adress&fefter=$fefter&fkvall=$fkvall&lform=$lform&lefter=$lefter&lkvall=$lkvall");
}
else
{
require("dbas/dbas.php");

if (!$db)

{
echo "<p>Fel: ingen uppkoppling mot databasen kunde göras<</p>";
exit;
}
$sql = "SELECT COUNT(*) FROM spelare WHERE id='$id'"; 
$result = mysql_query($sql); 

$datum = date("YmdHis");  

$query = "insert into sm_anmalningar (tag, namn, adress, postnummer, stad, telefon, epost, meddelande, fefter, fkvall, lform, lefter, lkvall, datum, ip) 
   values ('$tag' ,'$namn' , '$adress', '$postnummer', '$stad', '$telefon', '$epost', '$meddelande', '$fefter', '$fkvall', '$lform', '$lefter', '$lkvall', '$datum', '$ip')"; 
   
$result = mysql_query($query) or die("<p>SQL: $query <br>".mysql_error());

$query = "select id
	 from sm_anmalningar
 	 order by datum desc
 	 limit 1
	 ";

$result = mysql_query($query) or die("<p>SQL: $query <br>".mysql_error()); 
$row = mysql_fetch_array($result);
$id = htmlspecialchars( stripslashes($row["id"]));

//header("Location: anmal3.php?tag=$tag&namn=$namn&epost=$epost&telefon=$telefon&stad=$stad&postnummer=$postnummer&adress=$adress&id=$id");
$_SESSION['id'] = $id;
		
header("Location: anmal3.php");
}
?>
</body>
</html>