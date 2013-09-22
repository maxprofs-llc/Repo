<?php

  $dbhost = 'localhost';
  $dbname = 'epc_test';
  $dbuser = 'epc';
  $dbpass = 'vLdqLYyvxSZermEv';

  try {
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", $dbuser, $dbpass);      
  }
  catch (PDOException $e) {
    error('Failed to connect to MySQL: '.$e->getMessage());
  }
  
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
?>
