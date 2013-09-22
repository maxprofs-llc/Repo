<?php

$filename = "projektor.lst";
$myData = file($filename);
$dataCount = sizeof($myData);

$url = substr(strrchr(ltrim($HTTP_SERVER_VARS["PHP_SELF"], "/"), '/'), 1 );
$url2 .= "?" . $HTTP_SERVER_VARS["QUERY_STRING"];



for($c = 0; $c < $dataCount; $c++)
    {
    $thisFile = explode(" | ",$myData[$c]);
    if(!strcasecmp($thisFile[0],$url . $url2))
        {
        if($c+1 == $dataCount)  {
            $nextIndex = 0;  }
        else  {
            $nextIndex = $c+1;  }
        
        $nextFile = explode(" | ",$myData[$nextIndex]);
        echo  "<META HTTP-EQUIV=\"Refresh\" Content= \"" . rtrim($thisFile[1],"\n") . "; URL=" . $nextFile[0] . "\">";
        }
    }

php?>