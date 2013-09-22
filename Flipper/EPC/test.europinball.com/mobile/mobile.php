<?php
  require_once('../functions/general.php');
  require_once("phpqrcode/phpqrcode.php");

  class DataMapper 
  {
    public static $db;
    public static function init($dbh)
    {
      self::$db = $dbh;
    }
  }

  DataMapper::Init($dbh);

  class LoginMapper
  {
    public static $ulogin;
    public static function init($ulogin)
    {
      self::$ulogin = $ulogin;
    }
  }

  LoginMapper::Init($ulogin);

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
    public function getPlayer($id)
    {
      return getPlayerById(DataMapper::$db, $id);
    }
  }

  class User
  {
    public function logIn($userName, $passWord)
    {
      $result = false;
      $adminLevel = getPlayerAdminLevel(DataMapper::$db, $userName);
      if ($adminLevel > 0)
      {
        LoginMapper::$ulogin->Authenticate($userName, $passWord);
        $result = LoginMapper::$ulogin->IsAuthSuccess();
      }
      return $result;
    }
  }

  class Entry
  {
    private $entry = null;

    public function fromPlayerAndDivision($idPlayer, $idDivision)
    {
      return getEntry(DataMapper::$db, $idPlayer, $idDivision);
    }

    public function getScores($idEntry, $idMachine)
    {
      // return value
      $scores = array();
      $where = 'where qualEntry_id = ' . $idEntry . ' and machine_id = ' . $idMachine;
      $s = getScores(DataMapper::$db, $where);
      if ($s != false)
      {
        foreach ($s as $score)
        {
          $scores[] = $score;
        }
        return $scores;
      }
      return false;
    }

    public function isValidEntryID($idEntry)
    {
      $result = true;
      if ($idEntry == null || $idEntry == '' || $idEntry == false){
        $result = false;
      } else {
        if (getEntryById(DataMapper::$db, $idEntry) == false){
          $result = false;
        }
      }
      return $result;
    }

    public function updateScore($idScore, $iScore)
    {
      updateScore(DataMapper::$db, $idScore, $iScore);
    }
  }

  class Game
  {
    public function getDivision($idGame)
    {
      $m = getMachineById(DataMapper::$db, $idGame);
      return $m->tournamentDivision_id;
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

  class PlayerLabel
  {
    private $tag;
    private $fname;
    private $lname;
    private $country;
    private $publicImg = "https://test.europinball.org/images/objects/mobile/playerimg.png";
    private $playerImg = "/www/test.europinball.com/images/objects/mobile/playerimg.png";
    public function FromPlayer($playerId)
    {
      $oPlayer = new Player();

      $aPlayer = $oPlayer->getPlayer($playerId);
      if ($aPlayer != false)
      {
        $this->tag  = $aPlayer->initials;
        $this->fname = $aPlayer->firstName;
        $this->lname = $aPlayer->lastName;
        $this->country = $aPlayer->country;
      }
      $qrText = "pid=" . $playerId . "&tag=" .  $this->tag;
      QRcode::png($qrText, $this->playerImg, 0, 6, 0);
    }
    public function initials()
    {
      return $this->tag;
    }
    public function firstName()
    {
      return $this->fname;
    }
    public function lastName()
    {
      return $this->lname;
    }
    public function country()
    {
      return $this->country;
    }
    public function image()
    {
      return $this->publicImg;
    }
  }

  class GameLabel
  {
    private $name;
    private $publicImg = "https://test.europinball.org/images/objects/mobile/gameimg.png";
    private $gameImg = "/www/test.europinball.com/images/objects/mobile/gameimg.png";
    public function FromGame($gameId)
    {
      $aGame = getMachineById(DataMapper::$db, $gameId);

      if ($aGame != false)
      {
        $this->name  = $aGame->name;
      }

      $qrText = "gid=" . $gameId . "&game=" .  $this->name;
      QRcode::png($qrText, $this->gameImg, 0, 4, 1);
    }
    public function name()
    {
      return $this->name;
    }
    public function image()
    {
      return $this->publicImg;
    }
  }

  class Validator
  {
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
