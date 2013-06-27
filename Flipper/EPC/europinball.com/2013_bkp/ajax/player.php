<?php
  require_once('../functions/general.php');
  header('Content-Type: application/json');
  
  $join = (isset($_REQUEST['t'])) ? '
    left join divisionPlayer dP on dP.player_id = p.id 
    left join tournamentDivision tD on dP.tournamentDivision_id = tD.id' : '';
  $join .= ' left join gender g on p.gender_id = g.id';
    
  $where = ' where';
  $where .= (isset($_REQUEST['id'])) ? ' p.id = '.$_REQUEST['id'] : ' 1';
  $where .= (isset($_REQUEST['t'])) ? ' and tD.tournamentEdition_id = '.$_REQUEST['t'] : ' and 1';
    
  $query = 'select concat(p.firstName," ",p.lastName) as name, p.*, g.name as gender from player p'.$join.$where.' order by p.firstName, p.lastName';
    
  $objs = (array) getObjects($dbh, 'player', $query);

  print json_encode(array_values(geoFilter($objs)));
?>