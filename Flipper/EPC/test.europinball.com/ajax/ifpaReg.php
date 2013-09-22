<?php
  require_once('../functions/general.php');
  
  $player = getPlayerByIfpaId($dbh, $_REQUEST['ifpaId']);

  print json_encode($player);

?>