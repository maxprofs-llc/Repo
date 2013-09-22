<?php
 function datumform($tempdatum)
 {
 $tempdatum2 = substr($tempdatum, 2, 2);
 $tempdatum3 = substr($tempdatum, 4, 2);
 $tempdatum4 = substr($tempdatum, 6, 2);
 
 $returdatum = $tempdatum2. "-" .$tempdatum3. "-" .$tempdatum4;
 
 return ($returdatum) ;
 }
php?> 
