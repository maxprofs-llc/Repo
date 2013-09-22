<?php
  define('__ROOT__', dirname(__FILE__)); 
  require_once(__ROOT__.'/functions/general.php');
  
  printHeader('EPC 2013', __baseHref__);
  printTopper();

  $content = '<h2 class="entry-title">T-shirts!</h2>';
  $content .= '<p>There are T-shirts for sale for SEK 100 kr (approximately EUR € 11 / GBP £ 10 / USD $ 17), to help you remember this remarkable event!</p>';
  $content .= '<div id="tshirtPhoto"><img src="'.getPhoto($dbh, 'tshirt', 1).'" alt="EPC 2013 T-shirt" /></div>';
  $content .= '<p><a href="'.__baseHref__.'/images/tshirt-image.png" target="_new">Click here for a higher resolution image</a>. A big THANK YOU to Henrik "PIG" Wängerstedt for the design.</p>';
  
  if (checkLogin($dbh, $ulogin, false)) {
    $content .= getTshirtForm($dbh, $ulogin);
  } else {
    $content .= '<p>You need to <a href="../">register</a> to create a user before you can buy T-shirts.</p>';
    $content .= showLogin($ulogin, 'If you already have a user, please login.');
  }
  
  $content .= '<p>You pay for your T-shirt(s) on the <a href="'.__baseHref__.'/registration/payment-options/">payment page</a>';
  
  echo($content);
  printFooter($dbh, $ulogin);
?>
    
