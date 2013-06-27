{include file="elements/header.tpl.php" title=header}

<script type="text/javascript" src="javascript/statsVoidedEntries.js"></script>

<h2>{#STATS_VOIDED_ENTRIES_HL#} - {$iYear} - {$sDivision} {#DIVISION#}</h2>
<p>
{#SELECT_YEAR#} {$sJavascriptSelectYear} {#OR#} {#SELECT_DIVISION#} {$sJavascriptSelectDivision}
</p>
{#STATS_VOIDED_ENTRIES_MAIN#}
<br />
<br />
{include file="recycled/playersAndStandings.tpl.php" title=footer}

{include file="elements/footer.tpl.php" title=footer}
