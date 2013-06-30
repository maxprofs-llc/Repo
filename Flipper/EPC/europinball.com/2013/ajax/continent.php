<?php
  require_once('../functions/general.php');
  header('Content-Type: application/json');
  
  $where = ' where';
  $where .= (isset($_REQUEST['id'])) ? ' id = '.$_REQUEST['id'] : ' 1';
  $where .= (isset($_REQUEST['continent_id'])) ? ' and continent_id = '.$_REQUEST['continent_id'] : ' and 1';
  
  $objs = (array) getContinents($dbh, $where);
  
  print json_encode(array_values($objs));
?>