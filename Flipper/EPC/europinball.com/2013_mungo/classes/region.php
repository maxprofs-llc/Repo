<?php
  
  class region extends country {
    
    public $country_id;
    public $country;
    public $class = 'region';
    
    public function populate($dbh) {
      locate($dbh, $this, 'country');
    }
    
  }
?>