<?php

$s = $_GET['s'];

function undermenu($page)
  {
  
  echo "<p class=\"undermenu\">";
  
  if($page == "anmal")
     {echo "
     <a href=\"?s=anmal2012\">Anm�lan ordinarie & U18</a> &middot; <a href=\"?s=anmal_small_family\">Liten familj</a> &middot; <a href=\"?s=anmal_big_family\">Stor familj</a> &middot; <a href=\"?s=anmalda\">Anm�lda spelare</a><br /><a href = '?s=funkis2012'>Bli funktion�r</a> &middot; <a href = '?s=funkislista'>Dessa �r funktion�rer</a> &middot;  <a href=\"?s=ko\">K�lista</a>";
	}

  if($page == "regler")
     {echo "
     <a href=\"?s=regler\">Regler</a> &middot; <a href=\"?s=system\">T�vlingssystem</a> &middot; <a href=\"?s=former\">T�vlingsformer & spellista</a>
     ";}
     
  if($page == "blandat")
	{echo "<a href=\"?s=blandat\">�r flipper lagligt?</a> &middot; <a href =\"?s=stories\">Ber�ttelser</a> &middot; <a href = \"?s=stories2\">Fler ber�ttelser</a>";}

     
  if($page == "tidigare")
     {echo "<a href = '?s=2011'>2011</a> &middot;  <a href=\"?s=2010\">2010</a> &middot; <a href=\"?s=2009\">2009</a> &middot; <a href=\"?s=2008\">2008</a> &middot; <a href=\"?s=2007\">2007</a> &middot; <a href=\"?s=2006\">2006</a> &middot; <a href=\"?s=2005\">2005</a> &middot; <a href=\"?s=2004\">2004</a> &middot; <a href=\"?s=2003\">2003</a> &middot; <a href=\"?s=90tal\">90-talet</a>
     ";}
     
  if($page == "resultat")
    /* {echo "<a href=\"?s=resultat2011\">Huvudt&auml;vling</a> &middot; <a href=\"?s=resultatclassics2011\">Classics</a> &middot; <a href=\"?s=11kvalspel\">Main per spel</a> &middot; <a href=\"?s=11classicskvalspel\">Classics per spel</a> <br> <a href=\"bilder/diverse/11slutspelmainA.png\">Slutspelstr�d main A</a> &middot; <a href=\"bilder/diverse/11slutspelclassics.png\">
Slutspelstr�d classics</a>
     ";} */

  if($page == "kvaltider")
	echo "<a href=\"?s=kvaltider\">Kvaltider</a>";

  echo "</p>";
 }
  
include("head.fil");


include("menu.fil");



   if($s == "")
      {
      @include("pages/start.fil");
      }
   else
      {
      $filnamn = str_replace(":", "", $s);
      @include("pages/$filnamn".".fil");
      }
      
include("footer.fil");

?>
