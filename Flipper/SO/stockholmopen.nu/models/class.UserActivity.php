<?php
require_once(BASE_DIR . "classes/class.IP.php");
require_once(BASE_DIR . "classes/class.SmartyConfigFile.php");
require_once("class.Model.php");
require_once("class.User.php");
require_once("class.PageSetting.php");

class UserActivity extends Model
{
	public function setActive($a_sPage)
	{
		$sSessionID = sha1(session_id());
		$oIP = new IP();
		$sIP = $oIP->getUserIP();
		$sPage = $a_sPage;
		$oUser = new User();
		
		if($oUser->isLoggedIn())
		{
			$iIDUser = $oUser->getLoggedInUserID();
			if($iIDUser == null)
				$iIDUser = 0;
		
			// check if we've got a user-activity for this user and session-id
			if($this->getUserActivityIDForIDUserAndSessID($iIDUser, $sSessionID) == null)
			{
				//echo "<b>LOGGED IN</b> Adding user activity<br />";
				$this->insertUserActivity($iIDUser, $sIP, $sPage, $sSessionID);
			}
			else
			{
				//echo "<b>LOGGED IN</b> Updating user activity<br />";
				$this->updateUserActivityForUser($iIDUser, $sIP, $sPage, $sSessionID);
			}
		}
		else
		{
			// a non logged in user
			// check if we've got a user-activity for the session id
			if($this->getUserActivityIDForSessionID($sSessionID) == null)
			{			
				//echo "Adding user activity<br />";
				$this->insertUserActivity(null, $sIP, $sPage, $sSessionID);
			}
			else
			{
				//echo "Updating user activity<br />";
				$this->updateUserActivityForSessionID($sIP, $sPage, $sSessionID);		
			}
		}
	}

	public function insertUserActivity($a_iIDUser = 0, $a_sIP, $a_sPage, $a_sSessionID)
	{
		$sQuery = sprintf("INSERT INTO user_activities
							(users_id_user, ua_date, ua_ip, ua_page, ua_sess_id)
							VALUES (%d, '%s', '%s', '%s', '%s')",
							$this->oDB->escape($a_iIDUser),
							date("Y-m-d H:i:s"),	
							$this->oDB->escape($a_sIP),
							$this->oDB->escape($a_sPage),
							$this->oDB->escape($a_sSessionID));
		$this->oMDB2Wrapper->query("exec", $sQuery);
	}

	public function updateUserActivityForUser($a_iIDUser, $a_sIP, $a_sPage, $sSessionID)
	{
		$sQuery = sprintf("UPDATE user_activities
							SET users_id_user = %d, ua_date = '%s', ua_ip = '%s', ua_page = '%s'
							WHERE users_id_user = %d 
							AND ua_sess_id = '%s'
							LIMIT 1",
							$this->oDB->escape($a_iIDUser),
							date("Y-m-d H:i:s"),	
							$this->oDB->escape($a_sIP),
							$this->oDB->escape($a_sPage),
							$this->oDB->escape($a_iIDUser),
							$this->oDB->escape($sSessionID));
		$this->oMDB2Wrapper->query("exec", $sQuery);
	}
	
	public function updateUserActivityForSessionID($a_sIP, $a_sPage, $a_sSessionID)
	{
		$sQuery = sprintf("UPDATE user_activities
							SET users_id_user = 0, ua_date = '%s', ua_ip = '%s', ua_page = '%s', ua_sess_id = '%s'
							WHERE ua_sess_id = '%s' 
							LIMIT 1",
							date("Y-m-d H:i:s"),	
							$this->oDB->escape($a_sIP),
							$this->oDB->escape($a_sPage),
							$this->oDB->escape($a_sSessionID),
							$this->oDB->escape($a_sSessionID));
		$this->oMDB2Wrapper->query("exec", $sQuery);
	}
	
	private function getUserActivityIDForSessionID($a_sSessionID)
	{
		$sQuery = sprintf("SELECT id_ua
							FROM user_activities
							WHERE ua_sess_id = '%s'
							LIMIT 1",
							$this->oDB->escape($a_sSessionID));

		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);	
		if(isset($aRes[0]))
			return $aRes[0]['id_ua'];
		else
			return null;		
	}
	
	private function getUserActivityIDForIDUser($a_iIDUser)
	{
		$sQuery = sprintf("SELECT id_ua
							FROM user_activities
							WHERE users_id_user = %d
							LIMIT 1",
							$this->oDB->escape($a_iIDUser));
							
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);	
		if(isset($aRes[0]))
			return $aRes[0]['id_ua'];
		else
			return null;		
	}
	
	private function getUserActivityIDForIDUserAndSessID($a_iIDUser, $a_sSessionID)
	{
		$sQuery = sprintf("SELECT id_ua
							FROM user_activities
							WHERE users_id_user = %d
							AND ua_sess_id = '%s'
							LIMIT 1",
							$this->oDB->escape($a_iIDUser),
							$this->oDB->escape($a_sSessionID));
							
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);	
		if(isset($aRes[0]))
			return $aRes[0]['id_ua'];
		else
			return null;
	}

	private function getActivityReferenceTime()
	{
		// get the time that is set for the ajax-div to update the user-activity
		$oSmartyConfigFile = new SmartyConfigFile(MENU_CONFIG_FILE);
		$iUpdateTime = $oSmartyConfigFile->getStringFromDefinition("LOGIN_ACTIVITY_FREQUENCYUENCY");
		$iUpdateTime = intval($iUpdateTime);
		if($iUpdateTime == 0)
			$iUpdateTime = 15;
		
		// rely on PHP-time, once again
		return date("Y-m-d H:i:s", strtotime("-" . ($iUpdateTime+5) . " second"));
	}
	
	public function getActiveUsers()
	{
		$sRefTime = $this->getActivityReferenceTime();
		$sQuery = "SELECT users.*, user_activities.ua_page, user_activities.ua_ip
					FROM users
					JOIN user_activities 
					ON users.id_user = user_activities.users_id_user
					WHERE user_activities.ua_date > '" . $sRefTime . "'";
		return $this->oMDB2Wrapper->query("queryAll", $sQuery);
	}
	
	public function getActiveGuests()
	{
		$sRefTime = $this->getActivityReferenceTime();
		$sQuery = "SELECT user_activities.ua_page, user_activities.ua_ip
					FROM user_activities
					WHERE user_activities.ua_date > '" . $sRefTime . "'
					AND users_id_user = 0";
		return $this->oMDB2Wrapper->query("queryAll", $sQuery);
	}
	
	public function flush()
	{
		// flush all entries that are older than 24 hours
		$oPageSetting = new PageSetting();
		$aPageSetting = $oPageSetting->getPageSettings();

		$iReferenceTime = strtotime("-24 hour");
		$iLastFlushTime = strtotime($aPageSetting['user_activity_last_flush']) . "<br />";
		$iDiff = $iReferenceTime - $iLastFlushTime;
		// let's rely on PHP's time, again
		$sLastFlushTime = $aPageSetting['user_activity_last_flush'];
		
		$bFlush = false;
		if($iDiff > 0)
			$bFlush = true;
		
		if($bFlush)
		{			
			$sQuery = "DELETE FROM user_activities
						WHERE ua_date < '" . $sLastFlushTime . "'"; 
			$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
			// insert the latest flush time
			$oPageSetting->insertFlushTime();
		}
	}
}
?>