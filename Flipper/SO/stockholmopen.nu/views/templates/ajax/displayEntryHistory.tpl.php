{config_load file=lang/$sLang/config.$sLang.lang.php}
{config_load file=config.javascript.php}

<h3>{#ENTRY_HISTORY#}</h3>
<table class='minor' width='500px'>
<tr>
	<td class='HL'>{#DATE#}</td>
	<td class='HL'>{#ACTION#}</td>
	<td class='HL'>{#ROUND_NO#}#</td>
	<td class='HL'>{#USER#}</td>			
</tr>

{section name=section loop=$aEntryHistory}
	<tr class='underLine'>
		<td>{$aEntryHistory[section].date|truncate:16:"":true}</td>
		<td>
		{if $aEntryHistory[section].action == "entryRoundGameUpdate"}
			{#ROUND_GAME_CHANGE#}
		{elseif $aEntryHistory[section].action == "entryRoundScoreUpdate"}
			{#ROUND_SCORE_UPDATE#}
		{elseif $aEntryHistory[section].action == "entryPosted"}
			{#ENTRY_POSTED#}
		{elseif $aEntryHistory[section].action == "entryVoided"}
			{#ENTRY_VOIDED#}			
		{elseif $aEntryHistory[section].action == "entryUnvoided"}
			{#ENTRY_UNVOIDED#}			
		{/if}		
		</td>
		<td>{$aEntryHistory[section].roundNumber}</td>
		<td>{$aEntryHistory[section].username}</td>
	</tr>

{/section}
</table>
<br />
<br />