<?php
  define('__ROOT__', dirname(__FILE__)); 
  require_once(__ROOT__.'/functions/general.php');
  
  printHeader('EPC 2013', __baseHref__);
  printTopper();

  $content = '<h2 class="entry-title">Qualification groups!</h2>';
  $content .= '
    <p>Here you can choose your potential qualifications groups. Your current selections is shown below. Qualification group rules:</p>
      <ul>
        <li>You will be assigned one qualification group only - which will determine in what time slot you will play your qualification games.</li>
        <li>We will try to put you in one of your chosen qualifications groups, and we believe we will succeed doing so - but we give no guarantees.</li>
        <li>You can vastly increase your chances of getting your prefered time slot by paying the participation fee. We will assign time slots in order of payment.</li>
      </ul>
    </p>
  ';
  
  if (checkLogin($dbh, $ulogin, false)) {
    $player = getCurrentPlayer($dbh, $ulogin);
    $content .= getQualGroupForm($dbh, $player);
  } else {
    $content .= '<p>You need to <a href="../">register</a> to create a user before you can choose qualification groups.</p>';
    $content .= showLogin($ulogin, 'If you already have a user, please login.');
  }
  
  echo($content);
  printFooter($dbh, $ulogin);
?>
    
