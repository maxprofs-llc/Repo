<?php
// 071208: removing everything that has to do with entry-positions
// the amount of data this would generate is just too-much-to-be-worth-the-huge-performance-loss
// and, besides... it will won't reflect the "real-time" standings

// setting all public functions to "public" (was written for PHP4 from the start)

require_once("class.Model.php");
require_once(BASE_DIR . "classes/class.String.php");
require_once(BASE_DIR . "classes/class.LogFile.php");
require_once(BASE_DIR . "classes/class.IP.php");
require_once(BASE_DIR . "models/class.TournamentSetting.php");
//require_once(BASE_DIR . "models/class.EntryPosition.php");
require_once(BASE_DIR . "models/class.Player.php");
require_once(BASE_DIR . "models/class.Standings.php");
require_once(BASE_DIR . "models/class.User.php");
require_once(BASE_DIR . "models/class.Game.php");
require_once(BASE_DIR . "models/class.GamesInTournament.php");
require_once(BASE_DIR . "models/class.DivisionsToYears.php");
require_once(BASE_DIR . "models/class.Division.php");

class Entry extends Model
{
	public function insertEntry($a_iIDPlayer, $a_iIDDivision, $a_aIDGames)
	{
		$oUser = new User();
		$this->oDB->beginTransaction();
		
		$sQuery = sprintf("INSERT INTO entries
							(players_id_player, divisions_id_division) 
							VALUES (%d, %d)",
							$this->oDB->escape($a_iIDPlayer),
							$this->oDB->escape($a_iIDDivision));
		
		$this->oMDB2Wrapper->query("exec", $sQuery);	

		// [BUG] ? this could lead to bugs. should be safe with the transaction though?!
		// get last insert id
		$sQuery = "SELECT MAX(id_entry) as id_entry
					FROM entries";
				
		// should probably use something like:
		//$sQuery = "SELECT LAST_INSERT_ID(id_entry) AS id_last
		//			FROM entries";
		//$iCount = count($aRes);
		
		//return $aRes[$iCount-1]['id_last'];	
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);		
		$iIDLast = $aRes[0]['id_entry'];
	
		$this->oDB->commit();
		
		$oIP = new IP();
		
		$sQuery = sprintf("INSERT INTO entries_posters
						(entries_id_entry, users_id_user, entry_poster_date_posted, entry_poster_ip) 
						VALUES (%d, '%s', '%s', '%s')",
						$iIDLast,
						$this->oDB->escape($oUser->getLoggedInUserID()),
						date("Y-m-d H:i:s"),
						$this->oDB->escape($oIP->getUserIP()));
		
		$aRes = $this->oMDB2Wrapper->query("exec", $sQuery);	
		
		// loop through the games and insert entry rounds
		foreach($a_aIDGames as $iIDGame)
		{
			$this->oDB->beginTransaction();
			
			$sQuery = sprintf("INSERT INTO entry_rounds
							(games_id_game, entries_id_entry) 
							VALUES (%d, %d)",
							$this->oDB->escape($iIDGame),
							$this->oDB->escape($iIDLast));			
			$aRes = $this->oMDB2Wrapper->query("exec", $sQuery);

			// get last insert id
			$sQuery = "SELECT MAX(id_entry_round) AS id_entry_round
						FROM entry_rounds";
					
			$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);		
			$iIDLastEntryRound = $aRes[0]['id_entry_round'];

			$this->oDB->commit();
			$this->insertEntryRoundUpdater($iIDLastEntryRound, 0);
			
		}
		
		$oDivision = new Division();
		$sDivision = $oDivision->getShortNameFromID($a_iIDDivision);
		// increase number of played entries
		$this->increaseNumberOfPlayedEntries($a_iIDPlayer, $sDivision);
		// [BUGFIX]: just to set the correct number of entries for the player, seems to go wrong somewhere
		$this->setNumberOfPlayedEntries($a_iIDPlayer, $a_iIDDivision);
		return $iIDLast;
	}
	
	public function updateEntry($a_iIDEntry, $a_aIDsGames, $a_aScores, $a_bVoid = false)
	{
		$aEntryRounds = $this->getRoundsInEntry($a_iIDEntry);
		// loop through all rounds
		$i = 0;
		foreach($aEntryRounds as $aEntryRound)
		{
			//$aEntryRound = $this->getEntryRound($a_iIDEntry, $iIDGame);
			// if the game id is != null and != 0, and the score has changed
			if($a_aIDsGames[$i] != null && $a_aIDsGames[$i] != 0 && ($a_aScores[$i] != $aEntryRound['entry_round_score_game']) && $a_aScores[$i] != null)
			{
				$this->updateEntryRound($aEntryRound['id_entry_round'], $a_aScores[$i]);			
			}

			// check if the game has changed, if so change it in the entry round
			if($a_aIDsGames[$i] != null && $a_aIDsGames[$i] != 0 && ($a_aIDsGames[$i] != $aEntryRound['games_id_game']))
			{
				$this->updateEntryRoundChangeGame($aEntryRound['id_entry_round'], $a_aIDsGames[$i]);
			}
			
			$i++;			
		}

		// this will do the voiding, if we should void this entry
		$this->voidEntry($a_iIDEntry, $a_bVoid);	
	}
	
	public function updateEntryRound($a_iIDEntryRound, $a_iScore)
	{
		$sQuery = sprintf("UPDATE entry_rounds
							SET entry_round_score_game = '%s'
							WHERE id_entry_round = %d",
							$this->oDB->escape($a_iScore),
							$this->oDB->escape($a_iIDEntryRound));
							
		$this->oMDB2Wrapper->query("exec", $sQuery);
		$this->insertEntryRoundUpdater($a_iIDEntryRound, 1);		
	}
	
	public function updateEntryRoundChangeGame($a_iIDEntryRound, $a_iGame)
	{
		$sQuery = sprintf("UPDATE entry_rounds
							SET games_id_game = %d
							WHERE id_entry_round = %d",
							$this->oDB->escape($a_iGame),
							$this->oDB->escape($a_iIDEntryRound));
		
		$this->oMDB2Wrapper->query("exec", $sQuery);
		$this->insertEntryRoundUpdater($a_iIDEntryRound, 2);					
	}

	public function insertEntryRoundUpdater($a_iIDEntryRound, $a_iType)
	{
		$oUser = new User();
		$oIP = new IP();
		$sQuery = sprintf("INSERT INTO entry_round_updaters
						(entry_rounds_id_entry_round, users_id_user, entry_round_updater_date_posted,entry_round_updater_type, entry_round_updater_ip) 
						VALUES (%d, %d, '%s', %d, '%s')",
						$this->oDB->escape($a_iIDEntryRound),
						$this->oDB->escape($oUser->getLoggedInUserID()),
						date("Y-m-d H:i:s"),			
						$this->oDB->escape($a_iType),
						$this->oDB->escape($oIP->getUserIP()));
		
		$this->oMDB2Wrapper->query("exec", $sQuery);			
	}	
	
	public function deleteEntry($a_iIDEntry)
	{
		$oUser = new User();
		$oIP = new IP();
		// get all entry rounds
		$aEntryRounds = $this->getEntryRounds(null, $a_iIDEntry);
		$aEntryData = $this->getEntryData($a_iIDEntry);
		$sDivision = $aEntryData[0]['division_name_short'];
		$iIDPlayer = $aEntryData[0]['id_player'];
		
		$this->oDB->beginTransaction();
		
		// insert into the delete-entries table
		$sQuery = sprintf("INSERT INTO entries_deleted
						(users_id_user, id_entry, entry_deleted_date_posted, player_firstname, player_lastname, player_initials, player_year_entered, deleted_by, entry_deleted_ip) 
						VALUES (%d, %d, '%s', '%s', '%s', '%s', %d, '%s', '%s')",
						$this->oDB->escape($oUser->getLoggedInUserID()),
						$this->oDB->escape($aEntryData[0]['id_entry']),
						date("Y-m-d H:i:s"),			
						$this->oDB->escape($aEntryData[0]['player_firstname']),
						$this->oDB->escape($aEntryData[0]['player_lastname']),
						$this->oDB->escape($aEntryData[0]['player_initials']),
						$this->oDB->escape($aEntryData[0]['player_year_entered']),
						$this->oDB->escape($oUser->getLoggedInUsername()),
						$this->oDB->escape($oIP->getUserIP()));
		
		$this->oMDB2Wrapper->query("exec", $sQuery);
		
		// get last insert id
		$sQuery = "SELECT MAX(id_entry_deleted) as id_entry_deleted
					FROM entries_deleted";
				
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);		
		
		$iIDLast = $aRes[0]['id_entry_deleted'];		

		$this->oDB->commit();	
	
		// insert the deleted entryrounds
		foreach($aEntryRounds as $entryround)
		{
			$sQuery = sprintf("INSERT INTO entry_rounds_deleted
							(entries_deleted_id_entry_deleted, game_name, score) 
							VALUES (%d, '%s', %d)",
							$this->oDB->escape($iIDLast),
							$this->oDB->escape($entryround['game_name']),
							$this->oDB->escape($entryround['entry_round_score_game']));			
			$aRes = $this->oMDB2Wrapper->query("exec", $sQuery);
		}
		
		// delete from entry round updaters
		foreach($aEntryRounds as $entryround)
		{
			$sQuery = sprintf("DELETE FROM entry_round_updaters
								WHERE entry_rounds_id_entry_round = %d",
								$this->oDB->escape($entryround['id_entry_round']));
			$aRes = $this->oMDB2Wrapper->query("exec", $sQuery); 
		}
		
		// delete from entry posters
		$sQuery = sprintf("DELETE FROM entries_posters
							WHERE entries_id_entry = %d
							LIMIT 1",
							$this->oDB->escape($a_iIDEntry));

		$aRes = $this->oMDB2Wrapper->query("exec", $sQuery);
		
		// delete from entry-voiders
		$sQuery = sprintf("DELETE FROM entries_voided
							WHERE entries_id_entry = %d",
							$this->oDB->escape($a_iIDEntry));

		$aRes = $this->oMDB2Wrapper->query("exec", $sQuery);

		// delete the entry
		$sQuery = sprintf("DELETE FROM entries
							WHERE id_entry = %d
							LIMIT 1",
							$this->oDB->escape($a_iIDEntry));

		$aRes = $this->oMDB2Wrapper->query("exec", $sQuery);

		// delete all entry rounds
		$sQuery = sprintf("DELETE FROM entry_rounds
							WHERE entries_id_entry = %d",
							$this->oDB->escape($a_iIDEntry));

		$aRes = $this->oMDB2Wrapper->query("exec", $sQuery);
		
		// decrease number of played entries for the player
	 	$this->decreaseNumberOfPlayedEntries($iIDPlayer, $sDivision);
	}
	
	public function voidEntry($a_iIDEntry, $a_bVoid = false)
	{
		$oUser = new User();
		$bEntryVoided = false;
		
		// find out if the entry already is voided or not
		$sQuery = sprintf("SELECT * FROM entries
							WHERE id_entry = %d
							LIMIT 1",
							$this->oDB->escape($a_iIDEntry));
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		
		if($aRes[0]['entry_is_voided'] == 1)
			$bEntryVoided = true;

		// the entry has not been voided before
		if($a_bVoid == true && $bEntryVoided == false)
		{
			// void entry
			$sQuery = sprintf("UPDATE entries
								SET entry_is_voided = 1
								WHERE id_entry = %d",
								$this->oDB->escape($a_iIDEntry));			
			$aRes = $this->oMDB2Wrapper->query("exec", $sQuery);
			
			$oIP = new IP();
			$sQuery = sprintf("INSERT INTO entries_voided
								(entries_id_entry, users_id_user, entry_voided_date_posted, entry_voided_ip)
								VALUES (%d, %d, '%s', '%s')",
								$this->oDB->escape($a_iIDEntry),
								$this->oDB->escape($oUser->getLoggedInUserID()),
								date("Y-m-d H:i:s"),
								$this->oDB->escape($oIP->getUserIP()));
											
			$aRes = $this->oMDB2Wrapper->query("exec", $sQuery);			
		}
		
		// if the entry is voided and we want to unvoid it
		if(($a_bVoid == false || $a_bVoid == null) && $bEntryVoided == true)
		{
			// unvoid entry
			$sQuery = sprintf("UPDATE entries
								SET entry_is_voided = 0
								WHERE id_entry = %d",
								$this->oDB->escape($a_iIDEntry));			
			$aRes = $this->oMDB2Wrapper->query("exec", $sQuery);

			// insert an "unvoid" entry into the void log
			$sQuery = sprintf("INSERT INTO entries_voided
								(entries_id_entry, users_id_user, entry_voided_date_posted, entry_voided_unvoided)
								VALUES (%d, %d, '%s', %d)",
								$this->oDB->escape($a_iIDEntry),
								$this->oDB->escape($oUser->getLoggedInUserID()),
								date("Y-m-d H:i:s"),
								1);			
			$aRes = $this->oMDB2Wrapper->query("exec", $sQuery);		
		}		
	}
	
	public function calculateAllEntries($a_iYear, $a_aScoreRange, $a_sDivision)
	{
		$oGamesInTournament = new GamesInTournament();
		if(COUNT_CALC_STANDINGS_TIME)
		{
			$oLogFile = new LogFile();
		}
		
		// get all games for the year
		$aGames = $oGamesInTournament->getGamesInTournament($a_iYear, $a_sDivision);
		
		$aEntryArr = array();
		// loop through the games
		foreach($aGames as $value)
		{
			if(COUNT_CALC_STANDINGS_TIME)
				$sTimeStart = microtime(true);			

			$iIDGame = $value["games_id_game"];
			$aEntryArr = $this->setEntryRoundScoreForGame($iIDGame, $a_iYear, $a_aScoreRange, $aEntryArr, $a_sDivision);
		
			if(COUNT_CALC_STANDINGS_TIME)
			{
				$sTimeEnd = microtime(true);
				$oLogFile->writeTimeSetEntryRoundScoreForGame(LOG_FILE_DETAILED_ENTRY_CALC, ($sTimeEnd - $sTimeStart), $a_iYear, $iIDGame);	
			}
		}
		
		if(COUNT_CALC_STANDINGS_TIME)
			$sTimeStart = microtime(true);			
		
		$this->setEntryData($aEntryArr, $a_iYear);
		
		if(COUNT_CALC_STANDINGS_TIME)
		{
			$sTimeEnd = microtime(true);
			$oLogFile->writeTimeSetEntryData(LOG_FILE_DETAILED_ENTRY_CALC, ($sTimeEnd - $sTimeStart), $a_iYear);	
		}
		
		if(COUNT_CALC_STANDINGS_TIME)
			$sTimeStart = microtime(true);			

		// this function can take a lot of time since there might be a lot of inserts
		$this->setEntryPositions($a_iYear, $a_sDivision);

		if(COUNT_CALC_STANDINGS_TIME)
		{
			$sTimeEnd = microtime(true);
			$oLogFile->writeTimeSetEntryPositions(LOG_FILE_DETAILED_ENTRY_CALC, ($sTimeEnd - $sTimeStart), $a_iYear, $a_sDivision);	
		}
	}

	public function setEntryData($a_aEntryArr, $a_iYear)
	{
		// TODO: these methods shouldn't be needed, i could use array keys instead... somehow
		$iIDLowest = $this->getLowestEntryID($a_iYear);
		$iIDHighest = $this->getHighestEntryID($a_iYear);
		
		for($i = $iIDLowest; $i < ($iIDHighest+1); $i++)
		{
			$iIDEntry = $i;
			$bUpdate = true;
			
			if(isset($a_aEntryArr[$i]))
			{
				$iEntryScore = $a_aEntryArr[$i];		
			}
			else
			{
				$iEntryScore = 0;
				// if the entry isn't stored, we don't update
				$bUpdate = false;
			}
			
			if(($iIDEntry != null && $iIDEntry != 0) && $bUpdate == true)
			{
				// get the time the entry was "completed" i.e. when the last entry round was updated
				// ...and set the position to 0 (it will be set later)
				$sDateEntryCompletion = $this->getTimeOfLastEntryRoundCompletion($iIDEntry);
				$sQuery = "UPDATE entries
							SET entry_score = '" . $iEntryScore . "', 
							entry_date_completed ='" . $sDateEntryCompletion . "',
							entry_position = 0,
							entry_is_counted= 1
							WHERE id_entry = '" . $iIDEntry ."'
							LIMIT 1";
				$this->oMDB2Wrapper->query("exec", $sQuery);
			}
		}
	}
	
	public function setEntryRoundScoreForGame($a_iGameID, $a_iYear, $a_aScoreRange, $a_aEntryArr, $a_sDivision)
	{
		$sQuery = sprintf("SELECT entry_rounds.id_entry_round, entries_id_entry, entries.entry_is_voided, divisions.division_name_short
							FROM players
							JOIN entries
							ON players.id_player = entries.players_id_player
							JOIN entry_rounds
							ON entries.id_entry = entry_rounds.entries_id_entry
							JOIN divisions
							ON entries.divisions_id_division = divisions.id_division 
							WHERE entry_rounds.games_id_game = %d 
							AND players.player_year_entered=%d 
							AND divisions.division_name_short = '%s'
							AND entry_rounds.entry_round_score_game > 1
							ORDER BY entries.entry_is_voided ASC, entry_rounds.entry_round_score_game DESC",
							$this->oDB->escape($a_iGameID),
							$this->oDB->escape($a_iYear),
							$this->oDB->escape($a_sDivision));

		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		
		$i = 0;
		$iPos = 1;
		$iArrayCount = count($a_aScoreRange);
		//$iEntryArr = array();
		$bHasEntryRounds = false;
		foreach ($aRes as $entryRound)
		{
			$bHasEntryRounds = true;
			// if it's a voided entry the score will always be 0
			if($entryRound["entry_is_voided"] == 1)
			{
				$iTournamentScore = 0;
				// and the position will be 0
				$iPosition = 0;
			}
			else
			{
				if($i < $iArrayCount) // if the score is within the scoring "range"
					$iTournamentScore = $a_aScoreRange[$i];
				else
					$iTournamentScore = 0;
			
				$iPosition = $iPos;
			}
			// add the tournament score to the entry array
			if(!isset($a_aEntryArr[$entryRound["entries_id_entry"]]))
				$iTotalEntryScore = $a_aEntryArr[$entryRound["entries_id_entry"]] = null;

			$iTotalEntryScore = $a_aEntryArr[$entryRound["entries_id_entry"]] + $iTournamentScore;
			$a_aEntryArr[$entryRound["entries_id_entry"]] = $iTotalEntryScore;
			
			// TODO: optimize this, it sucks!
			// set the tournament score and position for every round
			if($entryRound["division_name_short"] == $a_sDivision)
			{
				// only update if it's the "right" division
				$sQuery = "UPDATE entry_rounds
							SET entry_round_score_tournament = '" . $iTournamentScore . "',
							entry_round_position = '" . $iPosition . "',
							entry_round_is_counted= 1
							WHERE id_entry_round = '" . $entryRound["id_entry_round"] . "'
							LIMIT 1";
			}
			$aRes = $this->oMDB2Wrapper->query("exec", $sQuery);					
				
 			$i++;
			$iPos++;
		}
		
		if($bHasEntryRounds) // yep, the game's got entry rounds
		{
			$oGame = new Game();
			$oGame->setHasEntryRounds($a_iGameID);
		}
		
		return $a_aEntryArr;
	}
	
	public function getTotalEntries()
	{
		$sQuery = "SELECT COUNT(*) FROM entries";
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes[0]['count(*)'];			
	}
	
	public function getTotalPlayedRounds()
	{
		$sQuery = "SELECT COUNT(*) FROM entry_rounds
					WHERE entry_round_score_game > 1";
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes[0]['count(*)'];		
	}
	
	public function getTotalScoreForAllRounds()
	{
		$sQuery = "SELECT SUM(entry_round_score_game)
					FROM entry_rounds";
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		$iTotalScore = null;
		foreach($aRes as $score)
		{
			$iTotalScore = $iTotalScore + $score['entry_round_score_game'];
		}
		
		return $iTotalScore;
	}
	
	public function getPlayerIDForEntry($a_iEntryID)
	{
		$sQuery = sprintf("SELECT entries.players_id_player
							FROM entries
							WHERE id_entry=%d
							LIMIT 1",
							$this->oDB->escape($a_iEntryID));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		if($aRes != null)
			return $aRes[0]["players_id_player"];			
		else
			return null;
	}
	
	public function getLowestEntryID($a_iYear)
	{
    	$sQuery = sprintf("SELECT MIN(entries.id_entry)
							FROM players
							JOIN entries
							ON players.id_player = entries.players_id_player
							WHERE players.player_year_entered=%d",
							$this->oDB->escape($a_iYear));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		
		if(isset($aRes[0]["min(entries.id_entry)"]))
			return $aRes[0]["min(entries.id_entry)"];
		else
			return null;
	}

	public function getHighestEntryID($a_iYear)
	{
		$sQuery = sprintf("SELECT MAX(entries.id_entry)
							FROM players
							JOIN entries
							ON players.id_player = entries.players_id_player
							WHERE players.player_year_entered=%d",
		$this->oDB->escape($a_iYear));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);

		if(isset($aRes[0]["max(entries.id_entry)"]))
			return $aRes[0]["max(entries.id_entry)"];
		else
			return null;
	}

	public function decreaseNumberOfPlayedEntries($a_iIDPlayer, $a_sDivision)
	{
		$iNumberOfEntries = $this->getNumberOfEntriesForPlayer($a_iIDPlayer, $a_sDivision);
		$iNumberOfEntries--;

		$oDivision = new Division();
		$iIDDivision = $oDivision->getDivisionIDFromShortName($a_sDivision);
		
		$sQuery = sprintf("UPDATE divisions_to_players
							SET dtp_no_of_played_entries = %d
							WHERE players_id_player = %d
							AND divisions_id_division = %d
							LIMIT 1",
							$this->oDB->escape($iNumberOfEntries),
							$this->oDB->escape($a_iIDPlayer),
							$this->oDB->escape($iIDDivision));
		$aRes = $this->oMDB2Wrapper->query("exec", $sQuery);				
	}
		
	public function increaseNumberOfPlayedEntries($a_iIDPlayer, $a_sDivision)
	{
		$iNumberOfEntries = $this->getNumberOfEntriesForPlayer($a_iIDPlayer, $a_sDivision);
		$iNumberOfEntries++;

		$oDivision = new Division();
		$iIDDivision = $oDivision->getDivisionIDFromShortName($a_sDivision);
		
		$sQuery = sprintf("UPDATE divisions_to_players
							SET dtp_no_of_played_entries = %d
							WHERE players_id_player = %d
							AND divisions_id_division = %d
							LIMIT 1",
							$this->oDB->escape($iNumberOfEntries),
							$this->oDB->escape($a_iIDPlayer),
							$this->oDB->escape($iIDDivision));
		$aRes = $this->oMDB2Wrapper->query("exec", $sQuery);				
	}
		
	public function getNumberOfEntriesForPlayer($a_iIDPlayer, $a_sDivision)
	{
		$sQuery = sprintf("SELECT dtp_no_of_played_entries
							FROM divisions_to_players
							JOIN divisions
							ON divisions_to_players.divisions_id_division = divisions.id_division
							WHERE divisions_to_players.players_id_player = %d
							AND divisions.division_name_short = '%s'
							LIMIT 1",
							$this->oDB->escape($a_iIDPlayer),
							$this->oDB->escape($a_sDivision));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);

		if($aRes != null)
		{	
			if($aRes[0]["dtp_no_of_played_entries"] > 0)
				return $aRes[0]["dtp_no_of_played_entries"];
			else
				return 0;
		}
		else
			return null;
	}
	
	// [BUGFIX] for not displaying the correct amount of entries
	
	public function newGetNumberOfEntriesForPlayer($a_iIDPlayer, $a_sDivision)
	{
		$sQuery = sprintf("SELECT COUNT(id_entry) AS count
							FROM entries
							WHERE players_id_player = %d
							AND divisions_id_division = %d",
							$this->oDB->escape($a_iIDPlayer),
							$this->oDB->escape($a_sDivision));
							
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);

		if($aRes[0]['count'] != null)
			return $aRes[0]['count'];
		else
			return null;
	}
	
	public function getNumberOfEntriesFromYearAndDivisionID($a_iYear, $a_iIDDivision)
	{
		$sQuery = sprintf("SELECT COUNT(entries.id_entry) AS count
							FROM players
							JOIN entries
							ON players.id_player = entries.players_id_player
							WHERE players.player_year_entered=%d
							AND entries.divisions_id_division=%d",
							$this->oDB->escape($a_iYear),
							$this->oDB->escape($a_iIDDivision));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes[0]['count'];
	}
	
	public function getNumberOfVoidedEntriedFromYearAndDivisionID($a_iYear, $a_iIDDivision)
	{
		$sQuery = sprintf("SELECT COUNT(entries.id_entry) AS count
							FROM players
							JOIN entries
							ON players.id_player = entries.players_id_player
							WHERE players.player_year_entered=%d
							AND entries.divisions_id_division=%d
							AND entries.entry_is_voided = 1",
							$this->oDB->escape($a_iYear),
							$this->oDB->escape($a_iIDDivision));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes[0]['count'];
	}
	
	public function getTimeOfLastEntryRoundCompletion($a_iIDEntry)
	{
		$sQuery = sprintf("SELECT MAX(entry_round_updater_date_posted) AS entry_round_updater_date_posted
							FROM entry_round_updaters
							JOIN entry_rounds
							ON entry_round_updaters.entry_rounds_id_entry_round = entry_rounds.id_entry_round
							WHERE entry_rounds.entries_id_entry = %d",
							$this->oDB->escape($a_iIDEntry));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes[0]["entry_round_updater_date_posted"];
	}

	public function getNumberOfEntriesForPlayers($a_iYear)
	{
		$sQuery = sprintf("SELECT players.id_player, COUNT(entries.id_entry) AS entry_count
							FROM players
							JOIN entries
							ON players.id_player = entries.players_id_player
							WHERE players.player_year_entered=%d
							GROUP by players.id_player
							ORDER BY entry_count DESC",
							$this->oDB->escape($a_iYear));
				
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);

		return $aRes; 
	}

	public function getPlayersQualPosition($a_iIDPlayer, $a_sDivision, $a_aEntries = null)
	{
		$sQuery = sprintf("SELECT MIN(entries.entry_position) AS best_entry_position
							FROM entries
							JOIN players
							ON entries.players_id_player = players.id_player
							JOIN divisions
							ON entries.divisions_id_division = divisions.id_division
							WHERE players.id_player = %d
							AND divisions.division_name_short = '%s'
							AND entries.entry_position > 0",
							$this->oDB->escape($a_iIDPlayer),
							$this->oDB->escape($a_sDivision));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);

		if($a_aEntries != null)
		{
			$a_aEntries[0]["best_entry_position"] = $aRes[0]["best_position"];
			return $a_aEntries;
		}
		else
		{
			return $aRes[0]["best_entry_position"];
		}
	}
	
	public function getAllEntriesForPlayer($a_iIDPlayer)
	{
		$oPlayer = new Player();
		
        $sQuery = sprintf("SELECT players.*, entries.*, countries.*, divisions.division_name_short
							FROM entries
							JOIN players
							ON entries.players_id_player = players.id_player
							JOIN countries
							ON players.countries_id_country = countries.id_country
							JOIN divisions
							ON entries.divisions_id_division = divisions.id_division
							WHERE players.id_player=%d
							ORDER BY divisions.division_name_short ASC, entries.entry_score DESC",
							$this->oDB->escape($a_iIDPlayer));

		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		$aRes = $oPlayer->addSplitTeamVariables($aRes);
			
		// add the entry_rounds to each entry
		$i = 0;
		foreach($aRes as $entry)
		{	
			$aRes[$i] = $this->addEntryRoundsToEntry($entry, $entry["id_entry"]);
			$i++;
		}
			
		return $aRes;
	}

	public function getAllEntriesSortedForPlayer($a_iIDPlayer, $a_sSort)
	{
		$sQuery = sprintf("SELECT players.*, countries.*, divisions.division_name_short
							FROM players
							JOIN countries
							ON players.countries_id_country = countries.id_country
							JOIN divisions
							ON entries.divisions_id_division = divisions.id_division 
							WHERE players.id_player=%d
							LIMIT 1",
							$this->oDB->escape($a_iIDPlayer));

		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		$aRes = $this->addEntryRoundsToPlayer($aRes, $a_sSort);
		return $aRes;
	}
	
	public function getEntryData($a_iIDEntry)
	{
		$sQuery = sprintf("SELECT players.*, entries.*, countries.*, divisions.division_name_short, entries_posters.entry_poster_date_posted
							FROM entries
							JOIN players
							ON entries.players_id_player = players.id_player
							JOIN countries
							ON players.countries_id_country = countries.id_country
							JOIN divisions
							ON entries.divisions_id_division = divisions.id_division 
							JOIN entries_posters
							ON entries.id_entry = entries_posters.entries_id_entry							
							WHERE id_entry=%d
							LIMIT 1",
							$this->oDB->escape($a_iIDEntry));
							
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		$oPlayer = new Player();
		$aRes = $oPlayer->addSplitTeamVariables($aRes);

		// add entry rounds to the entry
		$aRes = $this->addEntryRoundsToEntry($aRes, $a_iIDEntry, true);
		return $aRes; 	
	}
	
	/*
	public function getScoreForGame($a_iIDGame, $a_sDivision, $a_iYear, $sType)
	{
		$sAndYear = null;
		if($a_iYear != null)
		{
			$sAndYear = sprintf("AND players.player_year_entered = %d",
									$this->oDB->escape($a_iYear));	
		}

		if($sType == "highest")
			$sOrderBy = "ORDER BY entry_rounds.entry_round_score_game DESC";

		if($sType == "lowest")
			$sOrderBy = "ORDER BY entry_rounds.entry_round_score_game ASC";
			
		$sQuery = sprintf("SELECT entry_rounds.entry_round_score_game
							FROM entry_rounds
							JOIN entries
							ON entry_rounds.entries_id_entry = entries.id_entry
							JOIN players
							ON entries.players_id_player = players.id_player
							JOIN countries
							ON players.countries_id_country = countries.id_country
							JOIN divisions
							ON players.divisions_id_division = divisions.id_division
							WHERE entry_rounds.games_id_game=%d
							" . $sAndYear . "
							AND divisions.division_name_short ='%s'
							AND entry_rounds.entry_round_score_game > 1
							AND entry_rounds.entry_round_is_counted = 1
							" . $sOrderBy . "
							LIMIT 1",
							$this->oDB->escape($a_iIDGame),
							$this->oDB->escape($a_sDivision));
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		if($aRes != null)
			return $aRes[0]["entry_round_score_game"];	
		else
			return null;
	}
	*/
	
	
	public function getLowestScoreForGame($a_iIDGame, $a_sDivision = null, $a_iYear = null)
	{
		$sAndYear = null;
		if($a_iYear != null)
		{
			$sAndYear = sprintf("AND players.player_year_entered = %d",
									$this->oDB->escape($a_iYear));	
		}
		
		$sAndDivision = null;
		if($a_sDivision != null)
		{
			$sAndDivision = sprintf("AND divisions.division_name_short ='%s'",
								$this->oDB->escape($a_sDivision));	
		}
		
		$sQuery = sprintf("SELECT MIN(entry_rounds.entry_round_score_game) AS min_score
							FROM entry_rounds
							JOIN entries
							ON entry_rounds.entries_id_entry = entries.id_entry
							JOIN players
							ON entries.players_id_player = players.id_player
							JOIN countries
							ON players.countries_id_country = countries.id_country
							JOIN divisions
							ON entries.divisions_id_division = divisions.id_division 
							WHERE entry_rounds.games_id_game=%d
							" . $sAndYear . " " . $sAndDivision . " 
							AND entry_rounds.entry_round_score_game > 1
							AND entry_rounds.entry_round_is_counted = 1
							LIMIT 1",
							$this->oDB->escape($a_iIDGame),
							$this->oDB->escape($a_sDivision));
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		
		if($aRes != null)
			return $aRes[0]["min_score"];	
		else
			return null;	
	}
	
	public function getHighestScoreForGame($a_iIDGame, $a_sDivision = null, $a_iYear = null)
	{
		$sAndYear = null;
		if($a_iYear != null)
		{
			$sAndYear = sprintf("AND players.player_year_entered = %d",
									$this->oDB->escape($a_iYear));	
		}

		$sAndDivision = null;
		if($a_sDivision != null)
		{
			$sAndDivision = sprintf("AND divisions.division_name_short ='%s'",
								$this->oDB->escape($a_sDivision));	
		}		
		
		$sQuery = sprintf("SELECT MAX(entry_rounds.entry_round_score_game) AS max_score
							FROM entry_rounds
							JOIN entries
							ON entry_rounds.entries_id_entry = entries.id_entry
							JOIN players
							ON entries.players_id_player = players.id_player
							JOIN countries
							ON players.countries_id_country = countries.id_country
							JOIN divisions
							ON entries.divisions_id_division = divisions.id_division 
							WHERE entry_rounds.games_id_game=%d
							" . $sAndYear . " " . $sAndDivision . " 
							AND entry_rounds.entry_round_score_game > 1
							AND entry_rounds.entry_round_is_counted = 1
							LIMIT 1",
							$this->oDB->escape($a_iIDGame),
							$this->oDB->escape($a_sDivision));
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		
		if($aRes != null)
			return $aRes[0]["max_score"];	
		else
			return null;
	}
	
	public function entryRoundsExistsForGame($a_iIDGame, $a_iYear = null)
	{
		if($a_iYear == null)
		{
			$sQuery = sprintf("SELECT id_entry_round
								FROM entry_rounds
								WHERE games_id_game = %d
								LIMIT 1",
								$this->oDB->escape($a_iIDGame));
		}
		else
		{
			$sQuery = sprintf("SELECT entry_rounds.id_entry_round 
								FROM entry_rounds 
								JOIN entries
								ON entry_rounds.entries_id_entry = entries.id_entry
								JOIN players
								ON entries.players_id_player = players.id_player
								WHERE players.player_year_entered = %d
								AND entry_rounds.games_id_game = %d
								LIMIT 1",
								$this->oDB->escape($a_iYear),
								$this->oDB->escape($a_iIDGame));
		}
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		if($aRes != null)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function getEntryRoundsForGame($a_iIDGame, $a_sDivision, $a_iYear = null, $a_bOnlyNonVoided = false, $a_bOnlyWithTournamentScore = false, $a_iLimit = null)
	{
		$sAndYear = null;
		if($a_iYear != null)
		{
			$sAndYear = sprintf("AND players.player_year_entered = %d",
									$this->oDB->escape($a_iYear));
		}

		$sAndNonVoided = null;
		if($a_bOnlyNonVoided == true)
			$sAndNonVoided = " AND entries.entry_is_voided = 0";	

		$sAndTourScore = null;
		if($a_bOnlyWithTournamentScore == true)
			$sAndTourScore = " AND entry_rounds.entry_round_score_tournament > 0";	
		
		$sLimit = null;
		if($a_iLimit != null)
		{
			$sLimit = sprintf("LIMIT %d",
						$this->oDB->escape($a_iLimit));
		}
			
		$sQuery = sprintf("SELECT entries.*, entry_rounds.*, players.*, countries.*
							FROM entry_rounds
							JOIN entries
							ON entry_rounds.entries_id_entry = entries.id_entry
							JOIN players
							ON entries.players_id_player = players.id_player
							JOIN countries
							ON players.countries_id_country = countries.id_country
							JOIN divisions
							ON entries.divisions_id_division = divisions.id_division
							WHERE entry_rounds.games_id_game=%d
							" . $sAndYear . " " . $sAndNonVoided . " " . $sAndTourScore . "
							AND divisions.division_name_short ='%s'
							AND entry_rounds.entry_round_is_counted = 1
							ORDER BY entries.entry_is_voided ASC, entry_rounds.entry_round_score_game DESC " . $sLimit,
							$this->oDB->escape($a_iIDGame),
							$this->oDB->escape($a_sDivision));
	
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		$oPlayer = new Player();
		$aRes = $oPlayer->addSplitTeamVariables($aRes);
		
		// TODO: should add the time the entry round was last updated here
		$i = 0;
	
		foreach($aRes as $entryround)
		{
			$iScoreGame = $aRes[$i]["entry_round_score_game"];
			// get the highest score
			if($i == 0)
			{
				$iHighestScore = $aRes[$i]["entry_round_score_game"];
			}
			
			// calculate percentage of highest score
			$aRes[$i]["percentage_of_highest_score"] = round(($iScoreGame / $iHighestScore  * 100), 0);
			$aRes[$i]["score_game_real"] = $aRes[$i]["entry_round_score_game"];
			$aRes[$i]["score_game_output"] = number_format($iScoreGame, 0, '.', '.');
			// get the entry round update time
			$aRes[$i]["entry_round_date_posted"] = $this->getEntryRoundUpdate($entryround["id_entry_round"]);
			$i++;
		}
		
		return $aRes;		
	}
	
	public function getEntryRound($a_iIDEntry, $a_iIDGame)
	{
		$sQuery = sprintf("SELECT * FROM entry_rounds
							WHERE games_id_game = %d
							AND entries_id_entry = %d
							LIMIT 1",
							$this->oDB->escape($a_iIDGame),
							$this->oDB->escape($a_iIDEntry));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes[0];		
	}
	
	public function getEntryRounds($a_iYear = null, $a_iIDEntry = null)
	{
		$sQuery = "SELECT entry_rounds.*, games.game_name, players.player_year_entered
					FROM entry_rounds
					JOIN games
					ON entry_rounds.games_id_game = games.id_game
					JOIN entries
					ON entry_rounds.entries_id_entry = entries.id_entry
					JOIN players
					ON entries.players_id_player = players.id_player";
		if($a_iYear != null)
		{
			$sQuery.= sprintf(" WHERE players.player_year_entered = %d ",
					$this->oDB->escape($a_iYear));
		}

		if($a_iIDEntry != null)
		{
			$sQuery.= sprintf(" WHERE entry_rounds.entries_id_entry = %d ",
						$this->oDB->escape($a_iIDEntry));
		}

		$sQuery.= " ORDER BY entry_rounds.entry_round_score_tournament DESC";
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);

		// TODO: should probably add the date the round was last updated into the array
		return $aRes;
	}	
	
	public function getAverageEntryScoreForPlayer($a_iIDPlayer, $a_sDivision, $a_aEntries = null)
	{
		$oDivision = new Division();
		$iIDDivision = $oDivision->getDivisionIDFromShortName($a_sDivision);
		
		$sQuery = sprintf("SELECT AVG(entry_score) as avg_score 
							FROM entries
							WHERE players_id_player = %d
							AND divisions_id_division = %d
							AND entry_score != 0",
							$this->oDB->escape($a_iIDPlayer),
							$this->oDB->escape($iIDDivision));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);

		$dAvgScore = round($aRes[0]["avg_score"], 1);

		if($a_aEntries != null)
		{
			$a_aEntries[0]["avg_score"] = $dAvgScore;
			return $a_aEntries;
		}
		else
		{
			return $dAvgScore;
		}
	}
	
	public function getEntryIDsForYear($a_iYear)
	{
		$sQuery = sprintf("SELECT id_entry 
							FROM entries
							JOIN players
							ON entries.players_id_player = players.id_player
							WHERE players.player_year_entered = %d",
							$this->oDB->escape($a_iYear));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes;		
	}

	public function addEntryRoundsToGames($a_aGames, $a_sDivision, $a_iYear, $a_iLimit = null)
	{
		// loop through all games and add the entry rounds to the game
		$i = 0;
		foreach($a_aGames as $game)
		{
			// can't describe the shuffling of the arrays here, but it works. Well... at the moment
			$aTempGame[0] = $game;
			$a_aGames[$i]["entry_rounds"] = $this->getEntryRoundsForGame($aTempGame[0]["id_game"], $a_sDivision, $a_iYear, false, true, $a_iLimit);
			$aTempGame[0] = $a_aGames[$i];
			if(isset($a_aGames[$i]["entry_rounds"]))
				$aTempGame = $this->addEntryRoundStatsToGame($aTempGame, $a_sDivision, $a_iYear);
			$a_aGames[$i] = $aTempGame[0];
			$i++;
		}
		
		return $a_aGames;
	}

	public function addEntryRoundsToGame($a_aGame, $a_sDivision, $a_iYear, $a_bOnlyNonVoided = false, $a_bOnlyWithTournamentScore = false)
	{
		$a_aGame[0]["entry_rounds"] = $this->getEntryRoundsForGame($a_aGame[0]["id_game"], $a_sDivision, $a_iYear, $a_bOnlyNonVoided, $a_bOnlyWithTournamentScore);
		$a_aGame = $this->addEntryRoundStatsToGame($a_aGame, $a_sDivision, $a_iYear, true);		
		return $a_aGame;
	}
	
	
	public function addEntryRoundsToEntry($a_aEntry, $a_iIDEntry, $a_bSingleEntry = false)
	{
		$aEntryRounds = $this->getEntryRounds(null, $a_iIDEntry);
		
		$i = 0;

		foreach ($aEntryRounds as $entryround)
		{
			$entryround["score_game_output"] = number_format($entryround["entry_round_score_game"], 0, '.', '.');
			// get the date for when the entry-round was last updated
			$entryround["entry_round_date_posted"] = $this->getEntryRoundUpdate($entryround["id_entry_round"]);

			if($a_bSingleEntry == false)
				$a_aEntry["entry_rounds"][$i] = $entryround;
			else
				$a_aEntry[0]["entry_rounds"][$i] = $entryround;
			$i++;
		}
		
		return $a_aEntry;
	}

	public function addEntryRoundsToPlayer($a_aPlayer, $a_sSort)
	{
		if($a_sSort == "gameAsc")
			$sOrderBy = "ORDER BY games.game_name ASC, entry_rounds.entry_round_score_game DESC";

		if($a_sSort == "posDesc")
			$sOrderBy = "ORDER BY entry_rounds.entry_round_position ASC, games.game_name ASC";
	
				
		$sQuery = sprintf("SELECT entry_rounds.*, games.game_name,id_game, players.player_year_entered, entries.id_entry, entry_is_voided
							FROM players
							JOIN entries
							ON players.id_player = entries.players_id_player
							JOIN entry_rounds
							ON entries.id_entry = entry_rounds.entries_id_entry
							JOIN games
							ON entry_rounds.games_id_game = games.id_game
							WHERE entries.players_id_player = %d"
							. $sOrderBy . "",
							$this->oDB->escape($a_aPlayer[0]["id_player"]));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		// add the entries to the "player" array
		$i = 0;
		$a0PosArray = array();
		foreach ($aRes as $entryRound)
		{
			// a little ugly hack to place the 0 position entries at the end
			if($a_sSort == "posDesc" && $entryRound["entry_position"] == 0)
			{
				array_push($a0PosArray, $entryRound);
			}
			else
			{
				$a_aPlayer[0]["entry_rounds"][$i] = $entryRound;
				// format the score
				$a_aPlayer[0]["entry_rounds"][$i]["score_game_output"] = number_format($entryRound["entry_round_score_game"], 0, '.', '.');
				$i++;
			}
		}
		
		// add the 0 position entry rounds to the main array
		if($a_sSort == "posDesc")
		{
			foreach($a0PosArray as $entryRound)
			{
				$a_aPlayer[0]["entry_rounds"][$i] = $entryRound;
				// format the score
				$a_aPlayer[0]["entry_rounds"][$i]["score_game_output"] = number_format($entryRound["entry_round_score_game"], 0, '.', '.');
				$i++;				
			}
		}
		
		return $a_aPlayer;
	}
	
	public function addEntryRoundsToEntries($a_iYear, $a_sDivision, $a_aEntries)
	{
		$oTournamentSetting = new TournamentSetting();
		$aEntryRounds = $this->getEntryRounds($a_iYear);
		//$iNumberOfEntryRoundsPerEntry = $oTournamentSetting->getNumberOfRoundsPerEntry($a_iYear);
		$oDivisionsToYears = new DivisionsToYears();
		$iNumberOfEntryRoundsPerEntry = $oDivisionsToYears->getNumberOfRoundsPerEntry($a_iYear, $a_sDivision);
		
		if($iNumberOfEntryRoundsPerEntry == null || $iNumberOfEntryRoundsPerEntry == 0)
		{
			// haven't got the number of entry-rounds...
			$oLogFile = new LogFile();
			$oLogFile->writeEntryRoundNumberError($a_iYear, $a_sDivision);
		}
		
		// TODO: ugly, ugly loop ... i HAVE to change this even though
		// is made in the memory and not read, entirely, from disk
		$iIterations = 0;
		$i = 0;
		
		foreach($a_aEntries as $entry)
		{
			$iAddedEntryRounds = 0;
			$j = 0;
			foreach($aEntryRounds as $entryround)
			{
				if($entry["id_entry"] == $entryround["entries_id_entry"])
				{
					// found an entry rounds that belongs to the entry
					$a_aEntries[$i]["entry_rounds"][$iAddedEntryRounds] = $entryround;
					// format the score
					$entryround["score_game_output"] = number_format($entryround["entry_round_score_game"], 0, '.', '.');
					$iAddedEntryRounds++;
					if($iAddedEntryRounds == $iNumberOfEntryRoundsPerEntry)
					{
						// break if we've found the number of entry rounds for this year
						break;
					}
				}
				$j++;
				$iIterations++;
			}
			$i++;
			$iIterations++;
		}
		
		return $a_aEntries;
	}
	
	public function getEntryRoundUpdate($a_iIDEntryRound)
	{
		$sQuery = sprintf("SELECT MAX(entry_round_updater_date_posted) AS entry_round_updater_date_posted
							FROM entry_round_updaters
							WHERE entry_rounds_id_entry_round = %d
							LIMIT 1",
							$this->oDB->escape($a_iIDEntryRound));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes[0]['entry_round_updater_date_posted'];
	}
	
	public function addHighestScoresToGame($a_iLimit = "3", $a_iStart = null, $a_iEnd = null, $a_bOnlyCounted = false)
	{
		$oGamesInTournament = new GamesInTournament();
		// get all games that has ever been in the tournament
		$aGames = $oGamesInTournament->getAllGamesEverUsed(true, true, $a_iStart, $a_iEnd);
		$i = 0;
		foreach ($aGames as $aGame)
		{
			// get the n highest scores for the game, and the division
			$aHighScores = $this->getHighestScoresForGame($aGame['games_id_game'], $a_iLimit);
			$aTempGame[0] = $aGame;
			$aTempGame = $this->addEntryRoundStatsToGame($aTempGame, null, null, $a_bOnlyCounted);
			$aGames[$i] = $aTempGame[0];
			$aGames[$i]['entry_rounds'] = $aHighScores;
			$i++;	
		}
		return $aGames;	
	}
	
	public function getHighestScoresForGame($a_iIDGame, $a_iLimit = "3", $a_bUnlimited = false)
	{
		$sLimit = null;
		if($a_bUnlimited != true)
		{
			$sLimit = sprintf("LIMIT %d",
								$this->oDB->escape($a_iLimit));
		}				
		
		$oPlayer = new Player();
		$sQuery = sprintf("SELECT entry_rounds.*, players.*, entries.*, divisions.*, countries.*
							FROM entries
							JOIN players
							ON entries.players_id_player = players.id_player
							JOIN divisions
							ON entries.divisions_id_division = divisions.id_division 
							JOIN entry_rounds
							ON entries.id_entry = entry_rounds.entries_id_entry
							JOIN countries
							ON players.countries_id_country = countries.id_country
							WHERE entry_rounds.games_id_game = %d
							AND entry_rounds.entry_round_is_counted = 1
							ORDER BY entry_rounds.entry_round_score_game DESC " . $sLimit,
							$this->oDB->escape($a_iIDGame));

		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		$aRes = $oPlayer->addSplitTeamVariables($aRes);

		$i = 0;
		// loop through the result and add split-team vars, if any
		foreach ($aRes as $entryRound)
		{
			$aRes[$i]["score_game_output"] = number_format($entryRound['entry_round_score_game'], 0, '.', '.');
			$i++;
		}
		
		return $aRes;	
	}
	
	public function getEntriesForYear($a_iYear)
	{
		$sQuery = sprintf("SELECT entries.*, players.*, entries_posters.entry_poster_date_posted, divisions.*
							FROM entries
							JOIN players
							ON entries.players_id_player = players.id_player
							JOIN entries_posters
							ON entries.id_entry = entries_posters.entries_id_entry
							JOIN divisions
							ON entries.divisions_id_division = divisions.id_division
							WHERE players.player_year_entered = %d
							ORDER BY entries.id_entry DESC",
							$this->oDB->escape($a_iYear));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes;		
	}
	
	public function getOpenEntriesForYear($a_iYear)
	{
		$sQuery = sprintf("SELECT entries.*, players.*, entry_rounds.*, entries_posters.entry_poster_date_posted, divisions.*
							FROM entries
							JOIN players
							ON entries.players_id_player = players.id_player
							JOIN entry_rounds
							ON entries.id_entry = entry_rounds.entries_id_entry
							JOIN entries_posters
							ON entries.id_entry = entries_posters.entries_id_entry
							JOIN divisions
							ON entries.divisions_id_division = divisions.id_division 
							WHERE entry_rounds.entry_round_score_game = 0
							AND players.player_year_entered = %d
							AND entries.entry_is_voided = 0
							ORDER BY entries.id_entry ASC",
							$this->oDB->escape($a_iYear));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);		
		
		$aOpenEntries = array();
		$aStoredEntries = array();
		
		foreach($aRes as $entry)
		{
			if(!in_array($entry['id_entry'], $aStoredEntries))
			{
				array_push($aOpenEntries, $entry);
				array_push($aStoredEntries, $entry['id_entry']);					
			}
		}
		
		return $aOpenEntries;
	}
	
	// DO NOT change the sorting here (create new public functions if there's a need to sort the games)
	// since this order is used to keep track of the games when inserting points etc. etc. etc.
	// for the entry
	public function getRoundsInEntry($a_iIDEntry)
	{
		$sQuery = sprintf("SELECT games.*, entry_rounds.*
					FROM games
					JOIN entry_rounds
					ON games.id_game = entry_rounds.games_id_game
					WHERE entry_rounds.entries_id_entry = %d
					ORDER BY games.game_name ASC",
					$this->oDB->escape($a_iIDEntry));

		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes;	
	}
	
	public function playerHasPlayedEntries($a_iIDPlayer)
	{
		$sQuery = sprintf("SELECT COUNT(*) 
							FROM entries
							WHERE players_id_player =%d
							LIMIT 1",
							$this->oDB->escape($a_iIDPlayer));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);

		if($aRes[0]["count(*)"] == 0)
			return false;
		else
			return true;
	}
	
	public function isValidEntryID($a_iIDEntry)
	{
		$sQuery = sprintf("SELECT id_entry
							FROM entries
							WHERE id_entry =%d
							LIMIT 1",
							$this->oDB->escape($a_iIDEntry));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);

		if($aRes == null)
			return false;
		else
			return true;
	}
	
	public function isCompleted($a_iIDEntry)
	{
		// check if the entry is completed = all scores registered
		$sQuery = sprintf("SELECT entry_round_score_game
							FROM entry_rounds 
							WHERE entries_id_entry =%d",
							$this->oDB->escape($a_iIDEntry));
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);

		foreach($aRes as $val)
		{
			// if we have one null or 0 score it's not completed
			if($val['entry_round_score_game'] == null || $val['entry_round_score_game'] == 0)
				return false;
		}
		
		return true;
		
	}
	
	public function isVoided($a_iIDEntry)
	{
		// check if the entry is voided
		$sQuery = sprintf("SELECT entry_is_voided
							FROM entries
							WHERE id_entry =%d
							LIMIT 1",
							$this->oDB->escape($a_iIDEntry));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);

		if($aRes[0]['entry_is_voided'] == 1)
			return true;
		else
			return false;
	}
	
	public function getEntryHistory($a_iIDEntry)
	{
		$aEntryHistory = array();
		$i = 0;
		// get the date when the entry was posted
		$sQuery = sprintf("SELECT entries_posters.entry_poster_date_posted, users.user_username
							FROM entries_posters
							JOIN users
							ON entries_posters.users_id_user = users.id_user
							WHERE entries_id_entry = %d
							LIMIT 1",
							$this->oDB->escape($a_iIDEntry));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		
		$aEntryHistory[$i++] = $aRes[0]['entry_poster_date_posted'] . "," . "entryPosted," . $aRes[0]['user_username'];

		// get all voids and unvoids
		$sQuery = sprintf("SELECT entries_voided.entry_voided_unvoided, entries_voided.entry_voided_date_posted, users.user_username
							FROM entries_voided
							JOIN users
							ON entries_voided.users_id_user = users.id_user
							WHERE entries_id_entry = %d",
							$this->oDB->escape($a_iIDEntry));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		
		if($aRes != null)
		{
			foreach($aRes as $val)
			{
				if($val['entry_voided_unvoided'] == 1)
					$aEntryHistory[$i++] = $val['entry_voided_date_posted'] . ",entryUnvoided," . $val['user_username'];
				else
					$aEntryHistory[$i++] = $val['entry_voided_date_posted'] . ",entryVoided," . $val['user_username'];
			}
		}
		
		// get all entry round changes
		$aEntryRounds = $this->getEntryRounds(null ,$a_iIDEntry);
		$iRoundNumber = 1;
		if($aEntryRounds != null)
		{
			foreach($aEntryRounds as $entryround)
			{
				//$entryround['id_entry_round']
				$sQuery = "SELECT entry_round_updaters.entry_round_updater_date_posted, entry_round_updaters.entry_round_updater_type, users.user_username 
							FROM entry_round_updaters
							JOIN users
							ON entry_round_updaters.users_id_user = users.id_user
							WHERE entry_rounds_id_entry_round ='" . $entryround['id_entry_round'] ."'";
				$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
				
				if($aRes != null)
				{
					foreach($aRes as $entryupdate)
					{
						// type 1 = score-change
						// type 2 = game-change
						if($entryupdate['entry_round_updater_type'] == 1)
							$aEntryHistory[$i++] = $entryupdate['entry_round_updater_date_posted'] . ",entryRoundScoreUpdate," . $entryupdate['user_username'] . "," . $iRoundNumber;
						if($entryupdate['entry_round_updater_type'] == 2)
							$aEntryHistory[$i++] = $entryupdate['entry_round_updater_date_posted'] . ",entryRoundGameUpdate," . $entryupdate['user_username'] . "," . $iRoundNumber;
							
					}
				}
				$iRoundNumber++;
			}
		}
		
		$aTemp = array();
		$i = 0;
		// make the array nicer-ish
		foreach($aEntryHistory as $entryHistory)
		{
			$aHistory = preg_split("/,/", $entryHistory);
			$aTemp[$i]['date'] = $aHistory[0];
			$aTemp[$i]['action'] = $aHistory[1];
			$aTemp[$i]['username'] = $aHistory[2];
			if(isset($aHistory[3]))
				$aTemp[$i]['roundNumber'] = $aHistory[3];
			$i++;
			
		}
		
		// sort by date
		$i = 0;
		foreach($aTemp as $action)
		{
			$aDates[$i] = $action['date'] . "," . $i;
			$i++;
		}
		rsort($aDates);
		
		$aFormattedHistory = array();
		foreach($aDates as $date)
		{
			$aDatesAndIndex = preg_split("/,/", $date);
			array_push($aFormattedHistory, $aTemp[$aDatesAndIndex[1]]);
		}
		return $aFormattedHistory;
	}
	
	public function getDeletedEntries()
	{
		$sQuery = "SELECT * FROM entries_deleted
					ORDER BY entry_deleted_date_posted DESC";
		$aRet = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		
		$i = 0;
		foreach($aRet as $deletedEntry)
		{
			// get all deleted entry rounds
			$sQuery = "SELECT * FROM entry_rounds_deleted
						WHERE entries_deleted_id_entry_deleted ='" . $deletedEntry['id_entry_deleted'] . "'";
			$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		
			$aRet[$i]['entry_rounds'] = $aRes;
			$i++;
		}
		
		return $aRet;	
	}
	
	public function yearHasEntries($a_iYear)
	{
		$sQuery = sprintf("SELECT entries.id_entry
							FROM entries
							JOIN players 
							ON entries.players_id_player = players.id_player
							WHERE players.player_year_entered = %s
							LIMIT 1",
							$this->oDB->escape($a_iYear));
							
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		
		if($aRes == null)
			return false;
		else
		{
			if($aRes[0]['id_entry'] != null)
				return true;
			else
				return false;
		}
		
	}
	
	/* won't be used, i'll use the game_has_rounds field instead
	public function gameHasEntryRounds($a_iIDGame)
	{
		$sQuery = sprintf("SELECT id_entry_round
							FROM entry_rounds
							WHERE games_id_game = %d
							LIMIT 1",
							$this->oDB->escape($a_iIDGame));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);	
		if(count($aRes) > 0)
			return true;
		else
			return false;
	}
	*/
	
	public function setEntryPositions($a_iYear, $a_sDivision)
	{
		// get the standings
		$oStandings = new Standings();
		$aStandings = $oStandings->getStandings($a_iYear, $a_sDivision);
		
		$iPos = 1;
		foreach($aStandings as $entry)
		{
			if($entry["entry_position"] != $iPos)
			{
				$this->setEntryPosition($entry["id_entry"], $iPos);
				// WON'T USE THE POSITION-CHANGE TABLE/DATA
				//$this->oEntryPosition->insertEntryPosition($entry["id_entry"], $iPos);
			}
			$iPos++;
		}
	}

	public function setEntryPosition($a_iIDEntry, $a_iPos)
	{
		$sQuery = sprintf("UPDATE entries
							SET entry_position = %d
							WHERE id_entry = %d
							LIMIT 1",
							$this->oDB->escape($a_iPos),
							$this->oDB->escape($a_iIDEntry));
		
		$this->oMDB2Wrapper->query("exec", $sQuery);		
	}	
	
	public function getAvgEntryScores($a_iYear, $a_sDivision)
	{
		$sQuery = sprintf("SELECT ROUND(AVG(entry_score),1) AS avg_entry_score, players.* , entries.* , divisions.division_name_short, countries.*, divisions_to_players.*
							FROM players
							JOIN entries 
							ON players.id_player = entries.players_id_player
							JOIN divisions
							ON entries.divisions_id_division = divisions.id_division 
							JOIN divisions_to_players
							ON entries.divisions_id_division = divisions_to_players.divisions_id_division AND players.id_player = divisions_to_players.players_id_player 
							JOIN countries 
							ON players.countries_id_country = countries.id_country
							WHERE players.player_year_entered = %d
							AND divisions.division_name_short = '%s'
							AND entries.entry_is_voided !=1
							GROUP BY players.id_player
							ORDER BY avg_entry_score DESC",
							$this->oDB->escape($a_iYear),
							$this->oDB->escape($a_sDivision));							

		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		$i = 0;
		$oPlayer = new Player();
		$aRes = $oPlayer->addSplitTeamVariables($aRes);

		// loop through the players and add the average entry score + max and min
		foreach($aRes as $player)
		{
			$aRes[$i]['min_entry_score'] = $this->getMinEntryScoreForPlayer($player['id_player']);	
			$aRes[$i]['max_entry_score'] = $this->getMaxEntryScoreForPlayer($player['id_player']);
			$i++;
		}

		return $aRes;
	}
	
	public function getAvgEntryScoreForPlayer($a_iIDPlayer, $a_sDivision, $a_bNonVoided = false)
	{
		$oDivision = new Division();
		$iIDDivision = $oDivision->getDivisionIDFromShortName($a_sDivision);
		
		$sQuery = sprintf("SELECT ROUND(AVG(entry_score),1) AS avg_score
							FROM entries
							WHERE players_id_player = %d
							AND divisions_id_division = %d
							LIMIT 1",
							$this->oDB->escape($iIDDivision),
							$this->oDB->escape($a_iIDPlayer));

		if($a_bNonVoided)
		{
			$sQuery = sprintf("SELECT ROUND(AVG(entry_score),1) AS avg_score
								FROM entries
								WHERE players_id_player = %d
								AND divisions_id_division = %d
								AND entry_is_voided != 1
								LIMIT 1",
								$this->oDB->escape($a_iIDPlayer),
								$this->oDB->escape($iIDDivision));
		}
				
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		
		if(isset($aRes[0]))
			return $aRes[0]['avg_score'];
		else
			return null;
	}
	
	public function getMaxEntryScoreForPlayer($a_iIDPlayer)
	{
		$sQuery = sprintf("SELECT MAX(entry_score) AS max_score
							FROM entries
							WHERE players_id_player = %d
							LIMIT 1",
							$this->oDB->escape($a_iIDPlayer));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		if(isset($aRes[0]))
			return $aRes[0]['max_score'];
		else
			return null;		
	}
	
	public function getMinEntryScoreForPlayer($a_iIDPlayer)
	{
		$sQuery = sprintf("SELECT MIN(entry_score) AS min_score
							FROM entries
							WHERE players_id_player = %d
							AND entry_is_voided != 1
							LIMIT 1",
							$this->oDB->escape($a_iIDPlayer));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		if(isset($aRes[0]))
			return $aRes[0]['min_score'];
		else
			return null;		
	}
	
	public function getNoOfRoundsForGame($a_iYear, $a_sDivision, $a_bOnlyCounted = false)
	{
		$sAndCounted = null;
		if($a_bOnlyCounted)
		{
			$sAndCounted = "AND entry_rounds.entry_round_is_counted = 1";
		}
		$sQuery = sprintf("SELECT COUNT(entry_rounds.id_entry_round) AS entry_round_count, games.*
							FROM entry_rounds
							JOIN entries
							ON entry_rounds.entries_id_entry = entries.id_entry
							JOIN players
							ON entries.players_id_player = players.id_player
							JOIN games
							ON entry_rounds.games_id_game = games.id_game
							JOIN divisions
							ON entries.divisions_id_division = divisions.id_division 
							WHERE players.player_year_entered = %d
							AND divisions.division_name_short = '%s'
							AND entry_rounds.entry_round_score_game > 1
							" . $sAndCounted . " 
							GROUP BY games.id_game
							ORDER BY entry_round_count DESC",
							$this->oDB->escape($a_iYear),
							$this->oDB->escape($a_sDivision));

		// TODO: i should get the highest score for each game in the query, but I don't know how?!
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		$i = 0;
		// add the highest scores to the game
		foreach($aRes as $game)
		{
			$aRes[$i]['highest_score'] = $this->getHighestScoreAndPlayerForGame($game['id_game'], $a_iYear, $a_sDivision);
			$i++;
		}
		
		return $aRes;
	}
	
	public function getHighestScoreAndPlayerForGame($a_iIDGame, $a_iYear, $a_sDivision, $a_iCountry = null)
	{
		$sAndCountry = null;
		if($a_iCountry != null)
		{
			$sAndCountry = sprintf(" AND countries.id_country = %d ",
									$this->oDB->escape($a_iCountry));
		}		
					
		$sQuery = sprintf("SELECT players.*, entry_rounds.*, countries.*
							FROM players
							JOIN entries
							ON players.id_player = entries.players_id_player
							JOIN entry_rounds
							ON entries.id_entry = entry_rounds.entries_id_entry
							JOIN games
							ON entry_rounds.games_id_game = games.id_game
							JOIN divisions
							ON entries.divisions_id_division = divisions.id_division 
							JOIN countries
							ON players.countries_id_country = countries.id_country
							WHERE games.id_game = %d
							AND players.player_year_entered = %d
							AND divisions.division_name_short = '%s' " . $sAndCountry . "
							ORDER BY entry_rounds.entry_round_score_game DESC
							LIMIT 1",
							$this->oDB->escape($a_iIDGame),
							$this->oDB->escape($a_iYear),
							$this->oDB->escape($a_sDivision));

		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		$oString = new String();
		$aRes[0]['score_highest_output'] = $oString->pinScore($aRes[0]['entry_round_score_game']);
		
		$oPlayer = new Player();
		$aRes = $oPlayer->addSplitTeamVariables($aRes);

		return $aRes[0];
	}
	
	public function getMostPopularMachinesByCountry($a_iYear, $a_sDivision, $a_bOnlyCounted = false)
	{
		$sAndCounted = null;
		if($a_bOnlyCounted)
		{
			$sAndCounted = "AND entry_rounds.entry_round_is_counted = 1";
		}

		$sQuery = sprintf("SELECT countries.*, games.game_name, games.id_game, divisions.division_name_short, COUNT( entry_rounds.entries_id_entry ) AS entry_round_count
							FROM countries
							JOIN players 
							ON countries.id_country = players.countries_id_country
							JOIN entries 
							ON players.id_player = entries.players_id_player
							JOIN entry_rounds 
							ON entries.id_entry = entry_rounds.entries_id_entry
							JOIN games 
							ON entry_rounds.games_id_game = games.id_game
							JOIN divisions
							ON entries.divisions_id_division = divisions.id_division 
							WHERE entry_rounds.entry_round_score_game > 1
							AND players.player_year_entered = %d
							AND countries.country_name != 'Unknown'
							AND divisions.division_name_short = '%s'
							" . $sAndCounted . "
							GROUP BY countries.id_country, games.id_game
							ORDER BY country_name ASC , entry_round_count DESC",
							$this->oDB->escape($a_iYear),
							$this->oDB->escape($a_sDivision));
							
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		
		$i = 0;
		// add the highest score (for each country) for each game
		foreach($aRes as $game)
		{
			$aRes[$i]['highest_score'] = $this->getHighestScoreAndPlayerForGame($game['id_game'], $a_iYear, $a_sDivision, $game['id_country']);
			$i++;			
		}
		
		return $aRes;	
	}
	
	public function getNumberOfUniqueGames($a_iYear, $a_sDivision)
	{
		$sQuery = sprintf("SELECT players.*, countries.*, divisions_to_players.dtp_no_of_played_entries, 
							divisions.division_name_short, COUNT(DISTINCT(entry_rounds.games_id_game)) AS unique_game_count
							FROM players
							JOIN entries 
							ON players.id_player = entries.players_id_player
							JOIN entry_rounds 
							ON entries.id_entry = entry_rounds.entries_id_entry
							JOIN games 
							ON entry_rounds.games_id_game = games.id_game
							JOIN divisions
							ON entries.divisions_id_division = divisions.id_division 
							JOIN countries 
							ON players.countries_id_country = countries.id_country
							JOIN divisions_to_players
							ON players.id_player = divisions_to_players.players_id_player AND divisions.id_division = divisions_to_players.divisions_id_division 
							WHERE players.player_year_entered = %d 
							AND divisions.division_name_short = '%s'
							GROUP BY players.id_player
							ORDER BY unique_game_count DESC, divisions_to_players.dtp_no_of_played_entries",
							$this->oDB->escape($a_iYear),
							$this->oDB->escape($a_sDivision));

		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);			
	
		$oPlayer = new Player();
		$aRes = $oPlayer->addSplitTeamVariables($aRes);
		
		return $aRes;
	}
	
	public function getNumberOfVoidedEntries($a_iYear, $a_sDivision)
	{
		$sQuery = sprintf("SELECT COUNT(entries.id_entry) AS no_of_voided_entries, players.*, countries.*, divisions.division_name_short, divisions_to_players.dtp_no_of_played_entries
							FROM players
							JOIN entries 
							ON players.id_player = entries.players_id_player
							JOIN divisions
							ON entries.divisions_id_division = divisions.id_division 
							JOIN countries 
							ON players.countries_id_country = countries.id_country
							JOIN divisions_to_players
							ON players.id_player = divisions_to_players.players_id_player AND divisions.id_division = divisions_to_players.divisions_id_division 
							WHERE entries.entry_is_voided = 1
							AND players.player_year_entered = %d
							AND divisions.division_name_short = '%s'
							GROUP BY players.id_player
							ORDER BY no_of_voided_entries DESC, divisions_to_players.dtp_no_of_played_entries",
							$this->oDB->escape($a_iYear),
							$this->oDB->escape($a_sDivision));

		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);			
	
		$oPlayer = new Player();
		$aRes = $oPlayer->addSplitTeamVariables($aRes);
		
		return $aRes;
	}

	public function addEntryRoundStatsToGame($a_aGame, $a_sDivision = null, $a_iYear = null, $a_bOnlyCounted = false)
	{
		//printArray($a_aGame);
		$oString = new String();		
		// get the lowest score for the game
		$iLowestScore = $this->getLowestScoreForGame($a_aGame[0]["id_game"], $a_sDivision, $a_iYear);
		if($iLowestScore == null)
			$iLowestScore = 0;
		// get the highest score for the game
		$iHighestScore = $this->getHighestScoreForGame($a_aGame[0]["id_game"], $a_sDivision, $a_iYear);
		if($iHighestScore == null)
			$iHighestScore = 0;
			
		$a_aGame[0]["stats"]["score_highest"] = $iHighestScore;
		$a_aGame[0]["stats"]["score_lowest"] = $iLowestScore;
		$a_aGame[0]["stats"]["score_highest_output"] = $oString->pinScore($iHighestScore);
		$a_aGame[0]["stats"]["score_lowest_output"] = $oString->pinScore($iLowestScore);
		
		$a_aGame[0]["stats"]["no_of_played_entry_rounds"] = $this->getNumberOfEntryRounds($a_aGame[0]["id_game"], $a_iYear, $a_sDivision, $a_bOnlyCounted);
		$a_aGame[0]["stats"]["score_average"] = round($this->getAverageScore($a_aGame[0]["id_game"], $a_iYear, $a_sDivision, $a_bOnlyCounted));
		$a_aGame[0]["stats"]["score_average_output"] = $oString->pinScore(round($a_aGame[0]["stats"]["score_average"]));
		
		$a_aGame[0]["stats"]["score_median"] = $this->getMedianScore($a_aGame[0]["id_game"], $a_iYear, $a_sDivision, $a_bOnlyCounted);
		$a_aGame[0]["stats"]["score_median_output"] = $oString->pinScore($a_aGame[0]["stats"]["score_median"]);
		
		return $a_aGame;
	}
	
	public function getHistoGramBins($a_iiDGame, $a_sDivision = null, $a_iYear = null)
	{
		$this->oMDB2Wrapper->exec("DROP TABLE IF EXISTS percentile");

		$this->oMDB2Wrapper->exec("CREATE TABLE percentile
									(ID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY)
									SELECT entry_rounds_score_game FROM entry_rounds
									ORDER BY entry_rounds_score_game");
		
						

	}
		
	public function getHistogramDataForGame($a_iIDGame, $a_sDivision = null, $a_iYear = null)
	{
		$oGame = new Game();
		if($a_sDivision == null && $a_iYear == null)
		{
			// it's the top-scores thingy
			$aGame = $oGame->getGame($a_iIDGame);
			$aGame[0]['entry_rounds'] = $this->getHighestScoresForGame($a_iIDGame,null,true);
		}
		else
		{
			$aGame = $oGame->getGame($a_iIDGame);
			$aGame = $this->addEntryRoundsToGame($aGame, $a_sDivision, $a_iYear);
		}
		
		$iHighestScore = $this->getHighestScoreForGame($a_iIDGame, $a_sDivision, $a_iYear);
		$iLowestScore = $this->getLowestScoreForGame($a_iIDGame, $a_sDivision, $a_iYear);

		$oString = new String();
		// build the score intervals
		$iScoreBaseInterVal = round($iHighestScore / 10);
		
		$aScoreInterVals = array();
		for($i = 0; $i < 11; $i++)
		{
			$iMult = $i + 1;
			$aScoreInterVals[$i]['score_interval'] = $iScoreBaseInterVal * $i;
			$aScoreInterVals[$i]['number_of_scores'] = 0;
			if(isset($aScoreInterVals[$i]))
			{
				// TODO: the score strings shouldn't be set here, but in the templates
				if(isset($aScoreInterVals[$i-1]))
					$aScoreInterVals[$i]['score_interval_name'] = $oString->pinScore($aScoreInterVals[$i-1]['score_interval']) . " - " . $oString->pinScore($aScoreInterVals[$i]['score_interval']);
			}
		}
		
		// loop through all entry-rounds
		foreach($aGame[0]['entry_rounds'] as $entryRound)
		{
			if($entryRound['entry_round_score_game'] > 0)
			{
				$i = 0;
				foreach($aScoreInterVals as $scoreInterval)
				{
					if($entryRound['entry_round_score_game'] <= $aScoreInterVals[$i]['score_interval'])
					{
						$aScoreInterVals[$i]['number_of_scores'] = $aScoreInterVals[$i]['number_of_scores'] + 1;
						break;
					}
					$i++;
				}
			}					
		}

		$iMaxScore = 0;
		$iTotalRounds = $this->getNumberOfEntryRounds($aGame[0]["id_game"], $a_iYear, $a_sDivision);
		
		// set the max-scores number, and the total number of entry-rounds
		foreach ($aScoreInterVals as $scoreInterval)
		{
			if($scoreInterval['number_of_scores'] > $iMaxScore)
				$iMaxScore = $scoreInterval['number_of_scores'];
		}
		
		$i = 0;
		foreach ($aScoreInterVals as $scoreInterval)
		{
			$aScoreInterVals[$i]['max_number_of_scores'] = $iMaxScore;
			$aScoreInterVals[$i]['total_no_of_rounds'] = $iTotalRounds;
			$i++;
		}
		
		// UGLY: never the less... let's remove the first position from the array
		$aRet = array_shift($aScoreInterVals); 
		return $aScoreInterVals;
	}
	
	public function getNumberOfEntryRounds($a_iIDGame, $a_iYear = null, $a_sDivision = null, $a_bOnlyCounted = false)	
	{
		$sAndYear = null;
		if($a_iYear != null)
		{
			$sAndYear = sprintf("AND players.player_year_entered = %d",
								$this->oDB->escape($a_iYear));
		}

		$sAndDivision = null;
		if($a_iYear != null)
		{
			$sAndDivision = sprintf("AND divisions.division_name_short = '%s'",
									$this->oDB->escape($a_sDivision));
		}
		
		$sAndCounted = null;
		if($a_bOnlyCounted)
		{
			$sAndCounted = "AND entry_rounds.entry_round_is_counted = 1";
		}
		
		$sQuery = sprintf("SELECT COUNT(entry_rounds.id_entry_round) AS count
							FROM entry_rounds
							JOIN entries
							ON entry_rounds.entries_id_entry = entries.id_entry
							JOIN players
							ON entries.players_id_player = players.id_player
							JOIN divisions
							ON entries.divisions_id_division = divisions.id_division 			
							JOIN games
							ON entry_rounds.games_id_game = games.id_game
							WHERE games.id_game = %d " . 
							$sAndYear . " " . 
							$sAndDivision . " " . $sAndCounted . "
							AND entry_rounds.entry_round_score_game > 1",
							$this->oDB->escape($a_iIDGame));
							
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes[0]['count'];
	}
	
	public function getAverageScore($a_iIDGame, $a_iYear = null, $a_sDivision = null, $a_bOnlyCounted = false)
	{
		$sAndYear = null;
		if($a_iYear != null)
		{
			$sAndYear = sprintf("AND players.player_year_entered = %d",
								$this->oDB->escape($a_iYear));
		}

		$sAndDivision = null;
		if($a_iYear != null)
		{
			$sAndDivision = sprintf("AND divisions.division_name_short = '%s'",
									$this->oDB->escape($a_sDivision));
		}
		
		$sAndCounted = null;
		if($a_bOnlyCounted)
		{
			$sAndCounted = "AND entry_rounds.entry_round_is_counted = 1";
		}
		
		$sQuery = sprintf("SELECT AVG(entry_rounds.entry_round_score_game) AS average
							FROM entry_rounds
							JOIN entries
							ON entry_rounds.entries_id_entry = entries.id_entry
							JOIN players
							ON entries.players_id_player = players.id_player
							JOIN divisions
							ON entries.divisions_id_division = divisions.id_division 
							JOIN games
							ON entry_rounds.games_id_game = games.id_game
							WHERE games.id_game = %d " . 
							$sAndYear . " " . 
							$sAndDivision . " " . $sAndCounted . "
							AND entry_rounds.entry_round_score_game > 1",
							$this->oDB->escape($a_iIDGame));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes[0]['average'];		
	}

	public function getMedianScore($a_iIDGame, $a_iYear = null, $a_sDivision = null, $a_bOnlyCounted = false)
	{
		$sAndYear = null;
		if($a_iYear != null)
		{
			$sAndYear = sprintf("AND players.player_year_entered = %d",
								$this->oDB->escape($a_iYear));
		}

		$sAndDivision = null;
		if($a_iYear != null)
		{
			$sAndDivision = sprintf("AND divisions.division_name_short = '%s'",
									$this->oDB->escape($a_sDivision));
		}

		$sAndCounted = null;
		if($a_bOnlyCounted)
		{
			$sAndCounted = "AND entry_rounds.entry_round_is_counted = 1";
		}
	
		
		$sQuery = "CREATE TEMPORARY TABLE tmp (
					n INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
					value VARCHAR(99) NOT NULL );";
		$this->oMDB2Wrapper->query("exec", $sQuery);	

		$sQuery = sprintf("INSERT INTO tmp (value)
							SELECT entry_rounds.entry_round_score_game
							FROM entry_rounds
							JOIN entries
							ON entry_rounds.entries_id_entry = entries.id_entry
							JOIN players
							ON entries.players_id_player = players.id_player
							JOIN divisions
							ON entries.divisions_id_division = divisions.id_division 
							JOIN games
							ON entry_rounds.games_id_game = games.id_game
							WHERE games.id_game = %d " . 
							$sAndYear . " " . 
							$sAndDivision . " " . $sAndCounted . "
							AND entry_rounds.entry_round_score_game > 1
							ORDER BY 1;",
							$this->oDB->escape($a_iIDGame));
		$this->oMDB2Wrapper->query("exec", $sQuery);

		// have to split the next part into two querys, since I can't use this one:
		/*
		SELECT @count := COUNT(*) FROM tmp;
		SELECT DISTINCT value FROM tmp
		WHERE n IN (FLOOR((45+1)/2), CEIL((45+1)/2));
		*/
		// I get a syntax error in MDB2 that I can't figure out what's causing
		
		$sQuery = "SELECT COUNT(*) AS count FROM tmp";
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		$iCount = $aRes[0]['count'];

		$sQuery = "SELECT DISTINCT value FROM tmp
					WHERE n IN (FLOOR((" . $iCount . "+1)/2), CEIL((" . $iCount . "+1)/2))";
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);

		$sQuery = "DROP TABLE tmp";		
		$this->oMDB2Wrapper->query("exec", $sQuery);	

		if(isset($aRes[0]))		
			return $aRes[0]['value'];
		else
			return 0;		
	}	
	
	function addEntryRoundScoresToStandings($a_aStandings)
	{
		$i = 0;
		foreach($a_aStandings as $entry)
		{
			$aEntryRounds = $this->getEntryRounds(null, $entry['id_entry']);
			$j = 0;
			foreach($aEntryRounds as $entryround)
			{
				$a_aStandings[$i]['entry_round_score'][$j] = $entryround['entry_round_score_tournament'];
				$j++;
			}
			$i++;
		}
		
		return $a_aStandings;
	}
	
	public function setAverageEntryScores($a_iYear, $a_sDivision)
	{
		$oPlayer = new Player();
		$aPlayers = $oPlayer->getPlayers($a_iYear, $a_sDivision);
		$oDivision = new Division();
		$iIDDivision = $oDivision->getDivisionIDFromShortName($a_sDivision);
		
		foreach($aPlayers as $player)
		{
			$dAvg = $this->getAvgEntryScoreForPlayer($player['id_player'], $player['division_name_short'], true);
			$sQuery = sprintf("UPDATE divisions_to_players
							SET dtp_average_entry_score = '%s'
							WHERE players_id_player = %d
							AND divisions_id_division = %d",
							$this->oDB->escape($dAvg),
							$this->oDB->escape($player['id_player']),
							$this->oDB->escape($iIDDivision));		
			$this->oMDB2Wrapper->query("exec", $sQuery);				
		}
	}
	
	// [BUGFIX] to correct the number of played entries
	public function setNumberOfPlayedEntries($a_iIDPlayer, $a_iIDDivision)
	{
		$oDivision = new Division();
		$iNumberOfEntries = $this->newGetNumberOfEntriesForPlayer($a_iIDPlayer, $a_iIDDivision);
		$sQuery = sprintf("UPDATE divisions_to_players
							SET dtp_no_of_played_entries = '%d'
							WHERE players_id_player = %d
							AND divisions_id_division = %d",
							$this->oDB->escape($iNumberOfEntries),
							$this->oDB->escape($a_iIDPlayer),
							$this->oDB->escape($a_iIDDivision));
							
		$this->oMDB2Wrapper->query("exec", $sQuery);				
	}
}
?>
