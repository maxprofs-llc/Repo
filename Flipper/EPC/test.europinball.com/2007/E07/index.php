<?php

include("parts/header.epf");

   if($_GET['page'] == "")
      {
      include("content/start.epf");
      }
   else
      {
      $name = $_GET['page'];
      @include("content/$name.epf");
      }
      
include("parts/footer.epf");

?>