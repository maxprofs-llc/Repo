<?php
require_once("class.Model.php");
require_once("class.User.php");

class News extends Model
{
	public function insertNews($a_sText)
	{	
		$oUser = new User();
		
		$sQuery = sprintf("INSERT INTO news
						(users_id_user, news_text, news_date) 
						VALUES (%d,'%s','%s')",
						$this->oDB->escape($oUser->getLoggedInUserID()),
						$this->oDB->escape($a_sText),
						date("Y-m-d H:i:s"));
		$this->oMDB2Wrapper->query("exec", $sQuery);
	}
	
	public function updateNews($a_iIDNews, $a_sText)
	{
		$sQuery = sprintf("UPDATE news
						SET news_text = '%s' 
						WHERE id_news = %d
						LIMIT 1",
						$this->oDB->escape($a_sText),
						$this->oDB->escape($a_iIDNews));
		$this->oMDB2Wrapper->query("exec", $sQuery);	
	}
	
	public function deleteNews($a_iIDNews)
	{
		$sQuery = sprintf("DELETE FROM news
						WHERE id_news = %d
						LIMIT 1",
						$this->oDB->escape($a_iIDNews));		
		$this->oMDB2Wrapper->query("exec", $sQuery);	
	}
	
	public function getNews($a_iLimit = null, $a_iStart = null)
	{
		$sLimit = null;
		if($a_iLimit != null)
			$sLimit = "LIMIT " . $a_iLimit;
			
		if($a_iLimit != null && $a_iStart != null)
			$sLimit = "LIMIT " . $a_iStart . ", " . $a_iLimit;
			
		$sQuery = sprintf("SELECT news.*, users.*
							FROM news
							JOIN users
							ON news.users_id_user = users.id_user
							ORDER BY news_date DESC %s",
							$this->oDB->escape($sLimit));			

		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);		
		return $aRes;	
	}

	public function getNumberOfNews()
	{
		$sQuery = "SELECT COUNT(*) as count FROM news";
		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);		
		return $aRes[0]['count'];		
	}
	
	public function getNewsFromID($a_IDNews)
	{
		$sQuery = sprintf("SELECT *
							FROM news
							WHERE id_news=%d
							LIMIT 1",
							$this->oDB->escape($a_IDNews));			

		$aRes = $this->oMDB2Wrapper->query("queryAll", $sQuery);
		return $aRes[0];		
	}
	
}
?>