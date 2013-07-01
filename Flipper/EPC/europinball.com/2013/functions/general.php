<?php
  define('__ROOT__', dirname(dirname(__FILE__))); 
  require_once(__ROOT__.'/functions/db.php');
  require_once(__ROOT__.'/functions/header.php');
  require_once(__ROOT__.'/contrib/ulogin/config/all.inc.php');
  require_once(__ROOT__.'/contrib/ulogin/main.inc.php');
  require_once(__ROOT__.'/functions/auth.php');
  

  $baseHref = 'https://www.europinball.org/2013';
  
  spl_autoload_register(function($class) { // Autoloading classes. To fix some day: For some reason, some of the classes require require_once:s - which they shouldn't. 
    if (is_file(__ROOT__.'/classes/'.$class.'.class.php')) {
      include __ROOT__.'/classes/'.$class.'.class.php';
    }
  });  
  
  $classes = (object) array(
    'continent' => (object) array(
      'name' => 'continent', 'geo' => true, 'plural' => 'continents', 
      'headers' => array('name', 'latitude', 'longitude'), // Headers normally used in tables and lists
      'fields' => (object) array(
        'name' => (object) array(
          'label' => 'Name',
          'type' => 'text',  
          'mandatory' => true,  
          'special' => false,  
          'bundle' => false,
          'insert' => true,
          'default' => ''
        ),
        'latitude' => (object) array(
          'label' => 'Latitude',
          'type' => 'text',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,  
          'insert' => true,
          'default' => ''
        ),
        'longitude' => (object) array(
          'label' => 'Longtitude',  
          'type' => 'text',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,  
          'insert' => true,
          'default' => ''
        )
      ),
      'complete' => false
    ),
    'country' => (object) array(
      'name' => 'country', 'geo' => true, 'plural' => 'countries',
      'headers' => array('name', 'continent', 'latitude', 'longitude'), // Headers normally used in tables and lists
      'fields' => (object) array(
        'name' => (object) array( 
          'label' => 'Name',  
          'type' => 'text',  
          'mandatory' => true,  
          'special' => false,  
          'bundle' => false,  
          'insert' => true,
          'default' => ''  
        ),
        'continent' => (object) array(
          'label' => 'Continent',  
          'type' => 'text',  
          'mandatory' => true,  
          'special' => false,  
          'insert' => true,
          'bundle' => false  
        ),
        'latitude' => (object) array(  
          'label' => 'Latitude',  
          'type' => 'text',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,  
          'insert' => true,
          'default' => ''  
        ),
        'longitude' => (object) array(  
          'label' => 'Longtitude',  
          'type' => 'text',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,  
          'insert' => true,
          'default' => ''
        )
      ),
      'complete' => false
    ),
    'region' => (object) array(
      'name' => 'region', 'geo' => true, 'plural' => 'regions',
      'headers' => array('name', 'country', 'continent', 'latitude', 'longitude'),  // Headers normally used in tables nd lists
      'fields' => (object) array(
        'name' => (object) array(  
          'label' => 'Name',  
          'type' => 'text',  
          'mandatory' => true,  
          'special' => false,  
          'bundle' => false,  
          'insert' => true,
          'default' => ''  
        ),
        'continent' => (object) array(  
          'label' => 'Continent',  
          'type' => 'text',  
          'mandatory' => true,  
          'special' => false,  
          'bundle' => 1  
        ),
        'country' => (object) array(  
          'label' => 'Country',  
          'type' => 'text',  
          'mandatory' => true,  
          'special' => false,  
          'bundle' => 1  
        ),
        'latitude' => (object) array(  
          'label' => 'Latitude',  
          'type' => 'text',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,  
          'insert' => true,
          'default' => ''  
        ),
        'longitude' => (object) array(  
          'label' => 'Longtitude',  
          'type' => 'text',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,  
          'insert' => true,
          'default' => ''
        )
      ),
      'complete' => false
    ),
    'city' => (object) array(
      'name' => 'city', 'geo' => true, 'plural' => 'cities',
      'headers' => array('name', 'region', 'country', 'continent', 'latitude', 'longitude'), // Headers normally used in tables and lists
      'fields' => (object) array(
        'name' => (object) array(  
          'label' => 'Name',  
          'type' => 'text',  
          'mandatory' => true,  
          'special' => false,  
          'bundle' => false,  
          'insert' => true,
          'default' => ''  
        ),
        'continent' => (object) array(  
          'label' => 'Continent',  
          'type' => 'text',  
          'mandatory' => true,  
          'special' => false,  
          'bundle' => 1  
        ),
        'country' => (object) array(  
          'label' => 'Country',  
          'type' => 'text',  
          'mandatory' => true,  
          'special' => false,  
          'bundle' => 1  
        ),
        'region' => (object) array(  
          'label' => 'Region',  
          'type' => 'text',  
          'mandatory' => true,  
          'special' => false,  
          'bundle' => 1  
        ),
        'latitude' => (object) array(  
          'label' => 'Latitude',  
          'type' => 'text',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,  
          'insert' => true,
          'default' => ''  
        ),
        'longitude' => (object) array(  
          'label' => 'Longtitude',  
          'type' => 'text',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,  
          'insert' => true,
          'default' => ''
        )
      ),
      'complete' => false
    ),
    'player' => (object) array(
      'name' => 'player', 'geo' => false, 'plural' => 'players', 
      'headers' => array('name', 'initials', 'city', 'region', 'country', 'continent'), // Headers normally used in tables and lists
      'fields' => (object) array(
        'id' => (object) array(  
          'label' => 'ID',  
          'type' => 'hidden',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,  
          'insert' => true,
          'default' => 0  
        ),
        'ifpa_id' => (object) array(  
          'label' => 'IFPA ID',  
          'type' => 'hidden',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,  
          'insert' => false,
          'default' => 0  
        ),
        'class' => (object) array(  
          'label' => 'Class',  
          'type' => 'hidden',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,  
          'insert' => false,
          'default' => 'player'  
        ),
        'isPlayer' => (object) array(  
          'label' => 'isPlayer',  
          'type' => 'hidden',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,  
          'insert' => false,
          'default' => true  
        ),
        'isPerson' => (object) array(  
          'label' => 'isPerson',  
          'type' => 'hidden',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,  
          'insert' => false,
          'default' => true  
        ),
        'isIfpa' => (object) array(  
          'label' => 'isIfpa',  
          'type' => 'hidden',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,  
          'insert' => false,
          'default' => true  
        ),
        'firstName' => (object) array(  
          'label' => 'First name',  
          'type' => 'text',  
          'mandatory' => true,  
          'special' => false,  
          'bundle' => false,  
          'insert' => true,
          'default' => ''  
        ),
        'lastName' => (object) array(  
          'label' => 'Last name',  
          'type' => 'text',  
          'mandatory' => true,  
          'special' => false,  
          'bundle' => false,  
          'insert' => true,
          'default' => ''  
        ),
        'initials' => (object) array(  
          'label' => 'Initials',  
          'type' => 'text',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,  
          'insert' => true,
          'default' => ''  
        ),
        'username' => (object) array(  
          'label' => 'Username',  
          'type' => 'text',  
          'mandatory' => true,  
          'special' => false,  
          'bundle' => false,  
          'insert' => false,
          'default' => ''  
        ),
        'password' => (object) array(  
          'label' => 'Password',  
          'type' => 'password',  
          'mandatory' => true,  
          'special' => false,  
          'bundle' => false,  
          'insert' => false,
          'default' => ''  
        ),
        'passwordRequired' => (object) array(  
          'label' => 'Password',  
          'type' => 'hidden',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,  
          'insert' => false,
          'default' => true  
        ),
        'gender' => (object) array(  
          'label' => 'Gender',  
          'type' => 'select',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,
          'insert' => true,
          'default' => ''
        ),
        'streetAddress' => (object) array(  
          'label' => 'Street address',  
          'type' => 'text',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,  
          'insert' => true,
          'default' => ''  
        ),
        'zipCode' => (object) array(  
          'label' => 'ZIP',  
          'type' => 'text',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,  
          'insert' => true,
          'default' => ''  
        ),
        'city' => (object) array(  
          'label' => 'City',  
          'type' => 'select',  
          'mandatory' => false,  
          'special' => 'add',  
          'bundle' => false,
          'insert' => true,
          'default' => ''  
        ),
        'region' => (object) array(  
          'label' => 'Region',  
          'type' => 'select',  
          'mandatory' => false,  
          'special' => 'add',  
          'bundle' => false,
          'insert' => true,
          'default' => ''  
        ),
        'country' => (object) array(  
          'label' => 'Country',  
          'type' => 'select',  
          'mandatory' => true,  
          'special' => false,  
          'bundle' => false,
          'insert' => true,
          'default' => ''  
        ),
        'continent' => (object) array(  
          'label' => 'Continent',  
          'type' => 'select',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,
          'insert' => true,
          'default' => ''            
        ),
        'telephoneNumber' => (object) array(  
          'label' => 'Phone',  
          'type' => 'text',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,  
          'insert' => true,
          'default' => ''  
        ),
        'mobileNumber' => (object) array(  
          'label' => 'Cell phone',  
          'type' => 'text',  
          'mandatory' => true,  
          'special' => false,  
          'bundle' => false,  
          'insert' => true,
          'default' => ''  
        ),
        'mailAddress' => (object) array(  
          'label' => 'Email',  
          'type' => 'text',  
          'mandatory' => true,  
          'special' => false,  
          'bundle' => false,  
          'insert' => true,
          'default' => ''  
        ),
        'main' => (object) array(  
          'label' => 'Main',  
          'type' => 'checkbox',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => 1,  
          'insert' => true,
          'default' => true  
        ),
        'classics' => (object) array(  
          'label' => 'Classics',  
          'type' => 'checkbox',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => 1,  
          'insert' => true,
          'default' => true  
        ),
        'volunteer' => (object) array(  
          'label' => 'Volunteer',  
          'type' => 'checkbox',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,  
          'insert' => true,
          'default' => true  
        ),
        'birthDate' => (object) array(  
          'label' => 'Birth date',  
          'type' => 'text',  
          'mandatory' => false,  
          'special' => 'date',  
          'bundle' => false,  
          'insert' => true,
          'default' => ''  
        ),
        'dateRegistered' => (object) array(  
          'label' => 'Date registered',  
          'type' => 'hidden',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,  
          'insert' => true,
          'default' => date('Y-m-d')
        )
      ),
      'complete' => false
    ),
    'gender' => (object) array(
      'name' => 'gender', 'geo' => false, 'plural' => 'genders', 
      'headers' => array('name'),
      'mandatory' => array('name'),
      'fields' => (object) array(
        'name' => (object) array(  
          'label' => 'Name',  
          'type' => 'text',  
          'mandatory' => true,  
          'special' => false,  
          'bundle' => false,  
          'insert' => true,
          'default' => ''  
        )
      ),
      'complete' => true
    )
  );
  
  $geoTypes = array('continent', 'country', 'region', 'city');
  $playerHeaders = array('firstName', 'lastName', 'username', 'password', 'initials', 'ifpa_id', 'gender', 'streetAddress', 'zipCode', 'city', 'region', 'country', 'continent', 'telephoneNumber', 'mobileNumber', 'mailAddress', 'dateRegistered', 'birthDate', 'main', 'classics', 'volunteer', 'id', 'comment');
  $playerLabels = array('First name', 'Last name', 'Username', 'Password', 'Initials (tag)', 'IFPA ID', 'Gender', 'Address', 'ZIP', 'City', 'Region', 'Country', 'Continent', 'Phone', 'Cell phone', 'E-mail', 'Date registered', 'Birth date', 'Main division', 'Classics division', 'Volunteer', 'ID', 'Comment');
  $playerTypes = array('text', 'text', 'text', 'text', 'text', 'text', 'select', 'text', 'text', 'select', 'select', 'select', 'select', 'text', 'text', 'text', 'text', 'text', 'checkbox', 'checkbox', 'checkbox', 'text', 'text');
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
  
  function getContinents($dbh, $where, $order = 'order by name') {
    $query = '
      select
        cn.id as id,
        cn.id as continent_id,
        "continent" as class,
        "continent" as type,
        cn.name as name,
        cn.latitude as latitude,
        cn.longitude as longitude,
        cn.comment as comment
      from continent cn
    '; 
    $where = preg_replace('/ id /', ' cn.id ', $where);
    $where = preg_replace('/ continent_id /', ' cn.id ', $where);
    $sth = $dbh->query($query.' '.$where.' '.$order);
    while ($obj = $sth->fetchObject('continent')) {
      $objs[] = $obj;
    }
    return $objs;
  }
  
  
  function getCountries($dbh, $where, $order = 'order by name') {
    $query = '
      select
        co.id as id,
        "country" as class,
        "country" as type,
        co.name as name,
        coPco.id as country_id,
        coPco.name as country,
        coPco.id as parentCountry_id,
        coPco.name as parentCountry,
        co.altName as altName,
        co.latitude as latitude,
        co.longitude as longitude,
        coalesce(coCn.id, coPcoCn.id) as continent_id,
        coalesce(coCn.name, coPcoCn.name) as continent,
        co.comment as comment
      from country co
      left join country coPco
        on co.parentCountry_id = coPco.id
      left join continent coCn
        on co.continent_id = coCn.id
      left join continent coPcoCn
        on coPco.continent_id = coPcoCn.id
    '; 
    $where = preg_replace('/ id /', ' co.id ', $where);
    $where = preg_replace('/ country_id /', ' co.id ', $where);
    $where = preg_replace('/ parentCountry_id /', ' coPco.id ', $where);
    $where = preg_replace('/ continent_id /', ' coalesce(coCn.id, coPcoCn.id) ', $where);
    $sth = $dbh->query($query.' '.$where.' '.$order);
    while ($obj = $sth->fetchObject('country')) {
      $objs[] = $obj;
    }
    return $objs;
  }
  
  function getRegions($dbh, $where, $order = 'order by name') {
    $query = '
      select
        r.id as id,
        "region" as class,
        "region" as type,
        r.name as name,
        rPr.id as region_id,
        rPr.name as region,
        rPr.id as parentRegion_id,
        rPr.name as parentRegion,
        r.altName as altName,
        r.latitude as latitude,
        r.longitude as longitude,
        coalesce(rCo.id, rCoPco.id, rPrCo.id, rPrCoPco.id) as country_id,
        coalesce(rCo.name, rCoPco.name, rPrCo.name, rPrCoPco.name) as country,
        coalesce(rCoPco.id, rPrCoPco.id) as parentCountry_id,
        coalesce(rCoPco.name, rPrCoPco.name) as parentCountry,
        coalesce(rCn.id, rCoCn.id, rCoPcoCn.id, rPrCn.id, rPrCoCn.id, rPrCoPcoCn.id) as continent_id,
        coalesce(rCn.name, rCoCn.name, rCoPcoCn.name, rPrCn.name, rPrCoCn.name, rPrCoPcoCn.name) as continent,
        r.comment as comment
      from region r
      left join region rPr
        on r.parentRegion_id = rPr.id
      left join country rCo
        on r.country_id = rCo.id
      left join country rCoPco
        on rCo.parentCountry_id = rCoPco.id
      left join country rPrCo
        on rPr.country_id = rPrCo.id
      left join country rPrCoPco
        on rPrCo.parentCountry_id = rPrCoPco.id
      left join continent rCn
        on r.continent_id = rCn.id
      left join continent rCoCn
        on rCo.continent_id = rCoCn.id
      left join continent rCoPcoCn
        on rCoPco.continent_id = rCoPcoCn.id
      left join continent rPrCn
        on rPr.continent_id = rPrCn.id
      left join continent rPrCoCn
        on rPrCo.continent_id = rPrCoCn.id
      left join continent rPrCoPcoCn
        on rPrCoPco.continent_id = rPrCoPcoCn.id
    '; 
    $where = preg_replace('/ id /', ' r.id ', $where);
    $where = preg_replace('/ region_id /', ' r.id ', $where);
    $where = preg_replace('/ parentRegion_id /', ' rPr.id ', $where);
    $where = preg_replace('/ country_id /', ' coalesce(rCo.id, rCoPco.id, rPrCo.id, rPrCoPco.id) ', $where);
    $where = preg_replace('/ parentCountry_id /', ' coalesce(rCoPco.id, rPrCoPco.id) ', $where);
    $where = preg_replace('/ continent_id /', ' coalesce(rCn.id, rCoCn.id, rCoPcoCn.id, rPrCn.id, rPrCoCn.id, rPrCoPcoCn.id) ', $where);
    $sth = $dbh->query($query.' '.$where.' '.$order);
    while ($obj = $sth->fetchObject('region')) {
      $objs[] = $obj;
    }
    return $objs;
  }
  
  
  function getCities($dbh, $where, $order = 'order by name') {
    $query = '
      select
        c.id as id,
        "city" as class,
        "city" as type,
        c.name as name,
        c.altName as altName,
        c.latitude as latitude,
        c.longitude as longitude,
        coalesce(cR.id, cRPr.id) as region_id,
        coalesce(cR.name, cRPr.name) as region,
        cRPr.id as parentRegion_id,
        cRPr.name as parentRegion,
        coalesce(cCo.id, cCoPco.id, cRCo.id, cRCoPco.id, cRPrCo.id, cRPrCoPco.id) as country_id,
        coalesce(cCo.name, cCoPco.name, cRCo.name, cRCoPco.name, cRPrCo.name, cRPrCoPco.name) as country,
        coalesce(cCoPco.id, cRCoPco.id, cRPrCoPco.id) as parentCountry_id,
        coalesce(cCoPco.name, cRCoPco.name, cRPrCoPco.name) as parentCountry,
        coalesce(cCn.id, cCoCn.id, cCoPcoCn.id, cRCn.id, cRCoCn.id, cRCoPcoCn.id, cRPrCn.id, cRPrCoCn.id, cRPrCoPcoCn.id) as continent_id,
        coalesce(cCn.name, cCoCn.name, cCoPcoCn.name, cRCn.name, cRCoCn.name, cRCoPcoCn.name, cRPrCn.name, cRPrCoCn.name, cRPrCoPcoCn.name) as continent,
        c.comment as comment
      from city c
      left join region cR
        on c.region_id = cR.id
      left join region cRPr
        on cR.parentRegion_id = cRPr.id
      left join country cCo
        on c.country_id = cCo.id
      left join country cCoPco
        on cCo.parentCountry_id = cCoPco.id
      left join country cRCo
        on cR.country_id = cRCo.id
      left join country cRCoPco
        on cRCo.parentCountry_id = cRCoPco.id
      left join country cRPrCo
        on cRPr.country_id = cRPrCo.id
      left join country cRPrCoPco
        on cRPrCo.parentCountry_id = cRPrCoPco.id
      left join continent cCn
        on c.continent_id = cCn.id
      left join continent cCoCn
        on cCo.continent_id = cCoCn.id
      left join continent cCoPcoCn
        on cCoPco.continent_id = cCoPcoCn.id
      left join continent cRCn
        on cR.continent_id = cRCn.id
      left join continent cRCoCn
        on cRCo.continent_id = cRCoCn.id
      left join continent cRCoPcoCn
        on cRCoPco.continent_id = cRCoPcoCn.id
      left join continent cRPrCn
        on cRPr.continent_id = cRPrCn.id
      left join continent cRPrCoCn
        on cRPrCo.continent_id = cRPrCoCn.id
      left join continent cRPrCoPcoCn
        on cRPrCoPco.continent_id = cRPrCoPcoCn.id
    ';
    $where = preg_replace('/ id /', ' c.id ', $where);
    $where = preg_replace('/ city_id /', ' c.id ', $where);
    $where = preg_replace('/ region_id /', ' coalesce(cR.id, cRPr.id) ', $where);
    $where = preg_replace('/ parentRegion_id /', ' cRPr.id ', $where);
    $where = preg_replace('/ country_id /', ' coalesce(cCo.id, cCoPco.id, cRCo.id, cRCoPco.id, cRPrCo.id, cRPrCoPco.id) ', $where);
    $where = preg_replace('/ parentCountry_id /', ' coalesce(cCoPco.id, cRCoPco.id, cRPrCoPco.id) ', $where);
    $where = preg_replace('/ continent_id /', ' coalesce(cCn.id, cCoCn.id, cCoPcoCn.id, cRCn.id, cRCoCn.id, cRCoPcoCn.id, cRPrCn.id, cRPrCoCn.id, cRPrCoPcoCn.id) ', $where);
    $sth = $dbh->query($query.' '.$where.' '.$order);
    while ($obj = $sth->fetchObject('city')) {
      $objs[] = $obj;
    }
    return $objs;
  }
  
  function getPlayerJoin() {
    return '
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
        on pR.parentRegion_id = pRPr.id
      left join region pCR
        on pC.region_id = pCR.id
      left join region pCRPr
        on pCR.parentRegion_id = pCRPr.id
      left join country pCo
        on p.country_id = pCo.id
      left join country pCoPco
        on pCo.parentCountry_id = pCoPco.id
      left join country pCCo
        on pC.country_id = pCCo.id
      left join country pCCoPco
        on pCCo.parentCountry_id = pCCoPco.id
      left join country pRCo
        on pR.country_id = pRCo.id
      left join country pRCoPco
        on pRCo.parentCountry_id = pRCoPco.id
      left join country pRPrCo
        on pRPr.country_id = pRPrCo.id
      left join country pRPrCoPco
        on pRPrCo.parentCountry_id = pRPrCoPco.id
      left join country pCRCo
        on pCR.country_id = pCRCo.id
      left join country pCRCoPco
        on pCRCo.parentCountry_id = pCRCoPco.id
      left join country pCRPrCo
        on pCRPr.country_id = pCRPrCo.id
      left join country pCRPrCoPco
        on pCRPrCo.parentCountry_id = pCRPrCoPco.id
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
        on pCRPr.continent_id = pCRPrCn.id
      left join continent pCRPrCoCn
        on pCRPrCo.continent_id = pCRPrCoCn.id
      left join continent pCRPrCoPcoCn
        on pCRPrCoPco.continent_id = pCRPrCoPcoCn.id
      left join gender g
        on p.gender_id = g.id
      left join tournamentDivision mT
        on m.tournamentDivision_id = mT.id
      left join tournamentDivision clT
        on cl.tournamentDivision_id = clT.id
      left join tournamentEdition e
        on (mT.tournamentEdition_id = e.id or clT.tournamentEdition_id = e.id or v.tournamentEdition_id = e.id) and e.id = 1 
    ';
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
        coalesce(pR.id, pRPr.id, pCR.id, pCRPr.id) as region_id,
        coalesce(pR.name, pRPr.name, pCR.name, pCRPr.name) as region,
        coalesce(pRPr.id, pCRPr.id) as parentRegion_id,
        coalesce(pRPr.name, pCRPr.name) as parentRegion,
        coalesce(pCo.id, pCoPco.id, pRCo.id, pRCoPco.id, pRPrCo.id, pRPrCoPco.id, pCCo.id, pCCoPco.id, pCRCo.id, pCRCoPco.id, pCRPrCo.id, pCRPrCoPco.id) as country_id,
        coalesce(pCo.name, pCoPco.name, pRCo.name, pRCoPco.name, pRPrCo.name, pRPrCoPco.name, pCCo.name, pCCoPco.name, pCRCo.name, pCRCoPco.name, pCRPrCo.name, pCRPrCoPco.name) as country,
        coalesce(pCoPco.id, pRCoPco.id, pRPrCoPco.id, pCCoPco.id, pCRCoPco.id, pCRPrCoPco.id) as parentCountry_id,
        coalesce(pCoPco.name, pRCoPco.name, pRPrCoPco.name, pCCoPco.name, pCRCoPco.name, pCRPrCoPco.name) as parentCountry,
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
        e.id as tournamentEdition_id,
        p.username as username,
        if(p.password is null,1,0) as passwordRequired
      from person p 
    '; 
    $query .= getPlayerJoin();
    $where = preg_replace('/ tournamentEdition_id /', ' mT.tournamentEdition_id ', $where);
    $where = preg_replace('/ id /', ' p.id ', $where);
    $where = preg_replace('/ city_id /', ' pC.id ', $where);
    $where = preg_replace('/ region_id /', ' coalesce(pR.id, pRPr.id, pCR.id, pCRPr.id) ', $where);
    $where = preg_replace('/ parentRegion_id /', ' coalesce(pRPr.id, pCRPr.id) ', $where);
    $where = preg_replace('/ country_id /', ' coalesce(pCo.id, pCoPco.id, pRCo.id, pRCoPco.id, pRPrCo.id, pRPrCoPco.id, pCCo.id, pCCoPco.id, pCRCo.id, pCRCoPco.id, pCRPrCo.id, pCRPrCoPco.id) ', $where);
    $where = preg_replace('/ parentCountry_id /', ' coalesce(pCoPco.id, pRCoPco.id, pRPrCoPco.id, pCCoPco.id, pCRCoPco.id, pCRPrCoPco.id) ', $where);
    $where = preg_replace('/ continent_id /', ' coalesce(pCn.id, pCoCn.id, pCoPcoCn.id, pRCn.id, pRCoCn.id, pRCoPcoCn.id, pRPrCn.id, pRPrCoCn.id, pRPrCoPcoCn.id, pCCn.id, pCCoCn.id, pCCoPcoCn.id, pCRCn.id, pCRCoCn.id, pCRCoPcoCn.id, pCRPrCn.id, pCRPrCoCn.id, pCRPrCoPcoCn.id) ', $where);
//    echo($query.' '.$where.' '.$order);
    $sth = $dbh->query($query.' '.$where.' '.$order);
    while ($obj = $sth->fetchObject('player')) {
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
    
  function addGeo($dbh, $geoType, $name, $parentType = null, $parentId = null) {
    $update[':name'] = $name;
    $query = 'insert into '.$geoType.' set name = :name';
    if ($parentType && $parentId) {
      $update[':parentId'] = $parentId;
      $query .= ', '.$parentType.'_id = :parentId';
    }
    echo $query;
    $sth = $dbh->prepare($query);
    $sth->execute($update);
    return $dbh->lastInsertId();
  }
  
  function updateGeo($dbh, $geoType, $id, $parentArray){
    $update[':id'] = $id;
    $update[':parentId'] = $parentArray[1];
    $query = 'update '.$geoType.' set '.$parentArray[0].'_id = :parentId where id = :id';
    echo $query;
    $sth = $dbh->prepare($query);
    $sth->execute($update);
  }
  
  function addPlayerGeo($dbh, $player) {
    global $geoTypes;
    $update = false;
    foreach ($geoTypes as $geoType) {
      var_dump('run:');
      var_dump($geotype);
      var_dump($player->{$geoType});
      var_dump($player->{$geoType.'_id'});
      var_dump($parentType);
      var_dump($parentId);
      var_dump($update);
      if (preg_match('/^[0-9]+$/', $player->{$geoType})) {
        $geoId = $player->{$geoType};
        if ($update) {
          updateGeo($dbh, $geoType, $geoId, $update);
          $update = false;
        }
      } else if (preg_match('/.+/', $player->{$geoType})){
        $geoId = addGeo($dbh, $geoType, $player->{$geoType}, $parentType, $parentId);
        if ($update) {
          updateGeo($dbh, $geoType, $geoId, $update);
        }
        $update = array($geoType, $geoId);
      }
      $player->{$geoType.'_id'} = $geoId;
      $parentType = $geoType;
      $parentId = $geoId;
    }
    return $player;
  }
  
  function addPlayerQuery($dbh, $player, $type = 'player', $division = 1) {
    global $classes;
    $query = 'insert into '.$type.' set';
    foreach($classes->player->fields as $value => $meta) {
      if ($player->{$value}) {
        switch ($meta->type) {
          case 'select':
            if ($type != 'volunteer') {
              if (preg_match('/^[0-9]+$/', $player->{$value})) {
                $id = $player->{$value};
              } else if (preg_match('/^[0-9]+$/', $player->{$value.'_id'})) {
                $id = $player->{$value.'_id'};
              }
              $update[':'.$value] = $id;
              $query .= ' '.$value.'_id = :'.$value.',';
            }
          break;
          case 'hidden':
          case 'text':
            if ($meta->insert) {
              if ($value == 'id') {
                $field = 'person_id';
              } else {
                $field = $value;
              }
              $update[':'.$field] = $player->{$value};
              $query .= ' '.$field.' = :'.$field.',';
            }
          break;
        }
      }
    }
    switch ($type) {
      case 'player':
        $query .= ' tournamentDivision_id = :division';
        $update[':division'] = $division;
      break;
      case 'volunteer':
        $query .= ' tournamentEdition_id = :division';
        $update[':division'] = $division;
      break;
    }
    return array(rtrim($query, ','), $update);
  }
  
  function addPlayer($dbh, $player) {
    $player = addPlayerGeo($dbh, $player);
    var_dump($player);
    if ($player->id == '0') {
      $player->id = addPerson($dbh, $player);
    } 
    if ($player->username && $player->password) {
      updateUser($dbh, $player);
    }
    foreach(array('main', 'classics') as $division) {
      if ($player->{$division} == 'true') {
        $query = addPlayerQuery($dbh, $player, 'player', (($division == 'main') ? 1 : 2));
        var_dump($query);
        $sth = $dbh->prepare($query[0]);
        $sth->execute($query[1]);
      }
    }
    if ($player->volunteer == 'true') {
      addVolunteer($dbh, $player, 1);
    }
  }
  
  function addPerson($dbh, $player) {
    $query = addPlayerQuery($dbh, $player, 'person');
    $sth = $dbh->prepare($query[0]);
    var_dump($query);
    $sth->execute($query[1]);
    return $dbh->lastInsertId();
  }
  
  function addVolunteer($dbh, $player, $tournament) {
    $query = addPlayerQuery($dbh, $player, 'volunteer', $tournament);
    $sth = $dbh->prepare($query[0]);
    var_dump($query);
    $sth->execute($query[1]);
    return $dbh->lastInsertId();
  }
  
  function updateUser($dbh, $player){
    $query = 'update person p set p.username = :username,';
    $query .= ' password = :password';
    $query .= ' where p.id = :playerId';
    $update[':username'] = $player->username;
    $update[':password'] = encrPass($player->password, $player->username);
    $update[':playerId'] = $player->id;
    $sth = $dbh->prepare($query);
    $sth->execute($update);
    $ulogin = new uLogin('appLogin', 'appLoginFail');
    $ulogin->CreateUser($player->username,  $player->password);
  }
  
  function getIfpaIds($dbh, $where = 'where p.ifpa_id is not null', $order = 'order by ifpa_id asc') {
    $query = 'select p.id, p.ifpa_id from person p'.getPlayerJoin();
    $sth = $dbh->query($query.' '.$where.' '.$order);
    var_dump($query);
    while ($obj = $sth->fetchObject()) {
      $objs[] = $obj;
    }
    return $objs;
  }
  
  function salt($ind = null){
    return 'qcy0UPy5g4jC'.$ind;
  }
  
  function encrPass($pass, $ind = null, $salt = null) {
    $salt = ($salt) ? $salt : salt($ind);
    return sha1($salt.$pass);
  }
  
  function checkField($dbh, $field, $value, $id = 0) {
    switch ($field) {
      case 'username':
        if (!preg_match('/^[a-zA-Z0-9\-_]{3,32}$/', $value)) {
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
        if (!preg_match('/^[0-9 \-\+\(\)]{6,}$/', $value) && !$return) {
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
      if ($value == '' || checkdate(preg_replace('/00/','01',substr($value, 5,2)), preg_replace('/00/','01',substr($value, 8,2)), substr($value, 0,4))) {
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
        if (preg_match('/^[0-9]+$/', $value) && $value != 0) {
          $where = ' where id = "'.$value.'"';
          $query = 'select count(*) from '.$field.' '.$where;
          $sth = $dbh->query($query);
          if ($sth->fetchColumn() > 0) {
            $return = array(true, '{"valid":true,"reason":"'.ucfirst($field).' is OK!","field":"'.$field.'"}');
          } else {
            $return = array(false, '{"valid":false,"reason":"'.ucfirst($field).' ID '.$value.' doesn\'t exist!","field":"'.$field.'"}');
          }
        } else {
          if ($value || $value == 0) {
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
      case 'passwordRequired':
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