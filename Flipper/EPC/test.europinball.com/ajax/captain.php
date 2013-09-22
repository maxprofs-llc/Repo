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
          if ($team->setCaptain($dbh, $player)) {
            echo('{"success": true, "reason": "'.$player->name.' is now captain for '.$team->name.'"}');
          } else {
            $errorMsg = 'Could not set '.$player->name.' as captain for '.$team->name;
          }
        } else {
          $errorMsg = 'Could not find player ID '.$playerId.' in the database.';
        }
      } else {
        $errorMsg = 'No or invalid player ID '.$_REQUEST['playerId'].' specified.';
      }
    } else {
      $errorMsg = 'Could not find your team! Are you in a team?';
    }
  } else {
    $errorMsg = 'Could not find you! Are you logged in?';
  }

  if ($errorMsg) {
    echo(getError($errorMsg, false));    
  }
    
?>