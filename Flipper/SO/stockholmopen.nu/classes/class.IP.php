<?php
class IP
{
	public function getUserIP()
	{
		$ip = getenv("REMOTE_ADDR");
		if($ip == null)
			$ip = getenv("HTTP_CLIENT_IP");
			
		return $ip;
	}
}
?>