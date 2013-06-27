<?php
 function datumform2($tempdatum)
 {
 $tempdatum2 = substr($tempdatum, 2, 2);
 $tempdatum3 = substr($tempdatum, 4, 2);
 $tempdatum4 = substr($tempdatum, 6, 2);

 $dagdatum2 = substr($tempdatum, 0, 4);

 $dagdatum2 = $dagdatum2. "-" .$tempdatum3. "-" .$tempdatum4;

 $dag = date('w', strtotime($dagdatum2));  //0 == söndag, 6 == lördag.
 
 if($dag == 0)
 {
 $dag = 'Söndag';
 }

 if($dag == 1)
 {
 $dag = 'Måndag';
 }

 if($dag == 2)
 {
 $dag = 'Tisdag';
 }

 if($dag == 3)
 {
 $dag = 'Onsdag';
 }

 if($dag == 4)
 {
 $dag = 'Torsdag';
 }
 
 if($dag == 5)
 {
 $dag = 'Fredag';
 }
 
 if($dag == 6)
 {
 $dag = 'Lördag';
 }
      
 $returdatum = $dag." ".$tempdatum2. "-" .$tempdatum3. "-" .$tempdatum4;

 return ($returdatum) ;
 }
php?> 
