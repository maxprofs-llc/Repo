{if $sSort == null}
	<tr>
		<td valign='top'>{#ENTRY_ID#} #<a href='player.php?iIDEntry={$aPlayers[section].id_entry}' >{$aPlayers[section].id_entry}</a> (<b>{$aPlayers[section].division_name_short}</b> {#DIVISION_SHORT#})</td>
    <td colspan='4' valign='top'>
  		{if $bIncludedFromAdmin	== true}
        {#QR#}: <a href='wap/entryPrinter.php?entryId={$aPlayers[section].id_entry}&autoPrint=true' target='_new'><img src='images/icons/qr.png' class='iconLink' alt='{#ADMIN_ENTRY_PRINT#}' title='{#ADMIN_ENTRY_PRINT#}' /></a>
      {/if}
    </td>
	</tr>
{/if}
	
{section name=entryRounds loop=$aPlayers[section].entry_rounds}

{if $aPlayers[section].entry_is_voided == true}
	{assign var="bIsVoided" value="true"}
{/if}

{if $smarty.section.entryRounds.iteration is odd}
	<tr class='lineDark' {#MOUSE_OVER_DARK#}>
{else}
	<tr {#MOUSE_OVER_DEFAULT#}>
{/if}
	
	<td><a href='game.php?iYear={$aPlayers[section].entry_rounds[entryRounds].player_year_entered}&amp;iIDGame={$aPlayers[section].entry_rounds[entryRounds].games_id_game}&amp;sDivision={$aPlayers[section].division_name_short}'>{$aPlayers[section].entry_rounds[entryRounds].game_name|truncate:38:"...":true}</a></td>

	<td align='right' style='padding-right:10px'>
	   	{if $aPlayers[section].entry_rounds[entryRounds].entry_round_score_game < 2}
	    	{#NA#}
    	{else}
			{* IF THE ENTRY ISN'T COUNTED, DISPLAY "N/A" *}
			{if $aPlayers[section].entry_rounds[entryRounds].entry_round_is_counted != 1}
				{#NA#}	
			{else}
		    	{$aPlayers[section].entry_rounds[entryRounds].score_game_output}
			{/if}
    	{/if}
	</td>
	
	<td>    
    {if $bIsVoided == true}
	    <i>{#VOID#}</i>
    {else}
	    {$aPlayers[section].entry_rounds[entryRounds].entry_round_position}
    {/if}
	</td>

	<td>
    {if $bIsVoided == true}
	    <i>{#VOID#}</i>
    {else}
	{$aPlayers[section].entry_rounds[entryRounds].entry_round_score_tournament}
	{/if}
	</td>

	<td>
	{if $aPlayers[section].entry_rounds[entryRounds].entry_round_is_counted != 1}
		{#NA#}
	{else}
		{$aPlayers[section].entry_rounds[entryRounds].entry_round_date_posted|truncate:16:"":true}
	{/if}
	</td>

	{if $sSort != null}
		<td><a href='player.php?iIDEntry={$aPlayers[section].entry_rounds[entryRounds].id_entry}'>{$aPlayers[section].entry_rounds[entryRounds].id_entry}</a></td>	
	{/if}
</tr>
{/section}

<tr>
	<td></td>
	<td></td>
	<td class='tableLabel'>{#TOTAL#}</td>
	<td>
	{if $bIsVoided == true}
		<i>{#VOID#}</i>
	{else}
		{$aPlayers[section].entry_score}
	{/if}
	</td>
	
	<td></td>
</tr>