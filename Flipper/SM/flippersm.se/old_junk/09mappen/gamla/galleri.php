<?php

include("huvud.fil");

   if($_GET['sida'] == "")
      {
      include("galleri/04.fil");
      }
   else
      {
      $filnamn = str_replace(";", "", $_GET['sida']);
      @include("galleri/$filnamn.fil");
      }
      
include("fot.fil");

?>