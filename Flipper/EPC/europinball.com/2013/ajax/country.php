<?php
  require_once('../functions/general.php');
  header('Content-Type: application/json');
  
  $where = ' where';
  $where .= (isset($_REQUEST['id'])) ? ' co.id = '.$_REQUEST['id'] : ' 1';
  $where .= (isset($_REQUEST['continent_id'])) ? ' and co.continent_id = '.$_REQUEST['continent_id'] : ' and 1';
    
  $query = 'select * from country co'.$where.' order by co.name';
    
  $objs = (array) getObjects($dbh, 'country', $query);
  
  print json_encode(array_values(geoFilter($objs)));
?>