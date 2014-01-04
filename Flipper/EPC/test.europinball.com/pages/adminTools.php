<?php

  define('__ROOT__', dirname(dirname(__FILE__))); 
  require_once(__ROOT__.'/functions/init.php');

  $page = new page('Admin tools');
  $page->forms = TRUE;

  if ($page->reqLogin('You need to be logged in to access this page. If you don\'t have a user, please go to the <a href="'.config::$baseHref.'/registration/">registration page</a>.')) {
    $volunteer = volunteer('login');
    $tournament = tournament('active');
    $persons = persons($tournament);
    $volunteers = volunteers($tournament);
    $adminDiv = new div('adminDiv');
    if ($volunteer->receptionist) {
      $tabs = $adminDiv->addTabs(NULL, 'adminTabs');
        $prefix = 'players';
        ${$prefix.'Div'} = $tabs->addDiv($prefix.'Div');
          ${$prefix.'Div'}->data_title = ucfirst($prefix);
          ${$prefix.'Div'}->addH2(${$prefix.'Div'}->data_title, array('class' => 'entry-title'));
          $profileSelectDiv = ${$prefix.'Div'}->addDiv();
            $profileSelect = $profileSelectDiv->addContent($persons->getSelectObj($prefix.'Profile', NULL, 'Edit profile and photo'));
            $profileSelect->addCombobox();
            $profileSelect->addValueSpan('Person ID:');
            $profileSelect->addChange('
              var el = this;
              $("#" + el.id + "Tabs").hide();
              if ($(el).val() != 0) {
                $("body").addClass("modal");
                var modals = 2;
                $.post("'.config::$baseHref.'/ajax/getObj.php", {class: "person", type: "edit", id: $(this).val()})
                .done(function(data) {
                  $("#" + el.id + "EditDiv").html(data);
                  modals--;
                  if (modals == 0) {
                    $("body").removeClass("modal");
                    $("#" + el.id + "Tabs").show();
                  }
                });
                $.post("'.config::$baseHref.'/ajax/getObj.php", {class: "person", type: "photo", id: $(this).val()})
                .done(function(data) {
                  $("#" + el.id + "PhotoDiv").html(data);
                  modals--;
                  if (modals == 0) {
                    $("body").removeClass("modal");
                    $("#" + el.id + "Tabs").show();
                  }
                });
              }
            ');
            ${$prefix.'Div'}->addFocus('#'.$profileSelect->id.'_combobox', TRUE);
          //$profileSelectDiv
          $profileTabs = ${$prefix.'Div'}->addTabs(NULL, $prefix.'ProfileTabs', 'hidden');
            $profileEditDiv = $profileTabs->addDiv($profileSelect->id.'EditDiv');
            //$profileEditDiv
            $profileEditDiv = $profileTabs->addDiv($profileSelect->id.'PhotoDiv');
            //$photoSelectDiv
            $profileTabs->addCss('margin-top', '15px');
          //}$profileTabs
          $waitingDiv = ${$prefix.'Div'}->addDiv();
            $waitingButton = $waitingDiv->addButton('Recalculate waiting list');
            $waitingButton->addTooltip('');
            $waitingButton->addClick('
              var el = this;
              $(el).tooltipster("update", "Recalculating waiting list...").tooltipster("show");
              $.post("'.config::$baseHref.'/ajax/calcWaiting.php", {})
              .done(function(data) {
                $(el).tooltipster("update", data.reason).tooltipster("show");
              })
            ');
            $waitingButton->addCss('margin-top', '15px');
          //$waitingDiv
          $personMailAddresses = $persons->getAllOf('mailAddress');
          if ($personMailAddresses) {
            ${$prefix.'Div'}->addH2('Email addresses', array('class' => 'entry-title'))->addCss('margin-top', '15px');
            ${$prefix.'Div'}->addParagraph('Email addresses to all players that have registered their email address. Click in the box to copy the addresses to your clipboard.');
            ${$prefix.'Div'}->addParagraph(implode(', ', $personMailAddresses), $prefix.'mailAddresses', 'toCopy');
            ${$prefix.'Div'}->addParagraph('More coming soon...')->style = 'margin-top: 15px';
          }
        //Players
        $prefix = 'users';
        ${$prefix.'Div'} = $tabs->addDiv($prefix.'Div');
          ${$prefix.'Div'}->data_title = ucfirst($prefix);
          ${$prefix.'Div'}->addH2(${$prefix.'Div'}->data_title, array('class' => 'entry-title'));
          ${$prefix.'SelectDiv'} = ${$prefix.'Div'}->addDiv();
            ${$prefix.'Select'} = ${$prefix.'SelectDiv'}->addContent($persons->getSelectObj($prefix.'Persons', NULL, 'Edit user settings'));
            ${$prefix.'Select'}->addCombobox();
            ${$prefix.'Select'}->addValueSpan('Person ID:');
            ${$prefix.'Select'}->addChange('
              var el = this;
              $("#" + el.id + "EditDiv").hide();
              if ($(el).val() != 0) {
                $("body").addClass("modal");
                $.post("'.config::$baseHref.'/ajax/getObj.php", {class: "person", type: "'.$prefix.'", id: $(el).val()})
                .done(function(data) {
                  $("#" + el.id + "EditDiv").html(data);
                  $("#" + el.id + "EditDiv").show();
                  $(":button").button();
                  $("body").removeClass("modal");
                });
              }
            ');
            ${$prefix.'Div'}->addFocus('#'.${$prefix.'Select'}->id.'_combobox', TRUE);
          //$usersSelectDiv
          ${$prefix.'Div'}->addDiv(${$prefix.'Select'}->id.'EditDiv');
          //$usersEditDiv
          $adminLevels = adminLevels('all');
          $vols = clone $volunteers;
          foreach ($adminLevels as $adminLevel) {
            if ($adminLevel->id > 15) {
              $vols[$adminLevel->id] = $vols->filter($adminLevel->name, TRUE);
              $volAddresses[$adminLevel->id] = $vols->getAllOf('mailAddress');
            }
            if ($volAddresses[$adminLevel->id]) {
              $volAddressFound = TRUE;
            }
          }
          if ($volAddressFound) {
            ${$prefix.'Div'}->addH2('Email addresses', array('class' => 'entry-title'))->addCss('margin-top', '15px');
            ${$prefix.'MailTabs'} = ${$prefix.'Div'}->addTabs(NULL, $prefix.'MailTabs');
          }
          foreach ($adminLevels as $adminLevel) {
            if ($volAddresses[$adminLevel->id]) {
              ${$prefix.'MailDiv'}[$adminLevel->id] = ${$prefix.'MailTabs'}->addDiv($prefix.'MailDiv_'.$adminLevel->id, NULL, array('data-title' => ucfirst($adminLevel->name)));
                ${$prefix.'MailDiv'}[$adminLevel->id]->addH2(ucfirst($adminLevel->name).' email addresses', array('class' => 'entry-title'));
                ${$prefix.'MailDiv'}[$adminLevel->id]->addParagraph('Email addresses to all volunteers with level '.$adminLevel->id.' or higher that have registered their email address. Click in the box to copy the addresses to your clipboard.');
                ${$prefix.'MailDiv'}[$adminLevel->id]->addParagraph(implode(', ', $volAddresses[$adminLevel->id]), $prefix.'volAddresses_'.$adminLevel->id, 'toCopy');
              //${$prefix.'MailDiv'}
            }
          }
          ${$prefix.'Div'}->addParagraph('More coming soon...')->addCss('margin-top', '15px');
        //Users
        $prefix = 'payments';
        ${$prefix.'Div'} = $tabs->addDiv($prefix.'Div');
          ${$prefix.'Div'}->data_title = ucfirst($prefix);
          ${$prefix.'Div'}->addH2(${$prefix.'Div'}->data_title, array('class' => 'entry-title'));
          ${$prefix.'Select'} = ${$prefix.'Div'}->addContent($persons->getSelectObj($prefix.'Persons', NULL, 'Persons'));
            ${$prefix.'Select'}->addCombobox();
            ${$prefix.'Div'}->addFocus('#'.${$prefix.'Select'}->id.'_combobox', TRUE);
          //$paymentSelect
          $paidDiv = ${$prefix.'Div'}->addDiv('paidDiv', 'noInput');
            $paidDiv->addLabel('Paid:');
            $paidSpan = $paidDiv->addMoneySpan(0, 'paid', config::$currencies[config::$defaultCurrency]['format']);
          //$paidDiv
          $costsDiv = ${$prefix.'Div'}->addDiv('costsDiv', 'noInput');
            $costsDiv->addLabel('Should pay:');
            $costsSpan = $costsDiv->addMoneySpan(0, 'costs', config::$currencies[config::$defaultCurrency]['format']);
          //$costsDiv
          $payDiv = ${$prefix.'Div'}->addDiv('payDiv', 'noInput');
            $payDiv->addLabel('Left to pay:');
            $paySpan = $payDiv->addMoneySpan(0, 'pay', config::$currencies[config::$defaultCurrency]['format']);
            $paySpan->addClasses('sum');
          //$payDiv
          $setDiv = ${$prefix.'Div'}->addDiv();
            $setPaid = $setDiv->addInput('setPaid', 0, 'text', 'Set paid total', array('class' => 'short'));
            $setPaid->disabled = TRUE;
            $setPaid->addChange('
              var el = this;
              $("body").addClass("modal");
              $.post("'.config::$baseHref.'/ajax/setPersonProp.php", {person_id: $("#'.${$prefix.'Select'}->id.'").val(), prop: "paid", value: $(el).val()})
              .done(function(data) {
                if (data.valid) {
                  $("#'.${$prefix.'Select'}->id.'").change();
                  setTimeout(function() {
                    $("#'.${$prefix.'Select'}->id.'_combobox").focus().select()
                  }, 500);
                } else {
                  showMsg(data.reason);
                  $("body").removeClass("modal");
                }
              });
            ');
          //$setDiv
          ${$prefix.'Select'}->addChange('
            $("body").addClass("modal");
            var modals = 3;
            $.post("'.config::$baseHref.'/ajax/getProp.php", {class: "person", id: $(this).val(), prop: "paid"})
            .done(function(data) {
              modals--;
              if (modals == 0) {
                $("body").removeClass("modal");
              }
              if (data.valid) {
                $("#'.$paidSpan->id.'").html(parseInt(data.reason).toMoney(0, ".", " ", "", "'.config::$currencies[config::$defaultCurrency]['format'].'"));
                $("#'.$setPaid->id.'").val(data.reason).focus().select().prop("disabled", false);
              } else {
                showMsg(data.reason);
              }
            });
            $.post("'.config::$baseHref.'/ajax/getProp.php", {class: "person", id: $(this).val(), prop: "costs"})
            .done(function(data) {
              modals--;
              if (modals == 0) {
                $("body").removeClass("modal");
              }
              if (data.valid) {
                $("#'.$costsSpan->id.'").html(parseInt(data.reason).toMoney(0, ".", " ", "", "'.config::$currencies[config::$defaultCurrency]['format'].'"));
              } else {
                showMsg(data.reason);
              }
            });
            $.post("'.config::$baseHref.'/ajax/getProp.php", {class: "person", id: $(this).val(), prop: "toPay"})
            .done(function(data) {
              modals--;
              if (modals == 0) {
                $("body").removeClass("modal");
              }
              if (data.valid) {
                $("#'.$paySpan->id.'").html(parseInt(data.reason).toMoney(0, ".", " ", "", "'.config::$currencies[config::$defaultCurrency]['format'].'"));
              } else {
                showMsg(data.reason);
              }
            });
          ');
        //}
        $prefix = 'teams';
        ${$prefix.'Div'} = $tabs->addDiv($prefix.'Div');
          ${$prefix.'Div'}->data_title = ucfirst($prefix);
          ${$prefix.'Div'}->addH2(${$prefix.'Div'}->data_title, array('class' => 'entry-title'));
          ${$prefix.'Div'}->addParagraph('More coming soon...')->addCss('margin-top', '15px');
        //${$prefix.'Div'}
        $prefix = 'groups';
        ${$prefix.'Div'} = $tabs->addDiv($prefix.'Div');
          ${$prefix.'Div'}->data_title = ucfirst($prefix);
          ${$prefix.'Div'}->addH2(${$prefix.'Div'}->data_title, array('class' => 'entry-title'));
          ${$prefix.'Div'}->addParagraph('More coming soon...')->addCss('margin-top', '15px');
        //${$prefix.'Div'}
        $prefix = 'games';
        ${$prefix.'Div'} = $tabs->addDiv($prefix.'Div');
          ${$prefix.'Div'}->data_title = ucfirst($prefix);
          ${$prefix.'Div'}->addH2(${$prefix.'Div'}->data_title, array('class' => 'entry-title'));
          $games = games($tournament);
          ${$prefix.'SelectDiv'} = ${$prefix.'Div'}->addDiv();
            ${$prefix.'Select'} = ${$prefix.'SelectDiv'}->addContent($games->getSelectObj($prefix.'Games', NULL, 'Edit game ettings'));
            ${$prefix.'Select'}->addCombobox();
            ${$prefix.'Select'}->addValueSpan('Game ID:');
            ${$prefix.'Select'}->addChange('
              var el = this;
              $("#" + el.id + "EditDiv").hide();
              if ($(el).val() != 0) {
                $("body").addClass("modal");
                $.post("'.config::$baseHref.'/ajax/getGames.php", {obj: "person", type: "'.$prefix.'", id: $(el).val()})
                .done(function(data) {
                  $("#" + el.id + "EditDiv").html(data);
                  $("#" + el.id + "EditDiv").show();
                  $(":button").button();
                  $("body").removeClass("modal");
                });
              }
            ');
            ${$prefix.'Div'}->addFocus('#'.${$prefix.'Select'}->id.'_combobox', TRUE);
          //$usersSelectDiv
          ${$prefix.'Div'}->addDiv(${$prefix.'Select'}->id.'EditDiv');
          //$usersEditDiv
          $owners = owners('active');
          $mailAddresses = $owners->getAllOf('mailAddress');
          if ($mailAddresses) {
            ${$prefix.'Div'}->addH2('Email addresses', array('class' => 'entry-title'))->addCss('margin-top', '15px');
            ${$prefix.'Div'}->addParagraph('Email addresses to all game owners that have registered their email address. Click in the box to copy the addresses to your clipboard.');
            ${$prefix.'Div'}->addParagraph(implode(', ', $mailAddresses), $prefix.'mailAddresses', 'toCopy');
          }
          ${$prefix.'Div'}->addParagraph('More coming soon...')->addCss('margin-top', '15px');
        //${$prefix.'Div'}
        $prefix = 'scores';
        ${$prefix.'Div'} = $tabs->addDiv($prefix.'Div');
          ${$prefix.'Div'}->data_title = ucfirst($prefix);
          ${$prefix.'Div'}->addH2(${$prefix.'Div'}->data_title, array('class' => 'entry-title'));
          ${$prefix.'Div'}->addParagraph('More coming soon...')->addCss('margin-top', '15px');
        //${$prefix.'Div'}
        $prefix = 'results';
        ${$prefix.'Div'} = $tabs->addDiv($prefix.'Div');
          ${$prefix.'Div'}->data_title = ucfirst($prefix);
          ${$prefix.'Div'}->addH2(${$prefix.'Div'}->data_title, array('class' => 'entry-title'));
          ${$prefix.'Div'}->addParagraph('More coming soon...')->addCss('margin-top', '15px');
        //${$prefix.'Div'}
        $prefix = 'volunteers';
        ${$prefix.'Div'} = $tabs->addDiv($prefix.'Div');
          ${$prefix.'Div'}->data_title = ucfirst($prefix);
          ${$prefix.'Div'}->addH2(${$prefix.'Div'}->data_title, array('class' => 'entry-title'));
          $volunteers = volunteers('active');
          $mailAddresses = $volunteers->getAllOf('mailAddress');
          if ($mailAddresses) {
            ${$prefix.'Div'}->addH2('Email addresses', array('class' => 'entry-title'))->addCss('margin-top', '15px');
            ${$prefix.'Div'}->addParagraph('Email addresses to all volunteers that have registered their email address. Click in the box to copy the addresses to your clipboard.');
            ${$prefix.'Div'}->addParagraph(implode(', ', $mailAddresses), $prefix.'mailAddresses', 'toCopy');
            ${$prefix.'Div'}->addParagraph('More coming soon...')->addCss('margin-top', '15px');
          }
        //${$prefix.'Div'}
        $prefix = 't-shirts';
        ${$prefix.'Div'} = $tabs->addDiv($prefix.'Div');
          ${$prefix.'Div'}->data_title = ucfirst($prefix);
          ${$prefix.'Div'}->addH2(${$prefix.'Div'}->data_title, array('class' => 'entry-title'));
          $tshirtOrders = tshirtOrders('active');
          $mailAddresses = $tshirtOrders->getAllOf('mailAddress');
          $otherAddresses = array_diff($personMailAddresses, $mailAddresses);
          ${$prefix.'Div'}->addH2('Email addresses', array('class' => 'entry-title'))->addCss('margin-top', '15px');
          ${$prefix.'Div'}->addParagraph('Email addresses to all players that have chosen their T-shirts and registered their email address. Click in the box to copy the addresses to your clipboard.');
          ${$prefix.'Div'}->addParagraph(implode(', ', $mailAddresses), $prefix.'mailAddresses', 'toCopy');
          ${$prefix.'Div'}->addParagraph('Email addresses to all players that have NOT chosen their T-shirts, but do have registered their email address. Click in the box to copy the addresses to your clipboard.');
          ${$prefix.'Div'}->addParagraph(implode(', ', $otherAddresses), $prefix.'otherAddresses', 'toCopy');
          ${$prefix.'Div'}->addParagraph('More coming soon...')->addCss('margin-top', '15px');;
        //${$prefix.'Div'}
        $prefix = 'other';
        ${$prefix.'Div'} = $tabs->addDiv($prefix.'Div');
          ${$prefix.'Div'}->data_title = ucfirst($prefix);
          ${$prefix.'Div'}->addH2(${$prefix.'Div'}->data_title, array('class' => 'entry-title'));
          $geoTabs = ${$prefix.'Div'}->addTabs(NULL, 'geoTabs');
            foreach (array('city', 'region') as $geoClass) {
              $arrClass = $geoClass::$arrClass;
              $geoDiv = $geoTabs->addDiv($arrClass.'Div');
                $objs = $arrClass('all');
                $geoDiv->addH2('Merge '.$geoClass.' duplicates', array('class' => 'entry-title'));
                  $actionSel['Remove'] = $objs->getSelectObj($arrClass.'DupesRemove', NULL, 'Remove this '.$geoClass.':', array('class' => 'dupeSelect '.$geoClass.'Select'));
                  $geoDiv->addFocus('#'.$actionSel['Remove']->id.'_combobox', TRUE);
                  $actionSel['Keep'] = new select($arrClass.'DupesKeep', NULL, NULL, 'Keep this '.$geoClass.':', array('class' => 'dupeSelect '.$geoClass.'Select'));
                  $actionSel['Keep']->contents = $actionSel['Remove']->contents;
                  $actionSel['Keep']->escape = FALSE;
                  foreach(array('Remove', 'Keep') as $action) {
                    $actionDiv = $geoDiv->addDiv();
                      $actionSel[$action]->addCombobox();
                      $actionDiv->addContent($actionSel[$action]);
                      $actionDiv->addLabel(ucfirst($geoClass).' ID:', NULL, NULL, 'short');
                      $actionDiv->addSpan('none', $arrClass.'Dupes'.$action.'IDSpan');
                    //$actionDiv
                  } 
                //$geoDiv
                $geoDiv->addLabel(' ');
                $mergeButton = $geoDiv->addButton('Merge', $geoClass.'MergeButton', array('class' => 'mergeButton'));
                $mergeButton->{'data-geoclass'} = $geoClass;
                $mergeButton->{'data-arrclass'} = $arrClass;
                $tooltip = $mergeButton->addTooltip('');
                $tooltip->timer = 8000;
                $geoDiv->addParagraph('Anything now related to the first '.$geoClass.' will be changed to be related to the second '.$geoClass.' when you click the button. Properties from the first city will be transfered to the second city only if the property is empty for the second city.', NULL, 'italic');
              //$geoDiv
            } 
          //$geoTabs
          ${$prefix.'Div'}->addChange('
            $("#" + this.id + "IDSpan").html($(this).val());
          ', '.dupeSelect');
          ${$prefix.'Div'}->addClick('
            var el = this;
            var geoClass = $(this).data("geoclass");
            var arrClass = $(this).data("arrclass");
            var $removeSel = $("#" + arrClass + "DupesRemove");
            var $keepSel = $("#" + arrClass + "DupesKeep");
            if ($removeSel.val() && $keepSel.val) {
              $("body").addClass("modal");
              $(el).tooltipster("update", "Merging " + arrClass + "...").tooltipster("show");
              $.post("'.config::$baseHref.'/ajax/geoMerge.php", {obj: geoClass, remove: $removeSel.val(), keep: $keepSel.val()})
              .done(function(data) {
                $(el).tooltipster("update", data.reason).tooltipster("show").tooltipster("timer", 15000);
                if (data.valid) {
                  $("." + geoClass + "Select option[value=\'" + $removeSel.val() + "\']").each(function() {
                    $(this).remove();
                  });
                  $removeSel.val(0);
                  $keepSel.val(0);
                  $("#" + arrClass + "DupesRemoveIDSpan").html("None");
                  $("#" + arrClass + "DupesKeepIDSpan").html("None");
                  $("#" + arrClass + "DupesRemove_combobox").val("Choose...");
                  $("#" + arrClass + "DupesKeep_combobox").val("Choose...");
                  $("#" + arrClass + "DupesRemove_combobox").focus();
                  $("#" + arrClass + "DupesRemove_combobox").select();
                }
                $("body").removeClass("modal");
              })
            } else {
              $(el).tooltipster("update", "Please choose " + arrClass + " to remove and to keep...").tooltipster("show");
            }
          ', '.mergeButton');
        //$otherDiv
      //$tabs
      $page->addContent($adminDiv);
    } else {
      $paragraph = new paragraph('You need to be an administrator or receptionist to access this page. Please logout and log back in as administrator.');
      $page->addContent($paragraph);
    }
  }
  $page->submit();

?>