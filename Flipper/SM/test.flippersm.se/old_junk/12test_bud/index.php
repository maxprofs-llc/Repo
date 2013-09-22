<?php

$s = $_GET['s'];

function undermenu($page)
  {
  
  echo "<p class=\"undermenu\">";
  
  if($page == "anmal")
     {echo "
     <a href=\"?s=anmal2012\">Anmälan ordinarie & U18</a> &middot; <a href=\"?s=anmal_small_family\">Anmälan liten familj</a> &middot; <a href=\"?s=anmal_big_family\">Anmälan stor familj</a> &middot; <a href=\"?s=anmalda\">Anmälda spelare</a>";

  /* if($page == "anmal")
     {echo "
     <a href=\"?s=kvalschema\">Kvalschema</a> &middot; <a href=\"?s=funkis\">Funktionär</a> &middot; <a href=\"?s=nyttfunkisschema\">Funkis-schema</a>";


      " // nŠr man vill ha tillbaka kvalschemat
     <a href=\"?s=anmal\">Anmälan</a> &middot; <a href=\"?s=anmalda\">Anmälda spelare</a> &middot; <a href=\"?s=schema\">Kvalschema</a> &middot; <a href=\"?s=anmaldaclassics\">Anmälda classics</a> &middot; <a href=\"?s=funkis\">Funktionär</a>";
     
     */
	}
  if($page == "regler")
     {echo "
     <a href=\"?s=regler\">Regler</a> &middot; <a href=\"?s=system\">Tävlingssystem</a> &middot; <a href=\"?s=former\">Tävlingsformer & spellista</a>
     ";}
     
  if($page == "blandat")
	{echo "<a href=\"?s=blandat\">Är flipper lagligt?</a> &middot; <a href =\"?s=stories\">Berättelser</a> &middot; <a href = \"?s=stories2\">Fler berättelser</a>";}

     
  if($page == "tidigare")
     {echo "<a href = '?s=2011'>2011</a> &middot;  <a href=\"?s=2010\">2010</a> &middot; <a href=\"?s=2009\">2009</a> &middot; <a href=\"?s=2008\">2008</a> &middot; <a href=\"?s=2007\">2007</a> &middot; <a href=\"?s=2006\">2006</a> &middot; <a href=\"?s=2005\">2005</a> &middot; <a href=\"?s=2004\">2004</a> &middot; <a href=\"?s=2003\">2003</a> &middot; <a href=\"?s=90tal\">90-talet</a>
     ";}
     
  if($page == "resultat")
    /* {echo "<a href=\"?s=resultat2011\">Huvudt&auml;vling</a> &middot; <a href=\"?s=resultatclassics2011\">Classics</a> &middot; <a href=\"?s=11kvalspel\">Main per spel</a> &middot; <a href=\"?s=11classicskvalspel\">Classics per spel</a> <br> <a href=\"bilder/diverse/11slutspelmainA.png\">Slutspelsträd main A</a> &middot; <a href=\"bilder/diverse/11slutspelclassics.png\">
Slutspelsträd classics</a>
     ";} */

  if($page == "kvaltider")
	echo "<a href=\"?s=kvaltider\">Kvaltider</a>";

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
