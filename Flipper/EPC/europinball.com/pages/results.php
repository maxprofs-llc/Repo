<?php

  define('__ROOT__', dirname(dirname(__FILE__))); 
  require_once(__ROOT__.'/functions/init.php');

  $type = ($type) ? $type : (($_REQUEST['obj']) ? $_REQUEST['obj'] : 'players');
  $type = (isGroup($type, TRUE)) ? $type : ((isObj($type, TRUE)) ? $type::$arrClass : 'players');

  if (isId($_REQUEST['tournament_id'])) {
    $tournament = tournament($_REQUEST['tournament_id']);
  }
  if (!$tournament) {
    $tournament = tournament(config::$activeTournament);
  }
  if (!$tournament) {
    $tournament = getTournament();
  }
  if (!$tournament) {
    error('No tournament found!', NULL, FALSE, TRUE);
  }
  $divisions = divisions($tournament);
  if (!$divisions || count($divisions) < 1) {
    error('No divisions found!', NULL, FALSE, TRUE);
  }

  switch ($type) {
    case 'players':
      $title = 'players and teams';
      $divisions->filter('includeInStats');
    break;
    case 'persons':
      $title = 'players';
    break;
    case 'teams':
      $title = 'teams';
      $divisions->filter('includeInStats');
    break;
    case 'games':
    case 'machines':
      $title = 'games';
    break;
    case 'manufacturers':
      $title = 'game manufacturers';
    break;
    default:
      $title = $type;
    break;
  }

  $page = new page('Qualification results ');
  $page->datatables = TRUE;
  $page->datatablesReload = TRUE;
  
  $div = new div();
    $div->addH2('Results')->class = 'entry-title';
    $tabs = $div->addTabs(NULL, 'resultTabs');
      foreach ($divisions as $division) {
        $tabs->addAjaxTab(config::$baseHref.'/ajax/getStandings.php?class=division&id='.$division->id, $division->divisionName);
      }
    //Tabs
  //Div
  $page->addContent($div);
  
  $page->submit();

?>