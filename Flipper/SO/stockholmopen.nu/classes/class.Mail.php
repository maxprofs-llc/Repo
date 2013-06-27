<?php
require_once(BASE_DIR . "models/class.Country.php");
require_once(BASE_DIR . "models/class.Player.php");
require_once(BASE_DIR . "models/class.Division.php");

class Mail
{

	public function sendRegistrationNotificationMain($a_aRecipients, $a_iCountry, $a_iDivision, $a_sFirstName, $a_sLastName, $a_sAddressStreet, $a_sAddressZip, $a_sAddressCity, $a_sAddressRegion, $a_sPhone, $a_sMobilePhone, $a_sEmail, $a_sInitials, $a_sMainTournament, $a_sClassics, $a_sJuniors, $a_sEmail)
	{
		$oCountry = new Country();
		$aCountry = $oCountry->getCountryFromID($a_iCountry);
		$sCountryName = $aCountry['country_name'];
		if($a_iDivision != null)
		{
			$oDivision = new Division();
			$aDivision = $oDivision->getDivisionFromID($a_iDivision);
			$sDivisionNameShort = $aDivision['division_name_short'];
		}
		
		$sText = "Stockholm Open " . YEAR . " Registration: \n";
		$sText.= "---------------------------------------------------------------------\n";
		$sText.= "Name: " . $a_sFirstName . " " . $a_sLastName . "\n";
		$sText.= "Initials: " . $a_sInitials . "\n";
		$sText.= "Country: " . $sCountryName . "\n";
		$sText.= "City: " . $a_sAddressCity . "\n";
		if($a_sEmail != null)
			$sText.= "Email: " . $a_sEmail . "\n";
			
		if($a_iDivision != null)
		{
			$sText.= "Division: " . $sDivisionNameShort . "\n";
		}
		else
		{			
			if($a_sMainTournament == "on")
				$sText .= "A: Yes\n";
			else
				$sText .= "A: No\n";
				
			if($a_sClassics == "on")
				$sText .= "Classics: Yes\n";
			else
				$sText .= "Classics: No\n";
				
			if($a_sJuniors == "on")
				$sText .= "Juniors: Yes\n";
			else
				$sText .= "Juniors: No\n";						
		}
		
		// loop through the recipients, ehm... well...
		foreach($a_aRecipients as $rec)
		{
			$headers = "From: " . EMAIL_NO_REPLY;
			mail($rec, "Stockholm Open " . YEAR . " Registration", $sText, $headers);
		}
	}
	
	public function sendRegistrationNotificationSplit($a_aRecipients, $a_sInitials, $a_sTeamName, $a_iIDPlayer1, $a_iIDPlayer2)
	{
		$oPlayer = new Player();
		$aPlayer1 = $oPlayer->getPlayer($a_iIDPlayer1);
		$aPlayer2 = $oPlayer->getPlayer($a_iIDPlayer2);
		$sText = "Stockholm Open " . YEAR . " (Team) Registration: \n";
		$sText.= "---------------------------------------------------------------------\n";
		$sText.= "Team Name: " . $a_sTeamName . "\n";
		$sText.= "Player 1: " . $aPlayer1['player_firstname'] . " " . $aPlayer1['player_lastname'] . "\n";
		$sText.= "Player 2: " . $aPlayer2['player_firstname'] . " " . $aPlayer2['player_lastname'] . "\n";
		$sText.= "Initials: " . $a_sInitials . "\n";
		$sText.= "Division: S";

		// loop through the recipients, ehm... well...
		foreach($a_aRecipients as $rec)
		{
			$headers = "From: " . EMAIL_NO_REPLY;
			mail($rec, "Stockholm Open " . YEAR . " (Team) Registration", $sText, $headers);
		}
	}

}
?>