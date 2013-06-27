<table class='mainTable' style='text-align:left;'>
<tr>	
	{if $bDisplayEntryAverage == true}
		<td class='HL'>
		{#AVG#}
		</td>

		<td class='HL'>
		{#BEST#}
		</td>

		<td class='HL'>
		{#WORST#}
		</td>
	{/if}
	
	{if $bDisplayUniqueGames == true}
		<td class='HL'>
		{#NO_OF_GAMES#}
		</td>
	{/if}

	{if $bDisplayVoidedEntries == true}
		<td class='HL'>
		{#VOIDED#}
		</td>
	{/if}
		
	{if $bDisplayEntries == true}
	
		{* 071207: removing entry-position changes
		{if $bHidePositionChange != true}
			<td class='HL'>
		{/if}
		*}
		
		<td class='HL'>
		<!-- we only want to display the position if it's sorted by score -->
		{if $sSort == null || $sSort == "scoreDesc"} 
			{#POSITION_SHORT#}
		{/if}
		</td>
	
		{if ($sSort == null || $sSort == "scoreDesc") && $bIncludedFromSlide != "true"} 
			<td class='HLsortUp'>
		{else}
			<td class='HL'>
		{/if}
	
		{if $bDisableHLLinks != true}
			<a href='{$sLinkMain}&amp;sSort=scoreDesc'>{#POINTS#}</a>
		{else}
			{#POINTS#}
		{/if}	
		</td>
	{/if}
		
	{if $bDisplayIDs == true}
		<td class='HL'>{#ID#}</td>	
	{/if}
	
	{if $sSort == "nameAsc"} 
		<td class='HLsortDown'>
	{else}
		<td class='HL'>
	{/if}

	{if $bDisableHLLinks != true}
		<a href='{$sLinkMain}&amp;sSort=nameAsc'>{#NAME#}</a>
	{else}
		{#NAME#}
	{/if}
		
	</td>

	{if $sSort == "initialsAsc"} 
		<td class='HLsortDown'>
	{else}
		<td class='HL'>
	{/if}

	{if $bDisableHLLinks != true}
		<a href='{$sLinkMain}&amp;sSort=initialsAsc'>{#INITIALS#}</a>
	{else}
		{#INITIALS#}
	{/if}	
	</td>
	
	<!-- if it's the split division we can't sort on city -->
	{if $sDivision == "S"}
		<td class='HL'>
		{#CITY#}
	{else}
		{if $sSort == "cityAsc"} 
			<td class='HLsortDown'>
		{else}
			<td class='HL'>
		{/if}

		{if $bDisableHLLinks != true}
			<a href='{$sLinkMain}&amp;sSort=cityAsc'>{#CITY#}</a>
		{else}
			{#CITY#}
		{/if}
	{/if}
	</td>

	<!-- if it's the split division we can't sort on country -->
	{if $sDivision == "S"}
		<td class='HL'>
		{#COUNTRY#}
	{else}
		{if $sSort == "countryAsc"} 
			<td class='HLsortDown'>
		{else}
			<td class='HL'>
		{/if}

		{if $bDisableHLLinks != true}
			<a href='{$sLinkMain}&amp;sSort=countryAsc'>{#COUNTRY#}</a>
		{else}
			{#COUNTRY#}
		{/if}	
	{/if}
	</td>

	{if $bDisplayDivisions == true}
		<td class='HL'>{#DIVISION_SHORT#}</td>
	{/if}
		
	{if $bDisplayYears == true}
		<td class='HL'>{#YEAR#}</td>
	{/if}	
	
	
	{if $bDisplayEntries == true}
		<td class='HL'>
		{#ENTRY_ID#}
		</td>
		
		<td class='HL' colspan='{$aPlayers.0.entry_round_score|@count}'>
		{#ROUND_SCORES#}
		</td>

		<td class='HL'>
		{#LAST_UPDATE#}
		</td>
	{/if}

	{if $bDisplayEntries == true || $bDisplayEntryAverage == true || $bDisplayUniqueGames == true || $bDisplayVoidedEntries == true}
		{if $bDisableHLLinks != true}
			{if $sSort == "entriesDesc"} 
				<td class='HLsortUp'>
				<a href='{$sLinkMain}&amp;sSort=entriesAsc'>{#ENTRIES#}</a>				
				</td>
			{elseif $sSort == "entriesAsc"}
				<td class='HLsortDown'>
				<a href='{$sLinkMain}&amp;sSort=entriesDesc'>{#ENTRIES#}</a>
				</td>
			{else}	
				<td class='HL'>
				<a href='{$sLinkMain}&amp;sSort=entriesDesc'>{#ENTRIES#}</a>
				</td>
			{/if}
		{else}
			{if $bHideNoOfEntries != true}
				<td class='HL'>{#ENTRIES#}</td>
			{/if}
		{/if}	
	{/if}
	
	{if $bIncludedFromReg == true}
		{if $sSort == "dateDesc" || $sSort == null} 
			<td class='HLsortDown'>
		{else}
			<td class='HL'>
		{/if}
		
			{if $bDisableHLLinks != "true"}
				<a href='{$sLinkMain}&amp;sSort=dateDesc'>{#DATE_REGISTERED#}</a>
			{else}
				{#DATE_REGISTERED#}
			{/if}	
			</td>

		{if $bDivisionIsFree != 1}
			{if $sSort == "paid"} 
				<td class='HLsortDown'>
			{else}
				<td class='HL'>
			{/if}

			{if $bDisableHLLinks != "true"}	
				<a href='{$sLinkMain}&amp;sSort=paid'>{#PAID#}</a>
			{else}
				{#PAID#}
			{/if}
		{/if}
					
			</td>
	{/if}
	
	{if $bIncludedFromAdmin	== true}
	  <td class='HL'>{#QR#}</td>
  {/if}  
	{if $bDisplayEdit == "true"}
	  <td class='HL'>{#EDIT#}</td>
	{/if}
</tr>
<tr>
	<td colspan='16'></td>
</tr>
{section name=section loop=$aPlayers}

	{if $bIncludedFromSlide == "true"}
		{assign var="iPos" value=$smarty.section.section.iteration+$iPosStart}
	{else}
		{assign var="iPos" value=$smarty.section.section.iteration}
	{/if}

	{if $bDisplayDivisionHeadlines == "true" && $aPlayers[section].division_name_short != $sPrevDivision}
		<tr>
			<td colspan='12' class='HL'>{$aPlayers[section].division_name_short} {#DIVISION#}</td>
		</tr>
	{/if}

	{assign var="bDisplayBreak" value=false}
	{* FOR THE SLIDE ... *}
	{if $bIncludedFromSlide == "true"}
		{if $iPos == ($iNoOfPlayersInFinals+1)}
			{assign var="bDisplayBreak" value=true}
		{/if}
	{/if}
	
	{if ($smarty.section.section.iteration == ($iNoOfPlayersInFinals+1)) && $iNoOfPlayersInFinals != null}
		{assign var="bDisplayBreak" value=true}
	{/if}
	
	{if $bDisplayBreak == true && ($sSort == null || $sSort == "scoreDesc")}
		<tr>
			<td colspan='12'><hr /></td>
		</tr>
	{/if}
	
	{if $smarty.section.section.iteration is odd}
		<tr {#MOUSE_OVER_DEFAULT#}>
	{else}
		<tr class='lineDark' {#MOUSE_OVER_DARK#}>
	{/if}
	
	{if $bDisplayEntryAverage == true}
		<td><b>{$aPlayers[section].avg_entry_score}</b></td>
		<td>{$aPlayers[section].max_entry_score}</td>
		<td>{$aPlayers[section].min_entry_score}</td>
	{/if}

	{if $bDisplayUniqueGames == true}
		<td>
		<b>{$aPlayers[section].unique_game_count}</b>
		</td>
	{/if}

	{if $bDisplayVoidedEntries == true}
		<td>
		<b>{$aPlayers[section].no_of_voided_entries}</b>
		</td>
	{/if}
		
	{if $bDisplayEntries == "true"}
		{* 071207: removing position-changes *}
		{* {if $bHidePositionChange != true} *}
			{* <td> *}
			{* we only want to display the position-change if it's sorted by score *}
			{* {if $sSort == null || $sSort == "scoreDesc"} *}
				{* {if $aPlayers[section].entry_position_change > 5} *}
					{* <img src='images/icons/ratingN.gif' alt='' /> *}
				{* {elseif $aPlayers[section].entry_position_change > 0} *}
					{* <img src='images/icons/ratingNE.gif' alt='' /> *}
				{* {elseif $aPlayers[section].entry_position_change == 0} *}
					{* <img src='images/icons/ratingE.gif' alt='' /> *}
				{* {elseif $aPlayers[section].entry_position_change > -5} *}
					{* <img src='images/icons/ratingSE.gif' alt='' /> *}
				{* {else} *}
					{* <img src='images/icons/ratingS.gif' alt='' /> *}
				{* {/if} *}
			{* {/if} *}
			{* </td> *}
		{* {/if} *}
		
		<td align='center'>
		{* we only want to display the position if it's sorted by score *}
		{if $sSort == null || $sSort == "scoreDesc"}
			<b>{$iPos}</b>		
		{/if}
		</td>
		<td><b>{$aPlayers[section].entry_score}</b></td>
	{/if}

		{if $bDisplayIDs == true}
			<td>{$aPlayers[section].id_player}</td>
		{/if}
		
		<td>
			{if $bDisableLinks != true}
					{if $aPlayers[section].player_is_split_team == 1 && ($aPlayers[section].split_1_initials != null && $aPlayers[section].split_2_initials != null)}
						<a href='player.php?iIDPlayer={$aPlayers[section].id_player}'>{$aPlayers[section].player_firstname|truncate:26:"..."} {$aPlayers[section].player_lastname|truncate:16:"..."}</a> ({$aPlayers[section].split_1_initials} & {$aPlayers[section].split_2_initials})
					{else}
						<a href='player.php?iIDPlayer={$aPlayers[section].id_player}'>{$aPlayers[section].player_firstname|truncate:26:"..."} {$aPlayers[section].player_lastname|truncate:16:"..."}</a>
					{/if}
			{else}
					{if $aPlayers[section].player_is_split_team == 1 && ($aPlayers[section].split_1_initials != null && $aPlayers[section].split_2_initials != null)}
						{$aPlayers[section].player_firstname|truncate:26:"..."} {$aPlayers[section].player_lastname|truncate:16:"..."} ({$aPlayers[section].split_1_initials} & {$aPlayers[section].split_2_initials})
					{else}
						{$aPlayers[section].player_firstname|truncate:26:"..."} {$aPlayers[section].player_lastname|truncate:16:"..."}
					{/if}
			{/if}
			
		</td>
		
		<td>
			{if $bDisableLinks != true}	
				<a href='player.php?iIDPlayer={$aPlayers[section].id_player}'>{$aPlayers[section].player_initials}</a>
			{else}
				{$aPlayers[section].player_initials}
			{/if}				
		</td>

		{if $aPlayers[section].player_is_split_team == 1}
			<td>{$aPlayers[section].split_1_address_city|truncate:10:"..."} / {$aPlayers[section].split_2_address_city|truncate:10:"..."}</td>
			<td><img src='images/icons/flags/{$aPlayers[section].split_1_country_code}.gif' alt='{$aPlayers[section].split_1_country_name}' title='{$aPlayers[section].split_1_country_name}' /> <img src='images/icons/flags/{$aPlayers[section].split_2_country_code}.gif' alt='{$aPlayers[section].split_2_country_name}' title='{$aPlayers[section].split_2_country_name}' /></td>
		{else}
			<td>{$aPlayers[section].player_address_city|truncate:16:"..."}</td>
			<td><img src='images/icons/flags/{$aPlayers[section].country_code}.gif' alt='{$aPlayers[section].country_name}' title='{$aPlayers[section].country_name}' /></td>
		{/if}
		
		{if $bDisplayDivisions == true}
			<td>{$aPlayers[section].division_name_short}</td>
		{/if}

		{if $bDisplayYears == true}
			<td>{$aPlayers[section].player_year_entered}</td>
		{/if}

		{if $bDisplayEntries == true}
			<td><a href="#" onclick="new Ajax.Updater('entry{$aPlayers[section].id_entry}', 'ajax/displayEntry.php?iIDEntry={$aPlayers[section].id_entry}'); return false;">{$aPlayers[section].id_entry}</a></td>
			{section name=entryRounds loop=$aPlayers[section].entry_round_score}
			<td>
				<a href="#" onclick="new Ajax.Updater('entry{$aPlayers[section].id_entry}', 'ajax/displayEntry.php?iIDEntry={$aPlayers[section].id_entry}'); return false;">
				{if $aPlayers[section].entry_round_score[entryRounds] == 100}
					<b>{$aPlayers[section].entry_round_score[entryRounds]}</b>
				{else}
					{$aPlayers[section].entry_round_score[entryRounds]}
				{/if}
				</a>
			</td>		
			{/section}
			<td>{$aPlayers[section].entry_date_completed|truncate:16:"":true}</td>
		{/if}

		{if $bDisplayEntries == true || $bDisplayEntryAverage == true || $bDisplayUniqueGames == true || $bDisplayVoidedEntries == true}
			{if $bHideNoOfEntries != true}
				<td><a href='player.php?iIDPlayer={$aPlayers[section].id_player}'>{$aPlayers[section].dtp_no_of_played_entries}</a></td>
			{/if}		
		{/if}

		{if $bIncludedFromReg == true}
			<td>{$aPlayers[section].player_date_registered|truncate:10:"":true}</td>
			
			{if $bDivisionIsFree != 1}
				<td>
				{if $aPlayers[section].dtp_paid_fee == 1}
					X
				{/if}
				</td>
			{/if}
				
		{/if}

		{if $bIncludedFromAdmin	== true}
		  <td><a href='wap/playerPrinter.php?playerId={$aPlayers[section].id_player}&autoPrint=true' target='_new'><img src='images/icons/qr.png' alt='{#ADMIN_PLAYER_PRINT#}' title='{#ADMIN_PLAYER_PRINT#}' class='iconLink' /></a></td>    
    {/if}
		{if $bDisplayEdit == true}
			{if $aPlayers[section].division_name_short != "S"}			
				<td><a href='register.php?iIDEdit={$aPlayers[section].id_player}'><img src='images/icons/edit.gif' alt='{#EDIT#}' title='{#EDIT#}' class='iconLink' /></a></td>
			{else}
				<td><a href='registerSplit.php?iIDEdit={$aPlayers[section].id_player}'><img src='images/icons/edit.gif' alt='{#EDIT#}' title='{#EDIT#}' class='iconLink' /></a></td>
			{/if}	
		{/if}

		</tr>
		
		{* DISPLAY THE PLAYERS NAMES IF IT'S A SPLIT TEAM *}
		{if $aPlayers[section].is_split_team == 1}
			{if $smarty.section.section.iteration is odd}
				<tr {#MOUSE_OVER_DEFAULT#}>
			{else}
				<tr class='lineDark' {#MOUSE_OVER_DARK#}>
			{/if}
			{if $bDisplayEntries == true}
				{* ADD TWO CELLS *}
				<td></td>
				<td></td>
			{/if}	
			<td></td>
			<td></td>
			<td colspan='16'><a href='player.php?iIDPlayer={$aPlayers[section].split_1_id_player}' style='font-weight:normal'>{$aPlayers[section].split_1_firstname} {$aPlayers[section].split_1_lastname|truncate:20:"..."}</a> &amp; <a href='player.php?iIDPlayer={$aPlayers[section].split_2_id_player}' style='font-weight:normal'>{$aPlayers[section].split_2_firstname} {$aPlayers[section].split_2_lastname|truncate:20:"..."}</a></td>
		</tr>		
		{/if}
		
		{if $bDisplayEntries == true}		
			{* POPULATED BY AN AJAX CALL *}
			<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry{$aPlayers[section].id_entry}">
				</div>
				</td>
			</tr>
		{/if}
		{assign var="sPrevDivision" value=$aPlayers[section].division_name_short}
{/section}
</table>

{if $aPlayers == null}
	<center>
	{#NO_DATA_FOUND#}
	</center>
{/if}
