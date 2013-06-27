<?php
require_once("class.Model.php");
require_once("class.Entry.php");
require_once("class.DivisionsToPlayers.php");
require_once("class.TournamentSetting.php");
require_once("class.Division.php");

class Player extends Model
{
	public function insertPlayer($a_iGender, $a_iCountry, $a_sFirstName, $a_sLastName, $a_sAddressStreet, $a_sAddressZip, $a_sAddressCity, $a_sAddressRegion, $a_sPhone, $a_sMobilePhone, $a_sEmail, $a_sInitials, $a_sYear, $a_iYearBorn = null, $a_bIsSplitTeam = null)
	{
		$this->oDB->beginTransaction();

		$sQuery = sprintf("INSERT INTO players
						(genders_id_gender, countries_id_country, player_firstname, player_lastname, player_address_street, player_address_zip, player_address_city, player_address_region, player_phone, player_phone_mobile, player_email, player_initials, player_year_entered, player_date_registered, player_year_born, player_is_split_team) 
						VALUES (%d, %d, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', %d, '%s', %d, %d)",
						$this->oDB->escape($a_iGender),
						$this->oDB->escape($a_iCountry),
						$this->oDB->escape($a_sFirstName),
						$this->oDB->escape($a_sLastName),
						$this->oDB->escape($a_sAddressStreet),
						$this->oDB->escape($a_sAddressZip),
						$this->oDB->escape($a_sAddressCity),
						$this->oDB->escape($a_sAddressRegion),
						$this->oDB->escape($a_sPhone),
						$this->oDB->escape($a_sMobilePhone),
						$this->oDB->escape($a_sEmail),
						$this->oDB->escape($a_sInitials),
						$this->oDB->escape($a_sYear),					
						date("Y-m-d H:i:s"),
						$this->oDB->escape($a_iYearBorn),					
						$this->oDB->escape($a_bIsSplitTeam));					
		
		$this->oMDB2Wrapper->query("exec", $sQuery);
		
		// get the latest player id
		$sQuery = "SELECT MAX(id_player) AS id_player FROM players";
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		$this->oDB->commit();	

		// want to insert this as well, since we might implement: a-player-can-be-in-multiple-divisions (for e.g. classics and juniors)	
		// ... but only if the main-divisions are active... If they're not this will be inserted at the register.php page
		$oTournamentSetting = new TournamentSetting();
		$aTournamentSettings = $oTournamentSetting->getTournamentSettings(YEAR);
		if($aTournamentSettings[0]['ts_normal_divisions_active'] == 1)
		{
			$oDivisionsToPlayers = new DivisionsToPlayers();
			$oDivisionsToPlayers->insertDivision($a_iDivision, $aRes[0]['id_player']);
		}
		
		return $aRes[0]['id_player'];
	}
	
	public function updatePlayer($a_iIDPlayer, $a_iGender, $a_iCountry, $a_sFirstName, $a_sLastName, $a_sAddressStreet, $a_sAddressZip, $a_sAddressCity, $a_sAddressRegion, $a_sPhone, $a_sMobilePhone, $a_sEmail, $a_sInitials, $a_iYearBorn = null)
	{
		if($a_iCountry == 0 || $a_iCountry == null)
		{
			// 243 is "unknown"
			$a_iCountry = 243;
		}
		
		if($a_iGender == 0 || $a_iGender == null)
		{
			// set default to "male" (id = 2)
			$a_iGender = 2;
		}
			
		$sQuery = sprintf("UPDATE players
						SET genders_id_gender = %d, countries_id_country = %d, player_firstname = '%s', player_lastname = '%s', player_address_street = '%s', player_address_zip = '%s', player_address_city = '%s', player_address_region = '%s', player_phone = '%s', player_phone_mobile = '%s', player_email = '%s', player_initials = '%s', player_year_born = %d 
						WHERE id_player = %d",
						$this->oDB->escape($a_iGender),
						$this->oDB->escape($a_iCountry),
						$this->oDB->escape($a_sFirstName),
						$this->oDB->escape($a_sLastName),
						$this->oDB->escape($a_sAddressStreet),
						$this->oDB->escape($a_sAddressZip),
						$this->oDB->escape($a_sAddressCity),
						$this->oDB->escape($a_sAddressRegion),
						$this->oDB->escape($a_sPhone),
						$this->oDB->escape($a_sMobilePhone),
						$this->oDB->escape($a_sEmail),
						$this->oDB->escape($a_sInitials),
						$this->oDB->escape($a_iYearBorn),					
						$this->oDB->escape($a_iIDPlayer));
		
		$this->oMDB2Wrapper->query("exec", $sQuery);			
	}
	
	public function deletePlayer($iIDPlayer)
	{
		// delete from split-teams first
		$sQuery = sprintf("DELETE FROM team_split 
							WHERE players_id_player = %d 
							LIMIT 1",
							$this->oDB->escape($iIDPlayer));
							
		$this->oMDB2Wrapper->query("exec", $sQuery);		

		$sQuery = sprintf("DELETE FROM players 
							WHERE id_player = %d 
							LIMIT 1",
							$this->oDB->escape($iIDPlayer));
		
		// delete all the divisions for this player
		$oDivisionsToPlayers = new DivisionsToPlayers();
		$oDivisionsToPlayers->deleteDivisions($iIDPlayer);		
		$this->oMDB2Wrapper->query("exec", $sQuery);		
	}
	
	public function getPlayer($a_iIDPlayer, $a_iYear = null)
	{
		// in some certain cases we only want to display players from a certain year
		$sAndYear = null;
		if($a_iYear != null)
			$sAndYear = sprintf("AND player_year_entered = %d", $this->oDB->escape($a_iYear));
			
		$sQuery = sprintf("SELECT players.*, countries.*, genders.*
							FROM players
							JOIN countries
							ON players.countries_id_country = countries.id_country
							JOIN genders
							ON players.genders_id_gender = genders.id_gender
							WHERE players.id_player=%d " . $sAndYear . " 
							LIMIT 1",
							$this->oDB->escape($a_iIDPlayer));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		
		if(isset($aRes[0]))
			$aRes = $this->addSplitTeamVariables($aRes);	
				
		if($aRes != null)
			return $aRes[0];
		else
			return null;
			
	}
	
	public function getPlayers($a_iYear, $a_sDivision = null, $a_sSort = null, $a_bPaidOnly = false, $a_bExcludeSplit = false)
	{
		$sOrder = "ORDER BY player_date_registered DESC";
		
		if($a_sSort == null || $a_sSort == "dateDesc")
		{
			$sOrder = "ORDER BY player_date_registered DESC";
		}
		else if($a_sSort == "nameAsc")
		{
			$sOrder = "ORDER BY player_firstname ASC, player_lastname ASC";
		}
		else if($a_sSort == "initialsAsc")
		{
			$sOrder = "ORDER BY player_initials ASC, player_firstname ASC";
		}
		else if($a_sSort == "cityAsc")
		{
			$sOrder = "ORDER BY player_address_city ASC, player_firstname ASC";
		}		
		else if($a_sSort == "countryAsc")
		{
			$sOrder = "ORDER BY countries.country_name ASC, player_address_city ASC";
		}
		else if($a_sSort == "paid")
		{
			$sOrder = "ORDER BY divisions_to_players.dtp_paid_fee DESC, player_date_registered DESC";
		}
						
		if($a_sDivision != null)
			$sDivision = sprintf(" AND divisions.division_name_short = '%s'", $this->oDB->escape($a_sDivision));
		else
			$sDivision = null;
		
		if($a_bPaidOnly)
			$sPaid = "AND divisions_to_players.dtp_paid_fee = 1";
		else
			$sPaid = null;
		
		$sAndSplit = null;
		if($a_bExcludeSplit)
			$sAndSplit = "AND players.player_is_split_team != 1";
			
		if($a_sDivision != null)
		{
			$sQuery = sprintf("SELECT players.*, countries.*, divisions.*, divisions_to_players.*
								FROM players
								JOIN countries
								ON players.countries_id_country = countries.id_country
								JOIN divisions_to_players
								ON players.id_player = divisions_to_players.players_id_player
								JOIN divisions
								ON divisions_to_players.divisions_id_division = divisions.id_division
								WHERE players.player_year_entered = %d" 
								. $sDivision . " " . $sPaid . "
								%s",
								$this->oDB->escape($a_iYear),
								$this->oDB->escape($sOrder));
		}
		else
		{
			if($a_bPaidOnly)
			{
				$sQuery = sprintf("SELECT players.*, countries.*
									FROM players
									JOIN countries
									ON players.countries_id_country = countries.id_country
									JOIN divisions_to_players
									ON players.id_player = divisions_to_players.players_id_player
									WHERE players.player_year_entered= %d " . $sPaid . "
									" . $sAndSplit . "
									%s",
									$this->oDB->escape($a_iYear),
									$this->oDB->escape($sOrder));
			}
			else
			{
				$sQuery = sprintf("SELECT players.*, countries.*
									FROM players
									JOIN countries
									ON players.countries_id_country = countries.id_country
									WHERE players.player_year_entered= %d
									" . $sAndSplit . "
									%s",
									$this->oDB->escape($a_iYear),
									$this->oDB->escape($sOrder));
			}
		}
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		$aRes = $this->addSplitTeamVariables($aRes);
		return $aRes;			
	}
	
	public function addSplitTeamVariables($a_aPlayers)
	{
		$i = 0;
		foreach($a_aPlayers as $player)
		{
			if($player["player_is_split_team"] == 1)
			{
				$a_aPlayers[$i] = $this->getSplitTeamVariables($player);
			}
			$i++;

		}		
		return $a_aPlayers;
	}
	
	public function getSplitTeamVariables($a_aPlayer)
	{
		// get the team members city
		$sQuery = sprintf("SELECT * FROM team_split
							WHERE players_id_player=%d
							LIMIT 1",
							$this->oDB->escape($a_aPlayer["id_player"]));

		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);

		$iIDPlayer1 = $aRes[0]["team_split_id_player_1"];
		$iIDPlayer2 = $aRes[0]["team_split_id_player_2"];

		// get the first player's data
		$aPlayer1Data = $this->getPlayer($iIDPlayer1);
		
		// get the second player's data
		$aPlayer2Data = $this->getPlayer($iIDPlayer2);

		// add the data to the player array
		$a_aPlayer["split_1_address_city"] = $aPlayer1Data["player_address_city"];
		$a_aPlayer["split_2_address_city"] = $aPlayer2Data["player_address_city"];
		$a_aPlayer["split_1_id_country"] = $aPlayer1Data["id_country"];
		$a_aPlayer["split_2_id_country"] = $aPlayer2Data["id_country"];
		$a_aPlayer["split_1_country_name"] = $aPlayer1Data["country_name"];
		$a_aPlayer["split_2_country_name"] = $aPlayer2Data["country_name"];
		$a_aPlayer["split_1_country_def"] = $aPlayer1Data["country_def"];
		$a_aPlayer["split_2_country_def"] = $aPlayer2Data["country_def"];
		$a_aPlayer["split_1_country_code"] = $aPlayer1Data["country_code"];
		$a_aPlayer["split_2_country_code"] = $aPlayer2Data["country_code"];
		$a_aPlayer["split_1_firstname"] = $aPlayer1Data["player_firstname"];
		$a_aPlayer["split_2_firstname"] = $aPlayer2Data["player_firstname"];
		$a_aPlayer["split_1_lastname"] = $aPlayer1Data["player_lastname"];
		$a_aPlayer["split_2_lastname"] = $aPlayer2Data["player_lastname"];
		$a_aPlayer["split_1_id_player"] = $aPlayer1Data["id_player"];
		$a_aPlayer["split_2_id_player"] = $aPlayer2Data["id_player"];
		$a_aPlayer["split_1_initials"] = $aPlayer1Data["player_initials"];
		$a_aPlayer["split_2_initials"] = $aPlayer2Data["player_initials"];

		return $a_aPlayer;
	}
	
	public function getNumberOfPlayersFromYearAndDivision($a_iYear, $a_sDivision)
	{
		$aPlayers = $this->getPlayers($a_iYear, $a_sDivision, null, true);
		return count($aPlayers);
	}

	public function getPlayerCountForName($a_sFirstName, $a_sLastName, $a_iYear)
	{
		$sQuery = sprintf("SELECT COUNT(*) AS count
							FROM players
							WHERE player_firstname LIKE '%s' AND player_lastname LIKE '%s'
							AND player_year_entered = %d",
							$this->oDB->escape($a_sFirstName),
							$this->oDB->escape($a_sLastName),
							$this->oDB->escape($a_iYear));
			
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);		
		return $aRes[0]['count'];
	}
		
	public function getNumberOfPlayersFromYear($a_iYear)
	{
		$sQuery = sprintf("SELECT COUNT(players.id_player) AS count
							FROM players
							WHERE player_year_entered = %d
							AND player_is_split_team !=1",
							$this->oDB->escape($a_iYear));
							
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);		
		return $aRes[0]['count'];
	}
	
	public function getCountryCountFromYear($a_iYear)
	{
		$sQuery = sprintf("SELECT COUNT(DISTINCT(players.countries_id_country)) AS count
							FROM players
							WHERE players.player_year_entered = %d
							AND players.player_is_split_team != 1",		
							$this->oDB->escape($a_iYear));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);		
		return $aRes[0]['count'];
	}

	public function getCountryCountFromYearAndDivision($a_iYear, $a_sDivision)
	{
		$sQuery = sprintf("SELECT COUNT(DISTINCT(players.countries_id_country)) AS count
							FROM players
							JOIN countries ON players.countries_id_country = countries.id_country
							JOIN divisions_to_players ON players.id_player = divisions_to_players.players_id_player
							JOIN divisions ON divisions_to_players.divisions_id_division = divisions.id_division
							WHERE players.player_year_entered = %d
							AND divisions.division_name_short = '%s'",
							$this->oDB->escape($a_iYear),
							$this->oDB->escape($a_sDivision));							
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);		
		return $aRes[0]['count'];
	}	
	
	public function getNumberOfCountriesRepresentedFromYear($a_iYear)
	{
		$aPlayers = $this->getPlayers($a_iYear, null, "countryAsc", true);
		$aStoredCountries = array();
		$aStoredCountries['country_name'] = array();
		$aStoredCountries['no_of_players'] = array();
		$iNoOfCountries = 0;
		foreach($aPlayers as $player)
		{
			// TODO: this shouldn't be hard-coded, but I'll leave it like this for now
			if(!in_array($player['country_name'], $aStoredCountries['country_name']) && $player['country_name'] != "Unknown")
			{
				array_push($aStoredCountries['country_name'], $player['country_name']);
				$iNoOfPlayersFromCountry = $this->getNumberOfPlayersFromCountryAndYear($a_iYear, $player['countries_id_country'], true);
				array_push($aStoredCountries['no_of_players'], $iNoOfPlayersFromCountry);
				$iNoOfCountries++;
			}
		}
		
		$aRet = $aStoredCountries;
		$aRet['no_of_countries'] = $iNoOfCountries;
		return $aRet;
	}
	
	public function getNumberOfPlayersFromCountryAndYear($a_iYear, $a_iIDCountry, $a_bPaidOnly = false)
	{		
		$sQuery = sprintf("SELECT COUNT(DISTINCT(players.id_player)) AS count
							FROM players
							JOIN divisions_to_players
							ON players.id_player = divisions_to_players.players_id_player
							WHERE countries_id_country= %d
							AND player_year_entered= %d
							AND dtp_paid_fee = 1",
							$this->oDB->escape($a_iIDCountry),
							$this->oDB->escape($a_iYear));

		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);		
		return $aRes[0]['count'];
	}
	
	public function isValidPlayerID($a_iIDPlayer)
	{
		$sQuery = sprintf("SELECT id_player
							FROM players
							WHERE id_player =%d
							LIMIT 1",
							$this->oDB->escape($a_iIDPlayer));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);

		if($aRes == null)
			return false;
		else
			return true;
	}

	public function searchPlayersWithEntries($a_sSearch, $a_bOnlyWithEntryRounds = false, $a_bInitials = false)
	{
		$sAndEntryRounds = null;
		if($a_bOnlyWithEntryRounds)
			$sAndEntryRounds = "AND divisions_to_players.dtp_no_of_played_entries > 0"; // doesn't matter which division the entries have been played in
					
		$a_sSearch = $this->oDB->escape($a_sSearch);

		if(!$a_bInitials)
			$sWhere = "WHERE CONCAT(players.player_firstname, ' ', players.player_lastname) LIKE '%" . $a_sSearch . "%'"; 
		else
			$sWhere = "WHERE players.player_initials LIKE '%" . $a_sSearch . "%'"; 
		
		$sQuery = "SELECT *	FROM players 
					JOIN divisions_to_players
					ON players.id_player = divisions_to_players.players_id_player
					JOIN divisions
					ON divisions_to_players.divisions_id_division = divisions.id_division 
					JOIN countries
					ON players.countries_id_country = countries.id_country " . 
					$sWhere . $sAndEntryRounds . "
					ORDER BY player_year_entered DESC, player_firstname ASC, player_lastname ASC";

		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		$aRes = $this->addSplitTeamVariables($aRes);
		
		$aRet = array();
		$oEntry = new Entry();
		if($aRes != null)
		{
			foreach($aRes as $player)
			{
				$aEntries = $oEntry->getAllEntriesForPlayer($player['id_player']);
				array_push($aRet, $aEntries);
			}
		}

		return $aRet;
	}
	
	// sloppy... i should have changed the function above a bit to incorporate this, but it's 04:12 AM ;)
	public function searchPlayerNames($a_sPlayerName, $a_bOnlyWithEntryRounds = false)
	{
		$sAndEntryRounds = null;
		if($a_bOnlyWithEntryRounds)
			$sAndEntryRounds = "AND divisions_to_players.dtp_no_of_played_entries > 0";
			
		$sPlayerName = $this->oDB->escape($a_sPlayerName);		
		$sQuery = "SELECT DISTINCT(CONCAT(players.player_firstname, ' ', players.player_lastname)) AS player_name
					FROM players
					JOIN divisions_to_players
					ON players.id_player =  divisions_to_players.players_id_player
					WHERE CONCAT(players.player_firstname, ' ', players.player_lastname) LIKE '%" . $sPlayerName . "%'" . 
					$sAndEntryRounds . "
					ORDER BY player_firstname ASC, player_lastname ASC,  player_year_entered DESC";
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		//$aRes = $this->addSplitTeamVariables($aRes);
		return $aRes;
	}
	
	public function searchPlayerNamesAndInitials($a_sSearch, $a_bOnlyWithEntryRounds = false)
	{
		$sAndEntryRounds = null;
		if($a_bOnlyWithEntryRounds)
			$sAndEntryRounds = "AND divisions_to_players.dtp_no_of_played_entries > 0";
			
		$sPlayerName = $this->oDB->escape($a_sSearch);		
		$sQuery = "SELECT DISTINCT(CONCAT(players.player_firstname, ' ', players.player_lastname)) AS player_name, players.player_initials
					FROM players 
					JOIN divisions_to_players
					ON players.id_player =  divisions_to_players.players_id_player
					WHERE (CONCAT(players.player_firstname, ' ', players.player_lastname) LIKE '%" . $a_sSearch . "%' OR players.player_initials LIKE '%" . $a_sSearch . "%') " . 
					$sAndEntryRounds . " 
					ORDER BY player_firstname ASC, player_lastname ASC,  player_year_entered DESC";
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		//$aRes = $this->addSplitTeamVariables($aRes);
		return $aRes;
	}
	
	public function searchPlayerInitials($a_sInitials, $a_bOnlyWithEntryRounds = false)
	{
		$sAndEntryRounds = null;
		if($a_bOnlyWithEntryRounds)
			$sAndEntryRounds = "AND divisions_to_players.dtp_no_of_played_entries > 0";
			
		$a_sInitials = $this->oDB->escape($a_sInitials);		
		$sQuery = "SELECT DISTINCT(CONCAT(players.player_firstname, ' ', players.player_lastname)) AS player_name
					FROM players 
					JOIN divisions_to_players
					ON players.id_player =  divisions_to_players.players_id_player
					WHERE players.player_initials LIKE '%" . $a_sInitials . "%' " . $sAndEntryRounds . " ORDER BY player_firstname ASC, player_lastname ASC,  player_year_entered DESC";
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		//$aRes = $this->addSplitTeamVariables($aRes);
		return $aRes;
	}
	
	public function isSplitTeam($a_iIDPlayer)
	{
		$sQuery = sprintf("SELECT player_is_split_team 
							FROM players
							WHERE id_player =%d
							LIMIT 1",
							$this->oDB->escape($a_iIDPlayer));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		
		if($aRes != null)
		{
			if($aRes[0]["player_is_split_team"] == 1)
				return true;
			else
				return false;
		}
		else
			return false;		
	}
	
	public function playerIsInTeam($a_iIDPlayer)
	{
		$sQuery = sprintf("SELECT COUNT(*) AS count 
							FROM team_split
							WHERE team_split_id_player_1 = %d OR team_split_id_player_2 = %d
							LIMIT 1",
							$this->oDB->escape($a_iIDPlayer),
							$this->oDB->escape($a_iIDPlayer));
							
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		
		if($aRes[0]['count'] > 0)
			return true;
		else
			return false;		
	}

	public function hasPaidEntranceFee($a_iIDPlayer, $a_sDivision)
	{
		$sQuery = sprintf("SELECT dtp_paid_fee
							FROM divisions_to_players
							JOIN players
							ON divisions_to_players.players_id_player = players.id_player
							JOIN divisions
							ON divisions_to_players.divisions_id_division = divisions.id_division
							WHERE players.id_player = %d
							AND divisions.division_name_short = '%s'
							LIMIT 1",
							$this->oDB->escape($a_iIDPlayer),
							$this->oDB->escape($a_sDivision));
							
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		
		if($aRes != null)
		{
			if($aRes[0]['dtp_paid_fee'] == 1)
				return true;
			else
				return false;
		}
		else
			return false;
	}

	public function setEntrancFeePaid($a_iIDPlayer, $a_sDivision)
	{
		// get the divisions id
		$oDivision = new Division();
		$iIDDivision = $oDivision->getDivisionIDFromShortName($a_sDivision);				

		$sQuery = sprintf("UPDATE divisions_to_players 
							SET dtp_paid_fee = 1
							WHERE players_id_player = %d
							AND divisions_id_division = %d
							LIMIT 1",
							$this->oDB->escape($a_iIDPlayer),
							$this->oDB->escape($iIDDivision));

		$this->oMDB2Wrapper->query("exec", $sQuery);						
	}

	public function setEntrancFeeNonPaid($a_iIDPlayer, $a_sDivision)
	{
		// get the divisions id
		$oDivision = new Division();
		$iIDDivision = $oDivision->getDivisionIDFromShortName($a_sDivision);				

		$sQuery = sprintf("UPDATE divisions_to_players 
							SET dtp_paid_fee = 0
							WHERE players_id_player = %d
							AND divisions_id_division = %d
							LIMIT 1",
							$this->oDB->escape($a_iIDPlayer),
							$this->oDB->escape($iIDDivision));
		
		$this->oMDB2Wrapper->query("exec", $sQuery);						
	}

	public function getNumberOfPlayersWithEntranceFee($a_iYear = null, $a_sDivision = null)
	{
		if($a_iYear != null)
		{
			$sWhereYear = sprintf(" AND players.player_year_entered = %d",
								$this->oDB->escape($a_iYear));
		}
		else
			$sWhereYear = null;

		if($a_sDivision != null)
		{
			$sWhereDivision = sprintf(" AND divisions.division_name_short = '%s'",
								$this->oDB->escape($a_sDivision));
		}
		else
			$sWhereDivision = null;

		$sQuery = "SELECT COUNT(*) 
					FROM players
					JOIN divisions_to_players
					ON divisions_to_players.players_id_player = players.id_player 
					JOIN divisions
					ON divisions.id_division = divisions_to_players.divisions_id_division
					WHERE divisions_to_players.dtp_paid_fee = 1
					 " . $sWhereYear . $sWhereDivision; 
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes[0]['count(*)'];
	}
	
	public function voidTeam($a_iIDTeam)
	{
		$sQuery = sprintf("UPDATE players 
							SET player_is_split_team_voided = 1
							WHERE id_player = %d
							LIMIT 1",
							$this->oDB->escape($a_iIDTeam));

		$this->oMDB2Wrapper->query("exec", $sQuery);		
	}
	
	public function teamIsVoided($a_iIDTeam)
	{
		$sQuery = sprintf("SELECT player_is_split_team_voided 
							FROM players
							WHERE id_player = %d
							LIMIT 1",
							$this->oDB->escape($a_iIDTeam));
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);

		if($aRes != null)
		{
			if($aRes[0]['player_is_split_team_voided'] == 1)
				return true;
			else
				return false;
		}
		else
			return false;
	}
}
?>