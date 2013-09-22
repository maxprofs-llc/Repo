<?php

  class country extends geography {
    
    public $continent_id;
    public $continent;
    public $capitalCity_id;
    public $capitalCity;
    public $class = 'country';
    
    public function populate($dbh) {
      locate($dbh, $this, 'continent');
    }
    
  }
?>