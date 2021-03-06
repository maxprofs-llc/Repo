<?php

  define('__ROOT__', dirname(dirname(__FILE__))); 
  require_once(__ROOT__.'/functions/init.php');

  $page = new page('Edit profile');
  
  if ($page->reqLogin('You need to be logged in to access this page. If you don\'t have a user, please go to the <a href="'.config::$baseHref.'/registration/">registration page</a>.')) {
    $person = person('login');
    if ($person) {
      $tournament = tournament('active');
      $page->jeditable = TRUE;
      $page->combobox = TRUE;
      $page->tooltipster = TRUE;
      $page->forms = TRUE;
      $page->startDiv('tabs');
        $page->startUl();
          foreach(config::$editSections as $section) {
            $page->addLi('<a href="#'.preg_replace('/[^a-zA-Z0-9]/', '', $section).'" id="'.preg_replace('/[^a-zA-Z0-9]/', '', $section).'tabLink">'.ucfirst($section).'</a>');
          }
        $page->closeUl();
        if (in_array('profile', config::$editSections)) {
          $page->startDiv('profile');
            $page->addContent($person->getEdit());
          $page->closeDiv();
        }
        if (in_array('photo', config::$editSections)) {
          $page->startDiv('photo');
            $page->addContent($person->getPhotoEdit());
          $page->closeDiv();
        }
        if (in_array('security', config::$editSections)) {
          $page->startDiv('security');
            $page->addUserEdit();
          $page->closeDiv();
        }
        if (in_array('team', config::$editSections)) {
          $page->startDiv('team');
          $page->closeDiv();
        }
        if (in_array('qualGroup', config::$editSections)) {
          $page->startDiv('qualGroup');
          $page->closeDiv();
        }
        if (in_array('t-shirts', config::$editSections)) {
          $tshirtDiv = new div('tshirts');
          $tshirtDiv->addContent($person->getEdit('tshirts', 'T-shirt orders'));
          $tshirtDiv->addDiv(NULL, 'clearer');
          $page->addContent($tshirtDiv->getHtml());
        }
        if (in_array('volunteer', config::$editSections)) {
          $volDiv = new div('volunteer');
            $volDiv->indents = 3;
            $paragraph = $volDiv->addParagraph('Volunteer registration will open in short.');
          $page->addContent($volDiv->getHtml());
        } 
        if (in_array('payment', config::$editSections)) {
          $page->startDiv('payment');
            $paymentDiv = new div('paymentDiv');
            $paymentDiv->addContent($person->getEdit('payment', 'Payment options'));
            $page->addContent($paymentDiv->getHtml());
/*
            $page->addH2('Payment options');
            $page->startDiv('currencyDiv');
              $page->addContent(getCurrencySelect('payment')->getHtml());
            $page->closeDiv();
            $page->startDiv('itemsDiv');
              $divisions = divisions('active');
              foreach ($divisions as $division) {
                if (property_exists('config', $division->type.'Cost') && config::${$division->type.'Cost'}) {
                  $payMsg = $person->name.' (ID: '.$person->id.') has ordered ';
                  $page->startDiv($division->type.'CostDiv');
                    $cost = $person->getCost($division);
                    $costs += $cost;
                    $page->addInput(1, $division->type.'Num', $division->type.'Num', 'text', 'cost short', camelCaseToSpace($division->type, TRUE));
                    $page->addSpan($cost, $division->type.'Cost', 'currency');
                    $page->addInput($cost, $division->type.'Each', $division->type.'Each', 'hidden', 'each');
                    $payMsgs[] = $division->type.': 1';
                  $page->closeDiv();
                }
              }
              $payMsg .= implode($payMsgs, ', ');
              if (config::$tshirts && config::$tshirtCost > 0) {
                $page->startDiv('TshirtDiv');
                  $num = count(tshirtOrders($person, $tournament));
                  $cost = $person->getCost('tshirts');
                  $costs += $cost;
                  $page->addInput($num, 'tshirtNum', 'tshirtNum', 'text', 'cost short', 'T-shirts');
                  $page->addSpan($cost, 'tshirtCost', 'currency');
                  $page->addInput($cost, 'tshirtEach', 'tshirtEach', 'hidden', 'each');
                  $payMsg .= ', T-shirts: '.$num;
                $page->closeDiv();
              }
              $page->startDiv('subTotalDiv', (($person->paid) ? '' : 'hidden'));
                $page->addLabel('&nbsp;');
                $page->addSpan('&nbsp;', NULL, 'short');
                $page->addSpan($costs, 'subTotal', 'currency sum');
                $payMsg .= ', total: '.$costs;
              $page->closeDiv();
              $page->startDiv('paidDiv', (($person->paid) ? '' : 'hidden'));
                $page->addLabel('&nbsp;');
                $page->addLabel('Already paid', 'paidText', 'short');
//                $page->addInput($person->paid, 'paidText', 'paidText', 'text', 'short', '&nbsp;', FALSE, TRUE);
                $page->addSpan($person->paid * -1, 'paidCur', 'currency');
                $page->addInput($person->paid, 'paid', 'paid', 'hidden');
                $payMsg .= ', already paid: '.$person->paid;
              $page->closeDiv();
              $page->startDiv('totalDiv');
                $page->addLabel('&nbsp;');
                $page->addSpan('&nbsp;', NULL, 'short');
                $page->addSpan($costs - $person->paid, 'total', 'currency sum bold');
              $page->closeDiv();
              $page->addScript('
                $(".cost").change(function() {
                  var num = parseInt($(this).val().replace(/[^0-9]/g, ""));
                  var each = parseInt($("#" + this.id.replace("Num", "Each")).val().replace(/[^0-9]/g, ""));
                  var rate = $("#" + $("#curCode").val() + "Rate").val();
                  var cost = num * each * rate;
                  var format = $("#" + $("#curCode").val() + "Format").val();
                  $("#" + this.id.replace("Num", "Cost")).html(cost.toMoney(0, ".", " ", "", format));
                  var costs = 0;
                  var payMsg = $("#payment_person_name").val() + " (ID: " + $("#payment_person_id").val() + ") is paying for ";
                  var payMsgs = [];
                  $(".each").each(function() {
                    var id = this.id.replace("Each", "");
                    var num = parseInt($("#" + id + "Num").val().replace(/[^0-9]/g, ""));
                    payMsgs.push(id + ": " + num);
                    costs += parseInt($(this).val()) * num;
                  });
                  var paid = parseInt($("#paid").val());
                  var subTotal = costs * rate;
                  $("#subTotal").html(subTotal.toMoney(0, ".", " ", "", format));
                  var total = (costs - paid) * rate;
                  $(".totals").val(total);
                  $(".totalSpans").html(total.toMoney(0, ".", " ", "", format));
                  $("#total").html(total.toMoney(0, ".", " ", "", format));
                  var paidCur = paid * rate * -1;
                  $("#paidCur").html(paidCur.toMoney(0, ".", " ", "", format));
                  var paidText = paidCur * -1;
//                  $("#paidText").html("Paid: " + paidText.toMoney(0, ".", " ", "", format));
                  payMsg += payMsgs.join(", ") + ", total: " + subTotal.toMoney(0, ".", " ", "", format) + ", already paid: " + paidText.toMoney(0, ".", " ", "", format) + ", should pay: " + total.toMoney(0, ".", " ", "", format);
                  $("#payPalMsg").val(htmlspecialchars(payMsg));
                }) 
                .change();
              ');
            $page->closeDiv();
            $page->addInput($person->id, 'payment_person_id', NULL, 'hidden');
            $page->addInput($person->name, 'payment_person_name', NULL, 'hidden');
            */
            $page->startDiv('payTabs');
              $page->startUl();
                foreach(config::$paymentOptions as $paymentOption) {
                  $page->addLi('<a href="#'.preg_replace('/[^a-zA-Z0-9]/', '', $paymentOption).'" id="'.preg_replace('/[^a-zA-Z0-9]/', '', $paymentOption).'tabLink">'.$paymentOption.'</a>');
                }
              $page->closeUl();
              if (in_array('Credit card', config::$paymentOptions)) {
                $page->startDiv(preg_replace('/[^a-zA-Z0-9]/', '', 'Credit card'));
                  $page->startForm('payPalForm', 'left', 'https://www.paypal.com/cgi-bin/webscr', 'POST', TRUE);
                    $page->addInput('_xclick', NULL, 'cmd', 'hidden');
                    $page->addInput(config::$payPalAccount, NULL, 'business', 'hidden');
                    $page->addInput('1', NULL, 'undefined_quantity', 'hidden');
                    $page->addInput(config::$payPalItem, NULL, 'item_name', 'hidden');
                    $page->addInput('1', NULL, 'item_number', 'hidden');
                    $page->addInput($costs - $person->paid, 'payPalAmount', 'amount', 'hidden', 'totals');
                    $page->addInput(config::$payPalPageStyle, NULL, 'page_style', 'hidden');
                    $page->addInput('1', NULL, 'no_shipping', 'hidden');
                    $page->addInput(config::$baseHref.'/payment-ok/', NULL, 'return', 'hidden');
                    $page->addInput(config::$baseHref.'/payment-cancel/', NULL, 'cancel_return', 'hidden');
                    $page->addInput('Who/what you are paying for?', NULL, 'cn', 'hidden');
                    $page->addInput('Pay for', NULL, 'on0', 'hidden');
                    $page->addInput("Person ID: '.$person->id.'", 'payPalMsg', 'os0', 'hidden', 'payMsg');
                    $page->addInput(config::$defaultCurrency, NULL, 'currency_code', 'hidden', 'currencyInput');
                    $page->addContent('<input type="image" src="'.config::$baseHref.'/images/paypal_'.config::$defaultCurrency.'.gif" border="0" name="submit" alt="Click to pay" title="Click to pay" id="payPalImg">');
                  $page->closeForm();
                  $page->addParagraph('We are using PayPal for credit card payments. To pay using a normal credit card, click the button and choose "I don\'t have a PayPal account" or similar on the following pages. We accept Visa, Mastercard, Discover and American Express, as well as PayPal payments.');
                $page->closeDiv();
              }
              if (in_array('International bank transfer', config::$paymentOptions)) {
                $page->startDiv(preg_replace('/[^a-zA-Z0-9]/', '', 'International bank transfer'));
                  $page->addParagraph('Pay <span class="currencySpan bold">'.config::$defaultCurrency.'</span> <span class="totalSpans bold">'.(+$costs - $person->paid).'</span> to BIC/SWIFT address <span class="bold">'.config::$swiftAddress.'</span>, IBAN number <span class="bold">'.config::$ibanAccount.'</span>'.((config::$bank) ? ' in '.config::$bank : '').((config::$paymentReciever) ? '. Payment receiver is '.config::$paymentReciever : '').'.');
                  $page->addParagraph('Please include information on who you are and what you pay for.');
                $page->closeDiv();
              }
              if (in_array('Domestic bank transfer', config::$paymentOptions)) {
                $page->startDiv(preg_replace('/[^a-zA-Z0-9]/', '', 'Domestic bank transfer'));
                  $page->addParagraph('Please include information on who you are and what you pay for.');
                $page->closeDiv();
              }
            $page->closeDiv();
            $page->addScript('
              try {
                var payIndex = dataStore.getItem("payIndex");
              } catch(e) {
                var payIndex = 0;
              };
              payIndex = (parseInt(payIndex)) ? parseInt(payIndex) : 0;
              $("#payTabs").tabs({
                active: payIndex,
                activate: function(event, ui) {
                  dataStore.setItem("payIndex", ui.newTab.parent().children().index(ui.newTab));
                  var firstField = ui.newPanel.find("input[type=text],textarea,select").filter(":visible:first");
                  firstField.focus();
                },
                create: function(event, ui) {
                  var firstField = ui.panel.find("input[type=text],textarea,select").filter(":visible:first");
                  firstField.focus();
                }
              });
            ');
            $page->addParagraph('Payment registration is a manual process. Please allow up to a few days before your payment is registered in our system.',  NULL, 'italic');
          $page->closeDiv();
        }
      $page->closeDiv();
      $page->addScript('
        try {
          var tabIndex = dataStore.getItem("tabIndex");
        } catch(e) {
          var tabIndex = 0;
        };
        tabIndex = (parseInt(tabIndex)) ? parseInt(tabIndex) : 0;
        $("#tabs").tabs({
          active: tabIndex,
          activate: function(event, ui) {
            dataStore.setItem("tabIndex", ui.newTab.parent().children().index(ui.newTab));
            var firstField = ui.newPanel.find("input[type=text],textarea,select").filter(":visible:first");
            firstField.focus();
          },
          create: function(event, ui) {
            var firstField = ui.panel.find("input[type=text],textarea,select").filter(":visible:first");
            firstField.focus();
          }
        });
      ');
    } else {
      $page->startDiv();
        $page->addParagraph('Could not find you in the database? Please <a href="'.config::$baseHref.'/contact-us">contact</a> an administrator.');
      $page->closeDiv();
    }
  }
  
  $page->submit();

?>