<?php
session_start();
$strTag       = $_POST['txtTag'];
$strFirstname = $_POST['txtFirstname'];
$strLastname  = $_POST['txtLastname'];
$strAddress   = $_POST['txtAddress'];
$strCity      = $_POST['txtCity'];
$strPhone     = $_POST['txtPhone'];
$strEmail     = $_POST['txtEmail'];
$intAge       = (int)$_POST['txtAge'];
$intQualG1    = $_POST['chkQualG1']=="on";
  if(!$intQualG1)  {
     $intQualG1 = 0;  }
$intQualG2    = $_POST['chkQualG2']=="on";
  if(!$intQualG2)  {
     $intQualG2 = 0;  }
$intQualG3    = $_POST['chkQualG3']=="on";
  if(!$intQualG3)  {
     $intQualG3 = 0;  }
$intQualG4    = $_POST['chkQualG4']=="on";
  if(!$intQualG4)  {
     $intQualG4 = 0;  }
$intQualG5    = $_POST['chkQualG5']=="on";
  if(!$intQualG5)  {
     $intQualG5 = 0;  }
$intClassics    = $_POST['chkClassics']=="on";
  if(!$intClassics)  {
     $intClassics = 0;  }
$strShirts    = $_POST['txtOrder'];
$intPrice     = (int)$_POST['txtPris'];
$strMessage   = $_POST['txtMessage'];
$intSpam      = (int)$_POST['txtSpam'];

$intSpamCorrect = $_SESSION['flippertal'];
$strIP          = $REMOTE_ADDR;
$strDate        = date('ymd');
$strTime        = date('H:i:s');




//echo "SPAM CHECK. User sent this number: $intSpam, should be: $intSpamCorrect.<br>\n";
//echo "isset(intSpam): ". isset($intSpam) ."<br>\n";
//echo "isset(intSpamCorrect): ". isset($intSpamCorrect) ."<br>\n";


if(isset($intSpam) && isset($intSpamCorrect) && 9999<$intSpam && $intSpam<100000 && $intSpam == $intSpamCorrect)
    {
// open connection
    $db = MySQL_connect("localhost", "flippersm", "ngt3vligt");
    MySQL_select_db("flippersm", $db);
    
// input data
    $sql = "INSERT INTO sm07 (Tag, Firstname, Lastname, Address, City, Phone, Email, Age, QualG1, QualG2, QualG3, QualG4, QualG5, Classics, Shirts, Price, Message, IP, Date, Time) VALUES ('$strTag', '$strFirstname', '$strLastname', '$strAddress', '$strCity', '$strPhone', '$strEmail', $intAge, $intQualG1, $intQualG2, $intQualG3, $intQualG4, $intQualG5, $intClassics, '$strShirts', $intPrice, '$strMessage', '$strIP', '$strDate', '$strTime')";
    $sqlResult = MySQL_query($sql,$db);
    $intRows = MySQL_affected_rows();
    
    MySQL_close($db);
    
    $booAdminMail = mail("furir@flippersm.se, webb@flippersm.se", "SM-anm�lan - $strTag", "Hejsan! Nu har det trillat in �nnu en SM-anm�lan fr�n hemsidan.\n\nTag: $strTag\nNamn: $strFirstname $strLastname\nFr�n: $strAddress, $strCity\nTelefon: $strPhone\nEmail: $strEmail\n�lder: $intAge\nKval: $intQualG1, $intQualG2, $intQualG3, $intQualG4, $intQualG5\nTr�jor: '$strOrder'\nPris: $intPrice kr\nIP: $strIP\nDatum: $strDate $strTime\nEventuella kommentarer: $strMessage\n\n\nHej d�!\n", "From: SM 2007 <furir@flippersm.se>");
    $booPlayerMail = mail($strEmail, "Anm�lan Flipper-SM 2007", "Hejsan!\n\nDu har nu anm�lt dig till de Svenska m�sterskapen i flipperspel, 9-11 november 2007!\n\nGl�m inte att betala avgiften, som i ditt fall �r $intPrice kronor, till f�ljande konto hos Swedbank senast den 31 oktober:\nClearingnummer: 8304-8\nKontonummer: 3170013-1\nKontoinnehavare: Markus Salo\nSpar en kopia p� din inbetalning. Det �r viktigt att du anger namn och TAG f�r personen som betalningen avser.\n\nOBS! Det �r de f�rsta 200 personerna som B�DE anm�ler sig och betalar som f�r plats! F�r att se om din betalning registrerats, kan du kolla p� www.flippersm.se/index.php?sida=anmalda. Eftersom detta sker manuellt, kan det ta ett par dar innan din betalning syns p� hemsidan.\n\nF�ljande information gavs i anm�lan:\n\nTag: $strTag\nNamn: $strFirstname $strLastname\nFr�n: $strAddress, $strCity\nTelefon: $strPhone\nEmail: $strEmail\n�lder: $intAge\n�nskade kvaltider: Fre em-$intQualG1, Fre kv-$intQualG2, L�r fm-$intQualG3, L�r em-$intQualG4, L�r kv-$intQualG5\nTr�jbest�llning: '$strShirts'\nAvgift: $intPris\nDatum och tid: $strDate $strTime\nEventuellt meddelande: $strMessage\n\n\nOm n�t inte st�mmer eller om du har andra fr�gor om din anm�lan, skicka ett mail till Per p� webb@flippersm.se. F�r allm�nna fr�gor om Flipper-SM 2007, kontakta Markus p� general@flippersm.se.\n\n\nHej d� och lycka till!\n", "From: Flipper-SM 2007 <webb@flippersm.se>");
    
    
    if($intRows == 1 && $booAdminMail && $booPlayerMail)
        {
        echo "<h1>Anm�lan - Flipper-SM</h1><br/>\n\n";
        
        echo "<p><b>Anm�lan lyckades!</b><br/><br/>\n\n";
        
        echo "Ett mail har nu skickats till $strEmail med mer information. <b>Gl&ouml;m inte</b> att betala avgiften, som i ditt fall &auml;r $intPrice kronor, till f&ouml;ljande konto hos Swedbank senast den 31 oktober:<br/>\n";
        echo "Clearingnummer: 8304-8<br/>\n";
        echo "Kontonummer: 3170013-1<br/>\n";
        echo "Kontoinnehavare: Markus Salo<br/>\n";
        echo "Spar en kopia p&aring; din inbetalning. Det &auml;r viktigt att du anger namn och TAG f&ouml;r personen som betalningen avser.<br/><br/>\n\n";
        
        echo "<b>OBS!</b> Det �r de f�rsta 200 personerna som B�DE anm�ler sig och betalar som f�r plats! F�r att se om din betalning registrerats, kan du kolla p� <a href='index.php?sida=anmalda'>anm�lda-sidan</a>. Eftersom detta sker manuellt, kan det ta ett par dar innan din betalning syns p� hemsidan.<br/><br/>\n\n";
        
        echo "Kontaktperson vid fr&aring;gor om anm&auml;lan: : <a href='mailto:webb@flippersm.se'>Per Martinson</a><br/>\n";
        echo "Kontaktperson f&ouml;r allm&auml;nna fr&aring;gor: <a href='mailto:general@flippersm.se'>Markus Salo</a>, 0707-170380<br/>\n";
        echo "Sista anm&auml;ningsdag/betalningsdag: 2007-10-31</p><br/><br/>\n\n";
        }
    else
        {
        echo "<h1>Anm�lan - Flipper-SM</h1><br/>\n\n";
        
        echo "<p>Anm�lan lyckades <b>tyv�rr inte</b>! Spamskyddet var ok, s� du �r f�rmodligen en m�nniska, men databasen kunde inte n�s. Var v�nlig att g� tillbaka och f�rs�k igen.<br/><br/>\n\n";
        echo "Om problemet inte f�rsvinner, kontakta <a href='mailto:webb@flippersm.se'>webb-ansvarige</a> och ge honom denna information:</p><br/>\n\n";
        echo "<p>db: $db<br><br>\n";
        echo "sql: $sql<br><br>\n";
        echo "introws: $intRows<br><br>\n";
        echo "booAdminMail: $booAdminMail<br><br>\n";
        echo "booPlayerMail: $booPlayerMail</p><br/><br/>\n\n";
        }
    }
else
    {
    echo "<h1>Anm�lan - Flipper-SM</h1><br/>\n\n";
    
    echo "<p>Anm�lan lyckades <b>tyv�rr inte</b>! Du fyllde i fel nuffror i spamskyddet. Var v�nlig att g� tillbaka och f�rs�k igen.</p><br/><br/>\n\n";
    }


?>
