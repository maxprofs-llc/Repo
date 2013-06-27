<?php
function reDirectToErrorPage($a_oUser)
{
		// uber-admins should have access to everything
		if(!$a_oUser->isUberAdmin())
		{
			header("Location: " . BASE_URL . "errorNotAuth.php");
			exit;
		}	
}

function loginRedirectUserAdmin($a_oUser, $a_sType)
{
	// get logged in user-id
	$iIDUser = $a_oUser->getLoggedInUserID();
	
	switch ($a_sType) 
	{
		/*
		case "admin_users":
			if(!$a_oUser->isUserAdmin())
				reDirectToErrorPage();
	    break;

	    case "admin_entry_edit":
			if(!$a_oUser->isEntryAdmin())
				reDirectToErrorPage();
	    break;
		
	    case "admin_division_edit":
			if(!$a_oUser->isDivisionAdmin())
				reDirectToErrorPage();
	    break;

	    case "admin_games_edit":
			if(!$a_oUser->isGameAdmin())
				reDirectToErrorPage();
	    break;	    
		*/
	    case "admin_uber":
			if(!$a_oUser->isUberAdmin($iIDUser))
				reDirectToErrorPage($a_oUser);		
		
	    case "admin_scorekeep":
			if(!$a_oUser->isScorekeepAdmin($iIDUser))
				reDirectToErrorPage($a_oUser);
	    break;	    

	    default:
			reDirectToErrorPage($a_oUser);
	}	
}
?>