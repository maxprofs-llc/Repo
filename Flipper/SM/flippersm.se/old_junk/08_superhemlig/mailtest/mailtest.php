<?php

error_reporting(E_ALL);

ini_set("display_errors", "1");
ini_set('sendmail_from','webb@flippersm.se');
ini_set('sendmail_path' , "sendmail -t -i -F webb@flippersm.se -f
webb@flippersm.se");

/*
//send mail
$sendto = "per.martinson@gmail.com";
$subject = "Testar SM-serverns mail";
$header = "From: Flipper-SM <webb@flippersm.se>\r\n
Return-Path: webb@flippersm.se\r\n
Reply-to: webb@flippersm.se";

$med = "Nu sjutton ska det funka!";

$sender = "webb@flippersm.se";

$femte = "-f$sender";

$skicka = mail($sendto, $subject, $med, $header);

*/

// Include email() function.
require_once("email.php");
//send mail
$sendto = "per.martinson@gmail.com";
$subject = "Testar SM-serverns mail";
$header = "From: Flipper-SM <webb@flippersm.se>\r\n
Return-Path: webb@flippersm.se\r\n
Reply-to: webb@flippersm.se";

$med = "Nu sjutton ska det funka!";

$sender = "webb@flippersm.se";

$femte = "-f$sender";

$skicka = email($sendto, $subject, $med, $header);

?>



<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
	<title>Untitled</title>
	<meta name="generator" content="BBEdit 8.2">
</head>
<body>

Skickades: <?php echo "$skicka" ; ?>

</body>
</html>
