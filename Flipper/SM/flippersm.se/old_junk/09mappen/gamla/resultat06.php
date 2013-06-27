<?php

include("huvud.fil");

   if($_GET['sida'] == "")
      {
      @include("resultat06/kval.fil");
      }
   else
      {
      $filnamn = $_GET['sida'];
      @include("resultat06/$filnamn.fil");
      }
      
include("fot.fil");

?>