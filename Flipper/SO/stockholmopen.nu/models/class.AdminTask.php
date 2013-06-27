<?php
require_once("class.Model.php");
require_once("class.User.php");

class AdminTask extends Model
{
	public function getAllAdminTasksForLoggedInUser()
	{
		$oUser = new User();
		$sQuery = sprintf("SELECT admin_tasks.*, admin_tasks_to_users.*
							FROM admin_tasks
							JOIN admin_tasks_to_users
							ON admin_tasks.id_admin_task = admin_tasks_to_users.admin_tasks_id_admin_task
							WHERE admin_tasks_to_users.users_id_user = %d",
							$this->oDB->escape($oUser->getLoggedInUserID()));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		
		$aRet = array();
		foreach ($aRes as $adminTask)
		{
			$aRet[$adminTask["admin_task_name"]] = true;
		}
		
		return $aRet;	
	}
	
	public function getAllAdminTasksForUser($iIDUser)
	{
		$sQuery = sprintf("SELECT admin_tasks.*, admin_tasks_to_users.*
							FROM admin_tasks
							JOIN admin_tasks_to_users
							ON admin_tasks.id_admin_task = admin_tasks_to_users.admin_tasks_id_admin_task
							WHERE admin_tasks_to_users.users_id_user = %d",
							$this->oDB->escape($iIDUser));
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		
		$aRet = array();
		foreach ($aRes as $adminTask)
		{
			$aRet[$adminTask["admin_task_name"]] = true;
		}
		
		return $aRet;	
	}
	
	public function getUberAdminID()
	{
		$sQuery = "SELECT id_admin_task
					FROM admin_tasks
					WHERE admin_task_name = 'admin_uber'";
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		
		
		return $aRes[0]['id_admin_task'];		
	}
	
	public function getScoreKeepID()
	{
		$sQuery = "SELECT id_admin_task
					FROM admin_tasks
					WHERE admin_task_name = 'admin_scorekeep'";
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		
		
		return $aRes[0]['id_admin_task'];		
	}	

}
?>