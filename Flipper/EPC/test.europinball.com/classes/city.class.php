<?php

  class city extends geography {
    
    public $continent_id;
    public $continent;
    public $country_id;
    public $country;
    public $region_id;
    public $region;
    public $class = 'city';
    
    public function populate($dbh) {
      locate($dbh, $this, 'region');
    }
    
  }
?>