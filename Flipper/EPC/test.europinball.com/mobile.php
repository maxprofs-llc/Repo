<?php
  require_once('functions/general.php');

  class HTTPContext
  {
    public function getString($name) 
    {
      if(isset($_POST[$name]))
        return trim(strval($_POST[$name]));
      if(isset($_GET[$name]))
        return trim(strval($_GET[$name]));    
      return null;      
    }

    public function getInt($name) 
    {
      if(isset($_POST[$name]))
        return trim(intval($_POST[$name]));
      if(isset($_GET[$name]))
        return trim(intval($_GET[$name]));    
      return null;      
    }
  }

  class Player
  {
    public function getPlayer($player)
    {
      $a = array("player_year_entered" => "2013");
      return $a;
    }
    public function getPlayers($year)
    {
      echo "dbhost: " . $dbhost;
      if (false)
      {
      $split = null;
      $order = "ORDER BY player_date_registered DESC";
      $query = sprintf("SELECT players.*, countries.*
                FROM players
                JOIN countries
                ON players.countries_id_country = countries.id_country
                WHERE players.player_year_entered= %d
                " . $split . "
                %s",
                $year,
                $order);
      $sth = $dbh->query($query);
      while ($obj = $sth->fetchObject()) {
        $objs[] = $obj;
      }
      return $objs;    
      }
      else
      {
        $split = null;
        $order = "ORDER BY player_date_registered DESC";
        $query = sprintf("SELECT players.*, countries.*
                  FROM players
                  JOIN countries
                  ON players.countries_id_country = countries.id_country
                  WHERE players.player_year_entered= %d
                  " . $split . "
                  %s",
                  $year,
                  $order);
        $objs = getObjects($dbh, "players", $query);
      }
    }
  }

  class User
  {
    public function login($userName, $passWord)
    {
      return true;
    }
  }

  class Entry
  {
    public function getAllEntriesForPlayer($player)
    {
      $a = array();
      return $a;
    }

    public function getEntryRounds($idEntry = null, $idYear = null)
    {
      $a = array();
      return $a;
    }
    public function isValidEntryID($idEntry)
    {
      return true;
    }
    public function getEntryData($idEntry)
    {
      $a = array("divisions_id_division" => "1", );
      return $a;
    }
    
    public function getPlayerIDForEntry($a_iEntryID)
    {
      return "4321";
    }
    
    public function getEntryRound($a_iIDEntry, $a_iIDGame)
    {
      return "";
    }

    public function voidEntry($a_iIDEntry, $a_bVoid = false)
    {

    }

    public function updateEntryRound($a_iIDEntryRound, $a_iScore)
    {

    }
  }

  class Game
  {
    public function getAllGamesByYearAndDivision($idYear, $idDivision)
    {
      return "Getaway";
    }
  }

  class Division
  {
    public function getDivision()
    {
      $a = array("division_name_short" => "classic");
      return 1;
    }
  }

  class ArrayHelper
  {
    public function assocToOrderedByKey($a_aArr, $a_sKey)
    {
      $aRet = array();
      foreach($a_aArr as $value)
      {
        array_push($aRet,$value[$a_sKey]);
      }
      return $aRet;
    } 
  }

  class String
  {
    public function stripNonNumericChars($str)
    {
      $aAllowed = array("1","2","3","4","5","6","7","8","9","0");
      $iStrLength = strlen($str);
      $sRet = null;
      for($i = 0; $i < $iStrLength; $i++)
      {
        $cChar = substr($str, $i, 1);
        if(in_array($cChar, $aAllowed))
          $sRet .= $cChar;
      }
      return $sRet;
    }
  }

  class Validator
  {
      public function validValues($a_aValidValues, $a_mValue)
      {
        if(is_array($a_aValidValues))
        {
          if(in_array($a_mValue, $a_aValidValues))
            return true;
          else
            return false;
        }
        else
          return false;
      }
  
      public function validValuesInArray($a_aValidValues, $a_aValue)
      {
        foreach($a_aValue as $val)
        {
          if(!$this->validValues($a_aValidValues, $val))
            return false;
        }
        
        return true;
      }
  
      public function uniqueValuesInArray($a_aArr)
      {
        $aChecked = array();    
        foreach($a_aArr as $val)
        {
          if(in_array($val, $aChecked))
            return false;
          array_push($aChecked, $val);      
        }
        
        return true;
      }

      function positiveInt($inData)
      {
        if($inData == null)
          return false;
        
        if($inData == 0)
          return false; 
          
        if(preg_match('/^[0-9]+$/', $inData))
          return true;
        else
          return false;
      }
  }

?>
