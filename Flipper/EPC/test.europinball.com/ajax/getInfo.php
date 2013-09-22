<?php
  require_once('../functions/general.php');
  header('Content-Type: text/html');
  
  $id = ($_REQUEST['id']) ? $_REQUEST['id'] : null;
  $obj = ($_REQUEST['obj']) ? $_REQUEST['obj'] : 'player';
  
  if ($id && $obj) {
    echo getInfo($dbh, $obj, $id);
  }
    
?>