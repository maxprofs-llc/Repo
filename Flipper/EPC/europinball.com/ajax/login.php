<?php
  require_once('../functions/general.php');
  header('Content-Type: application/json');
  
  $user = (isset($_REQUEST['u'])) ? $_REQUEST['u'] : null;
  $pass = (isset($_REQUEST['p'])) ? $_REQUEST['p'] : null;
  
  $ulogin->Authenticate($user, $pass);
  if ($ulogin->IsAuthSuccess()) {
    echo('{"success": true, "reason": "Login successful"}');
  } else {
    echo('{"success": false, "reason": "Login failed"}');
  }
      
?>