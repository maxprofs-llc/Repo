<?php
  require_once('../functions/general.php');
  header('Content-Type: application/json');
  
  $allValid = true;
  if ($_REQUEST['data']) {
    foreach ($_REQUEST['data'] as $data) {
      var_dump($data);
      $value = json_decode($data);
      var_dump($value);
      $check = checkField($dbh, $value->f, $value->v, $value->id);
      if (!$check[0]) {
        $allValid = false;
        echo $check[1];       
        return false; 
      }
    }
    if ($allValid) {
      echo '{"valid":true,"reason":"All fields are OK!","field":null}';
    }
  } else {
    echo checkField($dbh, $_REQUEST['f'], $_REQUEST['v'], $_REQUEST['id'])[1];
  }
    
  ?>