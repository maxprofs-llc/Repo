<?php

  class players extends group {
    
    public static $objClass = 'player';
    public static $all = array();
    
    public function __construct($data = NULL, $prop = NULL, $cond = 'and') {
      if (!$prop && (is_string($data) || is_int($data))) {
        if(preg_match('/@/',$data)) {
          $data = (static::$objClass == 'player') ? array(
            'o.mailAddress' => trim($data),
            'p.mailAddress' => trim($data)
          ) : array('o.mailAddress' => trim($data));
          $cond = 'or';
        } else if (preg_match('/^[0-9]{1,5}$/', $data)) {
          $prop = (static::$objClass == 'player') ? 'p.ifpa_id' : 'ifpa_id';
          $data = trim($data);
        } else if (preg_match('/^[0-9 \-\+\(\)]{6,}$/',$data)) {
          $where = 'where replace(replace(replace(replace(replace(o.telephoneNumber," ",""),")",""),")",""),"-",""),"+","") like "%'.preg_replace('/[^0-9]/','',$data).'%"';
          $where .= ' or replace(replace(replace(replace(replace(o.mobileNumber," ",""),")",""),")",""),"-",""),"+","") like "%'.preg_replace('/[^0-9]/','',$data).'%"';
          $where .= (static::$objClass == 'player') ? ' or replace(replace(replace(replace(replace(p.telephoneNumber," ",""),")",""),")",""),"-",""),"+","") like "%'.preg_replace('/[^0-9]/','',$data).'%"' : '';
          $where .= (static::$objClass == 'player') ? ' or replace(replace(replace(replace(replace(p.mobileNumber," ",""),")",""),")",""),"-",""),"+","") like "%'.preg_replace('/[^0-9]/','',$data).'%"' : '';
          $data = $where;
        } else if (preg_match('/^[a-zA-Z0-9 \-]{3}$/',$data)) {
          $data = (static::$objClass == 'player') ? array(
            'o.initials' => trim($data),
            'p.initials' => trim($data)
          ) : array('o.initials' => trim($data));
          $cond = 'or';
        } else {
          $where = 'where concat(ifnull(o.firstName,""), " ", ifnull(o.lastName,"")) like "%'.trim($data).'%"';
          $where .= (static::$objClass == 'player') ? ' or concat(ifnull(p.firstName,""), " ", ifnull(p.lastName,"")) like "%'.trim($data).'%"' : '';
          $data = $where;
        }
      }
      if (isTeam($data)) {
        $tournament = ($this->tournamentEdition) ? $this->tournamentEdition : getTournament($prop); 
        $division = getDivision($tournament, 'main');
        if (isTournament($tournament)) {
          $data = '
            left join teamPerson tp 
              on tp.person_id = '.((static::$objClass == 'player') ? 'p' : 'o').'.id
            left join team t 
              on tp.team_id = t.id
            where t.id = '.$data->id.'
              and tp.tournamentEdition_id = '.$tournament->id.'
              '.((static::$objClass == 'player') ? 'and o.tournamentDivision_id = '.$division->id : '').'
          ';
        }
      } else if (isTeam($prop)) {
        $tournament = ($this->tournamentEdition) ? $this->tournamentEdition : getTournament($data);
        $division = getDivision($tournament, 'main');
        if (isTournament($tournament)) {
          $data = '
            left join teamPerson tp 
              on tp.person_id = '.((static::$objClass == 'player') ? 'p' : 'o').'.id
            left join team t 
              on tp.team_id = t.id
            where t.id = '.$prop->id.'
              and tp.tournamentEdition_id = '.$tournament->id.'
              '.((static::$objClass == 'player') ? 'and o.tournamentDivision_id = '.$division->id : '').'
          ';
        }
      }
      parent::__construct($data, $prop, $cond);
    }
    
    public function getTable($id = NULL, $class = NULL, array $headers = NULL) {
      $divisionIds = array();
      foreach ($this as $obj) {
        if (!in_array($obj->tournamentDivision_id, $divisionIds)) {
          $divisionIds[] = $obj->tournamentDivision_id;
        }
        $tbody[$obj->tournamentDivision_id][] = $obj->getTr();
      }
      sort($divisionIds);
      $tabs = new tabs(NULL, 'divisionTabs');
      foreach($divisionIds as $divisionId) {
        $division = division($divisionId);
        if ($division->team) {
          if ($division->national) {
            $headers = array('Name', 'Tag', 'Country', 'Members', 'Picture');
            $tableProps = array(
              'aoColumnDefs' => '[
                {"sClass": "icon", "aTargets": [ 4 ] }
              ]'
            );
          } else {
            $headers = array('Name', 'Tag', 'Members', 'Picture');
            $tableProps = array(
              'aoColumnDefs' => '[
                {"sClass": "icon", "aTargets": [ 3 ] }
              ]',
            );
          }
        } else {
          $headers = array('Name', 'Tag', 'City', 'Region', 'Country sort', 'Country', 'IFPA Rank', 'IFPA', 'Photo', 'Waiting', 'Paid');
          $tableProps = array(
            'aoColumnDefs' => '[
              { "aDataSort": [ 6 ], "aTargets": [ 7 ] },
              { "bVisible": false, "aTargets": [ 6 ] },
              { "aDataSort": [ 4 ], "aTargets": [ 5 ] },
              { "bVisible": false, "aTargets": [ 4 ] },
              {"sClass": "icon", "aTargets": [ 5 ] },
              {"sClass": "icon", "aTargets": [ 8 ] }
            ]',
          );
        }
        $tableProps['fnDrawCallback'] = '
          function() {
            $(this).css("width", "");
            $(".photoPopup").each(function() {
              $(this).dialog({
                autoOpen: false,
                modal: true, 
                width: "auto",
                height: "auto"
              });
            });
            $(".photoIcon").click(function() {
              var photoDiv = $(this).data("photodiv");
              $("#" + photoDiv).dialog("open");
              $(document).on("click", ".ui-widget-overlay", function() {
                $("#" + photoDiv).dialog("close");
              });
            });
            return true;
          },
        ';
        $thead = new tr();
        foreach ($headers as $label) {
          $thead->addTh($label);
        }
        $div = $tabs->addDiv($divisionId.'_divisionDiv', NULL, array('data-title' => ucfirst($division->divisionName)));
        $table = $div->addDatatables($tbody[$divisionId], $thead, $divisionId.'_divisionTable', NULL, NULL, $tableProps);
      }
      return $tabs;
    }

  }

?>