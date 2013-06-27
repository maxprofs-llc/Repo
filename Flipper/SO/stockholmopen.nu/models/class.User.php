<?php
// start a session if it's not initiated
if(!defined('SID'))
{
	session_start();
}

require_once("class.Model.php");
require_once("class.AdminTask.php");
require_once("class.Login.php");
require_once(BASE_DIR . "classes/class.LogFile.php");

class User extends Model
{
	function isLoggedIn()
	{
		if(isset($_SESSION['loggedInUser']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function logIn($a_sUserName, $a_sPassword)
	{
		$sQuery = sprintf("SELECT user_username, user_password, id_user
						FROM users
						WHERE user_username = '%s'
						AND user_password = '%s'
						LIMIT 1",
						$this->oDB->escape($a_sUserName),
						sha1($this->oDB->escape($a_sPassword)));
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		
		//printArray($aRes);
		
		$oLogFile = new LogFile();
		
		if(isset($aRes[0]))
		{
			if($aRes[0]['user_username'] == $a_sUserName)
			{
				// username and password is correct
				$_SESSION['loggedInUser']['username'] = $a_sUserName;
				$_SESSION['loggedInUser']['id_user'] = $aRes[0]['id_user'];
				// insert into the login table
				$oLogin = new Login();
				$oLogin->insertLogin($aRes[0]['id_user']);
				$oLogFile->writeLogin(LOG_FILE_LOGIN, $a_sUserName);		
				return true;
			}
			else
			{
				$oLogFile->writeLogin(LOG_FILE_LOGIN_FAILED, $a_sUserName);		
				return false;
			}			
		}
		else
		{
			$oLogFile->writeLogin(LOG_FILE_LOGIN_FAILED, $a_sUserName);		
			return false;
		}
	}
	
	function loginWithoutPassword($a_sUserName)
	{
		$_SESSION['loggedInUser']["username"] = $a_sUserName;
	}
	
	function userNameCharsOk($a_sUserName)
	{
		if (preg_match("#^([a-zA-Z0-9]+)$#", $a_sUserName))
			return true;
		else
			return false;
	}
	
	function logOut()
	{
		if(isset($_SESSION['loggedInUser']))
		{
			unset($_SESSION['loggedInUser']);
			return true;
		}
		else
		{
			return false;
		}
	}

	// check if a username exists
	function userExists($a_sUserName)
	{
		$bRet = false;
		
		// get the users
		$aUserNames = $this->getAllUsers(null, "user_username");

		foreach($aUserNames as $val)
		{	
			// compare the names in lower-case
			if(strtolower($val["user_username"]) == strtolower($a_sUserName))
			{
				$bRet = true;
				break;
			}						
		}
		
		return $bRet;		
	}
	
	function insertUser($a_sUsername, $a_sPassword, $a_sFirstname, $a_sLastname, $a_sEmail, $a_bUberAdmin)
	{	
		$this->oDB->beginTransaction();
				
		$sQuery = sprintf("INSERT INTO users
						(user_username,user_password,user_firstname,user_lastname,user_email,user_date_added) 
						VALUES ('%s','%s','%s','%s','%s','%s')",
						$this->oDB->escape($a_sUsername),
						sha1($this->oDB->escape($a_sPassword)),
						$this->oDB->escape($a_sFirstname),
						$this->oDB->escape($a_sLastname),
						$this->oDB->escape($a_sEmail),
						date("Y-m-d H:i:s"));

		$this->oMDB2Wrapper->query("exec", $sQuery);
		
		$sQuery = "SELECT MAX(id_user) AS id_user FROM users";
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		$iLastID = $aRes[0]['id_user'];
		
		$this->oDB->commit();
		
		$oAdminTask = new AdminTask();
		$iIDScoreKeep = $oAdminTask->getScoreKeepID();
		
		// insert score-keep access for ALL users
		$sQuery = sprintf("INSERT INTO admin_tasks_to_users
						(admin_tasks_id_admin_task,users_id_user) 
						VALUES (%d,%d)",
						$this->oDB->escape($iIDScoreKeep),
						$this->oDB->escape($iLastID));

		$aRes = $this->oMDB2Wrapper->query("exec", $sQuery);
		
		// if uber-admin is selected, insert the uber-admin access
		if($a_bUberAdmin == "on")
		{
			$iIDUberAdmin = $oAdminTask->getUberAdminID();
			
			$sQuery = sprintf("INSERT INTO admin_tasks_to_users
							(admin_tasks_id_admin_task,users_id_user) 
							VALUES (%d,%d)",
							$this->oDB->escape($iIDUberAdmin),
							$this->oDB->escape($iLastID));
	
			$aRes = $this->oMDB2Wrapper->query("exec", $sQuery);
		}
	}
	
	function updateUser($a_iIDUser, $a_sUsername, $a_sFirstname, $a_sLastname, $a_sEmail, $a_bUberAdmin)
	{
		$sQuery = sprintf("UPDATE users
						SET user_username = '%s', user_firstname = '%s', user_lastname = '%s', user_email = '%s'
						WHERE id_user = %d",
						$this->oDB->escape($a_sUsername),
						$this->oDB->escape($a_sFirstname),
						$this->oDB->escape($a_sLastname),
						$this->oDB->escape($a_sEmail),
						$this->oDB->escape($a_iIDUser));
	
		$this->oMDB2Wrapper->query("exec", $sQuery);
		
		// delete all uber-admin tasks for this user
		$sQuery = sprintf("DELETE FROM admin_tasks_to_users
							WHERE admin_tasks_id_admin_task = '5'
							AND users_id_user = %d",
							$this->oDB->escape($a_iIDUser));
		$this->oMDB2Wrapper->query("exec", $sQuery);

		// if uber-admin is selected, insert ..well.. it
		if($a_bUberAdmin == "on")
		{
			$sQuery = sprintf("INSERT INTO admin_tasks_to_users
							(admin_tasks_id_admin_task,users_id_user) 
							VALUES (%d,%d)",
							$this->oDB->escape('5'),
							$this->oDB->escape($a_iIDUser));
	
			$this->oMDB2Wrapper->query("exec", $sQuery);
		}	
	}
	
	function deleteUser($a_iIDUser)
	{
		$oAdminTask = new AdminTask();
		$aAdminTasks = $oAdminTask->getAllAdminTasksForUser($a_iIDUser);

		// if "admin_uber" is in the array we can't delete the user
		if(in_array("admin_uber", $aAdminTasks, true))
		{
			return false;
		}
		else
		{
			$sQuery = sprintf("DELETE FROM users
								WHERE id_user = %d",
								$this->oDB->escape($a_iIDUser));

			$this->oMDB2Wrapper->query("exec", $sQuery);
			return true;			
		}
	
	}
	
	function updatePassword($a_iIDUser, $a_sPassword)
	{
		$sQuery = sprintf("UPDATE users
						SET user_password = '%s' 
						WHERE id_user = %d",
						sha1($this->oDB->escape($a_sPassword)),
						$this->oDB->escape($a_iIDUser));
		$this->oMDB2Wrapper->query("exec", $sQuery);	
	}
	
	function getLoggedInUsername()
	{
		if(isset($_SESSION['loggedInUser']))
		{
			return $_SESSION['loggedInUser']["username"];
		}
		else
		{
			return false;
		}
	}

	function getLoggedInUserID()
	{
		if(isset($_SESSION['loggedInUser']['id_user']))
			return $_SESSION['loggedInUser']['id_user'];
		else
			return null;				
	}

	
	function getUserDataFromName($a_sUserName, $a_sVal = null)
	{
		$sQuery = sprintf("SELECT * FROM users
							WHERE user_username = '%s'
							LIMIT 1",	
							$this->oDB->escape($a_sUserName));
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		
		if(isset($aRes[0]))
		{
			if($a_sVal != null)
				return $aRes[0][$a_sVal];
			else 
				return $aRes[0];
		}
		else
			return null;	
	}
	
	function getUserDataFromID($a_UserID)
	{
		// get the username
		$sQuery = sprintf("SELECT * FROM users
							WHERE id_user = %d
							LIMIT 1",	
							$this->oDB->escape($a_UserID));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $this->getUserDataFromName($aRes[0]['user_username']);	
	}

	function getAllUsers($a_sOrder = null, $a_sField = null)
	{
		switch ($a_sOrder) 
		{
			case "username":
	    		$sOrder = "users.user_username ASC";
				break;
			case "firstname":
	    		$sOrder = "users.user_firstname ASC";
				break;
			case "lastname":
	    		$sOrder = "users.user_lastname ASC";
				break;
			case "initials":
	    		$sOrder = "users.user_initials ASC";
				break;
			default:
	    		$sOrder = "users.user_username ASC";
		}
		
		if($a_sField != null)
		{
			$sColumns = $a_sField;
		}
		else
		{
			$sColumns = "*";
		}
		
		$sQuery = "SELECT users." . $sColumns . " 
					FROM users 
					ORDER BY " . $sOrder;
		
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		
		return $aRes;
	}

	/* ADMIN ROLES */
	
	/*
	function isUserAdmin()
	{
		if($this->isAdminDynamic("admin_users"))
			return true;
		else
			return false;			
	}
	
	function isEntryAdmin()
	{
		if($this->isAdminDynamic("admin_entry_edit"))
			return true;
		else
			return false;		
	}

	function isDivisionAdmin()
	{
		if($this->isAdminDynamic("admin_division_edit"))
			return true;
		else
			return false;		
	}	
	
	function isGameAdmin()
	{
		if($this->isAdminDynamic("admin_games_edit"))
			return true;
		else
			return false;		
	}	
	*/
	
	function isUberAdmin($a_iIDUser = null)
	{
		$iIDUser = null;
		if($a_iIDUser != null)
			$iIDUser = $a_iIDUser;
			
		if($this->isAdminDynamic("admin_uber", $iIDUser))
			return true;
		else
			return false;		
	}	

	function isScorekeepAdmin($a_iIDUser = null)
	{
		$iIDUser = null;
		if($a_iIDUser != null)
			$iIDUser = $a_iIDUser;

		if($this->isUberAdmin())
			return true;
						
		if($this->isAdminDynamic("admin_scorekeep", $iIDUser))
			return true;
		else
			return false;		
	}	
	
	function isAdminDynamic($a_sTaskString, $a_iIDUser = null)
	{
		if($a_iIDUser == null)			
			$iUserID = $this->getLoggedInUserID();
		else
			$iUserID = $a_iIDUser;
			
		$sQuery = sprintf("SELECT admin_tasks.*, admin_tasks_to_users.*
					FROM admin_tasks, admin_tasks_to_users
					WHERE admin_tasks.id_admin_task = admin_tasks_to_users.admin_tasks_id_admin_task
					AND admin_tasks_to_users.users_id_user = %d
					AND admin_tasks.admin_task_name = '%s'",
					$this->oDB->escape($iUserID),
					$this->oDB->escape($a_sTaskString));
		
		$aRes = $this->oMDB2Wrapper->query("query", $sQuery);		

		if($aRes->numRows() > 0)
		{
			return true;
		}
		else 
		{
			return false;
		}
	}

	function getAllAdminTasksForLoggedInUser()
	{
		$this->oAdminTask = new AdminTask();
		return $this->oAdminTask->getAllAdminTasksForLoggedInUser();
	}
}
?>