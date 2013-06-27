<?php
  require_once('functions/header.php');
  printHeader('EPC 2013'); 
  printTopper();
  echo ('
      <span style="cursor: pointer;" onClick="getJson(\'ajax/listPlayers.php\', \'id=1\', \'player\');">Players!</span>
      <table id="player"></table>
      <span style="cursor: pointer;" onClick="getJson(\'ajax/listCities.php\', \'id=1\', \'city\');">Cities!</span>
      <table id="city"></table>
      <span style="cursor: pointer;" onClick="getJson(\'ajax/listRegions.php\', \'id=1\', \'region\');">Regions!</span>
      <table id="region"></table>
      <span style="cursor: pointer;" onClick="getJson(\'ajax/listCountries.php\', \'id=1\', \'country\');">Countries!</span>
      <table id="country"></table>
      <span style="cursor: pointer;" onClick="getJson(\'ajax/listContinents.php\', \'id=1\', \'continent\');">Continents!</span>
      <table id="continent"></table>
  ');
  printFooter();
?>
