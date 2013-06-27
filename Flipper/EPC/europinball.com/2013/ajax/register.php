<?php
  require_once('../functions/general.php');
  require_once('../functions/header.php');
    
  $player = new player($_REQUEST);

  var_dump($player);
  
//  addPlayer($dbh, $player);

  echo "\n<BR />\n";

?>