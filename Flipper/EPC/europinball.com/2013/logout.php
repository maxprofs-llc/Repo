<?php
  define('__ROOT__', dirname(__FILE__)); 
  require_once(__ROOT__.'/functions/general.php');
  
  printHeader('EPC 2013', $baseHref);
  
  echo('<h3 class="entry-title">Logout</h3>');

  appLogout($ulogin);
  $content = '
    <div id="login">
      You are logged out.
    </div>
  ';
  echo $content;
  printFooter();
?>
