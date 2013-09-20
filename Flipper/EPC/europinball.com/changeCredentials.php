<?php
  define('__ROOT__', dirname(__FILE__)); 
  require_once(__ROOT__.'/functions/general.php');
  
  printHeader('EPC 2013', __baseHref__);

  if (checkLogin($dbh, $ulogin)) {
    $content = '
      <div id="changeUser">
        '.showChangeUsername($dbh, $_SESSION['username']).'
      </div>
    ';
    echo $content;
    echo('<script type="text/javascript">document.getElementById(\'usernameText\').focus();</script>');
  }
  printFooter($dbh, $ulogin);
?>
