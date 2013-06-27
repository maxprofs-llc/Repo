<?php
  require_once('../functions/general.php');
  header('Content-Type: application/json');
  
  $where = ' where';
  $where .= (isset($_REQUEST['id'])) ? ' r.id = '.$_REQUEST['id'] : ' 1';
  $where .= (isset($_REQUEST['country_id'])) ? ' and r.country_id = '.$_REQUEST['country_id'] : ' and 1';
    
  $query = 'select * from region r'.$where.' order by r.name';
    
  $objs = getObjects($dbh, 'region', $query);
  
  print json_encode(array_values(geoFilter($objs)));
?>