<?php

$s = $_GET['s'];

function undermenu($page)
  {
  
  echo "<p class=\"undermenu\">";
  
  if($page == "anmal")
     {echo "
     <a href=\"?s=funkis\">Funktion‰rsanm‰lan</a>";

  /* if($page == "anmal")
     {echo "
     <a href=\"?s=kvalschema\">Kvalschema</a> &middot; <a href=\"?s=anmal\">Anm‰lan</a> &middot; <a href=\"?s=anmalda\">Anm‰lda spelare</a> &middot; <a href=\"?s=anmaldaclassics\">Anm‰lda classics</a> &middot; <a href=\"?s=funkis\">Funktion‰r</a> &middot; <a href=\"?s=nyttfunkisschema\">Funkis-schema</a>";


      " // när man vill ha tillbaka kvalschemat
     <a href=\"?s=anmal\">Anm‰lan</a> &middot; <a href=\"?s=anmalda\">Anm‰lda spelare</a> &middot; <a href=\"?s=schema\">Kvalschema</a> &middot; <a href=\"?s=anmaldaclassics\">Anm‰lda classics</a> &middot; <a href=\"?s=funkis\">Funktion‰r</a>";
     
     */
	}
  if($page == "regler")
     {echo "
     <a href=\"?s=regler\">Regler</a> &middot; <a href=\"?s=system\">T‰vlingssystem</a> &middot; <a href=\"?s=former\">T‰vlingsformer & spellista</a>
     ";}
     
     
  if($page == "tidigare")
     {echo "<a href=\"?s=2010\">2010</a>  &middot; <a href=\"?s=2009\">2009</a> &middot; <a href=\"?s=2008\">2008</a> &middot; <a href=\"?s=2007\">2007</a> &middot; <a href=\"?s=2006\">2006</a> &middot; <a href=\"?s=2005\">2005</a> &middot; <a href=\"?s=2004\">2004</a> &middot; <a href=\"?s=2003\">2003</a> &middot; <a href=\"?s=90tal\">90-talet</a>
     ";}
     
  if($page == "resultat")
    /* {echo "<a href=\"?s=resultat2011\">Huvudt&auml;vling</a> &middot; <a href=\"?s=resultatclassics2011\">Classics</a> &middot; <a href=\"?s=11kvalspel\">Main per spel</a> &middot; <a href=\"?s=11classicskvalspel\">Classics per spel</a> <br> <a href=\"bilder/diverse/11slutspelmainA.png\">Slutspelstr‰d main A</a> &middot; <a href=\"bilder/diverse/11slutspelclassics.png\">
Slutspelstr‰d classics</a>
     ";} */

  echo "</p>";
 }
  
include("huvud.fil");





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
