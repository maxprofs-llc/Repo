<?php
  require_once('../functions/general.php');
  header('Content-Type: application/json');
  
  $where = ' where ';
  $where .= (((isset($_REQUEST['obj']) && $_REQUEST['obj'] == 'city') || !isset($_REQUEST['obj'])) && (isset($_REQUEST['id']) && preg_match('/^[0-9]+$/', $_REQUEST['id']))) ? 'id = '.$_REQUEST['id'] : '1';
  if ($filter = getGeoFilterWheres('city')) {
    $where .= ' and '.$filter;
  }
  
  /*
  $where = ' where';
  $where .= (isset($_REQUEST['obj']) && $_REQUEST['obj'] == 'city' && isset($_REQUEST['id']) && preg_match('/^[0-9]+$/', $_REQUEST['id'])) ? ' id = '.$_REQUEST['id'] : ' 1';
  $where .= (isset($_REQUEST['region_id']) && preg_match('/^[0-9]+$/', $_REQUEST['region_id'])) ? ' and region_id = '.$_REQUEST['region_id'].' or parentRegion_id = '.$_REQUEST['region_id'] : ' and 1';
  $where .= (isset($_REQUEST['country_id']) && preg_match('/^[0-9]+$/', $_REQUEST['country_id'])) ? ' and country_id = '.$_REQUEST['country_id'].' or parentCountry_id = '.$_REQUEST['country_id'] : ' and 1';
  $where .= (isset($_REQUEST['continent_id']) && preg_match('/^[0-9]+$/', $_REQUEST['continent_id'])) ? ' and continent_id = '.$_REQUEST['continent_id'] : ' and 1';
    */
  
  $objs = (array) getCities($dbh, $where);

  print json_encode(array_values($objs));
?>