<?php
  require_once('../functions/general.php');
  header('Content-Type: application/json');
  
  $where = ' where';
  $where .= (isset($_REQUEST['id'])) ? ' c.id = '.$_REQUEST['id'] : ' 1';
  $where .= (isset($_REQUEST['region_id'])) ? ' and c.region_id = '.$_REQUEST['region_id'] : ' and 1';
    
  $query = 'select * from city c'.$where.' order by c.name';
    
  $objs = (array) getObjects($dbh, 'city', $query);

  print json_encode(array_values(geoFilter($objs)));
?>