<?php
  
  class machine extends base {
    
    public $tournamentDivision_id;
    public $game_id;
    public $game;
    public $class = 'machine';
    
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
