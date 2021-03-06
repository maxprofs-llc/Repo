<?php

  define('__ROOT__', dirname(dirname(__FILE__))); 
  require_once(__ROOT__.'/functions/init.php');
  
  $class = (isset($_REQUEST['class'])) ? $_REQUEST['class'] : NULL;
  $id = (isId($_REQUEST['id'])) ? $_REQUEST['id'] : NULL;
  $prop = (isset($_REQUEST['prop'])) ? $_REQUEST['prop'] : NULL;
  
  if ($class) {
    if (isObj($class, TRUE)) {
      if (isId($id)) {
        $obj = $class($id);
        if ($obj) {
          if ($prop) {
            $json = success($obj->$prop);
          } else {
            $json = success($obj);
          }
        } else {
          $json = failure('No such object');
        }
      } else {
        $json = failure('Invalid ID');
      }
    } else {
      $json = failure('No such class');
    }
  } else {
    $json = failure('No class provided');
  }
  
  jsonEcho($json);
  
?>
