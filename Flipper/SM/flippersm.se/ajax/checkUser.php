<?php
  require_once('../functions/general.php');
  
  $where = ' where username = "'.$_REQUEST['u'].'"';
  if ($_REQUEST['id'] && $_REQUEST['id'] != 0) {
    $where .= ' and id != '.$_REQUEST['id'];
  }
  
  $query = 'select count(*) from person '.$where;
  
  $sth = $dbh->query($query);
  
  if ($sth->fetchColumn() > 0) {
    echo(' Username is already taken!');
  } else {
    echo(' Username is up for grabs!');
  }
    
?>