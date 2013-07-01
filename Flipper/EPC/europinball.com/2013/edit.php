<?php
  define('__ROOT__', dirname(__FILE__)); 
  require_once(__ROOT__.'/functions/general.php');
  
  printHeader('EPC 2013', $baseHref);
  
  $action = @$_POST['action'];

  if (isAppLoggedIn() && $action == 'logout') { // We've been requested to log out
      appLogout($ulogin);
  } else if (!isAppLoggedIn()) {
    // We've been requested to log in
    if ($action == 'login') {
      // Here we verify the nonce, so that only users can try to log in
      // to whom we've actually shown a login page. The first parameter
      // of Nonce::Verify needs to correspond to the parameter that we
      // used to create the nonce, but otherwise it can be anything
      // as long as they match.
      if (isset($_POST['nonce']) && ulNonce::Verify('login', $_POST['nonce'])) {
        // We store it in the session if the user wants to be remembered. This is because
        // some auth backends redirect the user and we will need it after the user
        // arrives back.
        if (isset($_POST['autologin'])) {
          $_SESSION['appRememberMeRequested'] = true;
        } else {
          unset($_SESSION['appRememberMeRequested']);
        }
        // This is the line where we actually try to authenticate against some kind
        // of user database. Note that depending on the auth backend, this function might
        // redirect the user to a different page, in which case it does not return.
        $ulogin->Authenticate($_POST['user'],  $_POST['pwd']);
        if ($ulogin->IsAuthSuccess()) {
          // Since we have specified callback functions to uLogin,
          // we don't have to do anything here.
        }
      } else {
  			$msg = 'invalid nonce';
      }
  	} else if ($action == 'autologin'){	// We were requested to use the remember-me function for logging in.
  		// Note, there is no username or password for autologin ('remember me')
  		if (!$ulogin->IsAuthSuccess()) {
  			$msg = 'autologin failure';
  		} else {
  			$msg = 'autologin ok';
      }
  	} 
  }
  if (isAppLoggedIn()) {
    printTopper("getObjects('geo');");
    $content = '
      <form id="newData" name="newData">
        <input type="hidden" name="loggedIn" id="loggedIn" value="true">
        <input type="hidden" name="baseHref" id="baseHref" value="'.$baseHref.'">
        '.(($_REQUEST['obj']) ? '<input type="hidden" name="obj" id="obj" value="'.$_REQUEST['obj'].'">' : '').'
        '.(($_REQUEST['id']) ? '<input type="hidden" name="id2" id="id" value="'.$_REQUEST['id'].'">' : '').'
        <input type="hidden" name="user" id="user" value="'.$_SESSION['username'].'">
        <div id="ifpaRegResults">
        <span id="playerLoading"><img src="'.$baseHref.'/images/ajax-loader.gif" alt="Loading data..."></span>
          <div id="ifpaRegResultsTableDiv" style="display: none">
            <h3 id="ifpaRegResultsH3">People found:</h3>
            <table id="ifpaRegResultsTable" class="list">
            </table>
          </div>
        </div>
      </form>
  		<form action="edit.php" method="POST">
        <input type="hidden" name="action" value="logout">
        <input type="submit" value="Logout">
      </form>
    ';
  } else {
    
    printTopper();    
    $content = '
    	<h3>You need to login to access this page</h3>
    	<form action="'.$_SERVER['REQUEST_URI'].'" method="POST">
        <input type="hidden" name="action" value="login">
        <input type="hidden" name="loggedIn" id="loggedIn" value="false">
        '.(($_REQUEST['obj']) ? '<input type="hidden" name="obj" id="obj" value="'.$_REQUEST['obj'].'">' : '').'
        '.(($_REQUEST['id']) ? '<input type="hidden" name="id2" id="id" value="'.$_REQUEST['id'].'">' : '').'
        <input type="hidden" name="baseHref" id="baseHref" value="'.$baseHref.'">
  			<input type="hidden" id="nonce" name="nonce" value="'.ulNonce::Create('login').'">
        <table>
          <tr>
    		    <td>Username:</td>
    		    <td><input type="text" name="user"></td>
          </tr>
          <tr>
    		    <td>Password:</td>
            <td><input type="password" name="pwd"></td>
          </tr>
          <tr>
            <td>Remember me:</td>
            <td><input type="checkbox" name="autologin" value="1"></td>
          </tr>
          <tr>
    		    <td colspan="2"><input type="submit"></td>
          </tr>
        </table>
    	</form>
    ';
  }

  echo($content);
  echo($msg);

  printFooter();
?>
