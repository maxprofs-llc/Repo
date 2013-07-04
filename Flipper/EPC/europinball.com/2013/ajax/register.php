<?php
  require_once('../functions/general.php');
  require_once('../functions/header.php');
    
  $player = new player($_REQUEST);

  addPlayer($dbh, $player, $ulogin);

?>