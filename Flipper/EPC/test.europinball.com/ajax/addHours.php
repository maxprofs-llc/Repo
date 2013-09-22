<?php
  require_once('../functions/general.php');
  header('Content-Type: application/json');
  
  $tournament = (isset($_REQUEST['t']) && preg_match('/^[0-9]+$/', $_REQUEST['t'])) ? $_REQUEST['t'] : 1;
  $hours = (isset($_REQUEST['h']) && preg_match('/^[0-9]+$/', $_REQUEST['h'])) ? $_REQUEST['h'] : null;

  if ($hours) {
    $player = getCurrentPlayer($dbh, $ulogin);
    if ($player) {
      $player->hours = $hours;
      if (checkPlayer($dbh, $player, 'volunteer')) {
        $player->addVolunteer($dbh, $tournament, 'update');
      } else {
        $player->addVolunteer($dbh, $tournament);
      }
      $volunteer = $player->getVolunteer($dbh);
      if ($volunteer) {
        if ($volunteer->hours == $hours) {
          echo '{"success": true, "reason": "Hours added"}';
        } else {
          $errorMsg = 'Could not add the hours into the database';        
        }
      } else {
        $errorMsg = 'Could not find the volunteer. Are you registered as a vounteer?';
      }
    } else {
      $errorMsg = 'Could not find the player! Are you logged in?';
    }
  } else {
    $errorMsg = 'Required parameter (hours) missing';    
  }
  
  if ($errorMsg) {
    echo(getError($errorMsg, false));
  }
?>
