<?php

// Start a secure session if none is running
if (!sses_running()) {
	sses_start();
}

// We define some functions to log in and log out,
// as well as to determine if the user is logged in.
// This is needed because uLogin does not handle access control
// itself.
function isAppLoggedIn() {
	return isset($_SESSION['uid']) && isset($_SESSION['username']) && isset($_SESSION['loggedIn']) && ($_SESSION['loggedIn']===true);
}

function appLogin($uid, $username, $ulogin) {
	$_SESSION['uid'] = $uid;
	$_SESSION['username'] = $username;
	$_SESSION['loggedIn'] = true;

	if (isset($_SESSION['appRememberMeRequested']) && ($_SESSION['appRememberMeRequested'] === true)) {
		// Enable remember-me
		if ( !$ulogin->SetAutologin($username, true)) {
			echo "cannot enable autologin<br>";
    }
		unset($_SESSION['appRememberMeRequested']);
	}	else {
		// Disable remember-me
		if ( !$ulogin->SetAutologin($username, false)) {
			echo 'cannot disable autologin<br>';
    }
	}
}

function appLoginFail($uid = null, $username = null, $ulogin = null) {
	// Note, in case of a failed login, $uid, $username or both
	// might not be set (might be NULL).
	echo 'login failed<br>';
}

function appLogout($ulogin = null) {
  if ($ulogin) {  
    $ulogin->SetAutologin($_SESSION['username'], false);
  }
	unset($_SESSION['uid']);
	unset($_SESSION['username']);
	unset($_SESSION['loggedIn']);
}

$ulogin = new uLogin('appLogin', 'appLoginFail');

$ulogin->Autologin();

?>