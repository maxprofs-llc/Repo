<?php
 function tidform($tempdatum)
 {
 $tempdatum2 = substr($tempdatum, 2, 6);
 $temptid1 = substr($tempdatum, 8, 2);
 $temptid2 = substr($tempdatum, 10, 2);
 $temptid3 = $temptid1.":".$temptid2;
 
 $tid = $temptid3;

 return ($tid) ;
 }
php?> 
