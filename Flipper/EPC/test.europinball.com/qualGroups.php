<?php

  define('__ROOT__', dirname(__FILE__)); 
  require_once(__ROOT__.'/functions/general.php');
  
  printHeader('EPC 2013', __baseHref__);
  printTopper();
  
  $qualLimit['main'] = 60;
  $qualLimit['classics'] = 30;
  
  $content = '<h2 class="entry-title">Qualification group status</h2>';
  $content .= '<p>Below you can find the current amount of players in each qualification group. After each time slot you will find two numbers - the number of players that have chosen to be available for the time slot, and after the slash is the number of players that have chosen that slot as their prefered slot.</p>'; 
    
  $content .= '<p>The maximum number of players depend on the final number of games in the tournament, but it will end up at somewhere around 50. <b>As long as the number after the slash is below '.$qualLimit['main'].' ('.$qualLimit['classics'].' in Classics), everyone will be able to play at their prefered time slots.</b></p>';

  $qualGroups = getQualGroups($dbh);
  
  $player = getCurrentPlayer($dbh, $ulogin);
  
  if ($player) {
    $playerQualGroups = $player->getQualGroups($dbh, 1, false);
    $playerPreferedQualGroups = $player->getQualGroups($dbh, 1, true);
  }
  
  if ($playerQualGroups) {
    $content .= '<p>Your chosen time slots are marked with <span class="yellow">yellow background</span>.</p>';
    foreach($playerQualGroups as $playerQualGroup) {
      $playerQualGroupIds[] = $playerQualGroup->id;
    }
  }
  
  if ($playerPreferedQualGroups) {
    $content .= '<p>Your prefered time slots are marked with a <span class="yellow bold">bold font on yellow background</span>.</p>';
    foreach($playerPreferedQualGroups as $playerPreferedQualGroup) {
      $playerPreferedQualGroupIds[] = $playerPreferedQualGroup->id;
    }
  }
  
  $content .= '<p>Overcrowded time slots are marked with a <span class="red">red font</span>.</p><p>If a time slot is overcrowded, we will need to move people to other time slots. People will be granted their prefered time slot in order of participation fee payment date until the time slot is full.</p><br />';
  
  if($qualGroups && count($qualGroups > 0)) {
    
    $tournamentDivisionIds = [];
    foreach($qualGroups as $qualGroup) {
      if (!in_array($qualGroup->tournamentDivision_id, $tournamentDivisionIds)) {
        $tournamentDivisionIds[] = $qualGroup->tournamentDivision_id;
        $qualGroupsByDiv[$qualGroup->tournamentDivision_id] = [];
      }
      array_push($qualGroupsByDiv[$qualGroup->tournamentDivision_id], $qualGroup);    
    }

    foreach($tournamentDivisionIds as $tournamentDivisionId) {
      $type = ($tournamentDivisionId == 1) ? 'main' : 'classics';
      foreach($qualGroupsByDiv[$tournamentDivisionId] as $qualGroup) {
        $disabled = ($player->{$type}) ? false : true;
        if (!($date) || $date != $qualGroup->date) {
          if ($date) {
            $content .= '</table>';
          }
          $date = $qualGroup->date;
          $content .= '
            <table id="qualGroupMain'.$date.'Table" class="qualGroupTable">
              <tr>
                <td><h2><b>'.$date.' ('.ucfirst($type).')</b></h2></td>
              </tr>
          ';
        }
        $content .= '<tr><td';
        $content .= ($playerQualGroups && in_array($qualGroup->id, $playerQualGroupIds)) ? ' class="yellow' : ' class="';
        $content .= ($qualGroup->getNoOfPlayers($dbh, true) > $qualLimit[$type]) ? ' red' : '';
        $content .= ($playerPreferedQualGroups && in_array($qualGroup->id, $playerPreferedQualGroupIds)) ? ' bold">' : '">';          
        $content .= ucfirst($qualGroup->name).': '.$qualGroup->getNoOfPlayers($dbh).' / '.$qualGroup->getNoOfPlayers($dbh, true);
        $content .= '</td></tr>';
      }
    } 
    $content .= '
            </table>
    ';
  } else {
    $content .= 'Something must have gone wrong, because I can\'t find any qualification groups in the database?';
  }
  
  echo $content;

  printFooter($dbh, $ulogin);
?>
