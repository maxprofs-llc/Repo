<?php
  
  class score extends base {
    
    public $qualEntry_id;
    public $machine_id;
    public $gameAcronym;
    public $firstName;
    public $lastName;
    public $score;
    public $class = 'score';
    
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