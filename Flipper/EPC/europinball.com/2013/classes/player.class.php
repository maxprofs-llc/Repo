<?php
  
  class player extends base {
    
    public $firstName;
    public $lastName;
    public $username;
    public $password;
    public $passwordRequired;
    public $initials;
    public $isIfpa;
    public $ifpa_id;
    public $ifpaRank;
    public $isPerson;
    public $isPlayer;
    public $player_ids = [];
    public $gender_id;
    public $gender;
    public $type;
    public $streetAddress;
    public $zipCode;
    public $telephoneNumber;
    public $mobileNumber;
    public $mailAddress;
    public $city_id;
    public $city;
    public $region_id;
    public $region;
    public $country_id;
    public $country;
    public $continent_id;
    public $continent;
    public $dateRegistered;
    public $birthDate;
    public $classics;
    public $main;
    public $volunteer;
    public $qualGroups = [];
    public $qualGroup;
    public $class = 'player';
    
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
      $this->name = $this->firstName.' '.$this->lastName;
    }
    
    public function set($data) {
      foreach ($data as $key => $value) {
        $this->{$key} = $value;
      }
    }

    public function populate($dbh) {
      locate($dbh, $this, 'city');
    }
    
  }
?>