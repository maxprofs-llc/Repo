<?php

function undermenu() {}

include("regelhuvud.fil");

   if($_GET['sida'] == "")
      {
      include("regler.fil");
      }
   else
      {
      $filnamn = $_GET['sida'];
      @include("$filnamn.fil");
      }
      
include("regelfot.fil");

?>