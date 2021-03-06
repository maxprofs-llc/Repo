<?php

  require_once('classes.php');
  require_once('general.php');
  require_once('obj2html.php');
  
  config::$login = new auth();

  if ($_SESSION['msg']) {
    config::$msg = $_SESSION['msg'];
    unset($_SESSION['msg']);
  }
    
  function noError($noError = TRUE, $noWarning = TRUE, $noDebug = TRUE) {
    config::$debug = !$noDebug;
    config::$showWarnings = !$noWarning;
    config::$showErrors = !$noError;
  }

  if (isset($_REQUEST['noError'])) {
    noError();
  }

  if (isset($_REQUEST['debug'])) {
    config::$debug = (bool) $_REQUEST['debug'];
    config::$showWarnings = (bool) $_REQUEST['debug'];
    config::$showErrors = (bool) $_REQUEST['debug'];
  }

  $path = explode('/', $_SERVER['PHP_SELF']);
  array_pop($path);
  config::$pageType = $path[1];

  if (isset($_REQUEST[$pageType.'nonce'])) {
    if (ulNonce::Verify($pageType.'login', $_REQUEST[$pageType.'nonce'])) {
      config::$login->verified = TRUE;
    } else {
      config::$login->verified = TRUE;
    }
  }

  if (isId($_REQUEST['tournament']) || isId($_REQUEST['t'])) {
    config::$currentTournament = (isId($_REQUEST['tournament'])) ? $_REQUEST['tournament'] : $_REQUEST['t'];
  }
  
  if ($_REQUEST['msg']) {
    config::$msg = $_REQUEST['msg'];
  }
  
  if ($_REQUEST['action']) {
    config::$login->action($_REQUEST['action']);
  }

  if (!config::$login->nonce) {
    $nonce = ulNonce::Create($pageType.'login');
    config::$login->nonce = $nonce;
  }

  if (config::$login->loggedin() && !config::$login->person) {
    if (isset($_SESSION['username']) && $_SESSION['username']) {
      config::$login->person = person(array('username' => $_SESSION['username']), TRUE);
    } else if (config::$login->Username($_SESSION['uid'])) {
      $_SESSION['username'] = config::$login->Username($_SESSION['uid']);
      if (isset($_SESSION['username']) && $_SESSION['username']) {
        config::$login->person = person(array('username' => $_SESSION['username']), TRUE);
      }
    }
  }

?>