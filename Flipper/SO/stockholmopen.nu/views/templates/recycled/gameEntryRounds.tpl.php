{if $smarty.section.entryRounds.iteration is odd}
	<tr {#MOUSE_OVER_DEFAULT#}>
{else}
	<tr class='lineDark' {#MOUSE_OVER_DARK#}>
{/if}
	{if $bSlide == true}
		{assign var="iHighestScore" value=$aGames[section].stats.score_highest}
	{/if}
	
	{if $aGames[section].entry_rounds[entryRounds].entry_is_voided == 1}
		<td colspan='2'><i>{#VOID#}</i></td>
	{else}
		<td><b>{$aGames[section].entry_rounds[entryRounds].entry_round_position}</b></td>	
		<td><b>{$aGames[section].entry_rounds[entryRounds].entry_round_score_tournament}</b></td>	
	{/if}
	<td align='right' style='padding-right:10px;'>
	{if $aGames[section].entry_rounds[entryRounds].score_game_output == 1 || $aGames[section].entry_rounds[entryRounds].score_game_output == 0 || $aGames[section].entry_rounds[entryRounds].entry_round_is_counted == 0}
		{#NA#}
	{else}
		{$aGames[section].entry_rounds[entryRounds].score_game_output}
	{/if}
	</td>	
	{if $aGames[section].entry_rounds[entryRounds].score_game_output == 1 || $aGames[section].entry_rounds[entryRounds].score_game_output == 0 || $aGames[section].entry_rounds[entryRounds].entry_round_is_counted == 0}
		<td></td>
	{else}
		{* DON'T DISPLAY THE PERCENTAGE IF IT'S VOIDED *}	
		{if $aGames[section].entry_rounds[entryRounds].entry_is_voided != 1}
			<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: {math equation="-34 + ((x / y) * 26)" x=$aGames[section].entry_rounds[entryRounds].entry_round_score_game y=$iHighestScore format="%d"}px 6px; margin-left: 10px;'><span class='small'>{math equation="x / y * 100" x=$aGames[section].entry_rounds[entryRounds].entry_round_score_game y=$iHighestScore format="%d"}%</span></td>
		{else}
			<td></td>
		{/if}	
	{/if}
	<td><a href='player.php?iIDPlayer={$aGames[section].entry_rounds[entryRounds].id_player}'>{$aGames[section].entry_rounds[entryRounds].player_firstname|truncate:36:"..."} {$aGames[section].entry_rounds[entryRounds].player_lastname}</a></td>	
	<td>{$aGames[section].entry_rounds[entryRounds].player_initials}</td>	
		{if $aGames[section].entry_rounds[entryRounds].player_is_split_team == 1}
			<td><img src='images/icons/flags/{$aGames[section].entry_rounds[entryRounds].split_1_country_code}.gif' alt='{$aGames[section].entry_rounds[entryRounds].split_1_country_name}' title='{$aGames[section].entry_rounds[entryRounds].split_1_country_name}' /> <img src='images/icons/flags/{$aGames[section].entry_rounds[entryRounds].split_2_country_code}.gif' alt='{$aGames[section].entry_rounds[entryRounds].split_2_country_name}' title='{$aGames[section].entry_rounds[entryRounds].split_2_country_name}' /></td>
		{else}
			<td><img src='images/icons/flags/{$aGames[section].entry_rounds[entryRounds].country_code}.gif' alt='{$aGames[section].entry_rounds[entryRounds].country_name}' title='{$aGames[section].entry_rounds[entryRounds].country_name}' /></td>
		{/if}
	<td><a href="#" onclick="new Ajax.Updater('entry{$aGames[section].entry_rounds[entryRounds].id_entry_round}', 'ajax/displayEntry.php?iIDEntry={$aGames[section].entry_rounds[entryRounds].id_entry}'); return false;">{$aGames[section].entry_rounds[entryRounds].id_entry}</a></td>

	<td>
	{if $aGames[section].entry_rounds[entryRounds].entry_is_voided != 1}
		<a href="#" onclick="new Ajax.Updater('entry{$aGames[section].entry_rounds[entryRounds].id_entry_round}', 'ajax/displayEntry.php?iIDEntry={$aGames[section].entry_rounds[entryRounds].id_entry}'); return false;">{$aGames[section].entry_rounds[entryRounds].entry_score}</a></td>
	{else}
		<i>{#VOID#}</i>
	{/if}
	<td>
	{if $aGames[section].entry_rounds[entryRounds].entry_round_is_counted != 1}
		{#NA#}
	{else}
		{$aGames[section].entry_rounds[entryRounds].entry_round_date_posted|truncate:16:"":true}
	{/if}
	
	</td>	
</tr>
{* POPULATED BY AN AJAX CALL *}
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry{$aGames[section].entry_rounds[entryRounds].id_entry_round}">
	</div>
	</td>
</tr>
