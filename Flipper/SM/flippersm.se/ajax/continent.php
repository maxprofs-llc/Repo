<?php
  require_once('../functions/general.php');
  header('Content-Type: application/json');
  
  //Hard coded shit! Remove when chance given!
  $where = ' where id=1';
/*
  $where .= (((isset($_REQUEST['obj']) && $_REQUEST['obj'] == 'continent') || !isset($_REQUEST['obj'])) && (isset($_REQUEST['id']) && preg_match('/^[0-9]+$/', $_REQUEST['id']))) ? 'id = '.$_REQUEST['id'] : '1';
  if ($filter = getGeoFilterWheres('continent')) {
    $where .= $filter;
  }
*/

  $objs = (array) getContinents($dbh, $where);
  
  echo ($objs) ? json_encode(array_values($objs)) : '{"data": false}';
?>