<?php
  require_once('functions/general.php');
  require_once('functions/header.php');

  function getTable($baseHref, $type) {
    $content = '<div id="'.$type.'Div">
                  <h3 id="'.$type.'H3" class="entry-title">'.ucfirst(getPlural($type)).'</h3>
                  <span id="'.$type.'Loading"><img src="'.$baseHref.'/images/ajax-loader.gif" alt="Loading data..."></span>
                  <table id="'.$type.'Table" class="list"></table>
                  <span id="'.$type.'All" class="getAll"></span>
                  <br />
                </div>
    ';
    return $content;
  }
  printHeader('EPC 2013', __baseHref__);

  $type = ($_REQUEST['obj']) ? $_REQUEST['obj'] : 'player';
  $id = ($_REQUEST['id']) ? $_REQUEST['id'] : null;
  if ($id == 'self') {
    if (checkLogin($dbh, $ulogin, true)) {
      $id = getIdFromUser($dbh, $_SESSION['username']);
    } else {
      $id = 'stop';
    }
  }

  if ($id != 'stop') {
    $content = '';
  
    if ($type && $id) {
      $content .= '
                    <div class="leftInfoDiv">
                      <table>
      ';
      if ($obj = getObjectById($dbh, $type, $id)) {
        $content .= '<h2 class="entry-title">'.$obj->name.'</h2>';
        foreach($classes->{$type}->info as $field) {
          $label = '';
          if ($obj->{$field} && $obj->{$field} != '') {
            if ($classes->{$type}->fields->{$field}->type == 'select') {
              $value = getLink(getObjectById($dbh, strtolower(str_replace('parent', '', $field)), $obj->{$field.'_id'}));
            } else if (in_array($field, array('main', 'classics', 'volunteer'))) {
              $value = ($obj->{$field}) ? 'Yes' : 'No';
            } else if ($field == 'isIfpa') {
              $value = '<a href="http://www.ifpapinball.com/player.php?player_id='.$obj->ifpa_id.'" target="_new">'.(($obj->ifpaRank && $obj->ifpaRank != 0) ? $obj->ifpaRank : 'Unranked').'</a>';
            } else {
              $value = str_replace('-00', '', $obj->{$field});
            }
            
            $content .= '
                          <tr>
                            <td>'.(($label) ? $label : $classes->{$type}->fields->{$field}->label).': </td>
                            <td>'.$value.'</td>
                            </tr>
            ';
          }
        } 
        $content .= '
                      </table>    
                    </div>
                    <div class="rightInfoDiv">
                      <table>
                        <tr>
                          <td><img class="objectPhoto" src="'.getPhoto($dbh, $type, $id).'" alt="'.$obj->name.'"></td>
                        </tr>
                      </table>
                    </div>
        ';
        if (in_array($type, $geoTypes)) {
          printTopper('getObjects();');
          $content .= getTable(__baseHref__, 'player');
        } else {
          printTopper();
        }
      } else {
        echo('No '.$type.' with ID '.$id.' found!');
      }
    } else {
      printTopper('getObjects();');
      $start = false;
      foreach($geoTypes as $field) {
        if ($start || $type == $field) {
          $start = true;
          $content .= getTable(__baseHref__, $field);
        }
      }
      $content .= getTable(__baseHref__, 'player');
    }
  
    echo($content);
  
  }
  printFooter();
?>
