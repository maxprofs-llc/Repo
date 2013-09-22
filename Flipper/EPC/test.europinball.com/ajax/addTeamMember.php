<?php
  require_once('../functions/general.php');
  header('Content-Type: application/json');
  
  $playerId = (isset($_REQUEST['playerId']) && preg_match('/^[0-9]+$/', $_REQUEST['playerId'])) ? $_REQUEST['playerId'] : null;
  
  $currentPlayer = getCurrentPlayer($dbh, $ulogin);
  if ($currentPlayer) {
    $team = $currentPlayer->getTeam($dbh);
    if ($team) {
      if ($playerId) {
        $player = getPlayerById($dbh, $playerId);
        if ($player) {
          if ($team->addPlayer($dbh, $player)) {
            echo('{"success": true, "reason": "'.$player->name.' added to '.$team->name.'"}');
          } else {
            $errorMsg = 'Could not add player '.$player->name.' to '.$team->name;
          }
        } else {
          $errorMsg = 'Could not find the player with ID '.$playerId;
        }
      } else {
        $errorMsg = 'No or invalid player ID specified';        
      }
    } else {
      $errorMsg = 'Could not find your team! Are you in a team?';
    }
  } else {
    $errorMsg = 'Could not find the player! Are you logged in?';
  }
    
  if ($errorMsg) {
    echo(getError($errorMsg, false));    
  }
    
    
?>