<?php
  
  class entry extends base {
    
    public $person_id;
    public $player_id;
    public $tournamentDivision_id;
    public $firstName;
    public $lastName;
    public $country_id;
    public $country;
    public $place;
    public $points;
    public $class = 'entry';
    
    public function __construct($data = null, $type = 'array') {
      switch ($type) {
        case 'json':
          if ($data) {
            $this->set(json_decode($json, true));
          }
        break;
        case 'array':
          if ($data) {
            $this->set($data);
          }
        break;
      }
    }
    
    public function set($data) {
      foreach ($data as $key => $value) {
        $this->{$key} = $value;
      }
    }
  }
?>