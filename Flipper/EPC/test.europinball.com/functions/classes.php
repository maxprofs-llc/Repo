<?php

  spl_autoload_register(function($class) {
    if (is_file(__ROOT__.'/classes/'.$class.'.class.php')) {
      include __ROOT__.'/classes/'.$class.'.class.php';
    }
  });
  
  function object($obj) {
    return ($obj->failed) ? FALSE : $obj;
  }

  function city($data = NULL, $search = NULL) {
    $obj = new city($data, $search);
    return object($obj);
  }

  function cities($data = NULL, $search = NULL) {
    return new cities($data, $search);
  }

  function continent($data = NULL, $search = NULL) {
    $obj = new continent($data, $search);
    return object($obj);
  }

  function continents($data = NULL, $search = NULL) {
    return new continents($data, $search);
  }

  function country($data = NULL, $search = NULL) {
    $obj = new country($data, $search);
    return object($obj);
  }

  function countries($data = NULL, $search = NULL) {
    return new countries($data, $search);
  }

  function division($data = NULL, $search = NULL) {
    $obj = new division($data, $search);
    return object($obj);
  }

  function divisions($data = NULL, $prop = NULL) {
    return new divisions($data, $prop);
  }

  function entry($data = NULL, $search = NULL) {
    $obj = new entry($data, $search);
    return object($obj);
  }

  function entries($data = NULL, $prop = NULL) {
    return new entries($data, $prop);
  }

  function game($data = NULL, $search = NULL) {
    $obj = new game($data, $search);
    return object($obj);
  }

  function games($data = NULL, $search = NULL) {
    return new games($data, $search);
  }

  function gender($data = NULL, $search = NULL) {
    $obj = new gender($data, $search);
    return object($obj);
  }

  function genders($data = NULL, $search = NULL) {
    return new genders($data, $search);
  }

  function location($data = NULL, $search = NULL) {
    $obj = new location($data, $search);
    return object($obj);
  }

  function locations($data = NULL, $prop = NULL) {
    return new locations($data, $prop);
  }

  function machine($data = NULL, $search = NULL) {
    $obj = new machine($data, $search);
    return object($obj);
  }

  function machines($data = NULL, $search = NULL) {
    return new machines($data, $search);
  }

  function manufacturer($data = NULL, $search = NULL) {
    $obj = new manufacturer($data, $search);
    return object($obj);
  }

  function manufacturers($data = NULL, $search = NULL) {
    return new manufacturers($data, $search);
  }

  function match($data = NULL, $search = NULL) {
    $obj = new match($data, $search);
    return object($obj);
  }

  function matches($data = NULL, $search = NULL) {
    return new matches($data, $search);
  }

  function matchPlayer($data = NULL, $search = NULL) {
    $obj = new matchPlayer($data, $search);
    return object($obj);
  }

  function matchPlayers($data = NULL, $search = NULL) {
    return new matchPlayers($data, $search);
  }

  function owner($data = NULL, $search = NULL) {
    $obj = new owner($data, $search);
    return object($obj);
  }
  
  function owners($data = NULL, $search = NULL) {
    return new owners($data, $search);
  }
  
  function period($data = NULL, $search = NULL) {
    $obj = new period($data, $search);
    return object($obj);
  }

  function periods($data = NULL, $search = NULL) {
    return new periods($data, $search);
  }

  function person($data = NULL, $search = NULL) {
    $obj = new person($data, $search);
    return object($obj);
  }

  function persons($data = NULL, $search = NULL) {
    return new persons($data, $search);
  }

  function player($data = NULL, $search = NULL) {
    $obj = new player($data, $search);
    return object($obj);
  }

  function players($data = NULL, $search = NULL) {
    return new players($data, $search);
  }

  function qualGroup($data = NULL, $search = NULL) {
    $obj = new qualGroup($data, $search);
    return object($obj);
  }

  function qualGroups($data = NULL, $search = NULL) {
    return new qualGroups($data, $search);
  }

  function region($data = NULL, $search = NULL) {
    $obj = new region($data, $search);
    return object($obj);
  }

  function regions($data = NULL, $search = NULL) {
    return new regions($data, $search);
  }

  function score($data = NULL, $search = NULL) {
    $obj = new score($data, $search);
    return object($obj);
  }

  function scores($data = NULL, $search = NULL) {
    return new scores($data, $search);
  }

  function set($data = NULL, $search = NULL) {
    $obj = new set($data, $search);
    return object($obj);
  }

  function sets($data = NULL, $search = NULL) {
    return new sets($data, $search);
  }

  function task($data = NULL, $search = NULL) {
    $obj = new task($data, $search);
    return object($obj);
  }

  function tasks($data = NULL, $search = NULL) {
    return new tasks($data, $search);
  }

  function team($data = NULL, $search = NULL) {
    $obj = new team($data, $search);
    return object($obj);
  }

  function teams($data = NULL, $search = NULL) {
    return new teams($data, $search);
  }

  function tournament($data = NULL, $search = NULL) {
    $obj = new tournament($data, $search);
    return object($obj);
  }

  function tournaments($data = NULL, $prop = NULL) {
    return new tournaments($data, $prop);
  }

  function tshirt($data = NULL, $search = NULL) {
    $obj = new tshirt($data, $search);
    return object($obj);
  }

  function tshirts($data = NULL, $search = NULL) {
    return new tshirts($data, $search);
  }

  function volunteer($data = NULL, $search = NULL) {
    $obj = new volunteer($data, $search);
    return object($obj);
  }

  function volunteers($data = NULL, $search = NULL) {
    return new volunteers($data, $search);
  }

?>