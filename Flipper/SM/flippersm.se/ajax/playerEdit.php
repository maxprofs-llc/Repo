<?php
  require_once('../functions/general.php');
  require_once('../functions/header.php');
  header('Content-Type: application/json');
  
  $currentPlayer = getCurrentPlayer($dbh, $ulogin);
  if($currentPlayer) {
    $player = new player($_REQUEST);
    if (editPlayer($dbh, $player, $ulogin)) {
      echo '{"Success": true}';
    } else {
      echo '{"Success": false}';
    }
  } else {
    $errorMsg = 'Could not find the player! Are you logged in?';
  }

  if ($errorMsg) {
    echo(getError($errorMsg, false));    
  }

?>