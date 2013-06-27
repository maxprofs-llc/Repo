<?php
  
  class player extends base {
    
    public $firstName;
    public $lastName;
    public $initials;
    public $gender_id;
    public $gender;
    public $streetAddress;
    public $zipCode;
    public $telephoneNumber;
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
    public $qualGroups = [];
    public $class = 'player';
    
    public function populate($dbh) {
      locate($dbh, $this, 'city');
    }
  }
?>