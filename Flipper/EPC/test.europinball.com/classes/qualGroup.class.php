<?php
  class qualGroup extends base {
    
    public $tournamenDivision_id;
    public $date;
    public $fullName;
    public $shortName;
    public $startTime;
    public $endTime;
    public $class = 'qualGroup';
    public $players = [];
    public $potentialPlayers = [];
    
    public function __construct($data = null, $type = 'array') {
      switch ($type) {
        case 'json':
          if ($data) {
            $this->set(json_decode($json, true));
          }
        break;
        case 'array':
          if ($data) {
            $this->set($data);
          }
        break;
      }
    }
    
    public function set($data) {
      foreach ($data as $key => $value) {
        $this->{$key} = $value;
      }
    }
    
    function addPlayers($dbh, $players) {
      if ($players) {
        foreach ($players as $player) {
          $this->addPlayer($dbh, $player);
        }
        return true;
      } else {
        return false;
      }
    }
    
    function addPlayer($dbh, $player, $prefered = false, $paid = false) {
      if ($player) {
        if ($prefered) {
          $query = '
            update playerQualGroups set prefered = 0 where player_id=(
              select pl.id from player pl
              where pl.person_id=:playerId
              and pl.tournamentDivision_id=:tournamentDivision_id
            )
          ';
          $update[':playerId'] = $player->id;
          $update[':tournamentDivision_id'] = $this->tournamentDivision_id;
          $sth = $dbh->prepare($query);
          $sth->execute($update);
        }
        $this->removePlayer($dbh, $player);
        $query = '
          insert into playerQualGroups set
            name=:name,
            qualGroup_id=:qualGroupId,
            prefered=:prefered,
            paid=:paid,
            player_id=(
              select pl.id from player pl
              where pl.person_id=:playerId
              and pl.tournamentDivision_id=:tournamentDivision_id
            )
        ';
        $insert[':name'] = 'Div '.$this->tournamentDivision_id.', '.$this->shortName.': '.$player->initials;
        $insert[':qualGroupId'] = $this->id;
        $insert[':playerId'] = $player->id;
        $insert[':prefered'] = ($prefered) ? 1 : 0;
        $insert[':paid'] = ($paid) ? 1 : 0;
        $insert[':tournamentDivision_id'] = $this->tournamentDivision_id;
        // echo $query;
        $sth = $dbh->prepare($query);
        $sth->execute($insert);
        $lastInsertId = $dbh->lastInsertId();
        return $lastInsertId;
      } else {
        return false;
      }
    }
    
    function removePlayers($dbh, $players = 'all') {
      if ($players == 'all') {
        $query = 'delete playerQualGroups from playerQualGroups where playerQualGroups.qualGroup_id=:qualGroupId';
        $delete[':qualGroupId'] = $this->id;
        $sth = $dbh->prepare($query);
        if ($sth->execute($delete)) {
          return true;
        }
      } else {
        foreach ($players as $player) {
          $this->removePlayer($dbh, $player);
        }
        return true;
      }
      return false;
    }

    function removePlayer($dbh, $player, $prefered = false) {
      if ($prefered) {
        return addPlayer($dbh, $player);
      } else {
        $query = '
          delete playerQualGroups from playerQualGroups
          left join player
            on playerQualGroups.player_id = player.id
          where playerQualGroups.qualGroup_id=:qualGroupId and player.person_id=:playerId
            and player.tournamentDivision_id=:tournamentDivision_id
        ';
        $delete[':qualGroupId'] = $this->id;
        $delete[':playerId'] = $player->id;
        $delete[':tournamentDivision_id'] = $this->tournamentDivision_id;
        $sth = $dbh->prepare($query);
        return $sth->execute($delete);
      }
    }

    function getPlayers($dbh) {
      $playerAlias = ($this->tournamentDivision_id == 1) ? 'm' : 'cl';
      $query = getPlayerSelect().' left join playerQualGroups pq on pq.player_id = '.$playerAlias.'.id where pq.team_id = '.$this->id;  
      if ($sth = $dbh->query($query)) {
        unset($this->potentialPlayers);
        while ($obj = $sth->fetchObject('player')) {
          $objs[] = $obj;
        }
        if ($objs) {
          $this->potentialPlayers = $objs;
          return $objs;
        }
      } 
      return false;
    }
    
    function getNoOfPlayers($dbh, $prefered = false) {
      $query = 'select count(id) from playerQualGroups pq where pq.qualGroup_id = '.$this->id;
      $query .= ($prefered) ? ' and pq.prefered = 1 ' : '';
      $sth = $dbh->prepare($query);
      $sth->execute();
      return $sth->fetchColumn();      
    }
    
  }
?>