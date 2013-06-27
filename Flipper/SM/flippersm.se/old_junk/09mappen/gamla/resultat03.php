<?php

include("huvud.fil");

   if($_GET['sida'] == "")
      {
      include("resultat03/samtliga.fil");
      }
   else
      {
      $filnamn = $_GET['sida'];
      @include("resultat03/$filnamn.fil");
      }
      
include("fot.fil");

?>