<?php
  require_once('base.class.php'); // Why is this needed? Shouldn't autload take care of that?

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