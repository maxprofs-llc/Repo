{config_load file=lang/$sLang/config.$sLang.lang.php}
{config_load file=config.languages.php}
{config_load file=config.javascript.php}
{config_load file=config.inputs.php}

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>{#PAGE_TITLE#}</title>
<meta name="description" content="desc" />
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
<meta name="ROBOTS" content="NOODP" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/styleTables.css" type="text/css" />
<link rel="stylesheet" href="css/stylePopup.css" type="text/css" />
</head>
<body>

<h2>
{if $sDivision == "S"}
	{#REG_TEAMS_HL#}
{else}
	{#REG_PLAYERS_HL#}
{/if}
</h2>

{include file="recycled/playersAndStandings.tpl.php" title=footer}

</body>
</html>