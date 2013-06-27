<?php
  require_once('../functions/general.php');
  header('Content-Type: application/json');
  
  $where = ' where';
  $where .= (isset($_REQUEST['id'])) ? ' cn.id = '.$_REQUEST['id'] : ' 1';
    
  $query = 'select * from continent cn'.$where.' order by cn.name';
    
  $objs = (array) getObjects($dbh, 'continent', $query);
  
  print json_encode(array_values($objs));
?>