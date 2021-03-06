<?php
  
  class entry extends base {
    
    public $person_id;
    public $player_id;
    public $team_id;
    public $tournamentDivision_id;
    public $tournamentEdition_id;
    public $player;
    public $team;
    public $firstName;
    public $lastName;
    public $initials;
    public $city_id;
    public $city;
    public $country_id;
    public $country;
    public $place;
    public $points;
    public $maxScore;
    public $maxPoints;
    public $bestPlace;
    public $round;
    public $class = 'entry';
    
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

    function getQualScores($dbh) {
      return getScores($dbh);
    }

    function getScores($dbh, $groupBy = 'group by qs.machine_id', $orderBy = 'order by max(qs.points) desc, min(qs.place) asc') {
      $query = getScoreSelect(($groupBy) ? true : false).'
        where qs.qualEntry_id = '.$this->id;
      $query .= ' '.$groupBy.' '.$orderBy;
      $sth = $dbh->query($query);
      while ($obj = $sth->fetchObject('score')) {
        $objs[] = $obj;
      }
      return $objs;
    }

    function getBestScore($dbh, $game) {
      $query = getScoreSelect(false).'
        where qs.qualEntry_id = '.$this->id.'
        and qs.machine_id = '.$game->machine_id.'
        order by score desc
        limit 1
      ';
      $sth = $dbh->query($query);
      while ($obj = $sth->fetchObject('score')) {
        return $obj;
      }
      return false;
    }

    function checkAlone($dbh) {
      $player = getPlayerById($dbh, $this->person_id);
      $query = '
        select count(*) from qualScore q 
        left join player pl on
        q.player_id = pl.id 
        where q.round = '.$this->round.'
          and q.machine_id = '.$this->machineId.'
          and pl.qualGroup_id = '.(($this->tournamentDivision_id == 1) ? $player->mainQualGroup_id : $player->classicsQualGroup_id).'
          and pl.person_id != '.$this->person_id;
      $sth = $dbh->query($query);
      if ($sth->fetchColumn() > 0) {
        return false;
      } else {
        return true;
      }      
    }
    
    function calcPoints($dbh, $set = true) {
      $scores = $this->getScores($dbh);
      foreach ($scores as $score) {
        $points += $score->points;
      }
      if ($set) {
        if (!$this->setPoints($dbh, $points)) {
          return false;
        }
      }
      return $points;
    }

    function setPoints($dbh, $points = null) {
      $this->points = ($points) ? $points : null;
      $query = '
        update qualEntry set
          points = :points
        where id = :id
      ';
      $update[':points'] = ($points) ? $points : null;
      $update[':id'] = $this->id;
      $sth = $dbh->prepare($query);
      return ($sth->execute($update)) ? true : false;
    }

    function setPlace($dbh, $place = null) {
      $this->place = ($place) ? $place : null;
      $query = '
        update qualEntry set
          place = :place
        where id = :id
      ';
      $update[':place'] = ($place) ? $place : null;
      $update[':id'] = $this->id;
      $sth = $dbh->prepare($query);
      return ($sth->execute($update)) ? true : false;
    }

    function setPlayer($dbh, $player = null, $scores = true) {
      if ($this->tournamentDivision_id == 3) {
        return $this->setTeam($dbh, $player);
      } else {
        $this->player_id = ($player) ? (($player->classicsPlayerId) ? $player->classicsPlayerId : $player->mainPlayerId) : null;
        $this->player = ($player) ? $player->name : null;
        $this->person_id = ($player) ? $player->id : null;
        $this->firstName = ($player) ? $player->firstName : null;
        $this->lastName = ($player) ? $player->lastName : null;
        $this->initials = ($player) ? $player->initials : null;
        $this->country_id = ($player) ? $player->country_id : null;
        $this->country = ($player) ? $player->country : null;
        $this->city_id = ($player) ? $player->city_id : null;
        $this->city = ($player) ? $player->city : null;
        $this->name = ($player) ? $player->name.', '.(($player->classicsPlayerId) ? 'Classics' : 'Main').', 2013' : null;
        $query = '
          update qualEntry set
            name = :name,
            player_id = :playerId,
            person_id = :personId,
            firstName = :firstName,
            lastName = :lastName,
            initials = :initials,
            country_id = :countryId,
            country = :country,
            city_id = :cityId,
            city = :city
          where id = :id
        ';
        $update[':name'] = $this->name;
        $update[':playerId'] = $this->player_id;
        $update[':personId'] = $this->person_id;
        $update[':firstName'] = $this->firstName;
        $update[':lastName'] = $this->lastName;
        $update[':initials'] = $this->initials;
        $update[':countryId'] = $this->country_id;
        $update[':country'] = $this->country;
        $update[':cityId'] = $this->city_id;
        $update[':city'] = $this->city;
        $update[':id'] = $this->id;
        if ($scores) {
          $qualScores = $this->getScores($dbh, false, false);
          foreach ($qualScores as $qualScore) {
            $qualScore->setPlayer($dbh, $player, false);
          }
        }
        $sth = $dbh->prepare($query);
        return ($sth->execute($update)) ? true : false;
      }
    }
    
    function setTeam($dbh, $team = null, $scores = true) {
      if ($this->tournamentDivision_id != 3) {
        return $this->setPlayer($dbh, $team);
      } else {
        $this->team_id = ($team) ? $team->id : null;
        $this->team = ($team) ? $team->name : null;
        $this->initials = ($team) ? $team->initials : null;
        $this->country_id = ($team) ? $team->country_id : null;
        $this->country = ($team) ? $team->country : null;
        $this->city_id = ($team) ? $team->city_id : null;
        $this->city = ($team) ? $team->city : null;
        $this->name = ($team) ? $team->name.', Team, 2013' : null;
        $query = '
          update qualEntry set
            name = :name,
            player_id = :playerId,
            firstName = :firstName,
            initials = :initials,
            country_id = :countryId,
            country = :country,
            city_id = :cityId,
            city = :city
          where id = :id
        ';
        $update[':name'] = $this->name;
        $update[':playerId'] = $this->team_id;
        $update[':firstName'] = $this->team;
        $update[':initials'] = $this->initials;
        $update[':countryId'] = $this->country_id;
        $update[':country'] = $this->country;
        $update[':cityId'] = $this->city_id;
        $update[':city'] = $this->city;
        $update[':id'] = $this->id;
        if ($scores) {
          $qualScores = $this->getScores($dbh, false, false);
          foreach ($qualScores as $qualScore) {
            $qualScore->setTeam($dbh, $team, false);
          }
        }
        $sth = $dbh->prepare($query);
        return ($sth->execute($update)) ? true : false;
      }
    }
    
    function checkForDuplicates($dbh) {
      $scores = $this->getScores($dbh);
      foreach ($scores as $score) {
        $machineIds[$score->machine_id]++;
        if ($machineIds[$score->machine_id] > 1) {
          return $score;
        }
      }
      return false;
    }
    
    function createScore($dbh, $game = null, $score = null, $round = null, $order = null, $ulogin) {
      $currentPlayer = getCurrentPlayer($dbh, $ulogin);
      $query = '
        insert into qualScore set
          name = :name,
          qualEntry_id = :qualEntryId,
          machine_id = :machineId,
          game_id = :gameId,
          game = :game,
          gameAcronym = :gameAcronym,
          score = :score,
          `round` = :round,
          `order` = :order,
          player_id = :playerId,
          person_id = :personId,
          firstName = :firstName,
          lastName = :lastName,
          initials = :initials,
          tournamentDivision_id = :division,
          tournamentEdition_id = :tournament,
          country_id = :countryId,
          country = :country,
          city_id = :cityId,
          registerPerson_id = :registrator,
          city = :city
      ';
      $insert[':name'] = (($this->tournamentDivision_id == 1) ? 'Main' : (($this->tournamentDivision_id == 2) ? 'Classics' : 'Team')).' 2013: '.(($this->tournamentDivision_id == 3) ? $this->team : $this->firstName.' '.$this->lastName).(($game) ? ' on '.$game->name : '');
      $insert[':qualEntryId'] = $this->id;
      $insert[':machineId'] = ($game) ? $game->machine_id : null;
      $insert[':gameId'] = ($game) ? (($game->id == $game->machine_id) ? $game->game_id : $game->id) : null;
      $insert[':game'] = ($game) ? $game->name : null;
      $insert[':gameAcronym'] = ($game) ? $game->acronym : null;
      $insert[':score'] = $score;
      $insert[':round'] = $round;
      $insert[':order'] = $order;
      $insert[':playerId'] = ($this->tournamentDivision_id == 3) ? $this->team_id : $this->player_id;
      $insert[':personId'] = ($this->tournamentDivision_id == 3) ? null : $this->person_id;
      $insert[':firstName'] = ($this->tournamentDivision_id == 3) ? $this->team : $this->firstName;
      $insert[':lastName'] = ($this->tournamentDivision_id == 3) ? null : $this->lastName;
      $insert[':initials'] = $this->initials;
      $insert[':countryId'] = $this->country_id;
      $insert[':country'] = $this->country;
      $insert[':cityId'] = $this->city_id;
      $insert[':city'] = $this->city;
      $insert[':division'] = $this->tournamentDivision_id;
      $insert[':tournament'] = $this->tournamentEdition_id;
      $insert[':registrator'] = ($currentPlayer) ? $currentPlayer->id : null;
      $sth = $dbh->prepare($query);
      if ($sth->execute($insert)) {
        return $dbh->lastInsertId();
      } else {
        return false;
      }
    }

    function delete($dbh, $scores = true) {
      $delete[':id'] = $this->id;
      $query = 'delete from qualEntry where id = :id';
      $sth = $dbh->prepare($query);
      $qualScores = $this->getScores($dbh, false, false);
      if ($scores && $qualScores) {
        foreach($qualScores as $qualScore) {
          $qualScore->delete($dbh);
        }
      }
      return $sth->execute($delete);
    }

  }
?>