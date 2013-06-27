<?php
  $to = "hassehulabeck@yahoo.se,the@pal.pp.se";
  $subject = "Flipperboksbeställning";
  $body = $_POST['fornamn'] . " (" . $_POST['tag'] . ") " . $_POST['efternamn'] . " har beställt " . $_POST['antal'] . " böcker!\n\nUppgifter: \nAdressrad 1: " . $_POST['adress1'] . "\nAdressrad 2: " . $_POST['adress2'] . "\nPostnummer: " . $_POST['postnummer'] . "\nOrt: " . $_POST['ort'] . "\nTelefon: " . $_POST['telefon'] . "\nE-post: " . $_POST['epost'] . "\nFrakt: " . $_POST['frakt'] . "\n";
  $headers = "From: " . $_POST['epost'] . "\r\nX-BOK: Yes";
  $to2 = $_POST['epost'];
  $subject2 = "Flipperårsboken";
  $body2 = "Hej!\n\nDu har precis beställt en bok som av framtida forskare kommer att nämnas i samma andetag som \"Skattkammarön\", \"Det blåser på månen\" och \"Chrusjtjov minns\". Men än är den inte din. Vi är nämligen så fräcka att vi vill ha betalt också.\n\nDu har beställt " . $_POST['antal'] . " böcker för sammanlagt " . $_POST['antal']*189 . " kr (eller " . $_POST['antal']*89 . " kr om du bidragit/bidrar till boken). Du kan välja mellan att betala via bank, till ett bankgiro, med PayPal eller med kreditkort.\n\nFör betalning via bank, sätt in pengarna på SEB 5012-0018861 (kontoinnehavare Hans Andersson).\nGlöm inte att ange din TAG!\n\nFör betalning till BG, sätt in pengarna på 5909-5182 (Stockholm Open / Patrik Bodin).\nGlöm inte att ange din TAG!\n\nFör betalning via PayPal, skicka pengarna till the@pal.pp.se, eller klicka här: http://www.stockholmopen.nu/flipperbok/betala.php?antal=" . $_POST['antal'] . "\nGlöm inte att ange din TAG!\n\nFör betalning med kreditkort, klicka här: http://www.stockholmopen.nu/flipperbok/betala.php?antal=" . $_POST['antal'] . "\nGlöm inte att ange din TAG!\n\nVi behöver få in betalningen senast 2008-10-31.\n";
  $headers2 = "From: flipperboken@stockholmopen.nu";
  if (mail($to, $subject, $body, $headers)) {
    mail($to2, $subject2, $body2, $headers2);
    header("Location: betala.php?antal=" . $_POST['antal']);
  } else {
    mail($to2, $subject2, $body2, $headers2);
    header("Location: fuck.html");
  }
?>
