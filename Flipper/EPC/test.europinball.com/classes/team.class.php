<?php

  class team extends player {
        
    public static $instances;
    public static $arrClass = 'teams';

    public static $select = '
      select 
        o.id as id,
        o.name as name,
        o.name as fullName,
        o.initials as shortName,
        o.national as national,
        o.contactPlayer_id as contactPlayer_id,
        o.city_id as city_id,
        o.region_id as region_id,
        o.parentRegion_id as parentRegion_id,
        o.country_id as country_id,
        o.parentCountry_id as parentCountry_id,
        o.continent_id as continent_id,
        o.tournamentDivision_id as tournamentDivision_id,
        o.tournamentEdition_id as tournamentEdition_id,
        o.dateRegistered as dateRegistered,
        o.registerPerson_id as registerPerson_id,
        o.comment as comment
      from team o
    ';
    
    public static $parents = array(
      'contactPlayer' => 'player',
      'registerPerson_id' => 'person',
      'tournamentEdition' => 'tournament',
      'tournamentDivision' => 'division',
      'city' => 'city',
      'region' => 'region',
      'parentRegion' => 'region',
      'country' => 'country',
      'parentCountry' => 'country',
      'continent' => 'continent'
    );

    public static $children = array(
      'player' => array(
        'field' => 'team',
        'delete' => TRUE
      ),
      'teamPlayer' => array(
        'table' => 'teamPlayer',
        'field' => 'player',
        'delete' => TRUE
      )
    );
    
    public function __construct($data = NULL, $search = config::NOSEARCH, $depth = NULL) {
      $persons = array('current', 'active', 'login', 'auth');
      $divisions = array_merge(array('current', 'active'), config::$divisions);
      if (is_string($data) && in_array($data, $persons)) {
        $person = person($data);
        if (!$person || !isId($person->id)) {
          $this->failed = TRUE;
          return FALSE;
        }
      } else if ((isObj($data) && get_class($data) == 'tournament') || (is_string($data) && in_array($data, $divisions))) {
        $division = division($data, (($search !== config::NOSEARCH) ? $search : 'main'));
        if (!$division || !isId($division->id)) {
          $this->failed = TRUE;
          return FALSE;
        }
      }
      if ((isObj($data) && get_class($data) == 'person') || (is_string($search) && in_array($search, $divisions))) {
        $division = division((($search !== config::NOSEARCH) ? $search : 'main'));
        if (!$division || !isId($division->id)) {
          $this->failed = TRUE;
          return FALSE;
        }
      } else if (is_string($search) && in_array($search, $persons)) {
        $person = person($search);
        if (!$person || !isId($person->id)) {
          $this->failed = TRUE;
          return FALSE;
        }
      }
      if (isObj($person)) {
        if (isId($person->id) && isObj($division) && isId($division->id)) {
          $where = team::$select.'
            left join teamPerson tp on tp.team_id = o.id
            where tp.person_id = :person_id
              and o.tournamentDivision_id = :division_id
          ';
          $values[':person_id'] = $person->id;
          $values[':division_id'] = $division->id;
          $obj = $this->db->select($query, $values, 'team');
          if ($obj) {
            $this->_set($obj);
          } else {
            $this->failed = TRUE;
            return FALSE;
          }
          if ($this->id) {
            static::$instances['ID'.$this->id] = $this;
            $this->populate($depth);
            return TRUE;
          } else {
            $this->failed = TRUE;
            return FALSE;
          }
        }
      }
      parent::__construct($data, $search, $depth);
    }

    public function getMembers($tournament = NULL, $asPlayers = TRUE) {
      $tournament = getTournament($tournament);
      $division = division($tournament, 'main');
      if (isTournament($tournament)) {
        $query = (($asPlayers) ? player::$select : person::$select).'
          left join teamPerson tp on tp.person_id = '.(($asPlayers) ? 'p' : 'o').'.id
          left join team t on tp.team_id = t.id
          where t.id = :id
            and tp.tournamentEdition_id = :tournament
        ';
        $values[':id'] = $this->id;
        $values[':tournament'] = $tournament->id;
        if ($asPlayers) {
          $query .= '
            and o.tournamentDivision_id = :division
          '; 
          $values[':division'] = $division->id;
        }
        debug($query, 'Q');
        debug($this->id, 'team');
        debug($tournament->id, 'tournament');
        debug($division->id, 'division');
        $members = $this->db->select($query, $values, (($asPlayers) ? 'player' : 'person'));
        debug($members, 'TEAM');
        if (count($members) > 0) {
          return $members;
        }
      }
      return FALSE;
    }

    public function getPhotoIcon($icon = NULL) {
      $icon = ($icon) ? $icon : $this->getPhoto(FALSE, TRUE, FALSE);
      return parent::getPhotoIcon($icon);
    }

    public function getPhoto($defaults = TRUE, $thumbnail = FALSE, $anchor = FALSE) {
      if ($this->national && $this->country_id) {
        if (isGeo($this->country)) {
          $country = $this->country;
        } else {
          $country = country($this->country_id);
        }
      }
      if (isGeo($country)) {
        return $country->getPhoto($defaults, $thumbnail, $anchor);
      } else {
        return parent::getPhoto($defaults, $thumbnail, $anchor);
      }
    }
    
    public static function validateName($name, $obj = FALSE) {
      if (!$name) {
        return validated(TRUE, 'Nothing to validate.', $obj);
      }
      if (!preg_match('/^[a-zA-ZåäöÅÄÖüÛïÎëÊÿŸçßéÉæøÆØáÁóÓàÀČčŁłĳŠšŮ0-9 \-_#\$]{3,32}$/', $name)) {
        return validated(FALSE, 'The name must be at least three character and can only include a-Z, A-Z, most of ÜÅÄÖ and similar, 0-9, spaces, #, $, dashes and underscores.', $obj);
      } else {
        $team = team('name', $name);
        if ($team) {
          $currentTeam = team('current');
          if ($team->id == $currentTeam->id) {
            return validated(TRUE, 'That name does already belong to your team, you didn\'t change it.', $obj);
          } else {
            return validated(FALSE, 'That name is already taken.', $obj);
          }
        }
      }
      return validated(TRUE, 'That name is up for grabs.', $obj);
    }

  }

?>