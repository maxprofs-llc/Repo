<?php

include("huvud.fil");

   if($_GET['sida'] == "")
      {
      @include("resultat07/kval.fil");
      }
   else
      {
      $filnamn = $_GET['sida'];
      @include("resultat07/$filnamn.fil");
      }
      
include("fot.fil");

?>