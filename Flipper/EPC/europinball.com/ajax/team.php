<?php
  require_once('../functions/general.php');
  header('Content-Type: application/json');

  $where = ' where ';
  $where .= (((isset($_REQUEST['obj']) && $_REQUEST['obj'] == 'team') || !isset($_REQUEST['obj'])) && (isset($_REQUEST['id']) && preg_match('/^[0-9]+$/', $_REQUEST['id']))) ? 'tm.id = '.$_REQUEST['id'] : '1';
  
  $national = (isset($_REQUEST['n']) && $_REQUEST['n'] == 1) ? true : false;
  
  $objs = (array) getTeams($dbh, $where, $national);
  
  echo ($objs) ? json_encode(array_values($objs)) : '{"data": false}';
?>
