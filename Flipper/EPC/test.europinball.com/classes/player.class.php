<?php
  
  class player extends base {
    
    public $firstName;
    public $lastName;
    public $username;
    public $password;
    public $passwordRequired;
    public $initials;
    public $isIfpa;
    public $ifpa_id;
    public $ifpaRank;
    public $isPerson;
    public $isPlayer;
    public $player_ids = [];
    public $gender_id;
    public $gender;
    public $hours;
    public $type;
    public $streetAddress;
    public $zipCode;
    public $telephoneNumber;
    public $mobileNumber;
    public $mailAddress;
    public $tournamentDivision;
    public $tournamentDivision_id;
    public $tournamentEdition;
    public $tournamentEdition_id;
    public $city_id;
    public $city;
    public $region_id;
    public $region;
    public $country_id;
    public $country;
    public $continent_id;
    public $continent;
    public $dateRegistered;
    public $birthDate;
    public $classics;
    public $main;
    public $classicsPlayerId;
    public $mainPlayerId;
    public $volunteer;
    public $volunteer_id;
    public $qualGroups = [];
    public $qualGroup;
    public $class = 'player';
    public $paid;
    
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
      $this->name = $this->firstName.' '.$this->lastName;
    }
    
    public function set($data) {
      foreach ($data as $key => $value) {
        $this->{$key} = $value;
      }
    }

    public function populate($dbh) {
      locate($dbh, $this, 'city');
    }
    
    function isMemberOfTeam($dbh, $tournament = 3) {    
      if (getTeamByPlayerId($dbh, $this->id, $tournament)) {
        return true;
      } else {
        return false;
      }
    }
  
    function getTeam($dbh, $tournament = 3) {
      $query = '
        select 
          tm.id as id,
          tm.name as name,
          "team" as class,
          tm.initials as initials,
          tm.contactPlayer_id as contactPlayer_id,
          tm.contactPlayer_name as contactPlayer_name,
          tm.country as country,
          tm.country_id as country_id,
          td.name as tournamentDivision,
          td.id as tournamentDivision_id,
          te.name as tournamentEdition,
          te.id as tournamentEdition_id
        from team tm
          left join teamPlayer tp on tp.team_id = tm.id
          left join player pl on tp.player_id = pl.id
          left join tournamentDivision td on tm.tournamentDivision_id = td.id
          left join tournamentEdition te on td.tournamentEdition_id = te.id
        where td.id = '.$tournament.' and pl.person_id = '.$this->id;
      $sth = $dbh->query($query);
      while ($obj = $sth->fetchObject('team')) {
        return $obj;
      }
      return false;
    }
    
    function getTshirts($dbh, $tournament = 1) {
      $query = '
        select 
          pt.id as id,
          ts.name as name,
          "tshirt" as class,
          pt.number as number,
          pt.number as number_id,
          pt.person_id as player_id,
          pt.id as playerTshirt_id,
          tc.name as color,
          tc.id as color_id,
          tz.name as size,
          tz.id as size_id,
          tt.id as tournamentTshirt_id,
          te.name as tournamentEdition,
          te.id as tournamentEdition_id
        from personTShirt pt
          left join tournamentTShirt tt on pt.tournamentTShirt_id = tt.id
          left join tshirt ts on tt.tshirt_id = ts.id
          left join tournamentEdition te on tt.tournamentEdition_id = te.id
          left join color tc on ts.color_id = tc.id
          left join size tz on ts.size_id = tz.id
        where (te.id = '.$tournament.' or te.id is null) and pt.person_id = '.$this->id;
      $sth = $dbh->query($query);
      while ($obj = $sth->fetchObject('tshirt')) {
        $objs[] = $obj;
      }
      return $objs;
    }
    
    function getNoOfTshirts($dbh, $tournament = 1) {
      $tShirts = $this->getTshirts($dbh, $tournament);
      $noOfTshirts = 0;
      if ($tShirts) {
        foreach($tShirts as $tShirt) {
          $noOfTshirts += $tShirt->number;
        }
      }
      return $noOfTshirts;
    }
  
    function getQualGroups($dbh, $tournament = 1, $prefered = false) {
      $query = getQualGroupSelect().'
        left join playerQualGroups pq
          on pq.qualGroup_id=q.id
        left join player pl
          on pq.player_id=pl.id
        left join tournamentDivision td
          on q.tournamentDivision_id = td.id
        where (td.tournamentEdition_id = '.$tournament.' or td.tournamentEdition_id is null)
          and pl.person_id='.$this->id.(($prefered) ? ' and pq.prefered = 1' : '').'
        order by q.date
      ';
      $sth = $dbh->query($query);
      while ($obj = $sth->fetchObject('qualGroup')) {
        $objs[] = $obj;
      }
      return $objs;
    }
    
    function getPreferedQualGroup($dbh, $tournament) {
      return $this->getQualGroups($dbh, $tournament, true);
    }
  
    function addVolunteer($dbh, $tournament, $method = 'insert into') {
      $query = addPlayerQuery($dbh, $this, 'volunteer', $tournament, $method);
      if ($method == 'update') {
        $query[0] .= ' where person_id = :pId';
        $query[1][':pId'] = $this->id;
      }
      $sth = $dbh->prepare($query[0]);
      if ($sth->execute($query[1])) {
        return $dbh->lastInsertId();
      } else {
        return false;
      }
    }
  
    function getVolunteer($dbh) {
      $query = '
        select 
          id as volunteer_id,
          coalesce(v.hours, 0) as hours
        from volunteer v
        where v.person_id = '.$this->id;  
      $sth = $dbh->query($query);
      if ($obj = $sth->fetchObject()) {
        $this->hours = $obj->hours;
        $this->volunteer_id = $obj->volunteer_id;
        return $this;
      } else {
        return false;
      }
    }
    
    function getCosts($dbh, $type = 'all', $currency = 'SEK') {      
      $currencies = array('SEK' => 1, 'EUR' => 9, 'GBP' => 10, 'USD' => 6);
      $items = array('main' => 300, 'classics' => 200, 'team' => 100, 'tShirt' => 100);
      foreach ($items as $item => $price) {
        $cost[$item]['price'] = $price;
        switch ($type) {
          case 'main':
            $output[$item]['num'] = ($this->mainPlayerId > 0) ? 1 : 0;
          break;
          case 'classics':
            $output[$item]['num'] = ($this->classicsPlayerId > 0) ? 1 : 0;
          break;
          case 'team':
            $team = $this->getTeam($dbh);
            $output[$item]['num'] = ($team) ? count($team) : 0;
          break;
          case 'tShirt':
            $output[$item]['num'] = $this->getNoOfTshirts($dbh);
          break;
        }
        foreach($currencies as $cur => $rate) {
          $output[$item][$cur] = round($output[$item]['num'] * $price / $rate);
        }
      }
    }
    
    function setNonce($dbh, $nonce) {
      $update[':id'] = $this->mainPlayerId;
      $update[':nonce'] = $nonce;
      $query = 'update player set nonce = :nonce where id = :id';
      $sth = $dbh->prepare($query);
      return ($sth->execute($update)) ? true : false;
    }
  
  }
?>
