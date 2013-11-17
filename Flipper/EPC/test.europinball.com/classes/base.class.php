<?php

  abstract class base {
    
    public static $_db;

    public $db;
    public $id;
    public $name;
    public $fullName;
    public $shortName;
    public $acronym;
    public $photo;
    public $icon;
    public $comment;
    
    public static $parents = array(
    );
    
    public function __construct($data = NULL, $populate = TRUE) {
      if (!self::$_db) {
        self::$_db = new db();
      } 
      $this->db = self::$_db;
      if ($data) {
        if (preg_match('/^[0-9]+/', $data)) {
          $obj = $this->db->getObjectById(get_class($this), $data);
          if ($obj) {
            $this->_set($obj);
          }
        } else if (is_string($data) && is_object(json_decode($data))) {
          $this->_set(json_decode($data));
        } else if (is_array($data)) {
          $this->_set($data);
        }
      }
      echo get_class($this).': '.$this->id.' P: '.(($populate) ? 'true' : 'false').' ';
      if ($populate) {
        $this->populate();
      }
    }
    
    protected function _set($data) {
      foreach ($data as $key => $value) {
        $this->{$key} = $value;
      }
    }
    
    protected function populate() {
      foreach (static::$parents as $field => $class) {
        $this->$field = new $class($this->{$field.'_id'}, FALSE);
      }
    }

  }
?>