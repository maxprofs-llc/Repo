<?php
  require_once('functions/general.php');
  require_once('functions/header.php');
  
  $player = new player();
  foreach ($playerHeaders as $header) {
    $player->$header = $_REQUEST[$header];
  }
  foreach($geoTypes as $geoType) {
    if ($_REQUEST[$geoType.'AddText']) {
      $player->$geoType = $_REQUEST[$geoType.'AddText'];
    } else if ($_REQUEST[$geoType]) {
      $player->{$geoType.'_id'} = $_REQUEST[$geoType];
    }
  }
  addPlayer($dbh, $player);

  echo "\n<BR />\n";

?>