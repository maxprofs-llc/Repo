<?php

class HTTPContext
{
	public function getString($a_sName)
	{
		if(isset($_POST[$a_sName]))
			return trim(strval($_POST[$a_sName]));
		else
		{
			if(isset($_GET[$a_sName]))
				return trim(strval($_GET[$a_sName]));		
			else
				return null;			
		}
	}

	public function getInt($a_sName)
	{
		if(isset($_POST[$a_sName]))
		{
			if($_POST[$a_sName] == null)
				return null;
			else
				return trim(intval($_POST[$a_sName]));
		}
		else
		{
			if(isset($_GET[$a_sName]))
			{
				if($_GET[$a_sName] == null)
					return null;
				else
					return trim(intval($_GET[$a_sName]));
			}		
			else
				return null;	
		}		
	}
	
	public function isPosted($a_sName)
	{
		if(isset($_POST[$a_sName]))
			return true;
		else
		{
			if(isset($_GET[$a_sName]))
				return true;
			else
				return false;			
		}
	}
	
	/*
	public function getPostString($a_sName)
	{
		if(isset($_POST[$a_sName]))
			return trim(strval($_POST[$a_sName]));
		else
			return null;
	}
	
	public function getPostInt($a_sName)
	{
		if(isset($_POST[$a_sName]))
			return trim(intval($_POST[$a_sName]));
		else
			return null;		
	}
	
	public function getGetString($a_sName)
	{
		if(isset($_GET[$a_sName]))
			return trim(strval($_GET[$a_sName]));		
		else
			return null;		
	}
	
	public function getGetInt($a_sName)
	{
		if(isset($_GET[$a_sName]))
			return trim(intval($_GET[$a_sName]));		
		else
			return null;		
	}
	*/
	
	public function getCookieString($a_sName)
	{
		if(isset($_COOKIE[$a_sName]))
			return trim(strval($_COOKIE[$a_sName]));		
		else
			return null;		
	}
	
	public function getIntArray($a_sName)
	{
		$aRet = array();		
		$aArray = $this->getInt($a_sName);
		
		if(is_array($aArray))
		{
			foreach($aArray as $val)
			{
				array_push($aRet, trim($val));
			}
		}
		
		return $aRet;
	}

	public function getStringArray($a_sName)
	{
		echo $this->getString($a_sName);
	}
	
//	public function getPostArray($a_sName)
//	{
//		echo $_POST[$a_sName];
//	}

	public function getMultiple($a_sName)
	{
		$aRet = array();				

		if(isset($_POST[$a_sName]))
		{

			if($this->isHiddenMultiple($a_sName))
			{
				$aRet = $this->formatHiddenMultiple($a_sName);
			}
			else
			{
				foreach($_POST[$a_sName] as $post)
				{
					array_push($aRet, trim($post));
				}
			}
			
			return $aRet;
		}
		else
		{
			if(isset($_GET[$a_sName]))
			{
				if($this->isHiddenMultiple($a_sName))
				{
					$aRet = $this->formatHiddenMultiple($a_sName);
				}
				else
				{
					foreach($_GET[$a_sName] as $post)
					{
						array_push($aRet, trim($post));
					}
				}
			
				return $aRet;
			}
			else
				return null;	
		}		
	}

	public function isHiddenMultiple($a_sName)
	{
		$sSearch = "multiple";
		if($this->isPosted($a_sName))
		{
			$sPost = $this->getString($a_sName);			
			if(preg_match("/" . $sSearch . "/i", $sPost))
				return true;
			else
				return false;
		}
	}
	
	public function formatHiddenMultiple($a_sName)
	{
		$sPost = $this->getString($a_sName);
		$aSplit = preg_split('/,/', $sPost);
		$aRet = array();
		$i = 0;
		foreach($aSplit as $value)
		{
			if($i > 0)
				array_push($aRet, $value);
			$i++;
		}
		return $aRet;
	}

	
	function stripSlashes($a_sString)
	{
		return stripcslashes($a_sString);
	}
	
	function getArbitraryNumberOfPosts($a_iNoOfPosts, $a_sPrefix, $a_sVarType, $a_iStart = NULL)
	{
		$aReturn = array();

		// if we don't want to start from 0
		if($a_iStart != NULL)
			$iStart = $a_iStart;
		else
			$iStart = 0;
			
		for($i = $iStart; $i < $a_iNoOfPosts; $i++)
		{
			if($a_sVarType == "string")
			{
				$sPost = $a_sPrefix.$i;
				$sVal = $this->getString($sPost);
			}
			
			if($a_sVarType == "int")
			{
				$sPost = $a_sPrefix.$i;
				$sVal = $this->getInt($sPost);
			}
			array_push($aReturn, $sVal);
		}
		
		return $aReturn;
	}
}
?>