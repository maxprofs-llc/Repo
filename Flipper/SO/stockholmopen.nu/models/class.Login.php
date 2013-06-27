<?php
require_once(BASE_DIR . "classes/class.IP.php");
require_once("class.Model.php");

class Login extends Model
{
	function insertLogin($a_iIDUser)
	{
		$oIP = new IP();
		$sIP = $oIP->getUserIP();
		
		$sQuery = sprintf("INSERT INTO logins
							(users_id_user, login_date, login_ip)
							VALUES (%d, '%s', '%s')",
							$this->oDB->escape($a_iIDUser),
							date("Y-m-d H:i:s"),	
							$this->oDB->escape($sIP));
		
		$this->oMDB2Wrapper->query("exec", $sQuery);
	}	
}
?>