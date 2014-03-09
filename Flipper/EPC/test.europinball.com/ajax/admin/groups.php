<?php

  define('__ROOT__', dirname(dirname(dirname(__FILE__))));
  require_once(__ROOT__.'/functions/init.php');

  $volunteer = volunteer('login');
  if ($volunteer->receptionist) {
    $division = division('main');
    $persons = persons($division);
    $prefix = 'groups';
    ${$prefix.'Div'} = new div($prefix.'Div');
      ${$prefix.'Div'}->data_title = ucfirst($prefix);
      ${$prefix.'Div'}->addH2(${$prefix.'Div'}->data_title, array('class' => 'entry-title'));
      $tabs = ${$prefix.'Div'}->addTabs(NULL, 'adminTabs');
        $qualGroups = qualGroups($division);
        foreach ($qualGroups as $qualGroup) {
          $tabs->addAjaxTab(config::$baseHref.'/ajax/object.php?obj=qualGroup&id='.$qualGroup->id, ucfirst($qualGroup->shortName));
        }
      //$tabs
      ${$prefix.'Div'}->addParagraph('More coming soon...')->addCss('margin-top', '15px');
    //${$prefix.'Div'}
    echo ${$prefix.'Div'}->getHtml();
  } else {
    echo 'Admin login required. Please make sure you are logged in as an administrator and try again.';
  }

?>