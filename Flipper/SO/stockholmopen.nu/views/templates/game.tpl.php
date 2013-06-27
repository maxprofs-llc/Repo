{* ONLY INCLUDE THESE PARTS IF THE FILE ISN'T INCLUDED *}
{include file="elements/header.tpl.php" title=header}

{if $bInclude == null && $iIDGame == null && $bFromSearch != "true"}
	<h2>{#GAME_STANDINGS_HL#} - {$sDivision} {#DIVISION#} - {$iYear}</h2>
	{#GAME_STANDINGS_MAIN#}
{/if}

{$aYearsAndDivisions}

{if $bShowAll == "true" && $bFromSearch != "true" && $aLinks != null}
	<b>{#GAMES_PAGES#}:</b><br />
	{section name=section loop=$aLinks}
		{$aLinks[section]}
	{/section}	
	<br />
	<br />
	{#DISPLAY#} {$aInputs.iLimit.input} {#SCORES#}
{/if}

{if $aGames == null}
	{#ERROR_NO_GAMES_FOUND#}<br /><br />
{/if}

{section name=section loop=$aGames}

{* ONLY INCLUDE THESE PARTS IF THE FILE ISN'T INCLUDED *}
{if $bInclude == null}
	{* IF IT'S FROM THE SEARCH *}
	{if $bFromSearch == true}
		<h3><a href='game.php?iYear={$aGames[section].git_year_in_tournament}&amp;iIDGame={$aGames[section].id_game}&amp;sDivision={$aGames[section].division_name_short}'>{$aGames[section].game_name} ({$aGames[section].game_manufacturer_name}) - {$aGames[section].division_name_short} {#DIVISION#} - {$aGames[section].git_year_in_tournament}</a></h3>
	{else}
		<h3><a href='game.php?iYear={$iYear}&amp;iIDGame={$aGames[section].id_game}&amp;sDivision={$sDivision}'>{$aGames[section].game_name} ({$aGames[section].game_manufacturer_name}) - {$sDivision} {#DIVISION#} - {$iYear}</a></h3>
	{/if}
	{include file="recycled/gameStats.tpl.php" title=gameStats}	
	<br />
	{* DISPLAY PAST YEARS AND DIVISION LINKS *}
	{if $aGameYearsAndDivisions != null}
		{#GAME_OTHER_YEARS_AND_DIVISIONS#}: 	
		{section name=git loop=$aGameYearsAndDivisions}
			<a href='game.php?iYear={$aGameYearsAndDivisions[git].git_year_in_tournament}&amp;iIDGame={$iIDGame}&amp;sDivision={$aGameYearsAndDivisions[git].division_name_short}'>{$aGameYearsAndDivisions[git].git_year_in_tournament} {$aGameYearsAndDivisions[git].division_name_short} {#DIVISION_SHORT#}</a> 
	{/section}
	<br />
	<br />
	{/if}
{/if}

<table class='mainTable'>
{if ($bShowAll == true || $bInclude == true) && $aGames[section].no_of_played_entry_rounds != null}
	<tr>
		<td colspan='10' align='center'>
		{if $bFromSearch == "true"}
			{if $aGames[section].entry_rounds != null}
				<a href="game.php?iYear={$aGames[section].git_year_in_tournament}&amp;iIDGame={$aGames[section].id_game}&amp;sDivision={$aGames[section].division_name_short}">{#GAME_VIEW_ALL#}</a>
			{/if}
		{else}
			{if $aGames[section].entry_rounds != null}
				<a href="game.php?iYear={$iYear}&amp;iIDGame={$aGames[section].id_game}&amp;sDivision={$sDivision}">{#GAME_VIEW_ALL#}</a>
			{/if}
		{/if}
		</td>
	</tr>	
{/if}

{include file="recycled/gameHeadLines.tpl.php" title=game}
{if $aGames[section].entry_rounds == null}
	<tr>
		<td colspan='10' align='center'>{#NO_ENTRY_ROUNDS_FOUND#}</td>
	</tr>
{/if}

	{assign var="bDisplay" value="true"}
	
	{section name=entryRounds loop=$aGames[section].entry_rounds}
		
		{* TO LIMIT TO 10 DISPLAYED ENTRY ROUNDS IF WE SHOW ALL GAMES *}
		{if ($bShowAll == true || $bInclude == true) && $smarty.section.entryRounds.iteration > $iLimit}
			{assign var="bDisplay" value="false"}
		{/if}
		
		{* ALWAYS DISPLAY IF THE LIMIT IS SET TO NULL *}
		{if $iLimit == 0}
			{assign var="bDisplay" value="true"}
		{/if}
			
		{* get the highest score *}
		{if $smarty.section.entryRounds.iteration == 1}
			{assign var="iHighestScore" value=$aGames[section].entry_rounds[entryRounds].entry_round_score_game}
		{/if}
		
		{if $bDisplay == "true"}
			{include file="recycled/gameEntryRounds.tpl.php" title=gameRounds}
		{/if}
		
	{/section}
	{if $aGames[section].stats.no_of_played_entry_rounds > 0}
		<tr>
			{if $bFromSearch == true}	
				<td align='center' colspan='15'><a href="#" onclick="new Ajax.Updater('game{$aGames[section].id_game}{$aGames[section].git_year_in_tournament}{$aGames[section].division_name_short}', 'ajax/gameHistogram.php?iYear={$aGames[section].git_year_in_tournament}&amp;iIDGame={$aGames[section].id_game}&amp;sDivision={$aGames[section].division_name_short}'); return false;">{#GAME_VIEW_HIDE_HISTOGRAM#}</a></td>
			{else}
				<td align='center' colspan='15'><a href="#" onclick="new Ajax.Updater('game{$aGames[section].id_game}', 'ajax/gameHistogram.php?iYear={$iYear}&amp;iIDGame={$aGames[section].id_game}&amp;sDivision={$sDivision}'); return false;">{#GAME_VIEW_HIDE_HISTOGRAM#}</a></td>
			{/if}
		</tr>
	{/if}
</table>

{if $bFromSearch == true}
	<div id="game{$aGames[section].id_game}{$aGames[section].git_year_in_tournament}{$aGames[section].division_name_short}">
{else}
	<div id="game{$aGames[section].id_game}">
{/if}
</div>


{* ONLY WRITE THESE LINE BREAKS IF THE FILE ISN'T INCLUDED *}
{if $bInclude == null}
	<br />
{/if}

{/section}

{if $bShowAll == "true" && $bFromSearch != "true" && $aLinks != null}
	<b>{#GAMES_PAGES#}:</b><br />
	{section name=section loop=$aLinks}
		{$aLinks[section]}
	{/section}	
{/if}

{* ONLY INCLUDE THESE PARTS IF THE FILE ISN'T INCLUDED *}
{if $bInclude == null}
	{include file="elements/footer.tpl.php" title=footer}
{/if}