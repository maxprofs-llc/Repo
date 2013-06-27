<?php

include("huvud.fil");

   if($_GET['sida'] == "")
      {
      include("resultat04/kval.fil");
      }
   else
      {
      $filnamn = $_GET['sida'];
      @include("resultat04/$filnamn.fil");
      }
      
include("fot.fil");

?>