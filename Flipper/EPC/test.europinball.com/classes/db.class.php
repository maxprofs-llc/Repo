<?php

  class db extends PDO {
    
    private $host = 'localhost';
    private $name = 'epc_test';
    private $user = 'epc';
    private $pass = 'vLdqLYyvxSZermEv';
    private $charset = 'utf8';
    private $dbh;
    private $sth;
    
    public function __construct() {
      parent::__construct('mysql:host='.$this->host.';dbname='.$this->name.';charset='.$this->charset, $this->user, $this->pass);
      $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    public function getObjectById($class, $id) {
      $query = $class::$select.' where o.id = '.$id;
      $this->sth = $this->query($query);
      $obj = $this->sth->fetchObject($class);
      if ($this->last_row_count()) {
        return $obj;
      } else {
        return false;
      }
    }

    public function last_row_count() {
      return $this->query("SELECT FOUND_ROWS()")->fetchColumn();
    }

  }


?>