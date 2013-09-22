<?php

include("huvud.fil");

   if($_GET['sida'] == "")
      {
      include("galleri/04.fil");
      }
   else
      {
      $filnamn = $_GET['sida'];
      @include("galleri/$filnamn.fil");
      }
      
include("fot.fil");

?>