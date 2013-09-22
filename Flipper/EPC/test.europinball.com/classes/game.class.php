<?php
  
  class game extends base {
    
    public $acronym;
    public $isIpdb;
    public $ipdb_id;
    public $year;
    public $rules;
    public $classics;
    public $main;
    public $type;
    public $manufacturer;
    public $manufacturer_id;
    public $class = 'game';
    
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
      $this->type = ($this->classics) ? 'classics' : (($this->main) ? 'main' : null);
    }
    
    public function set($data) {
      foreach ($data as $key => $value) {
        $this->{$key} = $value;
      }
    }

  }
?>
