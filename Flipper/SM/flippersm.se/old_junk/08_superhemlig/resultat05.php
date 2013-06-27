<?php

include("huvud.fil");

   if($_GET['sida'] == "")
      {
      include("resultat05/kval.fil");
      }
   else
      {
      $filnamn = $_GET['sida'];
      @include("resultat05/$filnamn.fil");
      }
      
include("fot.fil");

?>