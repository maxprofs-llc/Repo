{include file="elements/header.tpl.php" title=header}

<h2>{#STANDINGS_HL#} - {$iYear} - {$sDivision} {#DIVISION#}</h2>

{if $g_iYear == $iYear}
	{eval var=#STANDINGS_MAIN#}
{else}
	{eval var=#STANDINGS_MAIN_OLD#}
{/if}
<br /><br />
<a href='slide.php?bStart=true&amp;iYear={$iYear}&amp;bTotalAndGames=true'>{#STANDINGS_ALL_SLIDE#}</a> / <a href='slideTotal.php?iYear={$iYear}&amp;bStart=true'>{#STANDINGS_SLIDE#}</a>
<br />
<br />
{include file="recycled/playersAndStandings.tpl.php" title=footer}

{include file="elements/footer.tpl.php" title=footer}
