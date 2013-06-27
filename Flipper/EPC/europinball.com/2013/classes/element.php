<?php
  require_once('base.php');

  class element extends base {
  
    public $action;
    public $id;
    public $name;
    public $content;
    public $class = 'element';
  
    public function output() {
      $this->update();
      return $this->content;
    }
  
  }
?>