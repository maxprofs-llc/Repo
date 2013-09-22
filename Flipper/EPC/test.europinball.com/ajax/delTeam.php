<?php
  require_once('../functions/general.php');
  header('Content-Type: application/json');
  
  $player = getCurrentPlayer($dbh, $ulogin);
  if ($player) {
    $team = $player->getTeam($dbh);
    if ($team) {
      if ($team->delete($dbh)) {
        $response = (object) array('success' => true, 'reason' => 'Team deleted!');
        echo(json_encode($response));
      } else {
        $errorMsg = 'Could not delete '.$team->name;
      }
    } else {
      $errorMsg = 'Could not find the team! Are you in a team?';
    }
  } else {
    $errorMsg = 'Could not find the player! Are you logged in?';
  }
  
  if ($errorMsg) {
    echo(getError($errorMsg, false));    
  }
?>