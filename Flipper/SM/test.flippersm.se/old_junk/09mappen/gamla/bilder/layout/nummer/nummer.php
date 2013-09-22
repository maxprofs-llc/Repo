<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
	<title>Untitled</title>
	<meta name="generator" content="BBEdit 8.2">
</head>
<body>

</body>
</html>

<?php

$i = 0;
    
while($i <= 9)
     {
     $bild[$i] = "<img src=\"$i.jpg\" alt=\"\" />";
     $nummer[$i] = $i;
     $i++;         
     }


$spamSlump = rand(11111, 99999);

$spamSlumpBilder = str_replace($nummer, $bild, $spamSlump);

echo "$spamSlumpBilder";

?>