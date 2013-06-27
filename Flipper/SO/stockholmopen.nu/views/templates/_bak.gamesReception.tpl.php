{include file="elements/header.tpl.php" title=header}

<h2>{#GAMES_HL#}</h2>


{section name=section loop=$aDivisions}

	{$aDivision.division_name_short}
	!<br />
{/section}


{include file="elements/footer.tpl.php" title=footer}