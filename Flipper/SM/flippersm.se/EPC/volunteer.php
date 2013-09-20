<?php
  define('__ROOT__', dirname(__FILE__)); 
  require_once(__ROOT__.'/functions/general.php');
  
  printHeader('EPC 2013', __baseHref__);
  printTopper();

  $content = '<h2 class="entry-title">Volunteer!</h2>';
  $content .= '<p>We need volunteers! Without volunteers, there would be no way to organize these tournaments. Please register for voluntary work here.</p>';
  $content .= '<p>Thanks to our hosts at the O\'Learys restaurant, all volunteers will get a free dinner each day they work!</p>';
  
  if (checkLogin($dbh, $ulogin, false)) {
    $content .= getVolunteerForm($dbh, $ulogin);
  } else {
    $content .= '<p>You need to <a href="../">register</a> to create a user before you can volunteer.</p>';
    $content .= showLogin($ulogin, 'If you already have a user, please login.');
  }
  
  echo($content);
  printFooter($dbh, $ulogin);
?>
    
