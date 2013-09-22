<?php

include("huvud.fil");

   if($_GET['sida'] == "")
      {
      @include("start.fil");
      }
   else
      {
      $filnamn = str_replace(":", "", $_GET['sida']);
      @include("$filnamn.fil");
      }
      
include("fot.fil");

?>