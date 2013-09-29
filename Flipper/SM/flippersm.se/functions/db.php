<?php

  $dbhost = 'localhost';
  $dbname = 'flippersm_main';
  $dbuser = 'flippersm';
  $dbpass = 'nf7JcYqJmYT8ymCE';

  try {
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", $dbuser, $dbpass);      
  }
  catch (PDOException $e) {
    error('Failed to connect to MySQL: '.$e->getMessage());
  }
  
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
?>
