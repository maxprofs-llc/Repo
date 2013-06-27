{config_load file=lang/$sLang/config.$sLang.lang.php}
{config_load file=config.javascript.php}

{section name=section loop=$aPlayers}
	<br />
	<table class='minor' width='500px'>
	{include file="recycled/entryRoundsHeadLines.tpl.php" title=entryRounds}
	{include file="recycled/entryRounds.tpl.php" title=entryRounds}
	</table>
{/section}
