<?php
  require_once('functions/general.php');
  require_once('functions/header.php');
  printHeader('EPC 2013');
  printTopper('getObjects();');
  
  $form = new regForm();
  $form->id = 'reg';
  $form->action = 'registered.php';
  $newField = new formInput('hidden', 'dateRegistered', date('Y-m-d'));
  $form->addField($newField);
  foreach($playerHeaders as $field) {
    $newField = new formInput();
    $newField->id = $field.ucfirst($playerTypes[array_search($field, $playerHeaders)]);
    $newField->name = $field;
    $newField->label = $playerLabels[array_search($field, $playerHeaders)];
    $newField->type = $playerTypes[array_search($field, $playerHeaders)];
    if ($field == 'gender') {
      $newField->addIcon = false;
      $newField->loading = false;
      $option = new selectOption('option', 'male', 1);
      $option->text = 'Male';
      array_push($newField->options, $option);
      $option = new selectOption('option', 'female', 2);
      $option->text = 'Female';
      array_push($newField->options, $option);
      $option = new selectOption('option', 'other', 3);
      $option->text = 'Other';
      array_push($newField->options, $option);
    }
    if ($field == 'telephoneNumber') {
      $geoComment = new formInput('comment', 'geoComment', 'Choose upper level to limit lower levels...');
      $geoComment->label = 'Geography';
      $form->addField($geoComment);
      foreach(array_reverse($geoTypes) as $geoField) {
        $select = new formInput('select');
        $select->id = $geoField.'Select';
        $select->name = $geoField;
        $select->label = ucfirst($geoField);
        $select->action = 'geoSelected(this);';
        if ($geoField != 'continent' && $geoField != 'country') {
          $select->addAction = 'geoAdd(this, true);';
          $select->cancelAction = 'geoAdd(this, false);';
        } else {
          $select->addIcon = false;
        }
        $option = new selectOption();
        array_push($select->options, $option);
        $form->addField($select);
      }
    }
    if ($field == 'comment') {
      $qualComment = new formInput('comment', 'qualComment', 'Choose your preferred time slots. We do not guarantee you can play on chosen times, but we will do our best...');
      $qualComment->label = 'Qualification times';
      $form->addField($qualComment);
      $qualGroups = getObjects($dbh, 'qualGroup', 'select * from qualGroup;');
      foreach ($qualGroups as $qualGroup) {
        $qualField = new formInput();
        $qualField->id = 'qualGroup'.$qualGroup->id;
        $qualField->name = $qualField->id;
        $qualField->label = 'Group '.$qualGroup->name;
        $qualField->text = date('l', strtotime($qualGroup->date)).' '.substr($qualGroup->startTime,0,5).'-'.substr($qualGroup->endTime,0,5);
        $qualField->type = 'checkbox';
        $form->addField($qualField);
      }
      $tShirtField = new formInput('add', 'tShirt0');
      $tShirtField->label = 'T-shirts';
      $tShirtField->addName = 'T-shirt';
      $tShirtField->action = 'addTShirt(this);';
      $form->addField($tShirtField);      
    }
    $form->addField($newField);
  }
  $button = new formInput('button', '', 'Register');
  $form->addField($button);
  
  $content = $form->output();

  echo($content);

  printFooter($dbh, $ulogin);
?>
