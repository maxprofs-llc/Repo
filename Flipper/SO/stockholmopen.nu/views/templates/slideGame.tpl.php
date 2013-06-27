{include file="elements/headerSlide.tpl.php" title=header}

<center>
{section name=section loop=$aGames}
	<h2>{$aGames[section].game_name} ({$aGames[section].game_manufacturer_name}) - {$sDivision} {#DIVISION#} - {$iYear}</h2>
	{include file="recycled/gameStats.tpl.php" title=gameStats}
	<br />
	<table class='mainTable' style='text-align: left;'>
	{include file="recycled/gameHeadLinesSlide.tpl.php" title=game}
	{section name=entryRounds loop=$aGames[section].entry_rounds}
		{include file="recycled/gameEntryRounds.tpl.php" title=gameRounds}
	{/section}
	</table>
{/section}
</center>
{include file="recycled/javascript.slide.tpl.php"}

{include file="elements/footerSlide.tpl.php" title=footer}