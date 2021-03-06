<?php

  define('__ROOT__', dirname(__FILE__)); 
  require_once(__ROOT__.'/functions/general.php');
  
  printHeader('EPC 2013', __baseHref__);
  printTopper();

  $content = '<h2 class="entry-title">Admin tools</h2>';
  
  if (checkLogin($dbh, $ulogin)) {
    $currentPlayer = getCurrentPlayer($dbh, $ulogin);
    if ($currentPlayer->adminLevel > 0) {
      require_once(__ROOT__.'/functions/admin.php');
      $content .= getAdminMenu();
      $playerTables = getAdminPlayerTables($dbh, $ulogin);
      switch ($_REQUEST['tool']) {
        case 'player':
          // $content .= '<br /><br />'.getAdminPasswordResetForm($dbh);
          $content .= $playerTables['players'];
        break;
        case 'user':
          $content .= $playerTables['users'];
        break;
        case 'payment':
          $content .= $playerTables['payments'];
        break;
        case 'results':
          $content .= $playerTables['results'];
        break;
        case 'volunteer':
          $volunteerTables = getAdminVolunteerTable($dbh);
          $content .= $volunteerTables['volunteers'];
          $content .= $volunteerTables['needs'];
          $content .= $volunteerTables['assignments'];
        break;
        case 'team':
          $content .= getAdminTeamTable($dbh, true);
          $content .= getAdminTeamTable($dbh, false);
        break;
        case 'tshirt':
          $content .= getAdminTshirtTable($dbh, 'total');
          $content .= getAdminTshirtTable($dbh, 'buyers');
        break;
        case 'game':
          $content .= getAdminGameTable($dbh);
        break;
        case 'qualGroup':
          $content .= getAdminQualGroupTable($dbh);
          $content .= $playerTables['qualGroups'];
        break;
      }
      $content .= getDataTables();
    } else {
      $content .= 'You do not have access to this page';
    }
  }

  echo($content);
  printFooter($dbh, $ulogin);
  
?>
