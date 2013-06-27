<?php
header ("Content-type: image/jpg");
session_start();
$tal = $_SESSION['flippertal'];

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
imagejpeg($bild,"",100); 

?>