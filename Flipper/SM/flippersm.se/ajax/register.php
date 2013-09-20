<?php
  require_once('../functions/general.php');
    
  $player = new player($_REQUEST);

  addPlayer($dbh, $player, $ulogin);

?>