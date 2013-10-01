<?php
  define('__ROOT__', dirname(__FILE__));
  require_once(__ROOT__.'/functions/general.php');

$s = isset($_GET['s']) ? $_GET['s'] : 'start';

function undermenu($page)
  {
  
  if($page == "anmal")
     {echo "
     <a href=\"?s=anmal\">Anm�lan</a> <a href=\"?s=anmalda\">Anm�lda spelare</a><a href = '?s=funktionar'>Bli funktion�r</a>";
	}

  if($page == "regler")
     {echo "
     <a href=\"?s=regler\">Regler</a> <a href=\"?s=system\">T�vlingssystem</a><a href=\"?s=former\">T�vlingsformer & spellista</a>
     ";}
     
  if($page == "blandat")
	{echo "<a href=\"?s=blandat\">�r flipper lagligt?</a> <a href =\"?s=stories\">Ber�ttelser</a> <a href = \"?s=stories2\">Fler ber�ttelser</a>";}

     
  if($page == "tidigare")
     {echo "<a href = '?s=2011'>2011</a>  <a href=\"?s=2010\">2010</a> <a href=\"?s=2009\">2009</a> <a href=\"?s=2008\">2008</a> <a href=\"?s=2007\">2007</a> <a href=\"?s=2006\">2006</a> <a href=\"?s=2005\">2005</a> <a href=\"?s=2004\">2004</a> <a href=\"?s=2003\">2003</a> <a href=\"?s=90tal\">90-talet</a>
     ";}
     
  if($page == "resultat")
    /* {echo "<a href=\"?s=resultat2011\">Huvudt&auml;vling</a> &middot; <a href=\"?s=resultatclassics2011\">Classics</a> &middot; <a href=\"?s=11kvalspel\">Main per spel</a> &middot; <a href=\"?s=11classicskvalspel\">Classics per spel</a> <br> <a href=\"bilder/diverse/11slutspelmainA.png\">Slutspelstr�d main A</a> &middot; <a href=\"bilder/diverse/11slutspelclassics.png\">
Slutspelstr�d classics</a>
     ";} */

  if($page == "kvaltider")
	echo "<a href=\"?s=kvaltider\">Kvaltider</a>";

 }

function submenu2($category)
  {
  
  echo "<p class=\"submenu2\">";
  
  if($category == "anmalan")
     {echo "
     <a href=\"?s=anmal\">Anm�lan ordinarie & U18</a> <a href=\"?s=anmal_small_family\">Liten familj</a> <a href=\"?s=anmal_big_family\">Stor familj</a>";
	}

  if($category == "anmalda")
     {echo "
      <a href=\"?s=anmalda\">Anm�lda spelare</a><br /> <a href=\"?s=ko\">K�lista</a>
     ";}
     
  if($category == "funktionar")
	{echo "<a href = '?s=funktionar'>Bli funktion�r</a> <a href = '?s=funkislista'>Dessa �r funktion�rer</a>";}

     
  if($category == "tidigare")
     {echo "<a href = '?s=2011'>2011</a>  <a href=\"?s=2010\">2010</a> <a href=\"?s=2009\">2009</a> <a href=\"?s=2008\">2008</a> <a href=\"?s=2007\">2007</a> <a href=\"?s=2006\">2006</a> <a href=\"?s=2005\">2005</a> <a href=\"?s=2004\">2004</a> <a href=\"?s=2003\">2003</a> <a href=\"?s=90tal\">90-talet</a>
     ";}
     
  if($category == "resultat")
    /* {echo "<a href=\"?s=resultat2011\">Huvudt&auml;vling</a> &middot; <a href=\"?s=resultatclassics2011\">Classics</a> &middot; <a href=\"?s=11kvalspel\">Main per spel</a> &middot; <a href=\"?s=11classicskvalspel\">Classics per spel</a> <br> <a href=\"bilder/diverse/11slutspelmainA.png\">Slutspelstr�d main A</a> &middot; <a href=\"bilder/diverse/11slutspelclassics.png\">
Slutspelstr�d classics</a>
     ";} */

  if($page == "kvaltider")
	echo "<a href=\"?s=kvaltider\">Kvaltider</a>";

  echo "</p>";
 }


include("huvud.fil");

function print_payment_info()
	{
        echo "<h3>Kontouppgifter</h3>\n";
	    echo "<p>SEB: 5001 03768 01<br/>\n";
        echo "Kontoinnehavare: Hans Andersson<br/>\n";
        echo "<p>Spar en kopia p&aring; din inbetalning. Ange <b>enbart</b> TAG p&aring; avs&auml;ndare. Vet du med dig att du har samma TAG som en annan deltagare kan du skicka ett mail till <a href=\"mailto:hans@hulabeck.se\">hans@hulabeck.se</a> n&auml;r du gjort din inbetalning s&aring; att vi bockar f&ouml;r r&auml;tt person som betalande.</p>\n\n";
        
        echo "<p><b>OBS!</b> Det �r de f�rsta 210 personerna som B�DE anm�ler sig och betalar som f�r plats, och det �r de 42 f�rsta per pass som b�de anm�ler sig och betalar som f�r sin kval�nskan igenom! F�r att se om din betalning registrerats, kan du kolla p� <a href='?s=anmalda'>anm�lda-sidan</a>. Eftersom detta sker manuellt, kan det ta ett par dagar innan din betalning syns p� hemsidan.</p>\n\n";
        
        echo "<p>Kontaktperson vid fr&aring;gor om anm&auml;lan: <a href='mailto:hans@hulabeck.se'>Hans Andersson</a></p>\n";
	}


   if($s == "")
      {
      @include("start.fil");
      }
   else
      {
      $filnamn = str_replace(":", "", $s);
      @include("$filnamn".".fil");
      }
      
include("fot.fil");

?>
