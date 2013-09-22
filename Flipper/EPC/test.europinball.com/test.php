<?php
  require_once('functions/general.php');
  printHeader('EPC 2013', __baseHref__);
  printTopper();
  /*
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
  */
  //   function whereBuilder($type = 'player', $objs = null, $where = null, $comp = ' = ', $quot = '"', $logic = 'and') {

    $defaultIdName = array(
      'id' => array(
        'column' => 'id',
        'where' => false
      ),
      'name' => array(
        'column' => 'name',
        'where' => false
      )
    );
    $objs = array(
      'gender' => $defaultIdName,
      'city' => $defaultIdName,
      'region' => $defaultIdName,
      'country' => $defaultIdName,
      'continent' => $defaultIdName,
      'tournamentDivision' => $defaultIdName,
      'tournamentEdition' => $defaultIdName
    );
      
    $objs = (object) array(
      'gender',
      'city',
      'region',
      'country',
      'continent',
      'tournamentDivision',
      'tournamentEdition'    
    );
      
    $obj = (object) array(
      'class' => 'player',
      'id' => '1'
    );
  
  echo '<pre>';
  var_dump(getParents($dbh, $obj));
  echo '</pre>';
  
  printFooter($dbh, $ulogin);
?>
