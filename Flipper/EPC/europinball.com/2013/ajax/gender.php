<?php
  require_once('../functions/general.php');
  header('Content-Type: application/json');
      
  $query = 'select * from gender g order by g.id asc';
    
  $objs = getObjects($dbh, 'gender', $query);
  
  print json_encode($objs);
?>