<?php
  define('__ROOT__', dirname(dirname(__FILE__))); 
  define('__baseHref__', 'https://test.europinball.org'); 
  require_once(__ROOT__.'/functions/db.php');
  require_once(__ROOT__.'/contrib/ulogin/config/all.inc.php');
  require_once(__ROOT__.'/contrib/ulogin/main.inc.php');
  require_once(__ROOT__.'/functions/auth.php');
  require_once(__ROOT__.'/functions/header.php');

  $baseHref = 'https://test.europinball.org';
  
  $exts = array('png', 'jpg', 'jpeg', 'jpg');

  spl_autoload_register(function($class) { // Autoloading classes. To fix some day: For some reason, some of the classes require require_once:s - which they shouldn't. 
    if (is_file(__ROOT__.'/classes/'.$class.'.class.php')) {
      include __ROOT__.'/classes/'.$class.'.class.php';
    }
  });  
  
  $classes = (object) array(
    'game' => (object) array(
      'name' => 'game', 'geo' => false, 'plural' => 'games', 'label' => 'Game', 'table' => 'game', 'column' => 'game_id',
      'headers' => array('name', 'acronym', 'manufacturer', 'year', 'isIpdb', 'rules'), // Headers normally used in tables and lists
      'info' => array('name', 'type', 'acronym', 'manufacturer', 'year', 'isIpdb', 'rules'), // Headers normally used in info divs
      'parents' => array('manufacturer'), 'selfParent' => false, 'acronym' => 'Ga',
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
        'type' => (object) array(
          'label' => 'Type',
          'type' => 'text',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,  
          'insert' => true,
          'default' => ''
        ),
        'acronym' => (object) array(
          'label' => 'Acronym',
          'type' => 'text',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,  
          'insert' => true,
          'default' => ''
        ),
        'manufacturer' => (object) array(
          'label' => 'Manufacturer',
          'type' => 'select',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,  
          'insert' => true,
          'default' => ''
        ),
        'year' => (object) array(
          'label' => 'Year',
          'type' => 'text',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,  
          'insert' => true,
          'default' => ''
        ),
        'isIpdb' => (object) array(
          'label' => 'IPDB',
          'type' => 'text',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,  
          'insert' => true,
          'default' => ''
        ),
        'rules' => (object) array(
          'label' => 'Rules',  
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
    'machine' => (object) array(
      'name' => 'machine', 'plural' => 'machines', 'table' => 'machine', 'column' => 'machine_id',
      'parents' => array('game', 'tournamentDivision'),
      'selfParent' => false, 'acronym' => 'Ma'
    ),
    'tournamentDivision' => (object) array(
      'name' => 'tournamentDivision', 'table' => 'tournamentDivision', 'column' => 'tournamentDivision_id',
      'parents' => array('tournamentEdition'), 
      'selfParent' => false, 'acronym' => 'Td'
    ),
    'tournamentEdition' => (object) array(
      'name' => 'tournamentEdition', 'table' => 'tournamentEdition', 'column' => 'tournamentEdition_id', 'acronym' => 'Te'
    ),
    'manufacturer' => (object) array(
      'name' => 'manufacturer', 'geo' => false, 'plural' => 'manufacturers', 'table' => 'manufacturer', 'column' => 'manufacturer_id', 'acronym' => 'Mn',
      'headers' => array('name', 'link'), // Headers normally used in tables and lists
      'info' => array('name', 'link'), // Headers normally used in info divs
      'fields' => (object) array(
        'name' => (object) array(
          'label' => 'Name',
          'type' => 'text',  
          'mandatory' => true,  
          'special' => false,  
          'bundle' => false,
          'insert' => false,
          'default' => ''
        ),
        'link' => (object) array(
          'label' => 'Link',
          'type' => 'text',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,  
          'insert' => false,
          'default' => ''
        )
      ),
      'complete' => false
    ),
    'continent' => (object) array(
      'name' => 'continent', 'geo' => true, 'plural' => 'continents', 'table' => 'continent', 'column' => 'continent_id', 'acronym' => 'Cn', 
      'headers' => array('name', 'latitude', 'longitude'), // Headers normally used in tables and lists
      'info' => array('name', 'latitude', 'longitude'), // Headers normally used in info divs
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
      'name' => 'country', 'geo' => true, 'plural' => 'countries', 'table' => 'country', 'column' => 'country_id',
      'headers' => array('name', 'continent', 'latitude', 'longitude'), // Headers normally used in tables and lists
      'info' => array('name', 'parentCountry', 'continent', 'latitude', 'longitude'), // Headers normally used in info divs
      'parents' => array('continent'),
      'selfParent' => true,
      'acronym' => 'Co',
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
          'type' => 'select',  
          'mandatory' => true,  
          'special' => false,  
          'insert' => true,
          'bundle' => false  
        ),
        'parentCountry' => (object) array(  
          'label' => 'Parent country',  
          'type' => 'select',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,
          'insert' => false,
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
    'region' => (object) array(
      'name' => 'region', 'geo' => true, 'plural' => 'regions', 'table' => 'region', 'column' => 'region_id',
      'headers' => array('name', 'country', 'continent', 'latitude', 'longitude'),  // Headers normally used in tables nd lists
      'info' => array('name', 'parentRegion', 'country', 'parentCountry', 'continent', 'latitude', 'longitude'), // Headers normally used in info divs
      'parents' => array('country', 'continent'),
      'selfParent' => true, 'acronym' => 'Re',
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
          'type' => 'select',  
          'mandatory' => true,  
          'special' => false,  
          'bundle' => 1  
        ),
        'country' => (object) array(  
          'label' => 'Country',  
          'type' => 'select',  
          'mandatory' => true,  
          'special' => false,  
          'bundle' => 1  
        ),
        'parentRegion' => (object) array(
          'label' => 'Parent region',  
          'type' => 'select',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,
          'insert' => false,
          'default' => ''  
        ),
        'parentCountry' => (object) array(  
          'label' => 'Parent country',  
          'type' => 'select',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,
          'insert' => false,
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
    'city' => (object) array(
      'name' => 'city', 'table' => 'city', 'column' => 'city_id', 'geo' => true, 'plural' => 'cities',
      'headers' => array('name', 'region', 'country', 'continent', 'latitude', 'longitude'), // Headers normally used in tables and lists
      'info' => array('name', 'region', 'parentRegion', 'country', 'parentCountry', 'continent', 'latitude', 'longitude'), // Headers normally used in info divs
      'parents' => array('region', 'country', 'continent'),
      'selfParent' => false,
      'acronym' => 'Ci',
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
          'type' => 'select',  
          'mandatory' => true,  
          'special' => false,  
          'bundle' => 1  
        ),
        'country' => (object) array(  
          'label' => 'Country',  
          'type' => 'select',  
          'mandatory' => true,  
          'special' => false,  
          'bundle' => 1  
        ),
        'region' => (object) array(  
          'label' => 'Region',  
          'type' => 'select',  
          'mandatory' => true,  
          'special' => false,  
          'bundle' => 1  
        ),
        'parentRegion' => (object) array(
          'label' => 'Parent region',  
          'type' => 'select',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,
          'insert' => false,
          'default' => ''  
        ),
        'parentCountry' => (object) array(  
          'label' => 'Parent country',  
          'type' => 'select',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,
          'insert' => false,
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
    'person' => (object) array(
      'name' => 'person', 'table' => 'person', 'column' => 'person_id',
      'parents' => array('city', 'region', 'country', 'continent', 'tournamentDivision', 'tournamentEdition', 'gender'),
      'selfParent' => false, 'acronym' => 'Pe'
    ), 
    'player' => (object) array(
      'name' => 'player', 'geo' => false, 'plural' => 'players', 'table' => 'player', 'column' => 'player_id',
      'headers' => array('name', 'initials', 'city', 'region', 'country', 'continent'), // Headers normally used in tables and lists
      'info' => array('name', 'initials', 'qualGroup', 'birthDate', 'gender', 'city', 'region', 'parentRegion', 'country', 'parentCountry', 'continent', 'isIfpa', 'main', 'classics', 'volunteer'), // Headers normally used in info divs
      'parents' => array('person', 'city', 'region', 'country', 'continent', 'tournamentDivision', 'tournamentEdition', 'gender'),
      'selfParent' => false, 'acronym' => 'Pl',
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
        'name' => (object) array(  
          'label' => 'Name',  
          'type' => '',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,  
          'insert' => true,
          'default' => null 
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
        'ifpaRank' => (object) array(  
          'label' => 'Rank position',  
          'type' => 'text',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,  
          'insert' => false,
          'default' => null 
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
          'label' => 'IFPA rank',  
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
        'parentRegion' => (object) array(
          'label' => 'Parent region',  
          'type' => 'select',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,
          'insert' => false,
          'default' => ''  
        ),
        'parentCountry' => (object) array(  
          'label' => 'Parent country',  
          'type' => 'select',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,
          'insert' => false,
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
      'name' => 'gender', 'geo' => false, 'plural' => 'genders', 'table' => 'gender', 'column' => 'gender_id', 'acronym' => 'Ge',
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
    ),
    'team' => (object) array(
      'name' => 'team', 'geo' => false, 'plural' => 'teams', 'table' => 'team', 'column' => 'team_id', 'acronym' => 'Tm',
      'headers' => array('name', 'initials'),
      'info' => array('name', 'initials'), // Headers normally used in info divs
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
        ),
        'initials' => (object) array(  
          'label' => 'Initials',  
          'type' => 'text',  
          'mandatory' => false,  
          'special' => false,  
          'bundle' => false,  
          'insert' => true,
          'default' => ''  
        )
      ),
      'complete' => true
    )
  );
  $GLOBALS['classes'] = $classes;
  
  $geoTypes = array('continent', 'country', 'region', 'city');
  $playerHeaders = array('firstName', 'lastName', 'username', 'password', 'initials', 'ifpa_id', 'ifpaRank', 'gender', 'streetAddress', 'zipCode', 'city', 'region', 'country', 'continent', 'telephoneNumber', 'mobileNumber', 'mailAddress', 'dateRegistered', 'birthDate', 'main', 'classics', 'volunteer', 'id', 'comment');
  $playerLabels = array('First name', 'Last name', 'Username', 'Password', 'Initials (tag)', 'IFPA ID', 'Rank position',  'Gender', 'Address', 'ZIP', 'City', 'Region', 'Country', 'Continent', 'Phone', 'Cell phone', 'E-mail', 'Date registered', 'Birth date', 'Main division', 'Classics division', 'Volunteer', 'ID', 'Comment');
  $playerTypes = array('text', 'text', 'text', 'text', 'text', 'text', 'text', 'select', 'text', 'text', 'select', 'select', 'select', 'select', 'text', 'text', 'text', 'text', 'text', 'checkbox', 'checkbox', 'checkbox', 'text', 'text');
  //  $debug = $_GET['debug'];
  
  
  function whereBuilder($type = 'player', $objs = null, $where = null, $comp = ' = ', $quot = '"', $logic = 'and', $frontPar = false, $endPar = false) {
    $coalesce = [];
    $defaultArray = array(
      'where' => array($comp, $quot, $logic, $frontPar, $endPar),
      'nowhere' => array(null, null, null, false, false)
    );
    if (is_array($objs)) {
      foreach($objs as $obj => $value) {
        if (is_array($value)) {
          array_push($coalesce, preg_replace('/_id$/', '', $obj));
          if (isAssoc($value)) {
            if (is_array($value['column'])) {
              if (isAssoc($value['column'])) {
                $columns[$obj][$value['column']['column']] = $value['column']['column'];
                $values[$obj][$value['column']['column']] = (isset($value['column']['value'])) ? 
                  $value['column']['value'] : null;
                $wheres[$obj][$value['column']['column']] = (isset($value['column']['where'])) ? 
                  $value['column']['where'] : $where;
                $defaults = ($wheres[$obj][$value['column']['column']]) ? 
                  $defaultArray['where'] : $defaultArray['nowhere'];
                $comps[$obj][$value['column']['column']] = (isset($value['column']['comp'])) ? 
                  $value['column']['comp'] : $defaults[0];
                $quots[$obj][$value['column']['column']] = (isset($value['column']['quot'])) ? 
                  $value['column']['quot'] : $defaults[1];
                $logics[$obj][$value['column']['column']] = (isset($value['column']['logic'])) ? 
                  $value['column']['logic'] : $defaults[2];
                $frontPars[$obj][$value['column']['column']] = 
                  (isset($value['column']['frontPar']) && $value['column']['frontPar']) ? '(' : $defaults[3];
                $endPars[$obj][$value['column']['column']] = 
                  (isset($value['column']['endPar']) && $value['column']['endPar']) ? ')' : $defaults[4];
                $multi[$obj] = true;
              }
            } else {
              $columns[$obj] = $value['column'];
              $values[$obj] = (isset($value['value'])) ? $value['value'] : null;
              $wheres[$obj] = (isset($value['where'])) ? $value['where'] : $where;
              $defaults = ($wheres[$obj]) ? $defaultArray['where'] : $defaultArray['nowhere'];
              $comps[$obj] = (isset($value['comp'])) ? $value['comp'] : $defaults[0];
              $quots[$obj] = (isset($value['quot'])) ? $value['quot'] : $defaults[1];
              $logics[$obj] = (isset($value['logic'])) ? $value['logic'] : $defaults[2];
              $frontPars[$obj] = (isset($value['frontPar']) && $value['frontPar']) ? '(' : $defaults[3];
              $endPars[$obj] = (isset($value['endPar']) && $value['endPar']) ? ')' : $defaults[4];
            }
          } else {
            $columns[$obj] = $value[0];
            $values[$obj] = (isset($value[1])) ? $value[1] : null;
            $wheres[$obj] = (isset($value[2])) ? $value[2] : $where;
            $defaults = ($wheres[$obj]) ? $defaultArray['where'] : $defaultArray['nowhere'];
            $comps[$obj] = (isset($value[3])) ? $value[3] : $defaults[0];
            $quots[$obj] = (isset($value[4])) ? $value[4] : $defaults[1];
            $logics[$obj] = (isset($value[5])) ? $value[5] : $defaults[2];
            $frontPars[$obj] = (isset($value[6]) && $value[5]) ? '(' : $defaults[3];
            $endPars[$obj] = (isset($value[7]) && $value[6]) ? ')' : $defaults[4];
          }
        } else {
          array_push($coalesce, preg_replace('/_id$/', '', $value));
          $columns[$value] = 'id';
          $names[$value] = 'name';
          $values[$value] = null;
          $wheres[$value] = $where;
          $defaults = ($wheres[$value]) ? $defaultArray['where'] : $defaultArray['nowhere'];
          $comps[$value] = $defaults[0];
          $quots[$value] = $defaults[1];
          $logics[$value] = $defaults[2];
          $frontPars[$value] = $defaults[3];
          $endPars[$value] = $defaults[4];
        }
      }
    } else {
      array_push($coalesce, preg_replace('/_id$/', '', $objs));     
      $columns[$objs] = 'id';
      $names[$objs] = 'name';
      $values[$objs] = null;
      $wheres[$objs] = $where;
      $defaults = ($wheres[$obj]) ? $defaultArray['where'] : $defaultArray['nowhere'];
      $comps[$objs] = $defaults[0];
      $quots[$objs] = $defaults[1];
      $logics[$objs] = $defaults[2];
      $frontPars[$objs] = $defaults[3];
      $endPars[$objs] = $defaults[4];
    }
    $joinBuild = joinBuilder($type, $coalesce);
    $output['join'] = $joinBuild['join'];
    foreach($coalesce as $coal) {
      if ($multi[$coal]) {
        foreach($columns[$coal] as $col => $val) {
          echo ' '.$col.'='.$val.' ';
          $output['coal'][$coal][$col] .= ' coalesce('.implode($joinBuild['coalesce'][$coal], '.'.$columns[$coal][$col].', ').'.'.$columns[$coal][$col].') ';
          if ($wheres[$coal][$col]) {
            $start = ($start) ? $start : $logics[$coal][$col];
            $output['where'][$coal][$col] .= ' '.$logics[$coal][$col].' '.$frontPars[$coal][$col].$output['coal'][$coal][$col].$comps[$coal][$col].' '.$quots[$coal][$col].$values[$coal][$col].$quots[$coal][$col].$endPars[$coal][$col];
            $whereOutput[$coal] = true;
            $whereOutput['global'] = true;
          }
        }
        if ($whereOutput[$coal]) {
          $output['where'][$coal] = implode($output['where'][$coal]);
        }
      } else {
        $output['coal'][$coal][$columns[$coal]] .= ' coalesce('.implode($joinBuild['coalesce'][$coal], '.'.$columns[$coal].', ').'.'.$columns[$coal].') ';
        if ($names[$coal]) {
          $output['coal'][$coal][$names[$coal]] .= ' coalesce('.implode($joinBuild['coalesce'][$coal], '.'.$names[$coal].', ').'.'.$names[$coal].') ';
        }
        if ($wheres[$coal]) {
          $start = ($start) ? $start : $logics[$coal];
          $output['where'][$coal] .= ' '.$logics[$coal].' '.$frontPars[$coal].$output['coal'][$coal][$columns[$coal]].$comps[$coal].' '.$quots[$coal].$values[$coal].$quots[$coal].$endPars[$coal];
          $whereOutput['global'] = true;
        }
      }
    }
    if ($whereOutput) {
      $output['where'] = preg_replace('/^ '.$start.'/', 'where', implode($output['where']).' ');
    }
    return $output;
  }
  
  function joinBuilder($type = 'player', $coalesce = null) {
    if (isset($coalesce) && !is_array($coalesce)) {
      $coalesce = array($coalesce);
    }
    if (isset($value) && !is_array($value)) {
      $value = array($value);
    }
    $data = joinBuilderHelper($type, $coalesce);
    $output['join'] = implode($data['join']);
    if ($coalesce && is_array($data['coalesce'])) {
      ksort($data['coalesce']);
      foreach($data['coalesce'] as $key => $level) {
        foreach ($level as $table => $cols) {
          $output['coalesce'][$table] .= $cols;
        }
      } 
      foreach ($output['coalesce'] as $table => $cols) {
        $output['coalesce'][$table] = explode(',', trim($cols,', '));
      }
    }
    return $output;
  }
  
  function joinBuilderHelper($child = 'player', $coalesce = null, $prefix = null, $level = 0, $self = true) {
    global $classes;
    $prefix .= $classes->{$child}->acronym;
    if ($coalesce) {
      foreach($coalesce as $table) {
        if ($table == $classes->{$child}->table) {
          $output['coalesce'][$level][$table] .= ','.$prefix;
        }
      }
    }
    if ($classes->{$child}->parents) {
      foreach($classes->{$child}->parents as $parent) {
        $output['join'][$level] .= ' left join '.$classes->{$parent}->table.' '.$prefix.'X'.$classes->{$parent}->acronym.' on '.$prefix.'.'.$classes->{$parent}->column.' = '.$prefix.'X'.$classes->{$parent}->acronym.".id\n";
        $newData = joinBuilderHelper($classes->{$parent}->name, $coalesce, $prefix.'X', $level + 1);
        if ($newData) {
          if ($newData['join']) {
            foreach($newData['join'] as $lvl => $joins) {
              $output['join'][$lvl] .= $joins;
            }
          }
          if ($coalesce && $newData['coalesce']) {
            foreach($newData['coalesce'] as $lvl => $tbl) {
              foreach($tbl as $table => $cols) {
                $output['coalesce'][$lvl][$table] .= $cols;
              }
            }
          }
        }
      }
      if ($classes->{$child}->selfParent && $self) {
        $output['join'][$level] .= ' left join '.$classes->{$child}->table.' '.$prefix.'X'.$classes->{$child}->acronym.' on '.$prefix.'.parent'.ucfirst($classes->{$child}->column).' = '.$prefix.'X'.$classes->{$child}->acronym.".id\n";
        if ($coalesce) {
          foreach($coalesce as $table) {
            if ($table == $classes->{$child}->$table) {
              $output['coalesce'][$level][$table] .= ' ,'.$prefix.'.id';
            }
          }
        }
        $newData = joinBuilderHelper($classes->{$child}->name, $coalesce, $prefix.'X', $level + 1, false);
        if ($newData) {
          if ($newData['join']) {
            foreach($newData['join'] as $lvl => $joins) {
              $output['join'][$lvl] .= $joins;
            }
          }
          if ($coalesce && $newData['coalesce']) {
            foreach($newData['coalesce'] as $lvl => $tbl) {
              foreach($tbl as $table => $cols) {
                $output['coalesce'][$lvl][$table] .= $cols;
              }
            }
          }
        }
      }
    }
    return $output;    
  }
  
  function getParents($dbh, $obj) {
    global $classes;
    if ($classes->{$obj->class}->parents) {
      foreach ($classes->{$obj->class}->parents as $parentClass) {
        if ($obj->{$classes->{$parentClass}->column} > 0) {
          $obj->{$parentClass} = getObjectById($dbh, $parentClass, $obj->{$classes->{$parentClass}->column})->name;
        } else {
          $newObj = getObject($dbh, $obj->class, $obj->id);
          if ($newObj->{$classes->{$parentClass}->column} > 0) {
            $obj->{$classes->{$parentClass}->column} = $newObj->{$classes->{$parentClass}->column};
            $obj->{$parentClass} = getObjectById($dbh, $parentClass, $obj->{$classes->{$parentClass}->column})->name;
          } else {
            $parentId = getParent($dbh, $obj, $parentClass);
            if ($parentId > 0) {
              $obj->{$classes->{$parentClass}->column} = $parentId;
              $obj->{$parentClass} = getObjectById($dbh, $parentClass, $parentId)->name;
            }
          }
        }
      }
    }
    return $obj;
  }
  
  function getParent($dbh, $obj, $type) {
    global $classes;
    while (!($obj->{$classes->{$type}->column} > 0)) {
      echo 'c:'.$obj->class;
      echo 'p:'.$classes->{$obj->class}->parents;
      echo "<br>\n";
      if ($classes->{$obj->class}->parents) {
        foreach ($classes->{$obj->class}->parents as $parentClass) {
          if ($obj->{$classes->{$parentClass}->column} > 0) {
            $parentObj = getObject($dbh, $parentClass, $obj->{$classes->{$parentClass}->column});
            if ($parentObj->{$classes->{$type}->column} > 0) {
              $obj->{$classes->{$type}->column} = $parentObj->{$classes->{$type}->column};
              return $parentObj->{$classes->{$type}->column};
            } else {
              $parentId = getParent($dbh, $parentObj, $type);
              if ($parentId > 0) {
                $obj->{$classes->{$type}->column} = $parentObj->{$classes->{$type}->column};
                return $parentId;
              }
            }
          } else {
            $parentId = getParent($dbh, $parentObj, $type);
            if ($parentId > 0) {
              $obj->{$classes->{$type}->column} = $parentObj->{$classes->{$type}->column};
            }
            return $parentId;            
          }
        }
      }
      return $obj->{$classes->{$type}->column};
    }
  }
  
  function getObject($dbh, $class, $id) {
    $query = 'select * from '.$class.' where id = '.$id;
    $newClass = $class;
    switch ($class) {
      case 'player': 
        $query = 'select * from '.$class.' where person_id = '.$id.' and (tournamentDivision_id = 1 or tournamentDivision_id = 2) group by person_id';
      break;
      case 'person': 
        $newClass = 'player';
      break;
      case 'tournamentDivision': 
        $newClass = 'stdClass';
      break;
      case 'tournamentEdition': 
        $newClass = 'stdClass';
      break;
    }
    $sth = $dbh->query($query);
    $obj = $sth->fetchObject($newClass);
    switch ($class) {
      case 'player':
        $obj->id = $obj->person_id;
      break;
      case 'person':
        $obj->id = $obj->person_id;
        $obj->class = 'person';
      break;
      case 'tournamentDivision':
        $obj->class = 'tournamentDivision';
      break;
      case 'tournamentEdition':
        $obj->class = 'tournamentEdition';
      break;
    }
    return $obj;
  }
  
  function getObjects($dbh, $class, $query) {
    $sth = $dbh->query($query);
    while ($obj = $sth->fetchObject($class)) {
      $obj->populate($dbh);
      $objs[] = $obj;
    }
    return $objs;
  }
  
  function getError($msg, $tr = true, $colspan = 7) {
    $errorMsg = $msg.', please <a href="JavaScript:window.location.reload()">reload the page</a> and try again, or <a href="mailto:support@europinball.org">contact us</a>.';
    if ($tr) {
      $errorMsg = '<tr><td colspan="'.$colspan.'">'.$errorMsg.'</td></tr>';
    }
    $error = (object) array('success' => false, 'reason' => $errorMsg);    
    return json_encode($error);
  }
    
  function getTshirtSelect() {
    return '
      select 
        ts.id as id,
        ts.name as name,
        "tshirt" as class,
        pt.number as number,
        pt.number as number_id,
        pt.person_id as player_id,
        pt.id as playerTshirt_id,
        tc.name as color,
        tc.id as color_id,
        tz.name as size,
        tz.id as size_id,
        tt.id as tournamentTshirt_id,
        te.name as tournamentEdition,
        te.id as tournamentEdition_id
      from tournamentTShirt tt
        left join tshirt ts on tt.tshirt_id = ts.id
        left join tournamentEdition te on tt.tournamentEdition_id = te.id
        left join color tc on ts.color_id = tc.id
        left join size tz on ts.size_id = tz.id
        left join personTShirt pt on pt.tournamentTShirt_id = tt.id
    ';
  }  
    
  function getTshirts($dbh, $tournament) {
    $query = getTshirtSelect().' where te.id = '.$tournament;
    $sth = $dbh->query($query);
    while ($obj = $sth->fetchObject('tshirt')) {
      $objs[] = $obj;
    }
    return $objs;
  }
  
  function getTshirtById($dbh, $tshirtId) {
    $query = getTshirtSelect().' where pt.id = '.$tshirtId;
    $sth = $dbh->query($query);
    if ($obj = $sth->fetchObject('tshirt')) {
      return $obj;
    } else {
      return false;
    }
  }
  
  function getTshirtByParams($dbh, $color = 3, $size = 3, $tournament = 1) {    
    $query = getTshirtSelect().' where tc.id = '.$color.' and tz.id = '.$size.' and te.id = '.$tournament;
    $sth = $dbh->query($query);
    if ($obj = $sth->fetchObject('tshirt')) {
      return $obj;
    } else {
      return false;
    }
  }
  
  function getTshirtsByPlayerId($dbh, $playerId, $tournament = 1) {
    $query = '
      select 
        pt.id as id,
        ts.name as name,
        "tshirt" as class,
        pt.number as number,
        pt.number as number_id,
        pt.person_id as player_id,
        pt.id as playerTshirt_id,
        tc.name as color,
        tc.id as color_id,
        tz.name as size,
        tz.id as size_id,
        tt.id as tournamentTshirt_id,
        te.name as tournamentEdition,
        te.id as tournamentEdition_id
      from personTShirt pt
        left join tournamentTShirt tt on pt.tournamentTShirt_id = tt.id
        left join tshirt ts on tt.tshirt_id = ts.id
        left join tournamentEdition te on tt.tournamentEdition_id = te.id
        left join color tc on ts.color_id = tc.id
        left join size tz on ts.size_id = tz.id
      where (te.id = '.$tournament.' or te.id is null) and pt.person_id = '.$playerId;
    $sth = $dbh->query($query);
    while ($obj = $sth->fetchObject('tshirt')) {
      $objs[] = $obj;
    }
    return $objs;
  }
  
  function addTshirt($dbh, $personId) {
    $update[':personId'] = $personId;
    $query = 'insert into personTShirt set person_id = :personId';
    $sth = $dbh->prepare($query);
    if ($sth->execute($update)) {
      return $dbh->lastInsertId();
    } else {
      return false;
    }
  }
  
  function delTshirt($dbh, $id) {
    $update[':id'] = $id;
    $query = 'delete from personTShirt where id = :id';
    $sth = $dbh->prepare($query);
    if ($sth->execute($update)) {
      return true;
    } else {
      return false;
    }
  }
  
  function updateTshirt($dbh, $id, $tshirt, $number = 1) {
    $query = ' update personTShirt ps ';
    $query .= ' set ps.tournamentTShirt_id = '.$tshirt->tournamentTshirt_id.', ps.number = '.$number.', ps.name = concat("'.$tshirt->tournamentEdition.' for Person ID ", ps.person_id, ": '.$tshirt->name.'"), ps.dateRegistered = "'.date('Y-m-d').'" where ps.id = '.$id;
    $sth = $dbh->query($query);
    return $sth->rowCount();
  }
    
  function getTshirtForm($dbh, $ulogin, $tournament = 1) {
    $player = getPlayerById($dbh, getIdFromUser($dbh, $ulogin->Username($_SESSION['uid'])));
    $tshirts = getTshirtsByPlayerId($dbh, $player->id, $tournament);
    if($tshirts && count($tshirts > 0)) {
      $shown = 'Any info already shown is what you have already ordered.<br />';
    } else {
      $shown = '<span id="tshirtNoneSpan" class="italic">You have no previsously ordered T-shirts. Order one now by clicking the icon below!<br /></span>';
    }
    $content = '
        <div id="tshirtOrderDiv">
          <h2 class="entry-title">T-shirts order form</h3>
          <input type="hidden" id="tournamentHidden" value="'.$tournament.'">
          <input type="hidden" id="playerIdHidden" value="'.$player->id.'">
          <table id="tshirtOrderTable">
            <tr id="tshirtOrderTr"><td colspan="7"><span class="italic">'.$shown.'Changes will take effect immediately.</span><td><tr>
    ';
    if($tshirts && count($tshirts > 0)) {
      foreach($tshirts as $tshirt) {
        $content .= getTshirtRow($dbh, $tournament, $tshirt->playerTshirt_id, $tshirt);
        $total += $tshirt->number;
        $highest = ($tshirt->playerTshirt_id > $highest) ? $tshirt->playerTshirt_id : $highest;
      }
    } 
    $content .= '
          </table>
          <p>Add more T-shirts:<img id="tshirtAdd" src="'.__baseHref__.'/images/add_icon.gif" class="icon" onclick="addTshirt(this);" alt="Click to add a new T-shirt" title="Click to add a new T-shirt"></p>
          <p><span id="tshirtCostSpan">Total cost: '.($total * 100).' SEK</span></p>
          <input type="hidden" id="tshirtCostHidden" value="'.($total * 100).'" />
          <input type="hidden" id="tshirtTotalHidden" value="'.$total.'" />
          <input type="hidden" id="tshirtHighestHidden" value="'.$highest.'" />
        </div>
    ';
    return $content;
  }
  
  function getTshirtRow($dbh, $tournament, $num, $playerTshirt = null, $warning = true) {
    $tshirts = getTshirts($dbh, $tournament);
    $content = '            <tr id="'.$num.'_tshirtTr">';
    $options['size'] = array('0' => 'Choose...');
    $options['color'] = array('0' => 'Choose...');
    foreach($tshirts as $tshirt) {
     if (!in_array($tshirt->size, $options['size'])) {
        $options['size'][$tshirt->size_id] = $tshirt->size;
      }
      if (!in_array($tshirt->color, $options['color'])) {
        $options['color'][$tshirt->color_id] = ucfirst($tshirt->color);
      }
    }
    $options['number'] = array(0=>0,1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10);
    foreach(array('number', 'color', 'size') as $param) {
      $content .= '
              <td class="labelTd"><label>'.ucfirst($param).':</label></td>
              <td class="selectTd"><select id="'.$num.'_tshirt'.ucfirst($param).'Select" class="select '.$param.'" onchange="tshirtChanged(this);">';
      foreach($options[$param] as $option_id => $option) {
        $content .= '                  <option value="'.$option_id.'"';
        if ($playerTshirt && count($playerTshirt) > 0 && $playerTshirt->{$param.'_id'} == $option_id) {
          $content .= ' selected ';
        }
        $content .= '>'.$option."</option>\n";
      }
      $content .= '</select></td>';
    }
    $content .= '
              <td><img id="'.$num.'_tshirtDel" src="'.__baseHref__.'/images/cancel.png" class="icon" onclick="delTshirt('.$num.');" alt="Click to delete this T-shirt" title="Click to delete this T-shirt"/><span class="error errorSpan" id="'.$num.'_tshirtSpan">';
    if ($warning && $playerTshirt && count($playerTshirt) > 0 && (!($playerTshirt->number_id > 0) || !($playerTshirt->color_id > 0) || !($playerTshirt->size_id > 0))) {
      $content .= 'You have not chosen all options for these T-shirts!';
    }
    $content .= '</span></td>
            </tr>';
    return $content;
  }
  
  function addTeam($dbh, $team, $player = null, $method = 'insert into') {
    $query = $method.' team set
        team.name=:name,
        team.initials=:initials,
        team.national=0,
        team.contactPlayer_id=(
          select pl.id from player pl
          where pl.person_id=:contactPlayer_id
          and pl.tournamentDivision_id = 1
        ),
        team.contactPlayer_name=(
          select concat(ifnull(pl.firstName, ""), " ", ifnull(pl.lastName, "")) from player pl
          where pl.person_id=:contactPlayer_id
          and pl.tournamentDivision_id = 1
        ),
        team.tournamentDivision_id=:tournamentDivision_id,
        team.dateRegistered=:dateRegistered,
        team.registerPerson_id=:registerPerson_id
    ';
    $insert[':name'] = $team->name;
    $insert[':initials'] = $team->initials;
    $insert[':contactPlayer_id'] = $team->contactPlayer_id;
    $insert[':tournamentDivision_id'] = $team->tournamentDivision_id;
    $insert[':dateRegistered'] = $team->dateRegistered;
    $insert[':registerPerson_id'] = $team->registerPerson_id;
    $sth = $dbh->prepare($query);
    $result = $sth->execute($insert);
    if ($method == 'insert into') {
      if ($player) {
        $team->id = $dbh->lastInsertId();
        $team->addPlayer($dbh, $player);
      }
    }
    return $team->id;
  }
  
  function editTeam($dbh, $team, $players = null) {
    if ($players) {
      $team->removePlayers($dbh);
      $team->addPlayers($dbh, $players);
    }
    return addTeam($dbh, $team, null, 'update');
  }
      
  function getTeamSelect() {
    return '
      select 
        tm.id as id,
        tm.name as name,
        "team" as class,
        tm.initials as initials,
        tm.contactPlayer_id as contactPlayer_id,
        tm.contactPlayer_name as contactPlayer_name,
        tm.country as country,
        tm.country_id as country_id,
        td.name as tournamentDivision,
        td.id as tournamentDivision_id,
        te.name as tournamentEdition,
        te.id as tournamentEdition_id
      from team tm
        left join tournamentDivision td on tm.tournamentDivision_id = td.id
        left join tournamentEdition te on td.tournamentEdition_id = te.id
    ';
  }  
    
  function getTeams($dbh, $where) {
    $query = getTeamSelect().' '.$where;
    $sth = $dbh->query($query);
    while ($obj = $sth->fetchObject('team')) {
      $objs[] = $obj;
    }
    return $objs;
  }
  
  function getTeamById($dbh, $teamId) {
    $query = getTeamSelect().' where tm.id = '.$teamId;
    $sth = $dbh->query($query);
    if ($obj = $sth->fetchObject('team')) {
      return $obj;
    } else {
      return false;
    }
  }
      
  function getFreeTeamMembers($dbh, $tournament = 1) {
    $query = getPlayerSelect();
    $query .= '
      left join teamPlayer tp on tp.player_id = m.id
      where tp.id is null and md.tournamentEdition_id = '.$tournament.'
      order by p.firstName, p.lastName';
    $sth = $dbh->query($query);
    while ($obj = $sth->fetchObject('player')) {
      $objs[] = $obj;
    }
    return $objs;
  }
  
  function getTeamForm($dbh, $ulogin, $tournament = 1) {
    $player = getPlayerById($dbh, getIdFromUser($dbh, $ulogin->Username($_SESSION['uid'])));
    $players = getFreeTeamMembers($dbh, $tournament);
    $team = $player->getTeam($dbh);
    if ($team) {
      $regTeamDisplay = 'none';
      $editTeamDisplay = '';
      $teamMembers = $team->getMembers($dbh);
      $players = array_merge($teamMembers, $players);
      $teamId = $team->id;
      $teamName = $team->name;
      $teamTag = $team->initials;
    } else {
      $regTeamDisplay = '';
      $editTeamDisplay = 'none';
      $teamId = 0;
      $teamName = '';
      $teamTag = '';
    }
    $content = '
      <script src="'.__baseHref__.'/js/contrib/jquery.form.min.js" type="text/javascript"></script>
      <p id="regTeamHeader" class="regTeam" style="display: '.$regTeamDisplay.';"><b>You are not a member of a team.</b> If you are supposed to be a member of an already registered team, please ask one of the existing members to add you to that team. If you want to register a new team, please fill in the details below.</p>
      <p id="editTeamHeader" class="editTeam" style="display: '.$editTeamDisplay.';">You are a member of the following team, and may change any parameters. <span class="italic">Use the button to change name or tag. Member changes are instant.</span></p>
      <p class="italic" class="editTeam" style="display: '.$editTeamDisplay.';">Note: You can not add players to this team if they are already members of another team, they need to leave their existing team before they can join your team.</p>
      <form id="newData" name="newData" action="'.$_SERVER['REQUEST_URI'].'">
        <input type="hidden" name="loggedIn" id="loggedIn" value="true">
        <input type="hidden" name="newPhoto" id="newPhoto" value="false">
        <input type="hidden" name="baseHref" id="baseHref" value="'.__baseHref__.'">
        <input type="hidden" name="user" id="user" value="'.$ulogin->Username($_SESSION['uid']).'">
        <input name="class" id="classHidden" type="hidden" value="team">
        <input name="id" id="idHidden" type="hidden" value="'.$teamId.'">
        <input name="action" id="action" type="hidden" value="regTeam">
        <input name="dateRegistered" id="dateRegisteredHidden" type="hidden" value="'.date('Y-m-d').'">
        <input name="registerPerson_id" id="registerPerson_idHidden" type="hidden" value="'.$player->id.'">
        <input name="tournamentDivision_id" id="tournamentDivision_idHidden" type="hidden" value="3">
        <table id="regTeamTable">
          <tr>
            <th colspan="2" id="regTeamTh">Team registration form</th>
          </tr>
          <tr id="nameTr">
            <td id="nameLabelTd" class="labelTd"><label id="nameLabel" for="nameText">Name</label></td>
            <td id="nameTd"><input name="name" id="nameText" type="text" class=" mandatory" onkeyup="checkField(this);" value="'.$teamName.'"><span id="nameSpan" class=" errorSpan">*</span></td>
          </tr>    
          <tr id="initialsTr">
            <td id="initialsLabelTd" class="labelTd"><label id="initialsLabel" for="initialsText">Team tag</label></td>
            <td id="initialsTd"><input name="initials" id="initialsText" type="text" onkeyup="checkField(this);" value="'.$teamTag.'"><span id="initialsSpan" class=" errorSpan"></span></td>
          </tr>
          <tr>
            <td class="labelTd"></td>
            <td><button id="submit" type="button" value="Submit!" class="formInput" onclick="regTeam()" disabled>Submit!</button><button id="delete" type="button" value="Delete team!" class="formInput editTeam" onclick="deleteTeam()" style="display: '.$editTeamDisplay.'">Delete team!</button><span id="submitSpan" class=" errorSpan" style="display: none;"></span>
          </tr>
    ';
    $playerNum = array(1,2,3,4);
    foreach($playerNum as $num) {
      $checked = '';
      $disabled = '';
      $leave = 'none';
      $captain = ' disabled';
      $captainDisplay = 'none';
      $selected = 0;
      if ($teamId == 0 && $num == 1) {
        $checked = ' checked';
        $captain = '';
        $captainDisplay = '';
      } else if ($teamMembers[$num - 1]) {
        $selected = $teamMembers[$num - 1]->id;
        $captain = '';
        if ($teamMembers[$num - 1]->mainPlayerId == $team->contactPlayer_id) {
          $checked = ' checked';
          $captainDisplay = '';
        }
        if ($teamMembers[$num - 1]->id == $player->id) {
          $disabled = ' disabled';
          $leave = '';
        }
      }
      if ($selected == 0) {
        $incomplete = '';
      } else {
        $incomplete = 'none';
      }
      $content .= '
          <tr id="teamPlayer'.$num.'Tr" style="display: '.$editTeamDisplay.';" class="editTeam">
            <td id="teamPlayer'.$num.'LabelTd" class="labelTd"><label id="teamPlayer'.$num.'Label" for="teamPlayer'.$num.'">Player #'.$num.'</label></td>
            <td id="teamPlayer'.$num.'Td" class="labelTd">'.createSelect($players, 'teamPlayer'.$num.'Select', $selected, 'memberSelected', $disabled).'<input type="radio" name="contactPlayer_id" id="contactPlayer_id'.$num.'" value="'.$selected.'" onchange="setCaptain();"'.$checked.$captain.'><span id="contactPlayer_id'.$num.'Captain" style="display: '.$captainDisplay.';">Captain</span><span id="teamPlayer'.$num.'Span" class=" errorSpan" style="display: none;"></span><span id="teamIncomplete'.$num.'Span" class="teamIncomplete errorSpan" style="display: '.$incomplete.';">Team is incomplete</span>
          </tr>
      ';
    }
    
    $content .= '
          <tr class="editTeam" style="display: '.$editTeamDisplay.'">
            <td></td>
            <td><button id="leaveTeam" type="button" value="Leave team!" class="editTeam formInput" onclick="removeTeamMember('.$team->id.', '.$player->id.');">Leave team!</button><span class="editTeam italic errorSpan">Note: This can only be undone by another member of the team.</span></td></td>
          </tr>
        </table>
      </form>
      <form id="imageForm" method="post" enctype="multipart/form-data" action="'.__baseHref__.'/ajax/imageUpload.php?obj=team&id='.$team->id.'" style="display: '.$editTeamDisplay.';" class="editTeam">
        <br />
        <th colspan="2" id="regTeamImgTh">Team logo or picture</th>
  	    <div id="preview">
  		    <img src="'.getPhoto($dbh, 'team', $team->id, true).'" id="thumb" class="preview" alt="Preview of '.$team->name.'">
          <div id="imageLoader"></div>
  	    </div>
  	    <div id="uploadForm">
          <label id="imageUploadLabel" class="italic">Click picture to change preview (save with button below)</label>
          <input type="file" name="imageUpload" id="imageUpload">
        </div>
        <button id="submitImg" type="button" value="Submit image!" class="formInput" onclick="teamPhoto();" disabled>Submit image!</button><span id="submitImgSpan" class=" errorSpan" style="display: none;"> 
        <script type="text/javascript">
          $(document).ready(function() { 
            $(\'#imageUpload\').on(\'change\', function() {
              $(\'#preview\').html(\'\');
              $(\'#imageLoader\').html(\'<img src="'.__baseHref__.'/images/loader.gif" alt="Uploading...."/>\');
              $(\'#submitImg\').prop(\'disabled\', false);
              $(\'#imageForm\').ajaxForm({
                target: \'#preview\'
              }).submit();
              $(\'#imageLoader\').html(\'\');
            });
            $(\'#thumb\').on(\'click\', function() {
              $(\'#imageUpload\').trigger(\'click\');
            });
          }); 
        </script>
      </form>
    ';
    return $content;
  }
  
  function getQualGroupById($dbh, $id) {
    $query = '
      select 
        q.id as id,
        concat(q.date, " ", left(q.startTime, 5), "-", left(q.endTime, 5)) as fullName,
        concat(left(q.startTime, 5), "-", left(q.endTime, 5)) as name,
        q.name as shortName,
        q.date as date,
        left(q.startTime, 5) as startTime,
        left(q.endTime, 5) as endTime,
        "qualGroup" as class,
        q.comment as comment,
        q.tournamentDivision_id as tournamentDivision_id
      from qualGroup q
      where q.id = '.$id;
    $sth = $dbh->query($query);
    while ($obj = $sth->fetchObject('qualGroup')) {
      return $obj;
    }
  }

  function getQualGroups($dbh, $tournament = 1) {
    $query = '
      select 
        q.id as id,
        concat(q.date, " ", left(q.startTime, 5), "-", left(q.endTime, 5)) as fullName,
        concat(left(q.startTime, 5), "-", left(q.endTime, 5)) as name,
        q.name as shortName,
        q.date as date,
        left(q.startTime, 5) as startTime,
        left(q.endTime, 5) as endTime,
        "qualGroup" as class,
        q.comment as comment,
        q.tournamentDivision_id as tournamentDivision_id
      from qualGroup q
    ';
    $sth = $dbh->query($query);
    while ($obj = $sth->fetchObject('qualGroup')) {
      $objs[] = $obj;
    }
    return $objs;
  }
  
  function addVolunteerTask($dbh, $volunteer, $task, $tournamentId = 1) {
    return addVolunteerItem($dbh, $volunteer, $task, 'task', $tournamentId);    
  }
  
  function addVolunteerPeriod($dbh, $volunteer, $period, $tournamentId = 1) {
    return addVolunteerItem($dbh, $volunteer, $period, 'period', $tournamentId);
  }
  
  function addVolunteerItem($dbh, $volunteer, $item, $type = 'task', $tournamentId = 1) {
    $query = '
      insert into 
        volunteer'.ucfirst($type).'
      set 
        volunteer_id = :volunteerId,
        '.$type.'_id = :'.$type.'Id,
        tournamentEdition_id = :tournamentId,
        name = :name
      on duplicate key update
        volunteer_id = :volunteerId,
        '.$type.'_id = :'.$type.'Id,
        tournamentEdition_id = :tournamentId,
        name = :name
    ';
    $update = array(
      ':volunteerId' => $volunteer->volunteer_id,
      ':'.$type.'Id' => $item->id,
      ':tournamentId' => $tournamentId,
      ':name' => $volunteer->lastName.': '.(($type == 'period') ? $item->fullName : $item->name)
    );
    $sth = $dbh->prepare($query);
    if ($sth->execute($update)) {
      return true;
    } else {
      return false;
    }    
  }
  
  function delVolunteerTask($dbh, $volunteer, $task, $tournamentId = 1) {
    return delVolunteerItem($dbh, $volunteer, $task, 'task', $tournamentId);
  }

  function delVolunteerPeriod($dbh, $volunteer, $period, $tournamentId = 1) {
    return delVolunteerItem($dbh, $volunteer, $period, 'period', $tournamentId);
  }
  
  function delVolunteerItem($dbh, $volunteer, $item, $type = 'task', $tournamentId = 1) {
    $query = '
      delete 
        from volunteer'.ucfirst($type).'
      where
        volunteer_id = :volunteerId and
        '.$type.'_id = :'.$type.'Id and
        tournamentEdition_id = :tournamentId
    ';
    $delete = array (
      ':volunteerId' => $volunteer->volunteer_id,
      ':'.$type.'Id' => $item->id,
      ':tournamentId' => $tournamentId
    );
    $sth = $dbh->prepare($query);
    if ($sth->execute($delete)) {
      return true;
    } else {
      return false;
    }    
  }

  function getTasksByPlayerId($dbh, $playerId, $tournament = 1) {
    $query = '
      select 
        t.id as id,
        t.name as name,
        "task" as class,
        v.person_id as player_id,
        v.id as volunteer_id,
        vt.id as volunteerTask_id,
        t.comment as comment,
        t.tournamentEdition_id as tournamentEdition_id
      from volunteerTask vt
        left join task t on vt.task_id = t.id
        left join volunteer v on vt.volunteer_id = v.id
      where (t.tournamentEdition_id = '.$tournament.' or t.tournamentEdition_id is null) and v.person_id = '.$playerId;
    $sth = $dbh->query($query);
    while ($obj = $sth->fetchObject()) {
      $objs[] = $obj;
    }
    return $objs;
  }
  
  function getPeriodsByPlayerId($dbh, $playerId, $tournament = 1) {
    $query = '
      select 
        p.id as id,
        concat(p.date, " ", left(p.startTime, 5), "-", left(p.endTime, 5)) as fullName,
        concat(left(p.startTime, 5), "-", left(p.endTime, 5)) as name,
        p.date as date,
        left(p.startTime, 5) as startTime,
        left(p.endTime, 5) as endTime,
        "period" as class,
        v.person_id as player_id,
        v.id as volunteer_id,
        vp.id as volunteerPeriod_id,
        p.comment as comment,
        p.tournamentEdition_id as tournamentEdition_id
      from volunteerPeriod vp
        left join period p on vp.period_id = p.id
        left join volunteer v on vp.volunteer_id = v.id
      where (p.tournamentEdition_id = '.$tournament.' or p.tournamentEdition_id is null) and v.person_id = '.$playerId.'
      order by p.date, p.startTime';
    $sth = $dbh->query($query);
    while ($obj = $sth->fetchObject()) {
      $objs[] = $obj;
    }
    return $objs;
  }
  
  function getTaskById($dbh, $id) {
    $query = '
      select 
        t.id as id,
        t.name as name,
        "task" as class,
        t.comment as comment,
        t.tournamentEdition_id as tournamentEdition_id
      from task t
      where t.id = '.$id;
    $sth = $dbh->query($query);
    while ($obj = $sth->fetchObject()) {
      return $obj;
    }
  }
  
  function getPeriodById($dbh, $id) {
    $query = '
      select 
        p.id as id,
        concat(p.date, " ", left(p.startTime, 5), "-", left(p.endTime, 5)) as fullName,
        concat(left(p.startTime, 5), "-", left(p.endTime, 5)) as name,
        p.date as date,
        left(p.startTime, 5) as startTime,
        left(p.endTime, 5) as endTime,
        "period" as class,
        p.comment as comment,
        p.tournamentEdition_id as tournamentEdition_id
      from period p
      where p.id = '.$id;
    $sth = $dbh->query($query);
    while ($obj = $sth->fetchObject()) {
      return $obj;
    }
  }

  function getTasks($dbh, $tournament = 1) {
    $query = '
      select 
        t.id as id,
        t.name as name,
        "task" as class,
        t.comment as comment,
        t.tournamentEdition_id as tournamentEdition_id
      from task t
      where (t.tournamentEdition_id = '.$tournament.' or t.tournamentEdition_id is null)';
    $sth = $dbh->query($query);
    while ($obj = $sth->fetchObject()) {
      $objs[] = $obj;
    }
    return $objs;
  }
  
  function getPeriods($dbh, $tournament = 1) {
    $query = '
      select 
        p.id as id,
        concat(p.date, " ", left(p.startTime, 5), "-", left(p.endTime, 5)) as fullName,
        concat(left(p.startTime, 5), "-", left(p.endTime, 5)) as name,
        p.date as date,
        left(p.startTime, 5) as startTime,
        left(p.endTime, 5) as endTime,
        "period" as class,
        p.comment as comment,
        p.tournamentEdition_id as tournamentEdition_id
      from period p
      where (p.tournamentEdition_id = '.$tournament.' or p.tournamentEdition_id is null)
      order by p.date, p.startTime';
    $sth = $dbh->query($query);
    while ($obj = $sth->fetchObject()) {
      $objs[] = $obj;
    }
    if (count($objs) > 0) {
      return $objs;
    } else {
      return false;
    }
  }
  
  function getVolunteerById($dbh, $id) {
    $player = getPlayerById($dbh, $id);
    $query = '
      select 
        id as volunteer_id,
        coalesce(v.hours, 0) as hours
      from volunteer v
      where v.person_id = '.$id;  
    $sth = $dbh->query($query);
    if ($obj = $sth->fetchObject()) {
      $player->hours = $obj->hours;
      $player->volunteer_id = $obj->volunteer_id;
      return $player;
    } else {
      return false;
    }
  }
  
  function getVolunteerForm($dbh, $ulogin, $tournament = 1) {
    $volunteer = getVolunteerById($dbh, getIdFromUser($dbh, $ulogin->Username($_SESSION['uid'])));
    $tasks = getTasks($dbh, $tournament);
    $periods = getPeriods($dbh, $tournament);
    if ($volunteer) {
      $volunteerTasks = getTasksByPlayerId($dbh, $volunteer->id, $tournament);
      $volunteerPeriods = getPeriodsByPlayerId($dbh, $volunteer->id, $tournament);
      $volunteerTaskIds = [];
      if($volunteerTasks) {
        foreach($volunteerTasks as $volunteerTask) {
          $volunteerTaskIds[] = $volunteerTask->id;
        }
      }
      $volunteerPeriodIds = [];
      if($volunteerPeriods) {
        foreach($volunteerPeriods as $volunteerPeriod) {
          $volunteerPeriodIds[] = $volunteerPeriod->id;
        }
      }
    }
    if(($tasks && count($tasks > 0)) || ($periods && count($periods > 0))) {
      $shown = 'Any info already shown is what you have already registered.<br />';
    } else {
      $shown = '<span id="volunteerNoneSpan" class="italic">You have nothing previsously registered.<br /></span>';
    }
    $content = '
          <div id="volunteerRegDiv">
            <h2 class="entry-title">Volunteer registration form</h3>
            <input type="hidden" id="tournamentHidden" value="'.$tournament.'">
            <input type="hidden" id="volunteerIdHidden" value="'.$volunteer->volunteer_id.'">
            <span class="italic">'.$shown.'The total number of hours does not have to match the number of hours you select as periods. We will distribute the number of hours you specify over the periods you are available, and we will not assign more hours than you offer.<br />Changes below will take effect immediately.</span>
            <br /><br />
            <p>Total number of hours you are willing to contribute: <select id="volunteerHoursSelect" class="select" onchange="volunteerHoursChanged(this);">
    ';
    for($i = 0; $i <= 100; $i++) {
      $content .= '<option value="'.$i.'"';
      if ((!($volunteer) && $i = 0) || $i == $volunteer->hours) {
        $content .= ' selected';
      }
      $content .= '>'.$i.'</option>'."\n";
    }
    $content .= '</select><span class="error errorSpan" id="volunteerHoursSpan"></span></p>
          </div>
          <div id="periodTableDiv" class="periodTable">
            <h2>Periods: <label>Check/uncheck all: </label><input type="checkbox" id="periodChackAll" onclick="periodCheckAll(this);" ';
    if ($volunteerPeriods && count($volunteerPeriods) == count($periods)) {
      $content .= 'checked';
    }            
    $content .= '></h2>
    ';
    if($periods && count($periods > 0)) {
      foreach($periods as $period) {
        if (!($date) || $date != $period->date) {
          if ($date) {
            $content .= '</table>';
          }
          $date = $period->date;
          $content .= '
            <table id="period'.$date.'Table" class="periodTable">
              <tr>
                <td><input type="checkbox" id="'.$date.'_'.$type.'Checkbox" onchange="periodCheckAll(this, \''.$date.'\');" class="periodCheckbox periodDate '.$period->date.'"> </td>
                <td><h2><b>'.$date.'</b></h2></td>
              </tr>
          ';
        }
        $content .= getVolunteerRow($dbh, 'period', $period, ((in_array($period->id, $volunteerPeriodIds)) ? true : false));
      }
    } 
    $content .= '
            </table>
          </div>
          <div id="taskTableDiv">
            <h2>Tasks:</h2></td>
            <table id="taskTable">
    ';
    if($tasks && count($tasks > 0)) {
      foreach($tasks as $task) {
        $content .= getVolunteerRow($dbh, 'task', $task, ((in_array($task->id, $volunteerTaskIds)) ? true : false));
      }
    }
    $content .= '
          </table>
        </div>
    ';
    return $content;
  }
  
  function getVolunteerRow($dbh, $type, $item = null, $checked = false) {
    $content = '            <tr id="'.$item->id.'_'.$type.'Tr">';
    if ($type == 'task') {
      $content .= '              <td class="labelTd"><label>'.ucfirst($item->name).'</label></td>';
    }
    $content .= '              <td class="boxTd"><input type="checkbox" id="'.$item->id.'_'.$type.'Checkbox" onchange="volunteerChanged(this, \''.$type.'\', '.$item->id.');" class="'.$type.'Checkbox '.$item->date.'" ';
    if ($checked) {
      $content .= 'checked';
    }
    $content .= '><span class="error errorSpan toolTip" id="'.$item->id.'_'.$type.'Span"></span>';
    if ($item->comment) {
      $content .= '<span class="italic">'.$item->comment.'</span>';
    }  
    $content .= ' </td>';
    if ($type == 'period') {
      $content .= '              <td class="labelTd"><label>'.ucfirst($item->name).'</label></td>';
    }
    $content .= '            </tr>';
    return $content;
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
  
  function getManufacturers($dbh, $where, $order = 'order by mn.name') {
    $query = '
      select
        mn.id as id,
        mn.name as name,
        "manufacturer" as class
      from manufacturer mn
      left join game g
        on g.manufacturer_id = mn.id
      left join machine ma
        on ma.game_id = g.id
      left join tournamentDivision d
        on d.id = ma.tournamentDivision_id
      left join tournamentEdition e
        on e.id = d.tournamentEdition_id
    '; 
    $where = preg_replace('/ id /', ' mn.id ', $where);
    $where = preg_replace('/ game_id /', ' g.id ', $where);
    $where = preg_replace('/ ipdb_id /', ' g.game_ipdb_id ', $where);
    $where = preg_replace('/ tournamentDivision_id /', ' d.id ', $where);
    $where = preg_replace('/ tournamentEdition_id /', ' e.id ', $where);
    $where = preg_replace('/ type = main /', ' d.id = 1 ', $where);
    $where = preg_replace('/ type = classics /', ' d.id = 2 ', $where);
    $sth = $dbh->query($query.' '.$where.' group by mn.id '.$order);
    while ($obj = $sth->fetchObject()) {
      $objs[] = $obj;
    }
    return $objs;
  }
    
  function getGames($dbh, $where, $order = 'order by g.name') {
    $query = '
      select
        g.id as id,
        g.name as name,
        "game" as class,
        mn.id as manufacturer_id,
        mn.name as manufacturer,
        g.acronym as acronym,
        if(g.game_ipdb_id is not null, 1, 0) as isIpdb,
        g.game_ipdb_id as ipdb_id,
        g.game_year_released as year,
        g.game_link_rulesheet as rules,
        if(d.id = 1, "main", if(d.id = 2, "classics", null)) as type,
        if(d.id = 1, 1, 0) as main,
        if(d.id = 2, 1, 0) as classics,
        d.id as tournamentDivision_id,
        e.id as tournamentEdition_id
      from machine ma
      left join game g
        on g.id = ma.game_id
      left join manufacturer mn
        on mn.id = g.manufacturer_id
      left join tournamentDivision d
        on d.id = ma.tournamentDivision_id
      left join tournamentEdition e
        on e.id = d.tournamentEdition_id
    '; 
    $where = preg_replace('/ id /', ' g.id ', $where);
    $where = preg_replace('/ manufacturer_id /', ' mn.id ', $where);
    $where = preg_replace('/ game_id /', ' g.id ', $where);
    $where = preg_replace('/ ipdb_id /', ' g.game_ipdb_id ', $where);
    $where = preg_replace('/ tournamentDivision_id /', ' d.id ', $where);
    $where = preg_replace('/ tournamentEdition_id /', ' e.id ', $where);
    $where = preg_replace('/ type = main /', ' d.id = 1 ', $where);
    $where = preg_replace('/ type = classics /', ' d.id = 2 ', $where);
    // echo $query.' '.$where.' and e.id = 1 group by g.id '.$order;
    $sth = $dbh->query($query.' '.$where.' and e.id = 1 group by g.id '.$order);
    while ($obj = $sth->fetchObject('game')) {
      $objs[] = $obj;
    }
    return $objs;
  }
  
  function getMachines($dbh, $where, $order = 'order by g.name') {
    $query = '
      select
        ma.id as id,
        ma.game as name,
        "machine" as class,
        d.id as tournamentDivision_id,
        ma.game_id as game_id
      from machine ma
      left join game g
        on g.id = ma.game_id
      left join tournamentDivision d
        on d.id = ma.tournamentDivision_id
    '; 
    $where = preg_replace('/ id /', ' ma.id ', $where);
    $where = preg_replace('/ game_id /', ' ma.game_id ', $where);
    $where = preg_replace('/ tournamentDivision_id /', ' d.id ', $where);
    $sth = $dbh->query($query.' '.$where.' '.$order);
    while ($obj = $sth->fetchObject('game')) {
      $objs[] = $obj;
    }
    return $objs;
  }
  
  function getGenders($dbh, $where, $order = 'order by name') {
    $query = '
      select
        ge.id as id,
        ge.id as continent_id,
        "gender" as class,
        "gender" as type,
        ge.name as name,
        ge.comment as comment
      from gender ge
    '; 
    $where = preg_replace('/ id /', ' ge.id ', $where);
    $where = preg_replace('/ gender_id /', ' ge.id ', $where);
    $sth = $dbh->query($query.' '.$where.' '.$order);
    while ($obj = $sth->fetchObject('gender')) {
      $objs[] = $obj;
    }
    return $objs;
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
//    echo($query.' '.$where.' '.$order);
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
        co.parentCountry_id as parentCountry_id,
        co.parentCountry as parentCountry,
        co.altName as altName,
        co.latitude as latitude,
        co.longitude as longitude,
        co.continent_id as continent_id,
        co.continent as continent,
        co.comment as comment
      from country co
    '; 
    $where = preg_replace('/ id /', ' co.id ', $where);
    $where = preg_replace('/ country_id /', ' co.parentCountry_id ', $where);
    $where = preg_replace('/ parentCountry_id /', ' co.parentCountry_id ', $where);
    $where = preg_replace('/ continent_id /', ' co.continent_id ', $where);
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
        r.parentRegion_id as parentRegion_id,
        r.parentRegion as parentRegion,
        r.altName as altName,
        r.latitude as latitude,
        r.longitude as longitude,
        r.country_id as country_id,
        r.country as country,
        r.parentCountry_id as parentCountry_id,
        r.parentCountry as parentCountry,
        r.continent_id as continent_id,
        r.continent as continent,
        r.comment as comment
      from region r
    '; 
    $where = preg_replace('/ id /', ' r.id ', $where);
    $where = preg_replace('/ region_id /', ' r.parentRegion_id ', $where);
    $where = preg_replace('/ parentRegion_id /', ' r.parentRegion_id ', $where);
    $where = preg_replace('/ country_id /', ' coalesce(r.country_id, r.parentCountry_id) ', $where);
    $where = preg_replace('/ parentCountry_id /', ' r.parentCountry_id ', $where);
    $where = preg_replace('/ continent_id /', ' r.continent_id ', $where);
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
        coalesce(c.region_id, c.parentRegion_id) as region_id,
        coalesce(c.region, c.parentRegion) as region,
        c.parentRegion_id as parentRegion_id,
        c.parentRegion as parentRegion,
        c.country_id as country_id,
        c.country as country,
        c.parentCountry_id as parentCountry_id,
        c.parentCountry as parentCountry,
        c.continent_id as continent_id,
        c.continent as continent,
        c.comment as comment
      from city c
    ';
    $where = preg_replace('/ id /', ' c.id ', $where);
    $where = preg_replace('/ city_id /', ' c.id ', $where);
    $where = preg_replace('/ region_id /', ' coalesce(c.region_id, c.parentRegion_id) ', $where);
    $where = preg_replace('/ parentRegion_id /', ' c.parentRegion_id ', $where);
    $where = preg_replace('/ country_id /', ' coalese(c.country_id, c.parentCountry_id) ', $where);
    $where = preg_replace('/ parentCountry_id /', ' c.parentCountry_id ', $where);
    $where = preg_replace('/ continent_id /', ' c.continent_id ', $where);
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
  /* 
  function getPlayers($dbh, $where = null, $order = 'order by p.firstName, p.lastName') {
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
        p.ifpaRank as ifpaRank,
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
    '.getPlayerJoin();
    $where = preg_replace('/ tournamentEdition_id /', ' mT.tournamentEdition_id ', $where);
    $where = preg_replace('/ id /', ' p.id ', $where);
    $where = preg_replace('/ player_id /', ' p.id ', $where);
    $where = preg_replace('/ city_id /', ' pC.id ', $where);
    $where = preg_replace('/ region_id /', ' coalesce(pR.id, pRPr.id, pCR.id, pCRPr.id) ', $where);
    $where = preg_replace('/ parentRegion_id /', ' coalesce(pRPr.id, pCRPr.id) ', $where);
    $where = preg_replace('/ country_id /', ' coalesce(pCo.id, pCoPco.id, pRCo.id, pRCoPco.id, pRPrCo.id, pRPrCoPco.id, pCCo.id, pCCoPco.id, pCRCo.id, pCRCoPco.id, pCRPrCo.id, pCRPrCoPco.id) ', $where);
    $where = preg_replace('/ parentCountry_id /', ' coalesce(pCoPco.id, pRCoPco.id, pRPrCoPco.id, pCCoPco.id, pCRCoPco.id, pCRPrCoPco.id) ', $where);
    $where = preg_replace('/ continent_id /', ' coalesce(pCn.id, pCoCn.id, pCoPcoCn.id, pRCn.id, pRCoCn.id, pRCoPcoCn.id, pRPrCn.id, pRPrCoCn.id, pRPrCoPcoCn.id, pCCn.id, pCCoCn.id, pCCoPcoCn.id, pCRCn.id, pCRCoCn.id, pCRCoPcoCn.id, pCRPrCn.id, pCRPrCoCn.id, pCRPrCoPcoCn.id) ', $where);
    //echo($query.' '.$where.' '.$order);
    $sth = $dbh->query($query.' '.$where.' '.$order);
    while ($obj = $sth->fetchObject('player')) {
      $objs[] = $obj;
    }
    return $objs;
  }
  */
  
  function getPlayerSelect(){
    $query = '
      select 
        p.id as id,
        "player" as class,
        "player" as type,
        coalesce(m.firstName, cl.firstName, p.firstName) as firstName,
        coalesce(m.lastName, cl.lastName, p.lastName) as lastName,
        coalesce(m.initials, cl.initials, p.initials) as initials,
        coalesce(m.streetAddress, cl.streetAddress, p.streetAddress) as streetAddress,
        coalesce(m.zipCode, cl.zipCode, p.zipCode) as zipCode,
        coalesce(m.gender_id, cl.gender_id, p.gender_id) as gender_id,
        coalesce(m.gender, cl.gender, p.gender) as gender,
        coalesce(m.city_id, cl.city_id, p.city_id) as city_id,
        coalesce(m.city, cl.city, p.city) as city,
        coalesce(m.region_id, cl.region_id, p.region_id) as region_id,
        coalesce(m.region, cl.region, p.region) as region,
        coalesce(m.country_id, cl.country_id, p.country_id) as country_id,
        coalesce(m.country, cl.country, p.country) as country,
        coalesce(m.continent_id, cl.continent_id, p.continent_id) as continent_id,
        coalesce(m.continent, cl.continent, p.continent) as continent,
        coalesce(m.parentRegion_id, cl.parentRegion_id, p.parentRegion_id) as parentRegion_id,
        coalesce(m.parentRegion, cl.parentRegion, p.parentRegion) as parentRegion,
        coalesce(m.parentCountry_id, cl.parentCountry_id, p.parentCountry_id) as parentCountry_id,
        coalesce(m.parentCountry, cl.parentCountry, p.parentCountry) as parentCountry,
        coalesce(m.telephoneNumber, cl.telephoneNumber, p.telephoneNumber) as telephoneNumber,
        coalesce(m.mobileNumber, cl.mobileNumber, p.mobileNumber) as mobileNumber,
        coalesce(m.mailAddress, cl.mailAddress, p.mailAddress) as mailAddress,
        coalesce(m.birthDate, cl.birthDate, p.birthDate) as birthDate,
        p.ifpa_id as ifpa_id,
        p.ifpaRank as ifpaRank,
        coalesce(m.comment, cl.comment, p.comment) as comment,
        if(p.ifpa_id is not null,1,0) as isIfpa,
        null as password,
        if(p.id is not null,1,0) as isPerson,
        if(m.id is not null or cl.id is not null,1,0) as isPlayer,
        if(m.id is not null,1,0) as main,
        if(cl.id is not null,1,0) as classics,
        if(m.id is not null,m.id,null) as mainPlayerId,
        if(cl.id is not null,cl.id,null) as classicsPlayerId,
        if(v.id is not null,1,0) as volunteer,
        1 as tournamentEdition_id,
        p.username as username,
        if(p.password is null,1,0) as passwordRequired
      from person p
      left join player m
        on m.person_id = p.id and m.tournamentDivision_id = 1
      left join player cl
        on cl.person_id = p.id and m.tournamentDivision_id = 2
      left join volunteer v
        on v.person_id = p.id and v.tournamentEdition_id = 1
        
      left join tournamentDivision md on
        m.tournamentDivision_id = md.id
      left join tournamentDivision cld on
        cl.tournamentDivision_id = cld.id
    ';
    return $query;
  }
  
  function getPlayers($dbh, $where = null, $order = 'order by p.firstName, p.lastName') {
    $query = getPlayerSelect();
    $where = preg_replace('/ tournamentEdition_id /', ' coalesce(md.tournamentEdition_id, cld.tournamentEdition_id, v.tournamentEdition_id) ', $where);
    $where = preg_replace('/ id /', ' p.id ', $where);
    $where = preg_replace('/ player_id /', ' p.id ', $where);
    $where = preg_replace('/ city_id /', ' coalesce(m.city_id, cl.city_id, p.city_id) ', $where);
    $where = preg_replace('/ region_id /', ' coalesce(m.region_id, cl.region_id, p.region_id) ', $where);
    $where = preg_replace('/ parentRegion_id /', ' coalesce(m.parentRegion_id, cl.parentRegion_id, p.parentRegion_id) ', $where);
    $where = preg_replace('/ country_id /', ' coalesce(m.country_id, cl.country_id, p.country_id) ', $where);
    $where = preg_replace('/ parentCountry_id /', ' coalesce(m.parentCountry_id, cl.parentCountry_id, p.parentCountry_id) ', $where);
    $where = preg_replace('/ continent_id /', ' coalesce(m.continent_id, cl.continent_id, p.continent_id) ', $where);
    //echo($query.' '.$where.' '.$order);
    $sth = $dbh->query($query.' '.$where.' '.$order);
    while ($obj = $sth->fetchObject('player')) {
      $objs[] = $obj;
    }
    return $objs;
  }
  
  function getPerson($dbh, $objs, $order = 'order by p.firstName, p.lastName') {
    $select =  '
      select 
        plXpe.id as id,
        "player" as class,
        "player" as type,
        coalesce(pl.firstName, plXpe.firstName) as firstName,
        coalesce(pl.lastName, plXpe.lastName) as lastName,
        trim(concat(ifnull(coalesce(pl.firstName, plXpe.firstName), "")," ",ifnull(coalesce(pl.lastName, plXpe.lastName), ""))) as name,
        coalesce(pl.initials, plXpe.initials) as initials,
        coalesce(pl.streetAddress, plXpe.streetAddress) as streetAddress,
        coalesce(pl.zipCode, plXpe.zipCode) as zipCode,
        coalesce(pl.telephoneNumber, plXpe.telephoneNumber) as telephoneNumber,
        coalesce(pl.mobileNumber, plXpe.mobileNumber) as mobileNumber,
        coalesce(pl.mailAddress, plXpe.mailAddress) as mailAddress,
        coalesce(pl.birthDate, plXpe.birthDate) as birthDate,
        plXpe.ifpa_id as ifpa_id,
        plXpe.ifpaRank as ifpaRank,
        coalesce(pl.comment, plXpe.comment) as comment,
        if(plXpe.ifpa_id is not null,1,0) as isIfpa,
        null as password,
        if(plXpe.id is not null,1,0) as isPerson,
        plXpe.username as username,
        if(plXpe.password is null,1,0) as passwordRequired,
    ';
    $joinBuild = whereBuilder('player', $objs);
    if ($joinBuild['coal']) {
      foreach($joinBuild['coal'] as $name => $col) {
        foreach($col as $column => $coal) {
          $select .= $coal.' as '.$name.(($column != 'name') ? '_'.$column : '').",\n";
        }
      }
      $select .= '
        if('.$joinBuild['coal']['tournamentDivision']['id'].' = 1 or pl2.tournamentDivsion_id = 1, 1, 0) as main,
        if('.$joinBuild['coal']['tournamentDivision']['id'].' = 2 or pl2.tournamentDivsion_id = 2, 1, 0) as classics,
        if(vl.tournamentEdition_id = 1, 1, 0) as volunteer
      ';
    }
    $select = trim($select, ',').'
      from player pl 
      '.$joinBuild['join'].'
      left join player pl2 on pl2.person_id = plXpe.id and pl2.tournamentDivision_id != pl.tournamentDivision_id
      left join volunteer vl on vl.person_id = plXpe.id
      where '.$joinBuild['coal']['tournamentEdition']['id'].' = 1
    ';
    // echo $select;
    $sth = $dbh->query($select.' '.$order);
    while ($obj = $sth->fetchObject('player')) {
      $objs[] = $obj;
    }
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

  function updateScore($dbh, $idScore, $iScore)
  {
    $query = 'update qualScore s set s.score = ' . $iScore;
    $query .= ' where s.id = ' . $idScore;
    $sth = $dbh->prepare($query);
    $sth->execute($update);
  }

  function getEntries($dbh, $where = null, $order = 'order by id')
  {
    $query = '
      select
        e.id as id,
        "entry" as class,
        "entry" as type,
        e.name as name,
        e.person_id as person_id,
        e.player_id as player_id,
        e.tournamentDivision_id as tournamentDivision_id, 
        e.firstName as firstName,
        e.lastName as lastName,
        e.country_id as country_id,
        e.country as country,
        e.place as place,
        e.points as points
      from qualEntry e
    ';
    $where = preg_replace('/ id /', ' e.id ', $where);
    $where = preg_replace('/ name /', ' e.name ', $where);
    $where = preg_replace('/ person_id /', ' e.person_id ', $where);
    $where = preg_replace('/ player_id /', ' e.player_id ', $where);
    $where = preg_replace('/ tournamentDivision_id /', ' e.tournamentDivision_id ', $where);
    $where = preg_replace('/ firstName /', ' e.firstName ', $where);
    $where = preg_replace('/ lastName /', ' e.lastName ', $where);
    $where = preg_replace('/ country_id /', ' e.countryId ', $where);
    $where = preg_replace('/ country /', ' e.country ', $where);
    //print $query.' '.$where.' '.$order;
    $sth = $dbh->query($query.' '.$where.' '.$order);
    while ($obj = $sth->fetchObject('entry')) {
      $objs[] = $obj;
    }
    return $objs;
  }

  function getEntry($dbh, $idPlayer, $idDivision)
  {
    $where = 'where player_id = '.$idPlayer.' and tournamentDivision_id = '.$idDivision;
    if ($obj = getEntries($dbh, $where)[0]) {
      return $obj;
    } else {
      return false;
    }
  }

  function getScores($dbh, $where = null, $order = "order by id")
  {
    $query = '
      select
        s.id as id,
        "score" as class,
        "score" as type,
        s.name as name,
        s.qualEntry_id as qualEntry_id,
        s.machine_id as machine_id,
        s.gameAcronym as gameAcronym,
        s.firstName as firstName,
        s.lastName as lastName,
        s.country as country,
        s.score as score
      from qualScore s
    ';
    $where = preg_replace('/ id /', ' s.id ', $where);
    $where = preg_replace('/ name /', ' s.name ', $where);
    $where = preg_replace('/ qualEntry_id /', ' s.qualEntry_id ', $where);
    $where = preg_replace('/ machine_id /', ' s.machine_id ', $where);
    $where = preg_replace('/ gameAcronym /', ' s.gameAcronym ', $where);
    $where = preg_replace('/ firstName /', ' s.firstName ', $where);
    $where = preg_replace('/ lastName /', ' s.lastName ', $where);
    $where = preg_replace('/ country /', ' s.country ', $where);
    $where = preg_replace('/ score /', ' s.score ', $where);
    //print $query.' '.$where.' '.$order;
    $sth = $dbh->query($query.' '.$where.' '.$order);
    while ($obj = $sth->fetchObject('score')) {
      $objs[] = $obj;
    }
    return $objs;
  }

  function getPlayerAdminLevel($dbh, $userName)
  {
    return 1;
  }

  function getPlayerList($dbh, $division = null, $tournament = '1') {
    $name = 'concat(o.firstName, " ", o.lastName)';
    if ($division) {
      $join = 'left join player l on l.person_id = o.id';
      $where = 'where l.tournamentDivision_id = '.$division;
    } else if ($tournament) {
      $join = 'left join player l on l.person_id = o.id left join tournamentDivision d on l.tournamentDivision_id = d.id';
      $where = 'where d.tournamentEdition_id = '.$tournament;
    }
    return getObjectListHelper($dbh, 'person', $where, $name, $join);
  }

  function getGameList($dbh, $division = null, $tournament = '1') {
    $name = 'o.name';
    if ($division) {
      $join = ' left join machine ma on ma.game_id = o.id';
      $where = 'where ma.tournamentDivision_id = '.$division;
    } else if ($tournament) {
      $join = ' left join machine ma on ma.game_id = o.id left join tournamentDivision d on ma.tournamentDivision_id = d.id';
      $where = 'where d.tournamentEdition_id = '.$tournament;
    }
    return getObjectListHelper($dbh, 'game', $where, $name, $join);
  }
  
  function getManufacturerList($dbh, $division = null, $tournament = '1') {
    $name = 'o.name';
    if ($division) {
      $join = ' left join game g on g.manufacturer_id = o.id left join machine ma on ma.game_id = g.id left join tournamentDivision d on ma.tournamentDivision_id = d';;
      $where = 'where ma.tournamentDivision_id = '.$division;
    } else if ($tournament) {
      $join = ' left join game g on g.manufacturer_id = o.id left join machine ma on ma.game_id = g.id left join tournamentDivision d on ma.tournamentDivision_id = d.id left join tournamentEdition e on d.tournamentEdition_id = e.id';
      $where = 'where d.tournamentEdition_id = '.$tournament;
    }
    return getObjectListHelper($dbh, 'manufacturer', $where, $name, $join);
  }
  
  function getCityList($dbh) {
    $name = 'o.name';
    return getObjectListHelper($dbh, 'city', null, $name, $join);
  }
  
  function getRegionList($dbh) {
    $name = 'o.name';
    return getObjectListHelper($dbh, 'region', null, $name, $join);
  }

  function getCountryList($dbh) {
    $name = 'o.name';
    return getObjectListHelper($dbh, 'country', null, $name, $join);
  }

  function getContinentList($dbh) {
    $name = 'o.name';
    return getObjectListHelper($dbh, 'continent', null, $name, $join);
  }

  function getGenderList($dbh) {
    $name = 'o.name';
    return getObjectListHelper($dbh, 'gender', null, $name, $join);
  }

  function getTeamList($dbh) {
    $name = 'o.name';
    return getObjectListHelper($dbh, 'team', null, $name, $join);
  }

  function getObjectListHelper($dbh, $type, $where = null, $name = 'o.name', $join = null) {
    $order = ' order by '.$name;
    $groupBy = ' group by o.id';
    $where .= ($where) ? ' and '.$name.' is not null and '.$name.' != ""' : 'where '.$name.' is not null and '.$name.' != ""';
    $query = 'select o.id as id, '.$name.' as name from '.$type.' o '.$join.' '.$where.' '.$groupBy.' '.$order;
    $sth = $dbh->query($query);
    while ($obj = $sth->fetchObject()) {
      $objs[] = $obj;
    }
    if (count($objs) > 0) {
      return $objs;
    } else {
      return false;
    }
  }
  
  function createSelect($objs, $name = 'select', $selectedId = 0, $onchange = 'infoSelected', $disabled = '') {
    $content = '<select name="'.$name.'" id="'.$name.'" onchange="'.$onchange.'(this);" previous="'.$selectedId.'" '.$disabled.">\n";
    $content .= '<option value="0">Choose...</options>';
    foreach($objs as $obj) {
      $content .= '<option value="'.$obj->id.'"';
      if ($obj->id == $selectedId) {
        $content .= ' selected';
      }
      $content .= '>'.$obj->name.'</option>'."\n";
    }
    return $content.'</select>'."\n";
  }
  
  function getManufacturerById($dbh, $id) {
    $where = 'where mn.id = '.$id;
    if ($obj = getManufacturers($dbh, $where)[0]) {
      return $obj;
    } else {
      return false;
    }
  }

  function getGameById($dbh, $id) {
    $where = 'where g.id = '.$id;
    if ($obj = getGames($dbh, $where)[0]) {
      return $obj;
    } else {
      return false;
    }
  }
  
  function getMachineById($dbh, $id) {
    $where = 'where ma.id = '.$id;
    if ($obj = getMachines($dbh, $where)[0]) {
      return $obj;
    } else {
      return false;
    }
  }
  
  function getPlayerById($dbh, $id) {
    $where = 'where p.id = '.$id;
    if ($obj = getPlayers($dbh, $where)[0]) {
      return $obj;
    } else {
      return false;
    }
  }
  
  function getEntryById($dbh, $id) {
    $where = 'where id = '. $id . ' and tournamentDivision_id = 1';
    if ($obj = getEntries($dbh, $where)[0]) {
      return $obj;
    } else {
      return false;
    }
  }
  
  function getCityById($dbh, $id) {
    $where = 'where c.id = '.$id;
    if ($obj = getCities($dbh, $where)[0]) {
      return $obj;
    } else {
      return false;
    }
  }
  
  function getRegionById($dbh, $id) {
    $where = 'where r.id = '.$id;
    if ($obj = getRegions($dbh, $where)[0]) {
      return $obj;
    } else {
      return false;
    }
  }
  
  function getCountryById($dbh, $id) {
    $where = 'where co.id = '.$id;
    if ($obj = getCountries($dbh, $where)[0]) {
      return $obj;
    } else {
      return false;
    }
  }
  
  function getContinentById($dbh, $id) {
    $where = 'where cn.id = '.$id;
    if ($obj = getContinents($dbh, $where)[0]) {
      return $obj;
    } else {
      return false;
    }
  }  

  function getGenderById($dbh, $id) {
    $where = 'where ge.id = '.$id;
    if ($obj = getGenders($dbh, $where)[0]) {
      return $obj;
    } else {
      return false;
    }
  }  
  
  function getObjectById($dbh, $type, $id) {
    switch ($type) {
      case 'game':
        return getGameById($dbh, $id);
      break;
      case 'manufacturer':
        return getManufacturerById($dbh, $id);
      break;
      case 'player':
        return getPlayerById($dbh, $id);
      break;
      case 'city':
        return getCityById($dbh, $id);
      break;
      case 'region':
        return getRegionById($dbh, $id);
      break;
      case 'country':
        return getCountryById($dbh, $id);
      break;
      case 'continent':
        return getContinentById($dbh, $id);
      break;
      case 'gender':
        return getGenderById($dbh, $id);
      break;
      case 'team':
        return getTeamById($dbh, $id);
      break;
      default:
        return false;
      break;
    }
  }
    
  function getObjectList($dbh, $type, $options) {
    switch ($type) {
      case 'game':
        return getGameList($dbh, $options['division'], $options['tournament']);
      break;
      case 'manufacturer':
        return getManufacturerList($dbh, $options['division'], $options['tournament']);
      break;
      case 'player':
        return getPlayerList($dbh, $options['division'], $options['tournament']);
      break;
      case 'city':
        return getCityList($dbh);
      break;
      case 'region':
        return getRegionList($dbh);
      break;
      case 'country':
        return getCountryList($dbh);
      break;
      case 'continent':
        return getContinentList($dbh);
      break;
      case 'gender':
        return getGenderList($dbh);
      break;
      case 'team':
        return getTeamList($dbh);
      break;
      default:
        return false;
      break;
    }
  }

  function addGeo($dbh, $geoType, $name, $parentType = null, $parentId = null) {
    $update[':name'] = $name;
    $query = 'insert into '.$geoType.' set name = :name';
    if ($parentType && $parentId) {
      $update[':parentId'] = $parentId;
      $query .= ', '.$parentType.'_id = :parentId';
    }
    $sth = $dbh->prepare($query);
    $sth->execute($update);
    return $dbh->lastInsertId();
  }
  
  function updateGeo($dbh, $geoType, $id, $parentArray){
    $update[':id'] = $id;
    $update[':parentId'] = $parentArray[1];
    $query = 'update '.$geoType.' set '.$parentArray[0].'_id = :parentId where id = :id';
    $sth = $dbh->prepare($query);
    $sth->execute($update);
  }
  
  function addPlayerGeo($dbh, $player) {
    global $geoTypes;
    $update = false;
    foreach ($geoTypes as $geoType) {
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
  
  function addPlayerQuery($dbh, $player, $type = 'player', $division = 1, $method = 'insert into') {
    global $classes;
    $query = $method.' '.$type.' set';
    $player->initials = substr($player->initials, 0, 3);
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
        if ($player->hours) {
          $query .= ' hours = :hours, ';
          $update[':hours'] = $player->hours;
        }
        $query .= ' tournamentEdition_id = :division';
        $update[':division'] = $division;
      break;
    }
    return array(rtrim($query, ','), $update);
  }
  
  function addPlayer($dbh, $player, $ulogin = null) {
    $player = addPlayerGeo($dbh, $player);
    if ($player->id == '0') {
      $player->id = addPerson($dbh, $player);
    } 
    if ($player->username && $player->password) {
      updateUser($dbh, $player, $ulogin);
    }
    foreach(array('main', 'classics') as $division) {
      if ($player->{$division} == 'true') {
        $query = addPlayerQuery($dbh, $player, 'player', (($division == 'main') ? 1 : 2));
        $sth = $dbh->prepare($query[0]);
        $sth->execute($query[1]);
      }
    }
    if ($player->volunteer == 'true') {
      if (!getVolunteerById($dbh, $player->id)) {
        if (checkPlayer($dbh, $player, 'volunteer')) {
          addVolunteer($dbh, $player, 1, 'update');        
        } else {
          addVolunteer($dbh, $player, 1);
        }
      }
    }
  }
  
  function editPlayer($dbh, $player, $ulogin = null) {
    $pId = $player->id;
    $player = addPlayerGeo($dbh, $player);
    $player->initials = substr($player->initials, 0, 3);
    foreach(array('main', 'classics') as $division) {
      if ($player->{$division} == 'true') {
        if (checkPlayer($dbh, $player, $division)) {
          $query = addPlayerQuery($dbh, $player, 'player', (($division == 'main') ? 1 : 2), 'update');
          $query[0] .= ' where person_id = :pId and tournamentDivision_id = :divisionId';
          $query[1][':pId'] = $pId;
          $query[1][':divisionId'] = ($division == 'main') ? 1 : 2;
        } else {
          $query = addPlayerQuery($dbh, $player, 'player', (($division == 'main') ? 1 : 2));
        }
        $sth = $dbh->prepare($query[0]);
        $sth->execute($query[1]);
      } else {
        deletePlayer($dbh, $player, $division);
      }
    }
    if ($player->username && $player->password) {
      updateUser($dbh, $player, $ulogin);
    }
    if ($player->volunteer == 'true') {
      if (checkPlayer($dbh, $player, 'volunteer')) {
        addVolunteer($dbh, $player, 1, 'update');        
      } else {
        addVolunteer($dbh, $player, 1);
      }
    } else {
      deletePlayer($dbh, $player, 'volunteer');
    }
    if ($player->newPhoto != 'false') {
      setPhoto($player);
    }
  }
  
  function checkPlayer($dbh, $player, $division) {
    $table = ($division == 'volunteer') ? 'volunteer' : 'player';
    $field = ($division == 'volunteer') ? 'tournamentEdition_id' : 'tournamentDivision_id';
    $divisionId = ($division == 'classics') ? 2 : 1;
    $query = 'select count(*) from '.$table.' where person_id = '.$player->id.' and '.$field.' = '.$divisionId;
    $sth = $dbh->query($query);
    if ($sth->fetchColumn() > 0) {
      return true;
    } else {
      return false;
    }
  }
  
  function deletePlayer($dbh, $player, $division) {
    $table = ($division == 'volunteer') ? 'volunteer' : 'player';
    $field = ($division == 'volunteer') ? 'tournamentEdition_id' : 'tournamentDivision_id';
    $delete[':divisionId'] = ($division == 'classics') ? 2 : 1;
    $delete[':person_id'] = $player->id;
    $query = 'delete from '.$table.' where person_id = :person_id and '.$field.' = :divisionId';
    $sth = $dbh->prepare($query);
    $sth->execute($delete);
  }
  
  function addPerson($dbh, $player) {
    $query = addPlayerQuery($dbh, $player, 'person');
    $sth = $dbh->prepare($query[0]);
    $sth->execute($query[1]);
    return $dbh->lastInsertId();
  }
  
  function addVolunteer($dbh, $player, $tournament, $method = 'insert into') {
    $pId = $player->id;
    $query = addPlayerQuery($dbh, $player, 'volunteer', $tournament, $method);
    if ($method == 'update') {
      $query[0] .= ' where person_id = :pId';
      $query[1][':pId'] = $pId;
    }
    $sth = $dbh->prepare($query[0]);
    $sth->execute($query[1]);
    return $dbh->lastInsertId();
  }
  
  function getIdFromUser($dbh, $username) {
    $query = "select id from person where username = :username";
    $select[':username'] = $username;
    $sth = $dbh->prepare($query);
    $sth->execute($select);
    $player = $sth->fetchObject('player');
    return $player->id;
  }
  
  function updateUser($dbh, $player, $ulogin = null){
    $query = 'update person p set p.username = :username,';
    $query .= ' password = :password';
    $query .= ' where p.id = :playerId';
    $update[':username'] = $player->username;
    $update[':password'] = encrPass($player->password, $player->username);
    $update[':playerId'] = $player->id;
    $sth = $dbh->prepare($query);
    if ($sth->execute($update)) {
      if ($ulogin) {
        if ($ulogin->CreateUser($player->username,  $player->password)) {
          return true;
        } else {
          return false;
        }
      } else {
        return true;
      }
    } else {
      return false;
    }
  }
  
  function salt($ind = null){
    return 'qcy0UPy5g4jC'.$ind;
  }
  
  function encrPass($pass, $ind = null, $salt = null) {
    $salt = ($salt) ? $salt : salt($ind);
    return sha1($salt.$pass);
  }
  
  function isAssoc($arr) {
    return array_keys($arr) !== range(0, count($arr) - 1);
  }
  
  function array_slice_assoc($array, $keys) {
    return array_intersect_key($array, array_flip($keys));
  }
   
  function getIfpaIds($dbh, $where = 'where p.ifpa_id is not null', $order = 'order by ifpa_id asc') {
    $query = 'select p.id, p.ifpa_id from person p'.getPlayerJoin();
    $sth = $dbh->query($query.' '.$where.' '.$order);
    while ($obj = $sth->fetchObject()) {
      $objs[] = $obj;
    }
    return $objs;
  }
  
  function updateIfpaRank($dbh, $player) {
    $query = 'update person p set p.ifpaRank = :ifpaRank';
    $query .= ' where p.id = :playerId';
    $update[':playerId'] = $player->id;
    $update[':ifpaRank'] = $player->rank;
    $sth = $dbh->prepare($query);
    $sth->execute($update);
  }
  
  function getTable($type) {
    $content = '<div id="'.$type.'Div">
                  <h3 id="'.$type.'H3" class="entry-title">'.ucfirst(getPlural($type)).'</h3>
                  <span id="'.$type.'Loading"><img src="'.__baseHref__.'/images/ajax-loader.gif" alt="Loading data..."></span>
                  <table id="'.$type.'Table" class="list"></table>
                  <span id="'.$type.'All" class="getAll"></span>
                  <br />
                </div>
    ';
    return $content;
  }
  
  function getInfo($dbh, $type, $id) {
    global $classes;
    if ($obj = getObjectById($dbh, $type, $id)) {
      $content = '
                  <div id="infoDiv" class="infoDiv">
                    <div class="leftInfoDiv">
                      <span id="all'.ucfirst($type).'Span">Other '.getPlural($type).': '.createSelect(getObjectList($dbh, $type, array ('tournament' => '1')), 'all'.ucfirst($type).'Select', $id).'</span>
                      <h2 class="entry-title">'.$obj->name.'</h2>
                      <table>
      ';
      foreach($classes->{$type}->info as $field) {
        $label = '';
        if ($obj->{$field} && $obj->{$field} != '') {
          if ($classes->{$type}->fields->{$field}->type == 'select') {
            $value = getLink(getObjectById($dbh, strtolower(str_replace('parent', '', $field)), $obj->{$field.'_id'}));
          } else if ($field == 'isIfpa') {
            $value = '<a href="http://www.ifpapinball.com/player.php?player_id='.$obj->ifpa_id.'" target="_new">'.(($obj->ifpaRank && $obj->ifpaRank != 0) ? $obj->ifpaRank : 'Unranked').'</a>';
          } else if (in_array($field, array('main', 'classics', 'volunteer'))) {
            $value = ($obj->{$field}) ? 'Yes' : 'No';
          } else if ($field == 'isIpdb') {
            $value = '<a href="http://ipdb.org/machine.cgi?id='.$obj->ipdb_id.'" target="_new">'.$obj->ipdb_id.'</a>';
          } else if ($field == 'type') {
            $divisionId = ($obj->{$field} == 'main') ? 1 : (($obj->{$field} == 'classics') ? 2 : '');
            if ($divisionId) {
              $value = '<a href="?d='.$divisionId.'">'.ucfirst($obj->{$field}).'</a>';
            } else {
              $value = ucfirst($obj->{$field});
            }
          } else if ($field == 'rules') {
            $value = '<a href="'.$obj->{$field}.'" target="_new">Rules sheet</a>';
          } else {
            $value = ucfirst(str_replace('-00', '', $obj->{$field}));
          }
          
          $content .= '
                      <tr>
                        <td>'.(($label) ? $label : $classes->{$type}->fields->{$field}->label).': </td>
                        <td>'.$value.'</td>
                      </tr>
          ';
        }
      } 
      if ($type == 'team') {
        $players = $obj->getMembers($dbh);
        $content .= '
                      <tr>
                        <td><b>Members:</b></td>
                        <td></td>
                      </tr>
        ';
        if ($players[0]) {
          foreach ($players as $player) {
            $content .= '
                      <tr>
                        <td colspan="2">'.getLink($player).'</td>
                      </tr>
            ';
          }
        }
      }
      $content .= '
                    </table>    
                  </div>
                  <div class="rightInfoDiv">
                    <table>
                      <tr>
                        <td><img class="objectPhoto" src="'.getPhoto($dbh, $type, $id).'" alt="'.$obj->name.'"></td>
                      </tr>
                    </table>
                  </div>
                </div>
      ';
      return $content;
    } else {
      return false;
    }
  }
  
  function getGeoFilterWheres($type = false, $gender = true) {
    global $geoTypes;
    $start = false;
    foreach(array_reverse($geoTypes) as $geoType) {
      if ($start || !$type || $type == $geoType) {
        $start = true;
        if ($filter = getGeoFilterWhere($geoType)) {
          return $filter;
        }
      }
    }
    if ($gender && $filter = getGeoFilterWhere('gender')) {
      return $filter;
    }
    return false;
  }
    
  function getGeoFilterWhere($type) {
    if (isset($_REQUEST['obj']) && $_REQUEST['obj'] == $type) {
      if (isset($_REQUEST['id']) && preg_match('/^[0-9]+$/', $_REQUEST['id'])) {
        if ($type == 'region' || $type == 'country') {
          return $type.'_id = '.$_REQUEST['id'].' or parent'.ucfirst($type).'_id = '.$_REQUEST['id'];
        } else {
          return $type.'_id = '.$_REQUEST['id'];
        }
      } else {
        return false;
      } 
    } else {
      return false;
    }
  }  

  function getPhotoExts() {
    return array('png', 'jpg', 'jpeg', 'gif');
  }
    
  function getPhoto($dbh, $type, $id, $thumbnail = false) {
    if ($thumbnail) {
      foreach (getPhotoExts() as $ext) {
        if (file_exists(__ROOT__.'/images/objects/'.$type.'/'.$id.'.thumb.'.$ext)) {
          return __baseHref__.'/images/objects/'.$type.'/'.$id.'.thumb.'.$ext;
        }
      }
    } 
    foreach (getPhotoExts() as $ext) {
      if (file_exists(__ROOT__.'/images/objects/'.$type.'/'.$id.'.'.$ext)) {
        return __baseHref__.'/images/objects/'.$type.'/'.$id.'.'.$ext;
      }
    }
    if ($type == 'player') {
      $ifpa_id = getIfpaIds($dbh, 'where p.id = '.$id)[0]->ifpa_id;
      foreach (getPhotoExts() as $ext) {
        if (file_exists(__ROOT__.'/images/objects/'.$type.'/ifpa/'.$ifpa_id.'.'.$ext)) {
          return __baseHref__.'/images/objects/'.$type.'/ifpa/'.$ifpa_id.'.'.$ext;
        }
      }
    }
    if ($thumbnail) {
      foreach (getPhotoExts() as $ext) {
        if (file_exists(__ROOT__.'/images/objects/'.$type.'/0.thumb.'.$ext)) {
          return __baseHref__.'/images/objects/'.$type.'/0.thumb.'.$ext;
        }
      }
    }
    foreach (getPhotoExts() as $ext) {
      if (file_exists(__ROOT__.'/images/objects/'.$type.'/0.'.$ext)) {
        return __baseHref__.'/images/objects/'.$type.'/0.'.$ext;
      }
    }
    foreach (getPhotoExts() as $ext) {
      if (file_exists(__ROOT__.'/images/objects/0.'.$ext)) {
        return __baseHref__.'/images/objects/0.'.$ext;
      }
    }
    return false;
  }

  function setPhoto($obj) {
    if ($obj->id && $obj->id != 0) {
      foreach (getPhotoExts() as $ext) {
        if (file_exists(__ROOT__.'/images/objects/'.$obj->class.'/'.$obj->id.'.'.$ext)) {
          unlink(__ROOT__.'/images/objects/'.$obj->class.'/'.$obj->id.'.'.$ext);
        }
      }
      if (rename(__ROOT__.'/images/objects/'.$obj->newPhoto, __ROOT__.'/images/objects/'.preg_replace('/\/preview\//', '/', $obj->newPhoto))) {
        return true;
      }
    }
    return false;
  }
  
  function getLink($obj) {
    switch ($obj->class) {
      default:
        return '<a href="'.__baseHref__.'/'.$obj->class.'/?obj='.$obj->class.'&id='.$obj->id.'">'.$obj->name.'</a>';
      break;
    }
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
      case 'name':
        if (!preg_match('/^[a-zA-Z0-9 \-_#\$]{3,32}$/', $value)) {
          $return = array(false, '{"valid":false,"reason":"The name must be at least three character and can only include a-Z, A-Z, 0-9, spaces, #, $, dashes and underscores!","field":"'.$field.'", "value":"'.$value.'"}');
        } else {
          $where = ' where tournamentDivision_id = 3 and name = "'.$value.'"';
          if ($id && $id != 0) {
            $where .= ' and id != '.$id;
          }
          $query = 'select count(*) from team '.$where;
          $sth = $dbh->query($query);
          if ($sth->fetchColumn() > 0) {
            $return = array(false, '{"valid":false,"reason":"The name is already taken!","field":"'.$field.'"}');
          } else {
            $return = array(true, '{"valid":true,"reason":"The name is up for grabs (or unchanged)!","field":"'.$field.'"}');
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
      case 'currentPassword':
      case 'newPassword':
      case 'newPassword2':
        if (preg_match('/^(?=.*\d)(?=.*[A-Za-z])(?=.*[!@#$])[0-9A-Za-z!@#$]{6,50}$/', $value)) {
          $return = array(true, '{"valid":true,"reason":"Password is OK!","field":"'.$field.'"}');
        } else {
          $return = array(false, '{"valid":false,"reason":"Password is required to be at least 6 characters, including a number, a letter and one of !@#$"}');
        }
      break;
      case 'initials':
        if (preg_match('/^[a-zA-Z0-9 \-]{1,3}$/', $value) || $value == '') {
          $return = array(true, '{"valid":true,"reason":"Initials are OK!","field":"'.$field.'", "value":"'.$value.'"}');
        } else {
          $return = array(false, '{"valid":false,"reason":"Initials can only be at most three characters without any strange ones!","field":"'.$field.'", "value":"'.$value.'"}');
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
      case 'ifpaRank':
      case 'isPlayer':
      case 'isPerson':
      case 'passwordRequired':
      case 'tournamentDivision_id':
      case 'registerPerson_id':
      case 'contactPlayer_id':
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
      'game' => 'games',
      'machine' => 'machines',
      'manufacturer' => 'manufacturers',
      'gender' => 'genders',
      'person' => 'persons',
      'player' => 'players',
      'city' => 'cities',
      'region' => 'regions',
      'country' => 'countries',
      'continent' => 'continents',      
    );
    return $plurals[$text];    
  }
  
?>
