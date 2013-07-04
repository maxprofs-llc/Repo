<?php
  abstract class base {
    
    public $id;
    public $name;
    public $comment;
    public $class = 'base';

    public function populate($dbh) {
    }
  }
?>