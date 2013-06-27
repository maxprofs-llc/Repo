<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="sv" lang="sv">
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<title>Untitled</title>
</head>
<body>



<?php
$intSlump = rand(10000, 99999);
$_SESSION['flippertal'] = $intSlump;

echo "
$intSlump <br>
<img src=\"nummer.php\" />";
?>

</body>
</html>
