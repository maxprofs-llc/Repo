<?php
  require_once("db.php");
  
  spl_autoload_register(function($class) {
    if (is_file('../classes/'.$class.'.php')) {
      include '../classes/'.$class.'.php';
    } else if (is_file('classes/'.$class.'.php')) {
      include 'classes/'.$class.'.php';
    } else if (is_file($class.'.php')) {
      include $class.'.php';
    }
  });
  
  $geoTypes = array('continent', 'country', 'region', 'city');
  $playerHeaders = array('firstName', 'lastName', 'initials', 'gender', 'streetAddress', 'zipCode', 'telephoneNumber', 'mailAddress', 'birthDate', 'main', 'classics', 'comment');
  $playerLabels = array('First name', 'Last name', 'Initials (tag)', 'Gender', 'Address', 'ZIP', 'Phone', 'E-mail', 'Birth date', 'Main division', 'Classics division', 'Comment');
  $playerTypes = array('text', 'text', 'text', 'select', 'text', 'text', 'text', 'email', 'date', 'checkbox', 'checkbox', 'text');
  $debug = $_GET['debug'];
    
  function getObject($dbh, $class, $id) {
    $query = 'select * from '.$class.' where id = '.$id;
    $sth = $dbh->query($query);
    return $sth->fetchObject($class);
  }
  
  function getObjects($dbh, $class, $query) {
    $sth = $dbh->query($query);
    while ($obj = $sth->fetchObject($class)) {
      $obj->populate($dbh);
      $objs[] = $obj;
    }
    return $objs;
  }
    
  function getPlayerByIfpaId($dbh, $ifpaId, $type = null) {
    if(preg_match('/@/',$ifpaId)) {
      $type = 'email';
    } else if (preg_match('/^[0-9]{1,5}$/', $ifpaId)) {
      $type = 'ifpa';
    } else if (preg_match('/^[0-9 \-\+\(\)]{6,}$/',$ifpaId)) {
      $type = 'phone';
    } else if (preg_match('/^[a-zA-Z0-9 \-]{3}$/',$ifpaId)) {
      $type = 'tag';
    } else {
      $type = 'name';
    }
    $query = '
      select 
        p.id as id,
        if(p.id is not null,"person",if(l.id is not null,"player",null)) as type,
        coalesce(l.firstName, p.firstName) as firstName,
        coalesce(l.lastName, p.lastName) as lastName,
        trim(concat(ifnull(coalesce(l.firstName, p.firstName),"")," ",ifnull(coalesce(l.lastName, p.lastName),""))) as name,
        coalesce(l.initials, p.initials) as initials,
        coalesce(l.gender_id, p.gender_id) as gender_id,
        coalesce(l.streetAddress, p.streetAddress) as streetAddress,
        coalesce(l.zipCode, p.zipCode) as zipCode,
        coalesce(l.city_id, p.city_id) as city_id,
        coalesce(l.region_id, p.region_id) as region_id,
        coalesce(l.country_id, p.country_id) as country_id,
        coalesce(l.continent_id, p.continent_id) as continent_id,
        coalesce(l.telephoneNumber, p.telephoneNumber) as telephoneNumber,
        coalesce(l.mobileNumber, p.mobileNumber) as mobileNumber,
        coalesce(l.mailAddress, p.mailAddress) as mailAddress,
        coalesce(l.birthDate, p.birthDate) as birthDate,
        p.ifpa_id as ifpa_id,
        if(p.id is not null,1,0) as isPerson,
        if(l.id is not null,1,0) as isPlayer,
        p.username as username
      from person p 
      left join player l 
        on l.person_id = p.id and (l.tournamentDivision_id = 1 or l.tournamentDivision_id = 2) 
    '; 
    switch ($type) {
      case 'email':
        $where = ' where coalesce(l.mailAddress, p.mailAddress) = "'.$ifpaId.'"';
      break;
      case 'ifpa':
        $where = ' where p.ifpa_id = '.$ifpaId;
      break;
      case 'phone':
        $where = ' where replace(replace(replace(replace(replace(coalesce(l.telephoneNumber, p.telephoneNumber)," ",""),")",""),")",""),"-",""),"+","") like "%'.preg_replace('/[^0-9]/','',$ifpaId).'%" or replace(replace(replace(replace(replace(coalesce(l.mobileNumber, p.mobileNumber)," ",""),")",""),")",""),"-",""),"+","") like "%'.preg_replace('/[^0-9]/','',$ifpaId).'%"';
      break;
      case 'tag':
        $where = ' where coalesce(l.initials, p.initials) like "'.preg_replace('/ $/','',$ifpaId).'"';
      break;
      case 'name':
        $where = ' where concat(coalesce(l.firstName, p.firstName), " ", coalesce(l.lastName, p.lastName)) like "%'.$ifpaId.'%"';
      break;
    }
    // echo($query.$where);
    $sth = $dbh->query($query.$where);
    while ($obj = $sth->fetchObject('player')) {
      $obj->populate($dbh);
      $objs[] = $obj;
    }
    return $objs;
  } 
    
  function addPlayerGeo($dbh, $player) {
    global $geoTypes;
    foreach ($geoTypes as $geoType) {
      echo $geoType.' - '.$parentType.','.$parentId.' | ';
      if ($player->{$geoType}) {
        $geoId = addGeo($dbh, $geoType, $player->{$geoType}, $parentType, $parentId);
      }
      if ($player->{$geoType."_id"}) {
        $parentType = $geoType;
        $parentId = $player->{$geoType."_id"};
      }
    }
    $player->{$geoType."_id"} = $geoId;
    return $player;
  }
  
  function addPlayer($dbh, $player) {
    global $geoTypes;
    global $playerHeaders;
    $player = addPlayerGeo($dbh, $player);
    $query = 'insert into player set ';
    foreach($playerHeaders as $field) {
      if ($player->$field && $field != 'main' && $field != 'classics') {
        $query .= '`'.(($field == 'gender') ? $field.'_id' : $field).'`="'.$player->$field.'",'; 
      }
    }
    $query = rtrim($query,',');
    $sth = $dbh->prepare($query);
    $sth->execute();
    $player->id = $dbh->lastInsertId();
    if ($player->main == 'on') {
      $query = 'insert into divisionPlayer set name="'.$player->initials.'", tournamentDivision_id=1, player_id='.$player->id.';';
      $sth = $dbh->prepare($query);
      $sth->execute();
    }
    if ($player->classics == 'on') {
      $query = 'insert into divisionPlayer set name="'.$player->initials.'", tournamentDivision_id=2, player_id='.$player->id.';';
      $sth = $dbh->prepare($query);
      $sth->execute();
    }
    
  }
  
  function addGeo($dbh, $geoType, $name, $parentType = null, $parentId = null) {
    $query = 'insert into '.$geoType.' set name="'.$name.'"';
    $query .= ($parentType) ? ', '.$parentType.'_id="'.$parentId.'"' : '';
    echo $query;
    $sth = $dbh->prepare($query);
    $sth->execute();
    return $dbh->lastInsertId();
  }
  
  function geoFilter($objs) {
    foreach(array('city', 'region', 'country', 'continent') as $type) {
      if (isset($_REQUEST[$type.'_id'])) {
        $cmp = cmpGeo($type, $_REQUEST[$type.'_id'], true);
        $objs = array_filter($objs, $cmp);
      }
    }
    debug($objs);
    return $objs;
  }
  
  function cmpGeo($attr, $id, $type = true) {
    debug('A: '.$attr.' ID: '.$id.' T: '.$type."\n<br />");
    return function($obj) use($attr, $id, $type) { 
      return ($obj->{$attr.'_id'} == $id) ? $type : !$type; 
    };
  }    
  
  function cmpOption($id, $type = true) {
    return function($obj) use($id, $type) { 
      return ($obj->id == $id) ? $type : !$type; 
    };
  }
  
  function cmpField($value, $type = true) {
    return function($obj) use($value, $type) { 
      return ($obj->value == $value) ? $type : !$type; 
    };
  }
  
  function locate($dbh, $obj, $type) {
    switch ($type) {
      case 'city':
        $obj->city = (isset($obj->city_id)) ? getObject($dbh, 'city', $obj->city_id) : null;
        locate($dbh, $obj, 'region');
        break;
      case 'region':
        $obj->region_id = (isset($obj->region_id)) ? $obj->region_id : ((isset($obj->city->region_id)) ? $obj->city->region_id : null);
        $obj->region = (isset($obj->region_id)) ? getObject($dbh, 'region', $obj->region_id) : null;
        locate($dbh, $obj, 'country');
      break;
      case 'country':
      debug('LOCATE');
        $obj->country_id = (isset($obj->country_id)) ? $obj->country_id : ((isset($obj->city->country_id)) ? $obj->city->country_id : ((isset($obj->region->country_id)) ? $obj->region->country_id : null));
        $obj->country = (isset($obj->country_id)) ? getObject($dbh, 'country', $obj->country_id) : null;
        locate($dbh, $obj, 'continent');
      break;
      case 'continent':
        $obj->continent_id = (isset($obj->continent_id)) ? $obj->continent_id : ((isset($obj->city->continent_id)) ? $obj->city->continent_id : ((isset($obj->region->continent_id)) ? $obj->region->continent_id : ((isset($obj->country->continent_id)) ? $obj->country->continent_id : null)));
        $obj->continent = (isset($obj->continent_id)) ? getObject($dbh, 'continent', $obj->continent_id) : null; 
      break;
    }
  }
    
	function error ($code, $txt) {
    die ("Error! ".$code.": ".$txt);
  }
  
  function debug ($txt) {
    global $debug;
    if ($debug) {
      echo $txt."\n</br>\n";      
    }
  }
  
  function getPlural($text) {
    $plurals = array(
      'player' => 'players',
      'city' => 'cities',
      'region' => 'regions',
      'country' => 'countries',
      'continent' => 'continents',      
    );
    return $plurals[$text];    
  }
  
?>