<?php
  require_once('../functions/general.php');
  header('Content-Type: application/json');
  
  $where = ' where';
  $where .= (isset($_REQUEST['id'])) ? ' id = '.$_REQUEST['id'] : ' 1';
  $where .= (isset($_REQUEST['country_id'])) ? ' and country_id = '.$_REQUEST['country_id'].' or parentCountry_id = '.$_REQUEST['country_id'] : ' and 1';
  $where .= (isset($_REQUEST['continent_id'])) ? ' and continent_id = '.$_REQUEST['continent_id'] : ' and 1';
    
  $objs = (array) getCountries($dbh, $where);
    
  print json_encode(array_values($objs));
?>