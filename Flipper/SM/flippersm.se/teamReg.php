<?php
  define('__ROOT__', dirname(__FILE__)); 
  require_once(__ROOT__.'/functions/general.php');

  printHeader('EPC 2013', __baseHref__);
  printTopper();

  $content = '<h2 class="entry-title">Team Registration!</h2>';
  $content .= '<p>There will be a primary and a secondary team tournament. The primary is for national teams only, registered by the IFPA country director for each country. The secondary is open for all other players, and team constellation is free (including across country borders). The two tournaments will be played at the same time using the same system. A player can participate in one single team only, so if you are already in the national team, then don\'t register here. Team players can not choose to play their main and classics qualification rounds during Saturday 1300-1900.</p>';
  
  if (checkLogin($dbh, $ulogin, false)) {
    $content .= getTeamForm($dbh, $ulogin);
  } else {
    $content .= '<p>You need to <a href="../">register</a> to create a user before you can register a team.</p>';
    $content .= showLogin($ulogin, 'If you already have a user, please login.');
  }
  
  echo($content);
  printFooter($dbh, $ulogin);
?>
