<?php

  define('__ROOT__', dirname(__FILE__)); 
  require_once(__ROOT__.'/functions/general.php');
  printHeader('EPC 2013', __baseHref__);
  printTopper();

  
  if (checkLogin($dbh, $ulogin)) {
    $currentPlayer = getCurrentPlayer($dbh, $ulogin);
    if ($currentPlayer->adminLevel > 0) {
      require_once(__ROOT__.'/functions/admin.php');
      
      $playerId = (isset($_REQUEST['playerId']) && preg_match('/^[0-9]+$/', $_REQUEST['playerId'])) ? $_REQUEST['playerId'] : null;
            
      $content = '<div id="arriveMenu"><h2 class="entry-title">Player arrival and confirmation checklist</h2>';

      if ($playerId) {
        $player = getPlayerById($dbh, $playerId);
        $costs = $player->getCosts($dbh, 'all', 'SEK')['all']['SEK'];
        $tshirts = $player->getTshirts($dbh);
        $team = $player->getTeam($dbh);
        $team = ($team) ? $team : $player->getTeam($dbh, 12);
        if ($player) {
          $content .= '
            <div>'.getInfo($dbh, 'player', $player->id, false).'</div>
            <h2 class="entry-title">Please have the player confirm that all info above and below is correct!</h2><br />
            <h2 class="big">Player login:</h2>
            <p>Player username is <span class="big">'.$player->username.'</span>. Check that the player knows his/her password, or reset it here: <input type="button" value="Reset" id="'.$player->id.'_passwordBtn" onclick="resetPassword(this)" class="passwordBtn">
            <span class="error errorSpan toolTip" id="'.$player->id.'_passwordBtnSpan"></span>
            <input type="hidden" id="resetNonce" value="'.ulNonce::Create('resetNonce').'">
            <input type="hidden" id="adminReset" value="true"></p>
            <h2 class="big">Player handout:</h2>
            <p>Please give the player:
              <ul>
                <li>The player QR code sticker, to put on his chest. <a href="'.__baseHref__.'/mobile/playerPrinter.php?playerId='.$player->id.'&autoPrint=true" target="_blank">Print here</a></li>
                <li>One 20% off discount ticket</li>
                '.(($player->volunteer) ? '<li>One free dinner ticket</li>' : '').'
                <li>Information that game cards for recreational play can be bought in the bar</li>
              </ul>
            </p>
            <br />
            <h2 class="big">Cell phone reachability:</h2>
            <p>Please confirm that the player <span class="big">'.$player->firstName.' '.$player->lastName.'</span> is reachable on cell phone number <span class="big" id="'.$player->id.'_mobileNumber">'.$player->mobileNumber.'</span> during the tournament.</p>
            <p><label>Change cell phone number to:</label>
            <input type="text" id="'.$player->id.'_mobileNumberChange" value="'.$player->mobileNumber.'">
            <input type="button" value="change" id="'.$player->id.'_mobileNumberChangeBtn" onclick="mobileNumberChange(this);">
            <span class="error errorSpan toolTip" id="'.$player->id.'_mobileNumberChangeBtnSpan"></span>
            </p><br />
          ';
          if ($player->paid == $costs) {
            $corrected = '';
            $tooMuch = 'none';
            $tooLittle = 'none';
          } else if ($player->paid > $costs) {
            $corrected = 'none';
            $tooMuch = '';
            $tooLittle = 'none';
          } else if (!$player->paid || $player->paid < $costs) {
            $corrected = 'none';
            $tooMuch = 'none';
            $tooLittle = '';
          }
          $content .= '
            <h2 class="big">Payment status:</h2>
            '.getCurCalcForm().'
            <p class="paymentCorrect" style="display: '.$corrected.'">The player have paid in full: <span class="big"><span id="'.$player->id.'_costs">'.$player->paid.'</span> SEK.</span></p>
            <p class="paymentTooMuch" style="display: '.$tooMuch.'">The player have paid too much. (S)he should only pay <span class="big"><span id="'.$player->id.'_tooMuchCosts">'.$costs.'</span> SEK</span>, but have paid <span class="big">'.$player->paid.' SEK</span> so please <span class="big">give '.($player->paid - $costs).' SEK back</span> and <a href="javascript: adminPaidChange(document.getElementById(\''.$player->id.'_tooMuchCosts\'));" id="tooMuchCorrected">click here</a> when done.</p>
            <span class="error errorSpan toolTip" id="'.$player->id.'_tooMuchCostsSpan"></span>
            <p class="paymentNeeded" style="display: '.$tooLittle.'">The player have paid <span class="big">'.$player->paid.' SEK</span> and should pay <span class="big"><span id="'.$player->id.'_tooLittleCosts">'.$costs.'</span> SEK</span>, so (s)he needs to <span class="big">pay '.($costs - $player->paid).' SEK more</span>. <a href="javascript: adminPaidChange(document.getElementById(\''.$player->id.'_tooLittleCosts\'))" id="tooLittleCorrected">Click here</a> when done.</p>
            <span class="error errorSpan toolTip" id="'.$player->id.'_tooLittleCostsSpan"></span><br />
            <h2 class="big">T-shirts:</h2>
          ';
          if ($tshirts && count($tshirts) > 0) {
            foreach ($tshirts as $tshirt) {
              if (!$tshirt->dateDelivered) {
                $handOut = 'hand out the undelivered T-shirt(s) and tick the checkbox(es) above';
              } else {
                $confirm = 'confirm that the player has already got the T-shirt(s) marked as delivered';
              }
              $tshirtNo++;
              $tshirtRows .= '
                <tr>
                  <td>Order ID '.$tshirt->id.': <span class="big">'.$tshirt->number.'</span> pcs of <span class="big">'.$tshirt->color.' '.$tshirt->size.'</span> T-shirts</td>
                  <td>
                    <input type="checkbox" class="tshirtDlvrAll" id="'.$tshirt->id.'_dlvr" onclick="tshirtDlvr(this);" '.(($tshirt->dateDelivered) ? 'checked' : '').'>
                    <span class="error errorSpan toolTip" id="'.$tshirt->id.'_dlvrSpan"></span>
                  </td>
                  <td id="'.$tshirt->id.'_dlvrDate">'.(($tshirt->dateDelivered) ? 'Delivered '.$tshirt->dateDelivered : 'Mark as delivered').'</td>
                </tr>
              ';
            }
            $content .= '
              <table>
                <tr>
                  <td>T-shirt order(s)</td>
                  '.(($tshirtNo > 1) ? '<td><input type="checkbox" id="tshirtDlvrAll" '.(($handOut) ? '' : 'checked').' onclick="tshirtDlvrAll(this);"></td>
                  <span class="error errorSpan toolTip" id="tshirtDlvrAllSpan"></span>
                  <td align="right">Mark all/none of the order(s) as delivered:</td>' : '<td></td><td></td>').'
                </tr>
              '.$tshirtRows.'</table><br />
            ';
            $content .= '
              <p>Please '.implode(', ',array_filter(array($confirm, $handOut))).'.</p>
              ';
          } else {
            $content .= '<p>The player has not ordered any T-shirts. Ask the player if (s)he wants to buy T-shirts, and record any T-shirts sold <a href="'.__baseHref__.'/admin-tools/?tool=tshirt" target="_blank">here</a>.</p>';
          }
          $content .= 'If the player wants to buy (additional) T-shirts, it can be done <a href="'.__baseHref__.'/admin-tools/?tool=tshirt" target="_blank">here</a>.';
          $qualGroup = getQualGroupById($dbh, $player->mainQualGroup_id);
          $content .= '
            <br /><br /><h2 class="big">Qualification group and schedule:</h2>
            <p>The player is assigned to play in <span class="big">Group '.$qualGroup->shortName.' on '.$qualGroup->date.' at '.$qualGroup->startTime.'-'.$qualGroup->endTime.'</span></p>';
          if ($player->classics) {
            $qualGroup = getQualGroupById($dbh, $player->classicsQualGroup_id);
            $content .= '<p>The player is assigned to play Classics in <span class="big">Group '.$qualGroup->shortName.' on '.$qualGroup->date.' at '.$qualGroup->startTime.'-'.$qualGroup->endTime.'</span></p>';
          }
          $content .= '
            <p>Change qualification group assignments <a href="'.__baseHref__.'/admin-tools/?tool=qualGroup" target="_blank">here</a>.</p>
            <br /><h2 class="big">Team tournament:</h2>
          ';
          if ($team) {
            $content .= getInfo($dbh, 'team', $team->id, false).'
              <p>Have the player confirm that the team information is correct.<br />
              The team tournament qualification is scheduled for <span class="big">Saturday 2013-09-14 1300-1600</span> and finals at <span class="big">1600-1900</span>.</p>
            ';
          } else {
            '<p>The player is not a member of any team. The easiest way to register a team is for the player to login to the web site and create the team.</p>';
          }
          $content .= '
            <br /><h2 class="big">Volunteer schedule:</h2>
            <p>Under construction...</p>
          ';
        } else {
          $content .= 'Could not find the player with ID '.$playerId.'.';
        }
      } else {
        $content .= 'No or invalid player ID specified.';
      }
    } else {
      $content .= '</div>You do not have access to this page.';
    }
  }

  echo($content);
  printFooter($dbh, $ulogin);
  
?>
