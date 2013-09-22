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
          if ($team->removePlayer($dbh, $player) > 0) {
            echo('{"success": true, "reason": "'.$player->name.' removed from '.$team->name.'"}');
          } else {
            $errorMsg = 'Could not remove player ID '.$player->id.' from '.$team->name;
          }
        } else {
          $errorMsg = 'Could not find the player with ID '.$playerId;
        }
      } else {
        if ($team->removePlayers($dbh)) {
          echo('{"success": true, "reason": "All members removed from '.$team->name.'"}');
        } else {
          $errorMsg = 'Could not remove all players from '.$team->name;
        }
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
