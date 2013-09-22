<html>

<head>
<style>
<!--A:link, A:visited { text-decoration: none;}A:hover {  text-decoration: underline;color:"000033"}--></style>
</head>

<body
bgcolor="ffffff"
link="000000"
vlink="000000">

<font face="verdana">
<font color="000000">
<font size="1">

<font size="2">
<b>Anmäl dig till Flipper-SM 2004</b>
<font size="1">
<br>
<br>
Sista chansen!!!!!!!! I skrivande stund finns det fortfarande några platser kvar i Flipper-SM 2004 då det inte kommit in 200 betalda anmälningsavgifter ännu.
<br>
<br>
Ring Helena på 0702-885111 för information om hur du snor åt dig en av de sista platserna.
<?
/*
<i><b>OBS: </b>Det går inte att anmäla sig till Flipper SM 2004 längre. Den sista anmälningsdagen var 31/10</i>
<br>
<br>
Om du har problem med anmälningsformuläret, skicka ett mail till: <a href='mailto:stefan@flippersm.se'><b>stefan@flippersm.se</b></a>.
<br>
<br>
<b>Föranmälan</b>
<br>
<br>
För att kunna delta i Flipper-SM 2004 måste du anmäla dig i förväg. Du föranmäler dig först här på webben för att sedan betala in din anmälningsavgift (se nedan för info). Din anmälan är inte bindande förrän du betalt in din anmälningsavgift.
<br><br>
Eftersom Flipper-SM i dess nuvarande form och organisation har ett något begränsat antal deltagare vi kan ta emot är detta 
antal satt till max 200 deltagare år 2004. De 200 först <i>betalande</i> deltagarna är de som garanteras en plats i Flipper-SM 2004.
<br><br>
Vi kommer förmodligen inte kunna ta emot några anmälningar på plats i och med att vi räknar med att dessa 200 platser kommer att
 fyllas upp innan tävlingen.
<br>
<br>
Sista anmälningsdag är 31/10.
<br>
<br>
<b>Anmälningsavgiften</b>
<br>
<b>OBS:</b> Sista betalningsdagen är <b>31/10</b>
<br>
<br>
Anmälningsavgiften betalas in på:
<br>
<br>
Postgiro: 23 84 76 -6. Mottagare är Flipper-SM, c/o Helena Walter, Albiongatan 9 A, 802 55 Gävle
<br>
<br>
Spar en kopia på din inbetalning. Om du väljer att betala via postkontor är det viktigt att ni anger vilken person betalningen avser.
<br>
<br>
Om du betalar din anmälningsavgift innan den 31/7 är avgiften 100:-
<br>
Betalar du mellan <b>1/8</b> och <b>31/10</b> är avgiften <b>150:-</b>.
<br>
<br>
När vi fått in din anmälningsavgift kommer detta att markeras vid ditt namn bland <a href='anmalda.php'><b>Anmälda Spelare</b></a> här på hemsidan.
<br>
<br>
<b>OBS:</b> Det kan ta upp till en vecka för oss att hinna registrera din betalning.
<?/*
$tag = trim($_GET['tag']);
$namn = trim($_GET['namn']);
$gata = trim($_GET['gata']);
$postnummer = trim($_GET['postnummer']);
$stad = trim($_GET['stad']);
$telefon = trim($_GET['telefon']);
$epost = trim($_GET['epost']);
$meddelande = trim($_GET['meddelande']);
$fefter = trim($_GET['fefter']);
$fkvall = trim($_GET['fkvall']);
$lform = trim($_GET['lform']);
$lefter = trim($_GET['lefter']);
$lkvall = trim($_GET['lkvall']);

echo "<hr>";
echo "<table>";
echo "<tr>";
echo "<td>";
echo "<font size='1'><b>Anmälan - Flipper-SM 2004</b><br><br>";
echo "Fält markerade med <b>(*)</b> är obligatoriska";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "<br>";
echo "</td>";
echo "</tr>";

echo "<form action='anmal2.php' method='post'>";

echo "<tr>";
echo "<td><font size='1'><b>TAG (*):</b></td>";
echo "</tr>";

echo "<tr>";
echo "<td><font size='1'>Endast TRE tecken. Dina initialer du använder när/om du skriver in dig på highscorelistor.<br><br>";
echo "</tr>";

echo "<tr>";

if($tag == null)
{
echo "<td><font size='1'><input type=text name='tag' value='$tag' maxlength=3 size=3 STYLE='background-color: #FFFFD0';><br></td>";
}
else
{
echo "<td><font size='1'><input type=text name='tag' value='$tag' maxlength=3 size=3'> <b>ok</b><br></td>";
}	
echo "</tr>";

echo "<tr>";
echo "<td><font size='1'><b>Namn (*):</b> (För och Efternamn)</td>";
echo "</tr>";
echo "<tr>";
if($namn == null)
{
echo "<td><font size='1'><input type=text name='namn' value='$namn' maxlength=100 size=40 STYLE='background-color: #FFFFD0';><br></td>";
}
else
{
echo "<td><font size='1'><input type=text name='namn' value='$namn' maxlength=100 size=40> <b>ok</b><br></td>";
}	
echo "</tr>";

echo "<tr>";
echo "<td><font size='1'><b>Adress (*):</b></td>";
echo "</tr>";
echo "<tr>";
if($adress == null)
{
echo "<td><font size='1'><input type=text name='adress' value='$adress' maxlength=100 size=40 STYLE='background-color: #FFFFD0';><br></td>";
}
else
{
echo "<td><font size='1'><input type=text name='adress' value='$adress' maxlength=100 size=40> <b>ok</b><br></td>";
}
echo "</tr>";

echo "<tr>";
echo "<td><font size='1'><b>Postnummer (*):</b></td>";
echo "</tr>";
echo "<tr>";
if($postnummer == null)
{
echo "<td><font size='1'><input type=text name='postnummer' value='$postnummer' maxlength=100 size=40 STYLE='background-color: #FFFFD0';><br></td>";
}
else
{
echo "<td><font size='1'><input type=text name='postnummer' value='$postnummer' maxlength=100 size=40'> <b>ok</b><br></td>";
}
echo "</tr>";

echo "<tr>";
echo "<td><font size='1'><b>Stad (*):</b></td>";
echo "</tr>";
echo "<tr>";
if($stad == null)
{
echo "<td><font size='1'><input type=text name='stad' value='$stad' maxlength=100 size=40 STYLE='background-color: #FFFFD0';><br></td>";
}
else
{
echo "<td><font size='1'><input type=text name='stad' value='$stad' maxlength=100 size=40> <b>ok</b><br></td>";
}
echo "</tr>";

echo "<tr>";
echo "<td><font size='1'><b>Telefon (*):</b></td>";
echo "</tr>";
echo "<tr>";
if($telefon == null)
{
echo "<td><font size='1'><input type=text name='telefon' value='$telefon' maxlength=100 size=40 STYLE='background-color: #FFFFD0';><br></td>";
}
else
{
echo "<td><font size='1'><input type=text name='telefon' value='$telefon' maxlength=100 size=40> <b>ok</b><br></td>";
}
echo "</tr>";

echo "<tr>";
echo "<td><font size='1'><b>Epost:</b></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font size='1'><input type=text name='epost' value='$epost' maxlength=100 size=40><br></td>";
echo "</tr>";

echo "<tr>";
echo "<td><font size='1'><b>Kvaltider:</b></td>";
echo "</tr>";

echo "<tr>";
echo "<td><font size='1'>Här ser vi gärna att du anger vilken/vilka tider du har möjlighet att kvala. Du kommer endast kvala under ett av tillfällena, men ange gärna alla de tider du har möjlighet att kvala. Kryssar du inte för något av alternativen tolkar vi det som att du kan spela under vilken som helst av tiderna.<br \><br \><b>OBS:</b> vi garanterar inte att du får spela på någon av tiderna du anger, men vi kommer att i mesta möjliga mån placera deltagarna på de önskade kvaltiderna.</td>";
echo "</tr>";

if($fefter == false)
{
echo "<tr><td><p><input type=checkbox name='fefter'><font size='1'>Fredag eftermiddag</p></td></tr>";
}
else
{
echo "<tr><td><p><input type=checkbox name='fefter' checked='true'><font size='1'>Fredag eftermiddag</p></td></tr>";
}

if($fkvall == false)	
{
echo "<tr><td><p><input type=checkbox name='fkvall'><font size='1'>Fredag kväll</p></td></tr>";
}
else
{
echo "<tr><td><p><input type=checkbox name='fkvall' checked='true'><font size='1'>Fredag kväll</p></td></tr>";
}

if($lform == false)
{
echo "<tr><td><p><input type=checkbox name='lform'><font size='1'>Lördag förmiddag</p></td></tr>";
}
else
{
echo "<tr><td><p><input type=checkbox name='lform' checked='true'><font size='1'>Lördag förmiddag</p></td></tr>";
}

if($lefter == false)
{
echo "<tr><td><p><input type=checkbox name='lefter'><font size='1'>Lördag eftermiddag</p></td></tr>";
}
else
{
echo "<tr><td><p><input type=checkbox name='lefter' checked='true'><font size='1'>Lördag eftermiddag</p></td></tr>";
}

if($lkvall == false)
{
echo "<tr><td><p><input type=checkbox name='lkvall'><font size='1'>Lördag kväll</p></td></tr>";
}
else
{
echo "<tr><td><p><input type=checkbox name='lkvall' checked='true'><font size='1'>Lördag kväll</p></td></tr>";
}

echo "<tr>";
echo "<td><font size='1'><b>Meddelande:</b></td>";
echo "</tr>";

echo "<tr>";
echo "<td><font size='1'>Om du vill lämna något särskilt meddelande till arrangörerna i samband med din anmälan kan du skriva det här.<br><br>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "<textarea name=meddelande wrap=physical cols=40 rows=6>$meddelande</textarea>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td colspan=2><input type=submit class='egen' value='Anmäl dig'></td>";
echo "</tr>";
echo "</table>";
echo "</form>";*/
?>
