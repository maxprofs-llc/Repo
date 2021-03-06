<?php

  define('__ROOT__', dirname(dirname(__FILE__))); 
  require_once(__ROOT__.'/functions/init.php');

  $page = new page('Password reset');
  
  $page->addH2('Password reset');
  
  debug($_SESSION);

  if ($page->loggedin()) {
    if ($_REQUEST['action'] == 'newUser') {
    }
    $person = person('login');
    $page->addParagraph('You are already logged in as '.$person->name.'. You can go to the <a href="'.config::$baseHref.'/edit" class="buttonLink">Profile editor</a> to change your login credentials.');
    $page->addParagraph('If you are not '.$person->name.' and intended to reset the password for someone else, you need to '.page::getButton('log out').' first.');
    $page->addForm('log out', array('action' => 'logout'));
  } else {
    $reqNonce = $_REQUEST['reqnonce'];
    if ($reqNonce) {
      if (ulNonce::Verify('reqNonce', $reqNonce)) {
        $person = person(array('nonce' => $reqNonce));
        if ($person && isId($person->id)) {
          $page->addParagraph('You have been identified as '.$person->name.(($person->shortName) ? ' ('.$person->shortName.')' : '').(($person->cityName || $person->countryName) ? ' from '.(($person->cityName) ? $person->cityName.', ' : '').$person->countryName : '').'.');
          $page->addParagraph('If this is not corret, please '.page::getButton('reload').' this page and try again.');
          $page->addForm('reload');
          $resetNonce = ulNonce::Create('resetNonce');
          $page->addNewUser('Provide new credentials', $person->id, 'reset');
          $page->addScript('
            $("#resetaction").val("reset");
            $("#resetnewUserButton").val("Submit");
            $("#resetnonce").val("'.$resetNonce.'");
          ');
        }
      }
    }
  }

        if ($person && isId($person->id)) {
          if ($person->username) {
            $_SESSION['username'] = $person->username;
            $page->addParagraph('You have been identified as '.$person->name.(($person->shortName) ? ' ('.$person->shortName.')' : '').(($person->cityName || $person->countryName) ? ' from '.(($person->cityName) ? $person->cityName.', ' : '').$person->countryName : '').'.');
            $page->addParagraph('If this is not correct, please '.page::getButton('reload').' this page and try again.');
            $page->addForm('reload');
            $page->addNewUser('Provide new credentials', $person->id, 'reset');
            $page->addScript('
              $("#resetnewUserButton").val("Submit");
              $("#resetaction").val("reset");
            ');
          } else {
            $page->addParagraph('You don\'t have any user in the system. Please go to the '.page::getButtonLink(config::$baseHref.'/registration/', 'Registration').' page to create one.');
          }
        }

  $page->submit();
?>