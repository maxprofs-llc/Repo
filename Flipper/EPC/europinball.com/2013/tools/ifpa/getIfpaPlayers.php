<?php
  define('__ROOT__', dirname(dirname(dirname(__FILE__)))); 
  require_once(__ROOT__.'/functions/general.php');
  require_once(__ROOT__.'/tools/ifpa/ifparank.php');
  
  $objs = getIfpaIds($bdh);
  
  foreach ($objs as $obj) {
    $obj->rank = get_rank_from_id($obj->id)->rank;
    var_dump($obj);
    $i++;
    if ($i > 50) {
      die('hej');
    }
  }
