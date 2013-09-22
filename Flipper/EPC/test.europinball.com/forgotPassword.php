<?php

  define('__ROOT__', dirname(__FILE__)); 
  require_once(__ROOT__.'/functions/general.php');
  
  printHeader('EPC 2013', __baseHref__);
  printTopper();
  
  $nonce = (isset($_REQUEST['nonce'])) ? $_REQUEST['nonce'] : false;
  $playerId = (isset($_REQUEST['player'])) ? $_REQUEST['player'] : false;

  function getPlayerFromNonce($dbh, $nonce) {
    $objs = getPlayers($dbh, 'where m.nonce = '.$nonce.' and m.tournamentDivision_id = 1');
    if ($objs && count($objs) == 1) {
      if (ulNonce::Verify('reset', $nonce)) {
        return $objs[0];
      } else {
        return false;
      }
    } else {
      return false;
    }
  }
  
  function sendResetEmail($dbh, $email) {
    if (validEmail($email)) {
      $nonce = ulNonce::Create('reset');
      $player->setNonce($dbh, $nonce);
      // send email with nonce link
      return true;
    } else {
      return false;
    }
  }
  
  $content = '<h2 class="entry-title">Password reset</h2>';

  if ($nonce) {
    $player = getPlayerFromNonce($dbh, $nonce);
    if ($player) {
      $content .= '<input type="hidden" name="person_id" id="personId" value="'.$player->id.'">'
      $content .= '<p>Your identity as username '.$player->username.' has been confirmed. Please set a new password: <input name="password" id="passwordPassword" type="password" onchange="checkResetPassword();"><span id="passwordSpan" class="errorSpan"></span></p>';
      // set password with ajax
      // Redirect to login in javascript
    } else {
      $content .= '<p>Your nonce has expired or is invalid.';
      if (validEmail($player->mailAddress)) {
        if (sendResetEmail($dbh, $player)) {
          $content .= 'We have sent a new email to the registered address for user '.$player->username.' - please click the link in that email.</p>';
        } else {
          $content .= 'Something went wrong trying to send you a password reset email. Please <a href="mailto:support@europinball.org">email us</a> for assistance.</p>';
        }
      } else {
        $content .= 'There\'s something wrong with the email address registered to you. Please <a href="mailto:support@europinball.org">email us</a> for assistance.</p>';
      }
    }
  } else {
    if (validEmail($player->mailAddress)) {
      if (sendResetEmail($dbh, $player->mailAddress)) {
  }
  

  /*
  if (checkLogin($dbh, $ulogin)) {
    echo 'Changing password...';
    echo $ulogin->SetPassword(161, 'chang3m3');
    echo $ulogin->SetPassword(167, 'chang3m3');
    echo "<br />\n";
  }
  */
  
//  deNorm($dbh);
  /*
  if ($nonce) {
    $player = getPlayerFromNonce($nonce);
    if ($player) {
      $expire = getExpire($player);
      
    } else {
      echo 
    }
  
  SELECT count(paid), sum(paid), sum(paid) / count(paid) FROM `player` WHERE 1
  
  
  }
  
  var_dump($_SESSION);
  echo $ulogin->SetPassword(83, 'chang3m3');
  
  */
?>