<?php
  require_once('../functions/general.php');
  header('Content-Type: text/html');

  $player = getCurrentPlayer($dbh, $ulogin);
  if ($player) {
    $team = new team($_REQUEST);
    if ($team) {
      if ($team->id == 0) {
        echo addTeam($dbh, $team, $player);
      } else {
        echo editTeam($dbh, $team);
      }
    } else {
      $errorMsg = 'Could not create the team. Did you provide the correct parameters?';
    }
  } else {
    $errorMsg = 'Could not find the player! Are you logged in?';
  }

  if ($errorMsg) {
    echo(json_decode(getError($errorMsg, false))->reason);    
  }

?>