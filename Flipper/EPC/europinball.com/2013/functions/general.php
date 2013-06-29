<?php
  require_once("db.php");
  
  spl_autoload_register(function($class) { // Autoloading classes. To fix some day: For some reason, some of the classes require require_once:s - which they shouldn't. 
    if (is_file('../classes/'.$class.'.class.php')) {
      include '../classes/'.$class.'.class.php';
    } else if (is_file('classes/'.$class.'.class.php')) {
      include 'classes/'.$class.'.class.php';
    } else if (is_file($class.'.class.php')) {
      include $class.'.class.php';
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
    
  // Validate an email address. Returns true if the email address has the email address format and the domain exists.
  function validEmail($email) {
    $isValid = true;
    $atIndex = strrpos($email, "@"); // Let's split it to make life easier
    if (is_bool($atIndex) && !$atIndex) {
      $isValid = false; // No @!
    } else {
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      if ($localLen < 1 || $localLen > 64) {
        $isValid = false; // Local part length exceeded
      } else if ($domainLen < 1 || $domainLen > 255) {
        $isValid = false; // Domain part length exceeded
      } else if ($local[0] == '.' || $local[$localLen-1] == '.') {
        $isValid = false; // Local part starts or ends with '.'
      } else if (preg_match('/\\.\\./', $local)) {
        $isValid = false; // Local part has two consecutive dots
      } else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain)) {
        $isValid = false; // Character not valid in domain part
      } else if (preg_match('/\\.\\./', $domain)) {
        $isValid = false; // Domain part has two consecutive dots
      } else if (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\","",$local))) {
        if (!preg_match('/^"(\\\\"|[^"])+"$/', str_replace("\\\\","",$local))) {
          $isValid = false;// Character not valid in local part unless local part is quoted
        }
      }
      if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A"))) {
        $isValid = false; // domain not found in DNS
      }
    }
    return $isValid;
  }
  
  function getRegions($dbh, $where, $order = 'order by r.name') {
    $query = '
      select
        r.id as id,
        r.name as name,
        r.altName as altName,
        r.latitude as latitude,
        r.longitude as longitude,
        coalesce(co.id, pRCo.id) as country_id,
        coalesce(co.name, pRCo.name) as country,
        coalesce(cn.id, rRCn.id, coCn.id) as continent_id,
        coalesce(cn.name, rRCn.name, coCn.name) as continent,
        c.comment as comment
      from city c
      left join parentRegion pR
        on c.parentRegion_id = pR.id
      left join country co
        on c.country_id = co.id
      left join country pRCo
        on pR.country_id = pRCo.id
      left join continent cn
        on c.continent_id = cn.id
      left join continent pRCn
        on pR.continent_id = pRCn.id
      left join continent coCn
        on co.continent_id = coCn.id
    '; 
    $sth = $dbh->query($query.' '.$where.' '.$order);
    while ($obj = $sth->fetchObject('city')) {
//      $obj->populate($dbh);
      $objs[] = $obj;
    }
    return $objs;
  }
  
  function getCities($dbh, $where, $order = 'order by c.name') {
    $query = '
      select
        c.id as id,
        c.name as name,
        c.altName as altName,
        r.id as region_id,
        r.name as region,
        r.latitude as latitude,
        r.longitude as longitude,
        coalesce(co.id, rCo.id) as country_id,
        coalesce(co.name, rCo.name) as country,
        coalesce(cn.id, rCn.id, coCn.id) as continent_id,
        coalesce(cn.name, rCn.name, coCn.name) as continent,
        c.comment as comment
      from city c
      left join region r
        on c.region_id = r.id
      left join country co
        on c.country_id = co.id
      left join country rCo
        on r.country_id = rCo.id
      left join continent cn
        on c.continent_id = cn.id
      left join continent rCn
        on r.continent_id = rCn.id
      left join continent coCn
        on co.continent_id = coCn.id
    '; 
    $sth = $dbh->query($query.' '.$where.' '.$order);
    while ($obj = $sth->fetchObject('city')) {
//      $obj->populate($dbh);
      $objs[] = $obj;
    }
    return $objs;
  }
  
  function getPlayers($dbh, $where, $order = 'order by p.firstName, p.lastName') {
    $query = '
      select 
        p.id as id,
        "player" as class,
        "player" as type,
        p.firstName as firstName,
        p.lastName as lastName,
        trim(concat(ifnull(p.firstName,"")," ",ifnull(p.lastName,""))) as name,
        p.initials as initials,
        g.id as gender_id,
        g.name as gender,
        p.streetAddress as streetAddress,
        p.zipCode as zipCode,
        pC.id as city_id,
        pC.name as city,
        coalesce(pR.id, pRPr.id, pCR.id, pCRpR.id) as region_id,
        coalesce(pR.name, pRPr.name, pCR.name, pCRpR.name) as region,
        coalesce(pCo.id, pCoPco.id, pRCo.id, pRCoPco.id, pRPrCo.id, pRPrCoPco.id, pCCo.id, pCCoPco.id, pCRCo.id, pCRCoPco.id, pCRPrCo.id, pCRPrCoPco.id) as country_id,
        coalesce(pCo.name, pCoPco.name, pRCo.name, pRCoPco.name, pRPrCo.name, pRPrCoPco.name, pCCo.name, pCCoPco.name, pCRCo.name, pCRCoPco.name, pCRPrCo.name, pCRPrCoPco.name) as country,
        coalesce(pCn.id, pCoCn.id, pCoPcoCn.id, pRCn.id, pRCoCn.id, pRCoPcoCn.id, pRPrCn.id, pRPrCoCn.id, pRPrCoPcoCn.id, pCCn.id, pCCoCn.id, pCCoPcoCn.id, pCRCn.id, pCRCoCn.id, pCRCoPcoCn.id, pCRPrCn.id, pCRPrCoCn.id, pCRPrCoPcoCn.id) as continent_id,
        coalesce(pCn.name, pCoCn.name, pCoPcoCn.name, pRCn.name, pRCoCn.name, pRCoPcoCn.name, pRPrCn.name, pRPrCoCn.name, pRPrCoPcoCn.name, pCCn.name, pCCoCn.name, pCCoPcoCn.name, pCRCn.name, pCRCoCn.name, pCRCoPcoCn.name, pCRPrCn.name, pCRPrCoCn.name, pCRPrCoPcoCn.name) as continent,
        p.telephoneNumber as telephoneNumber,
        p.mobileNumber as mobileNumber,
        p.mailAddress as mailAddress,
        p.birthDate as birthDate,
        p.ifpa_id as ifpa_id,
        p.comment as comment,
        if(p.ifpa_id is not null,1,0) as isIfpa,
        null as password,
        if(p.id is not null,1,0) as isPerson,
        if(m.id is not null or cl.id is not null,1,0) as isPlayer,
        if(m.id is not null,1,0) as main,
        if(cl.id is not null,1,0) as classics,
        if(v.id is not null,1,0) as volunteer,
        p.username as username
      from person p 
      left join player m
        on m.person_id = p.id and m.tournamentDivision_id = 1
      left join player cl
        on cl.person_id = p.id and cl.tournamentDivision_id = 2
      left join volunteer v 
        on v.person_id = p.id and v.tournamentEdition_id = 1 
      left join city pC
        on p.city_id = pC.id
      left join region pR
        on p.region_id = pR.id
      left join region pRPr
        on pR.parentregion_id = pRPr.id
      left join region pCR
        on pC.region_id = pCR.id
      left join region pCRpR
        on pCR.parentregion_id = pCRpR.id
      left join country pCo
        on p.country_id = pCo.id
      left join country pCoPco
        on pCo.parentcountry_id = pCoPco.id
      left join country pCCo
        on pC.country_id = pCCo.id
      left join country pCCoPco
        on pCCo.parentcountry_id = pCCoPco.id
      left join country pRCo
        on pR.country_id = pRCo.id
      left join country pRCoPco
        on pRCo.parentcountry_id = pRCoPco.id
      left join country pRPrCo
        on pRPr.country_id = pRPrCo.id
      left join country pRPrCoPco
        on pRPrCo.parentcountry_id = pRPrCoPco.id
      left join country pCRCo
        on pCR.country_id = pCRCo.id
      left join country pCRCoPco
        on pCRCo.parentcountry_id = pCRCoPco.id
      left join country pCRPrCo
        on pCRpR.country_id = pCRPrCo.id
      left join country pCRPrCoPco
        on pCRPrCo.parentcountry_id = pCRPrCoPco.id
      left join continent pCn
        on p.continent_id = pCn.id
      left join continent pCoCn
        on pCo.continent_id = pCoCn.id
      left join continent pCoPcoCn
        on pCoPco.continent_id = pCoPcoCn.id
      left join continent pCCn
        on pC.continent_id = pCCn.id
      left join continent pCCoCn
        on pCCo.continent_id = pCCoCn.id
      left join continent pCCoPcoCn
        on pCCoPco.continent_id = pCCoPcoCn.id
      left join continent pRCn
        on pR.continent_id = pRCn.id
      left join continent pRCoCn
        on pRCo.continent_id = pRCoCn.id
      left join continent pRCoPcoCn
        on pRCoPco.continent_id = pRCoPcoCn.id
      left join continent pRPrCn
        on pRPr.continent_id = pRPrCn.id
      left join continent pRPrCoCn
        on pRPrCo.continent_id = pRPrCoCn.id
      left join continent pRPrCoPcoCn
        on pRPrCoPco.continent_id = pRPrCoPcoCn.id
      left join continent pCRCn
        on pCR.continent_id = pCRCn.id
      left join continent pCRCoCn
        on pCRCo.continent_id = pCRCoCn.id
      left join continent pCRCoPcoCn
        on pCRCoPco.continent_id = pCRCoPcoCn.id
      left join continent pCRPrCn
        on pCRpR.continent_id = pCRPrCn.id
      left join continent pCRPrCoCn
        on pCRPrCo.continent_id = pCRPrCoCn.id
      left join continent pCRPrCoPcoCn
        on pCRPrCoPco.continent_id = pCRPrCoPcoCn.id
      left join gender g
        on p.gender_id = g.id
      left join tournamentDivision mT
        on m.tournamentDivision_id = mT.id
      left join tournamentDivision clT
        on m.tournamentDivision_id = clT.id
      left join tournamentDivision vT
        on m.tournamentDivision_id = vT.id
      left join tournamentEdition e
        on (mT.tournamentEdition_id = e.id or clT.tournamentEdition_id = e.id or v.tournamentEdition_id = e.id) and e.id = 1 
    '; 
//    echo($query.' '.$where.' '.$order);
    $sth = $dbh->query($query.' '.$where.' '.$order);
    while ($obj = $sth->fetchObject('player')) {
//      $obj->populate($dbh);
      $objs[] = $obj;
    }
    return $objs;
  }
  
  function getPlayerByIfpaId($dbh, $ifpaId, $type = null) {
    if(preg_match('/@/',$ifpaId)) {
      $where = 'where p.mailAddress = "'.$ifpaId.'"';
    } else if (preg_match('/^[0-9]{1,5}$/', $ifpaId)) {
      $where = 'where p.ifpa_id = '.$ifpaId;
    } else if (preg_match('/^[0-9 \-\+\(\)]{6,}$/',$ifpaId)) {
      $where = 'where replace(replace(replace(replace(replace(p.telephoneNumber," ",""),")",""),")",""),"-",""),"+","") like "%'.preg_replace('/[^0-9]/','',$ifpaId).'%" or replace(replace(replace(replace(replace(p.mobileNumber," ",""),")",""),")",""),"-",""),"+","") like "%'.preg_replace('/[^0-9]/','',$ifpaId).'%"';
    } else if (preg_match('/^[a-zA-Z0-9 \-]{3}$/',$ifpaId)) {
      $where = 'where p.initials like "'.preg_replace('/ $/','',$ifpaId).'"';
    } else {
      $where = 'where concat(ifnull(p.firstName,""), " ", ifnull(p.lastName,"")) like "%'.$ifpaId.'%"';
    }
    return getPlayers($dbh, $where);
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
  
  function checkField($dbh, $field, $value, $id = 0) {
    switch ($field) {
      case 'username':
        if (!preg_match('/[a-zA-Z0-9\-_]{3,32}/', $value)) {
          $return = array(false, '{"valid":false,"reason":"Username must be at least three character and can only include a-Z, A-Z, 0-9, dashes and underscores!","field":"'.$field.'"}');
        } else {
          $where = ' where username = "'.$value.'"';
          if ($id && $id != 0) {
            $where .= ' and id != '.$id;
          }
          $query = 'select count(*) from person '.$where;
          $sth = $dbh->query($query);
          if ($sth->fetchColumn() > 0) {
            $return = array(false, '{"valid":false,"reason":"Username is already taken!","field":"'.$field.'"}');
          } else {
            $return = array(true, '{"valid":true,"reason":"Username is up for grabs (or unchanged)!","field":"'.$field.'"}');
          }
        }
      break;
      case 'mailAddress':
        if (!validEmail($value)) {
          $return = array(false, '{"valid":false,"reason":"Invalid mail address!","field":"'.$field.'"}');
        } else {
          $return = array(true, '{"valid":true,"reason":"Mail address is OK!","field":"'.$field.'"}');
        }
      break;
      case 'telephoneNumber':
        if ($value == '') {
          $return = array(true, '{"valid":true,"reason":"Phone number is OK!","field":"'.$field.'"}');
        }
      case 'mobileNumber':
        if (!preg_match('/^[0-9 \-\+\(\)]{6,}$/', $value)) {
          $return = array(false, '{"valid":false,"reason":"Please use only numbers, parantheses, spaces, dashes and plus signs!","field":"'.$field.'"}');
        } else {
          $return = array(true, '{"valid":true,"reason":"Phone number is OK!","field":"'.$field.'"}');
        }
      break;
      case 'firstName':
      case 'lastName':
      if ($value) {
          $return = array(true, '{"valid":true,"reason":"'.ucfirst($field).' is OK!","field":"'.$field.'"}');
        } else {
          $return = array(false, '{"valid":false,"reason":"'.ucfirst($field).' is required!","field":"'.$field.'"}');
        }
      break;
      case 'birthDate':
      case 'dateRegistered':
      if (checkdate(preg_replace('/00/','01',substr($value, 5,2)), preg_replace('/00/','01',substr($value, 8,2)), substr($value, 0,4)) || $value == '') {
          $return = array(true, '{"valid":true,"reason":"'.ucfirst($field).' is OK!","field":"'.$field.'"}');
        } else {
          $return = array(false, '{"valid":false,"reason":"Invalid date format - use ISO 8601 format: YYYY-MM-DD!","field":"'.$field.'"}');
        }
      break;
      case 'password':
        if (preg_match('/^(?=.*\d)(?=.*[A-Za-z])(?=.*[!@#$])[0-9A-Za-z!@#$]{6,50}$/', $value)) {
          $return = array(true, '{"valid":true,"reason":"Password is OK!","field":"'.$field.'"}');
        } else {
          $return = array(false, '{"valid":false,"reason":"Password is required to be at least 6 characters, including a number, a letter and one of !@#$"}');
        }
      break;
      case 'initials':
        if (preg_match('/^[a-zA-Z0-9 \-]{1,3}$/', $value) || $value == '') {
          $return = array(true, '{"valid":true,"reason":"Initials are OK!","field":"'.$field.'"}');
        } else {
          $return = array(false, '{"valid":false,"reason":"Initials can only be at most three characters without any strange ones!","field":"'.$field.'"}');
        }
      break;
      case 'city':
      case 'region':
      case 'country':
      case 'continent':
      case 'gender':
        if (preg_match('/^[0-9]+$/', $value)) {
          $where = ' where id = "'.$value.'"';
          $query = 'select count(*) from '.$field.' '.$where;
          $sth = $dbh->query($query);
          if ($sth->fetchColumn() > 0) {
            $return = array(true, '{"valid":true,"reason":"'.ucfirst($field).' is OK!","field":"'.$field.'"}');
          } else {
            $return = array(false, '{"valid":false,"reason":"'.ucfirst($field).' ID '.$value.' doesn\'t exist!","field":"'.$field.'"}');
          }
        } else {
          if ($value) {
            $return = array(true, '{"valid":true,"reason":"'.ucfirst($field).' is OK!","field":"'.$field.'"}');
          } else {
            $return = array(false, '{"valid":false,"reason":"'.ucfirst($field).' is required!","field":"'.$field.'"}');
          }
        }
      break;
      case 'streetAddress':
      case 'zipCode':
      case 'main':
      case 'id':
      case 'ifpa_id':
      case 'isPlayer':
      case 'isPerson':
      case 'isIfpa':
      case 'class':
      case 'classics':
      case 'volunteer':
        $return = array(true, '{"valid":true,"reason":"Not checked!","field":"'.$field.'"}');
      break;
      default:
        $return = array(false, '{"valid":false,"reason":"Unknown field!","field":"'.$field.'"}');
      break;
    }
    return $return;
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
    return $objs;
  }
  
  function cmpGeo($attr, $id, $type = true) {
//    debug('A: '.$attr.' ID: '.$id.' T: '.$type."\n<br />");
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