<?php
  require_once('functions/general.php');
  require_once('functions/header.php');
  printHeader('EPC 2013');
  $type = str_replace('.php', '', basename($_SERVER['SCRIPT_NAME']));
  $start = false;
  foreach($geoTypes as $field) {
    if ($start || $type == $field) {
      $start = true;
      $content .= '
        <div id="'.$field.'Div">
          <h3 id="'.$field.'H3">'.ucfirst(getPlural($field)).'</h3>
          <span id="'.$field.'Loading"><img src="images/ajax-loader.gif" alt="Loading data..."></span>
          <table id="'.$field.'Table" class="list"></table>
          <span id="'.$field.'All" class="getAll"></span>
          <br />
        </div>
      ';
    }
  }
  $content .= '
        <div id="playerDiv">
          <h3 id="playerH3">'.ucfirst(getPlural('player')).'</h3>
          <span id="playerLoading"><img src="images/ajax-loader.gif" alt="Loading data..."></span>
          <table id="playerTable" class="list"></table>
          <span id="playerAll" class="getAll"></span>
          <br />
          <button text="hej" onclick="popTbls();">Hej</button>
        </div>
  ';
  
  printTopper('getObjects();');
  echo($content);
  printFooter();
?>
