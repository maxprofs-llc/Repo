<?php
  define('__ROOT__', dirname(__FILE__)); 
  require_once(__ROOT__.'/functions/general.php');
  
  printHeader('EPC 2013', $baseHref);

  echo('<h3 class="entry-title">Login</h3>');

  if (checkLogin($dbh, $ulogin)) {
    $content = '
      <div id="login">
        You are logged in.
      </div>
    ';
    echo $content;
  } else {
    echo('<script type="text/javascript">document.getElementById(\'usernameLogin\').focus();</script>');
  }
  
  printFooter();
?>
