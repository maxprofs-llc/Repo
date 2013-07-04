<?php

function customTemplate($page) {
	switch($page) {
		case 'you':
		case 'you-2':
		case 'your-pages':
      header('Location: /wordpress/registration/players/?obj=player&id=self');
      die();
    break;
		case 'players':
		case 'player':
		case 'other-players':
	    include($_SERVER['DOCUMENT_ROOT'].'/2013/player.php');
    break;
		case 'country':
		case 'countries':
	    include($_SERVER['DOCUMENT_ROOT'].'/2013/country.php');
    break;
		case 'city':
		case 'cities':
	    include($_SERVER['DOCUMENT_ROOT'].'/2013/city.php');
    break;
		case 'region':
		case 'regions':
	    include($_SERVER['DOCUMENT_ROOT'].'/2013/region.php');
    break;
		case 'continent':
		case 'continents':
	    include($_SERVER['DOCUMENT_ROOT'].'/2013/continent.php');
    break;
		case 'manufacturer':
		case 'manufacturers':
      include($_SERVER['DOCUMENT_ROOT'].'/2013/manufacturer.php');
    break;
		case 'machine':
		case 'machines':
		case 'game':
		case 'games':
	    include($_SERVER['DOCUMENT_ROOT'].'/2013/game.php');
    break;
		case 'gender':
		case 'genders':
	    include($_SERVER['DOCUMENT_ROOT'].'/2013/gender.php');
    break;
		case 'object':
			include($_SERVER['DOCUMENT_ROOT'].'/2013/object.php');
	  break;
		case 'editplayer':
			include($_SERVER['DOCUMENT_ROOT'].'/2013/edit.php');
	  break;
		case 'registration':
			include($_SERVER['DOCUMENT_ROOT'].'/2013/reg.php');
	  break;
		case 'change-credentials':
			include($_SERVER['DOCUMENT_ROOT'].'/2013/changeCredentials.php');
	  break;
		case 'login':
			include($_SERVER['DOCUMENT_ROOT'].'/2013/login.php');
	  break;
		case 'logout':
			include($_SERVER['DOCUMENT_ROOT'].'/2013/logout.php');
	  break;
	}
}

?>
