{include file="elements/header.tpl.php" title=header}

<h2>{#STATS_TOP_SCORES_HL#}</h2>
{#STATS_TOP_SCORES_MAIN#}
<br />
<br />

<h2>{#GAMES_PAGES#}:</h2>  
{section name=section loop=$aLinks}
	{$aLinks[section]}
{/section}

<br />
<br />
{#DISPLAY#} {$aInputs.iLimit.input} {#SCORES#}

<table class='mainTable'>
{section name=section loop=$aGames}
	<tr>
		<td colspan='7'><h3>{$aGames[section].game_name} ({$aGames[section].game_manufacturer_name})</h3></td>
	</tr>
	<tr>
		<td colspan='7'>{include file="recycled/gameStats.tpl.php" title=gameStats}</td>
	</tr>
	<tr>
		<td colspan='7'>
		{#GAME_YEARS_AND_DIVISIONS#}: 
		{section name='years' loop=$aGames[section].game_year_and_divisions}
			<a href='game.php?iYear={$aGames[section].game_year_and_divisions[years].git_year_in_tournament}&amp;iIDGame={$aGames[section].game_year_and_divisions[years].games_id_game}&amp;sDivision={$aGames[section].game_year_and_divisions[years].division_name_short}'>{$aGames[section].game_year_and_divisions[years].git_year_in_tournament} {$aGames[section].game_year_and_divisions[years].division_name_short} 	{#DIVISION_SHORT#}</a> 
		{/section}
		</td>
	</tr>
	{if $aGames[section].number_of_played_rounds > 0}
		<tr>
			<td class='HL' width='130'>{#SCORE#}</td>
			<td class='HL'></td>
			<td class='HL' width='50'></td>
			<td class='HL' width='170'>{#PLAYER_NAME#}</td>
			<td class='HL' width='70'>{#INITIALS#}</td>
			<td class='HL' width='90'>{#COUNTRY#}</td>
			<td class='HL' width='90'>{#ENTRY_ID#}</td>
			<td class='HL' width='90'>{#POINTS#}</td>
			<td class='HL' width='70'>{#YEAR#}</td>
			<td class='HL'>{#DIVISION#}</td>
		</tr>
	
		{section name=entryRounds loop=$aGames[section].entry_rounds}
			{* get the highest score *}
			{if $smarty.section.entryRounds.iteration == 1}
				{assign var="iHighestScore" value=$aGames[section].entry_rounds[entryRounds].entry_round_score_game}
			{/if}
			{if $smarty.section.entryRounds.iteration is odd}
				<tr {#MOUSE_OVER_DEFAULT#}>
			{else}
				<tr class='lineDark' {#MOUSE_OVER_DARK#}>
			{/if}
				<td>{$aGames[section].entry_rounds[entryRounds].score_game_output}</td>
				<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: 			{math equation="-34 + ((x / y) * 26)" x=$aGames[section].entry_rounds[entryRounds].entry_round_score_game y=$iHighestScore format="%d"}px 6px; margin-left: 10px;'><span class='small'>{math equation="x / y * 100" x=$aGames[section].entry_rounds[entryRounds].entry_round_score_game y=$iHighestScore format="%d"}%</span></td>
				<td>
				{if $aGames[section].entry_rounds[entryRounds].entry_is_voided == true}
					<i>{#VOID#}</i>
				{/if}
				</td>
				<td><a href='player.php?iIDPlayer={$aGames[section].entry_rounds[entryRounds].id_player}'>{$aGames[section].entry_rounds[entryRounds].player_firstname|truncate:24:"..."} {$aGames[section].entry_rounds[entryRounds].player_lastname}</a></td>
				<td><a href='player.php?iIDPlayer={$aGames[section].entry_rounds[entryRounds].id_player}'>{$aGames[section].entry_rounds[entryRounds].player_initials}</a></td>
		
					{if $aGames[section].entry_rounds[entryRounds].player_is_split_team == 1}
						<td><img src='images/icons/flags/{$aGames[section].entry_rounds[entryRounds].split_1_country_code}.gif' alt='{$aGames[section].entry_rounds[entryRounds].split_1_country_name}' title='{$aGames[section].entry_rounds[entryRounds].split_1_country_name}' /> <img src='images/icons/flags/{$aGames[section].entry_rounds[entryRounds].split_2_country_code}.gif' alt='{$aGames[section].entry_rounds[entryRounds].split_2_country_name}' title='{$aGames[section].entry_rounds[entryRounds].split_2_country_name}' /></td>
					{else}
						<td><img src='images/icons/flags/{$aGames[section].entry_rounds[entryRounds].country_code}.gif' alt='{$aGames[section].entry_rounds[entryRounds].country_name}' title='{$aGames[section].entry_rounds[entryRounds].country_name}' /></td>
					{/if}
				
				<td><a href="#" onclick="new Ajax.Updater('entry{$aGames[section].entry_rounds[entryRounds].id_entry_round}', 'ajax/displayEntry.php?iIDEntry={$aGames[section].entry_rounds[entryRounds].id_entry}'); return false;">{$aGames[section].entry_rounds[entryRounds].entries_id_entry}</a></td>
				<td><a href="#" onclick="new Ajax.Updater('entry{$aGames[section].entry_rounds[entryRounds].id_entry_round}', 'ajax/displayEntry.php?iIDEntry={$aGames[section].entry_rounds[entryRounds].id_entry}'); return false;">{$aGames[section].entry_rounds[entryRounds].entry_score}</a></td>				
				<td><a href='game.php?iYear={$aGames[section].entry_rounds[entryRounds].player_year_entered}&amp;iIDGame={$aGames[section].entry_rounds[entryRounds].games_id_game}&amp;sDivision={$aGames[section].entry_rounds[entryRounds].division_name_short}'>{$aGames[section].entry_rounds[entryRounds].player_year_entered}</a></td>
				<td><a href='game.php?iYear={$aGames[section].entry_rounds[entryRounds].player_year_entered}&amp;iIDGame={$aGames[section].entry_rounds[entryRounds].games_id_game}&amp;sDivision={$aGames[section].entry_rounds[entryRounds].division_name_short}'>{$aGames[section].entry_rounds[entryRounds].division_name_short}</a></td>
			</tr>
			{* POPULATED BY AN AJAX CALL *}
			<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry{$aGames[section].entry_rounds[entryRounds].id_entry_round}">
				</div>
				</td>
			</tr>
		{/section}
	{/if}
	
	{if $aGames[section].stats.no_of_played_entry_rounds > 0}
		<tr>
			<td align='center' colspan='15'><a href="#" onclick="new Ajax.Updater('game{$aGames[section].id_game}', 'ajax/gameHistogram.php?iIDGame={$aGames[section].id_game}'); return false;">{#GAME_VIEW_HIDE_HISTOGRAM#}</a></td>
		</tr>
	{/if}
	
	<tr>
		<td colspan='15'>
		<div id="game{$aGames[section].id_game}">
		</div>
		</td>
	</tr>			
	
{/section}
</table>

<br />
<br />
<h2>{#GAMES_PAGES#}:</h2>  
{section name=section loop=$aLinks}
	{$aLinks[section]}
{/section}

{include file="elements/footer.tpl.php" title=footer}