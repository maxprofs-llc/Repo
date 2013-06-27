{include file="elements/header.tpl.php" title=header}

<script type="text/javascript" src="javascript/statsMachinesByCountry.js"></script>

<h2>{#STATS_POPULAR_GAMES_BY_COUNTRY_HL#} - {$iYear} - {$sDivision} {#DIVISION#}</h2>
<p>
{#SELECT_YEAR#} {$sJavascriptSelectYear} {#OR#} {#SELECT_DIVISION#} {$sJavascriptSelectDivision}
</p>
{#STATS_POPULAR_GAMES_BY_COUNTRY_MAIN#}
<br />
<br />

{include file="recycled/noOfEntryRounds.tpl.php" title=entryRounds}

{include file="elements/footer.tpl.php" title=footer}
