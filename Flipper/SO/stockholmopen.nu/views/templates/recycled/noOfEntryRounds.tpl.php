<table class='mainTable'>
	<tr>
		<td class='HL'>{#ROUNDS#}</td>
		<td class='HL'>{#GAME#}</td>
		<td class='HL'>{#BEST_SCORE#}</td>
		<td class='HL'>{#BY#}</td>
		<td class='HL'>{#COUNTRY#}</td>
	</tr>
	{section name=section loop=$aGameRounds}
		{assign var="bOutput" value=true}
		{if ($aGameRounds[section].highest_score.country_name != $sPrevCountry) && $bDisplayCountryHeadline == true}
			<tr>
				<td colspan='10' class='HL'>{$aGameRounds[section].highest_score.country_name}</td>
			</tr>
		{/if}
		
		{if $smarty.section.section.iteration is odd}
			<tr {#MOUSE_OVER_DEFAULT#}>
		{else}
			<tr class='lineDark' {#MOUSE_OVER_DARK#}>
		{/if}
	
		<td><b>{$aGameRounds[section].entry_round_count}</b></td>
		<td><a href='game.php?iYear={$iYear}&amp;iIDGame={$aGameRounds[section].id_game}&amp;sDivision={$sDivision}'>{$aGameRounds[section].game_name}</a></td>
		<td>{$aGameRounds[section].highest_score.score_highest_output}</td>
		<td><a href='player.php?iIDPlayer={$aGameRounds[section].highest_score.id_player}'>{$aGameRounds[section].highest_score.player_firstname} {$aGameRounds[section].highest_score.player_lastname}</a></td>
		{if $aGameRounds[section].highest_score.player_is_split_team == 1}
			<td><img src='images/icons/flags/{$aGameRounds[section].highest_score.split_1_country_code}.gif' alt='{$aGameRounds[section].highest_score.split_1_country_name}' title='{$aGameRounds[section].highest_score.split_1_country_name}' /> <img src='images/icons/flags/{$aGameRounds[section].highest_score.split_2_country_code}.gif' alt='{$aGameRounds[section].highest_score.split_2_country_name}' title='{$aGameRounds[section].highest_score.split_2_country_name}' /></td>
		{else}
			<td><img src='images/icons/flags/{$aGameRounds[section].highest_score.country_code}.gif' alt='{$aGameRounds[section].highest_score.country_name}' title='{$aGameRounds[section].highest_score.country_name}' /></td>
			{/if}

		{assign var="sPrevCountry" value=$aGameRounds[section].highest_score.country_name}
	</tr>
	{/section}

	{if $bOutput != true}
	<tr>
		<td colspan='5' align='center'>{#NO_DATA_FOUND#}</td>
	</tr>
	{/if}
</table>

