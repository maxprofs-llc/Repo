<?php

  define('__ROOT__', dirname(__FILE__)); 
  require_once(__ROOT__.'/functions/general.php');

  $obj = new city(1907);
//  $obj = new country(188);

//  $country = new country(188);
//  $obj = $country->getLocations();
  
//  $tournament = new tournament(1);
//  $obj = $tournament->getDivisions();
  
// $obj = new person(array('ifpa_id' => '27', 'mailAddress' => 'the@pal.pp.se'), true);
// $obj = new player(array('ifpa_id' => '27', 'mailAddress' => 'the@pal.pp.se'), true);

// $obj = new person('27', 'ifpa_id');
// $obj = new player('27', 'ifpa_id');
 $objs = new player(1645);
 
echo "P".property_exists($this, '$arrClass')
echo " A".$this->arrClass;
echo " A2".player::arrClass;
 preDump(player::$instances);

/*
echo 'hej';
foreach($objs as $obj) {
/*
  echo '<br><br>';
  echo ($obj->id) ? $obj->id.': '.$obj->firstName.' '.$obj->lastName : 'No ID';  
  */
/*
  preDump($obj);
  preDump($obj->getFlat());
  preDump($obj);
  echo(json_encode($obj));
  preDump($obj);
  $obj->flatten();
  preDump($obj);
}
*/

?> 