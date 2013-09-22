<?php
  
  class tshirt extends base {
    
    public $player;
    public $player_id;
    public $playerTshirt_id;
    public $color;
    public $number;
    public $number_id;
    public $color_id;
    public $size;
    public $size_id;
    public $tournamentTshirt_id;
    public $tournamentEdition;
    public $tournamentEdition_id;
    
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
