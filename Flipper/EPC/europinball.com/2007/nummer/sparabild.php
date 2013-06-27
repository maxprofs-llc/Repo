<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="sv" lang="sv">
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<title>Untitled</title>
</head>
<body>


<?php

function captcha($tal)
  {

	$filnamn = rand(10, 20);
	$filnamn = "images/" . $filnamn . ".jpg";

	$bredd = 27;
	$hojd = 40;

	$bild = imagecreatetruecolor($bredd*5, $hojd);

	$i = 0;
	while($i < 5)
	   {
	   $siffra = substr("$tal",$i,1);
	   $koordinat = $bredd * $i;
	   $stopp = $koordinat + $bredd;
	   $insert = "$siffra" . ".jpg";

	   $insert = imagecreatefromjpeg($insert);
	   imagecopymerge($bild,$insert,$koordinat,0,0,0,$stopp,$hojd,100); 

	   $i++;
	   }
   
	if(file_exists($filnamn))
	  {
	  unlink("$filnamn");
	  }
   
	imagejpeg($bild, $filnamn, 100);
	imagedestroy($bild);

	echo "<img src=\"$filnamn\" alt=\"captcha\" />";

  }


$tal = rand(10000, 99999);
captcha($tal);

?>


</body>
</html>
