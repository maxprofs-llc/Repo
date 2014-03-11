<?php

  class qualGroup extends timeSlot {
        
    public static $instances;
    public static $arrClass = 'qualGroups';

    public static $select = '
      select 
        o.id as id,
        concat(o.name, ": ", o.date, " ", replace(replace(startTime, ":00", ""), ":00", ""), "-", replace(replace(endTime, ":00", ""), ":00", "")) as name,
        concat(o.name, ": ", o.date, " ", startTime, " - ", endTime) as fullName,
        concat(o.name, ": ", replace(replace(startTime, ":00", ""), ":00", ""), "-", replace(replace(endTime, ":00", ""), ":00", "")) as shortName,
        concat(o.date, " ", startTime, " - ", endTime) as dateName,
        concat(o.date, startTime) as sortName,
        o.name as acronym,
        o.date as date,
        o.startTime as startTime,
        o.endTime as endTime,
        o.tournamentDivision_id as tournamentDivision_id,
        o.comment as comment
      from qualGroup o
    ';
    
    public static $parents = array(
      'tournamentDivision' => 'division'
    );
    
    // @todo: Fix children
/*
    public static $children = array(
      'player' => 'qualGroup',
      'team' => 'qualGroup',
      'playerQualGroups' => array(
        'field' => 'qualGroup',
        'delete' => TRUE
      )
    );
*/
    
    public function getRegRow($array = FALSE) {
      $return = array(
        $this->getLink()
/*
        $this->getLink('shortName'),
        (is_object($this->city)) ? $this->city->getLink() : $this->cityName,
        (is_object($this->region)) ? $this->region->getLink() : $this->regionName,
        (is_object($this->country)) ? $this->country->name : $this->countryName,
        (is_object($this->country)) ? $this->country->getIcon() : $this->countryName,
        (($this->ifpaRank) ? $this->ifpaRank : (($this->getLink('ifpa')) ? 99000 : 100000)),
        str_replace('Unranked', 'Unr', $this->getLink('ifpa')),
        (($this->person) ? $this->person->getPhotoIcon() : ''),
        (($this->waiting) ? ((isId($this->waiting)) ? $this->waiting : '*'): ''),
        (($this->paid) ? 'Yes' : '')
*/
      );
      return ($array) ? $return : (object) $return;
    }
    
    public function getEdit($type = 'groupsAdmin', $title = NULL, $tournament = NULL, $prefix = NULL) {
      switch ($type) {
        case 'payment': 
        default:
          $div = new div($prefix.'qualGroupEditDiv'.$this->id);
          $players = players($this->tournamentDivision);
          $groupPlayers = players($this);
          $headers = array('ID', 'Name', 'Action');
          $delIcon = new img(config::$baseHref.'/images/cancel.png', 'Click to remove player', array('class' => 'icon'));
          foreach ($groupPlayers as $groupPlayer) {
            $rows[] = array($groupPlayer->id, $groupPlayer->name, $delIcon);
          }
          $div->addH3('Players', array('class' => 'entry-title'));
          $table = $div->addTable($rows, $headers);
          $table->addDatatables();
          $tr = new tr();
          $tr->addTd('Add player');
          $playerSelect = $players->getSelectObj($prefix.'qualGroupAddPlayer'.$this->id, NULL, FALSE);
          $playerSelect->addCombobox();
          $tr->addTd($playerSelect)->entities = FALSE;
          $addIcon = new img(config::$baseHref.'/images/add_icon.gif', 'Click to add player', array('class' => 'icon'));
          $td = $tr->addTd($addIcon);
          $td->entities = FALSE;
          $tr->type = 'tbody';
          $table->addContent($tr);
          $addIcon->addClick('
            var el = $("#'.$playerSelect->id.'");
            var combobox = document.getElementById("'.$playerSelect->id.'_combobox");
            $(combobox).tooltipster("update", "Updating the database...").tooltipster("show");
            $.post("'.config::$baseHref.'/ajax/setProp.php", {class: "player", id: $(el).val(), prop: "qualGroup_id", value: '.$this->id.'})
            .done(function(data) {
              $(combobox).tooltipster("update", data.reason).tooltipster("show");
              if (data.valid) {
                $("#'.$table->id.'").dataTable().fnAddData([
                  $(el).val(),
                  $(el).children(":selected").text(),
                  "<img class=\"icon\" title=\"Click to remove player\" id=\"\" alt=\"Click to remove player\" src=\"'.config::$baseHref.'/images/cancel.png\">"
                ]);
                $(el).val(0);
                $(el).change();
              }
            });
          ');
          $delIcon->addClick('
            alert("hej");
            var position = $("#'.$table->id.'").dataTable().fnGetPosition(this);
            alert(position);
            var row = position[0];
            alert(row);
            var data = $("#'.$table->id.'").dataTable().fnGetData(row);
            alert(data[0]);
            showMsg("Updating the database...");
            $.post("'.config::$baseHref.'/ajax/setProp.php", {class: "player", id: data[0], prop: "qualGroup_id", value: 0})
            .done(function(data) {
              showMsg(data.reason);
              if (data.valid) {
                $("#'.$table->id.'").dataTable().fnDeleteRow(row);
              }
            });
          ');
          $div->addScriptCode('
            $("#'.$playerSelect->id.'_combobox").tooltipster({
              theme: ".tooltipster-light",
              content: "Updating the database...",
              trigger: "custom",
              position: "right",
              offsetX: 38,
              timer: 3000
            });
          ');
          return $div;
        break;
      }
    }

  }

?>