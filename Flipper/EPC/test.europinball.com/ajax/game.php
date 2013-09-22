<?php
  require_once('../functions/general.php');
  header('Content-Type: application/json');
  
  
  $where = ' where ';
  $where .= (((isset($_REQUEST['obj']) && $_REQUEST['obj'] == 'game') || !isset($_REQUEST['obj'])) && (isset($_REQUEST['id']) && preg_match('/^[0-9]+$/', $_REQUEST['id']))) ? 'id = '.$_REQUEST['id'] : '1';
  
  $where .= (isset($_REQUEST['t']) && preg_match('/^[0-9]+$/', $_REQUEST['t'])) ? ' and tournamentEdition_id = '.$_REQUEST['t'] : '';
  $where .= (isset($_REQUEST['d']) && preg_match('/^[0-9]+$/', $_REQUEST['d'])) ? ' and tournamentDivision_id = '.$_REQUEST['d'] : '';
  $where .= (isset($_REQUEST['edition_id']) && preg_match('/^[0-9]+$/', $_REQUEST['edition_id'])) ? ' and tournamentEdition_id = '.$_REQUEST['edition_id'] : '';
  $where .= (isset($_REQUEST['edition']) && preg_match('/^[0-9]+$/', $_REQUEST['edition'])) ? ' and tournamentEdition_id = '.$_REQUEST['edition'] : '';
  $where .= (isset($_REQUEST['division_id']) && preg_match('/^[0-9]+$/', $_REQUEST['division_id'])) ? ' and tournamentDivision_id = '.$_REQUEST['division_id'] : '';
  $where .= (isset($_REQUEST['division']) && preg_match('/^[0-9]+$/', $_REQUEST['division'])) ? ' and tournamentDivision_id = '.$_REQUEST['division'] : '';
  $where .= (isset($_REQUEST['ipdb_id']) && preg_match('/^[0-9]+$/', $_REQUEST['ipdb_id'])) ? ' and ipdb_id = '.$_REQUEST['ipdb_id'] : '';
  $where .= (isset($_REQUEST['ipdb']) && preg_match('/^[0-9]+$/', $_REQUEST['ipdb'])) ? ' and ipdb_id = '.$_REQUEST['ipdb'] : '';
  $where .= (isset($_REQUEST['game_id']) && preg_match('/^[0-9]+$/', $_REQUEST['game_id'])) ? ' and game_id = '.$_REQUEST['game_id'] : '';
  $where .= (isset($_REQUEST['game']) && preg_match('/^[0-9]+$/', $_REQUEST['game'])) ? ' and game_id = '.$_REQUEST['game'] : '';
  $where .= (isset($_REQUEST['manunacturer_id']) && preg_match('/^[0-9]+$/', $_REQUEST['manunacturer_id'])) ? ' and manufacturer_id = '.$_REQUEST['manufacturer_id'] : '';
  $where .= (isset($_REQUEST['manufacturer']) && preg_match('/^[0-9]+$/', $_REQUEST['manufacturer'])) ? ' and manufacturer_id = '.$_REQUEST['manufacturer'] : '';
  $where .= (isset($_REQUEST['type']) && preg_match('/^main$|^classics$/', $_REQUEST['type'])) ? ' and type = '.$_REQUEST['type'] : '';
    
  if (isset($_REQUEST['obj']) && isset($_REQUEST['id']) && preg_match('/^[0-9]+$/', $_REQUEST['id'])) {
    switch ($_REQUEST['obj']) {
      case 'edition':
      case 'edition_id':
      $filterObj = 'tournamentEdition_id';
      break;
      case 'division':
      case 'division_id':
      $filterObj = 'tournamentDivision_id';
      break;
      case 'ipdb_id':
      case 'ipdb':
      $filterObj = 'ipdb_id';
      break;
      case 'game_id':
      case 'game':
      $filterObj = 'game_id';
      break;
      case 'manunacturer_id':
      case 'manufacturer':
      $filterObj = 'manufacturer_id';
      break;
      case 'type':
      $filterObj = 'type';
      break;
    }
    if ($filterObj) {
      $where .= ' and '.$filterObj.' = '.$_REQUEST['id'];
    }
  }
  
  $objs = (array) getGames($dbh, $where);
    
  echo ($objs) ? json_encode(array_values($objs)) : '{"data": false}';
?>