<?php
  require_once('functions/general.php');
  require_once('functions/header.php');

  printHeader('EPC 2013', __baseHref__);
  printTopper();

  $id = ($_REQUEST['id']) ? $_REQUEST['id'] : null;

  if ($id && preg_match('/^[0-9]+$/', $id)) {
    $content .= '
                    <div class="leftInfoDiv">
                      <table>
    ';
    if ($obj = getGameById($dbh, $id)) {
      $content .= '<h2 class="entry-title">'.$obj->name.'</h2>';
      foreach($classes->game->info as $field) {
        $label = '';
        if ($obj->{$field} && $obj->{$field} != '') {
          if ($classes->game->fields->{$field}->type == 'select') {
            $value = getLink(getObjectById($dbh, $field, $obj->{$field.'_id'}));
          } else if ($field == 'isIpdb') {
            $value = '<a href="http://ipdb.org/machine.cgi?id='.$obj->ipdb_id.'" target="_new">'.$obj->ipdb_id.'</a>';
          } else if ($field == 'rules') {
            $value = '<a href="'.$obj->{$field}.'" target="_new">Rules sheet</a>';
          } else {
            $value = ucfirst($obj->{$field});
          }
            
          $content .= '
                        <tr>
                          <td>'.(($label) ? $label : $classes->game->fields->{$field}->label).': </td>
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
                          <td><img class="objectPhoto" src="'.getPhoto($dbh, 'game', $id).'" alt="'.$obj->name.'"></td>
                        </tr>
                      </table>
                    </div>
      ';
    } else {
      echo('No game with ID '.$id.' found!');
    }
  }
  echo($content);
  printFooter();
?>
