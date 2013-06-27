{include file="elements/header.tpl.php" title=header}

<h2>{#STOCKHOLM_OPEN#} - {$iYear} - {#STATS_AND_CHARTS#}</h2>

<p>
{#SELECT_YEAR#} {$sSelectYear}
</p>

<table>
<tr>
	<td class='tableLabel'>{#TOTAL_NUMBER_OF_PLAYERS#}</td>
	<td>{$aStats.total_no_of_players}</td>
</tr>
<tr>
	<td class='tableLabel'>{#NUMBER_OF_COUNTRIES_REPRESENTED#}</td>
	<td>{$aStats.countries.no_of_countries}</td>
</tr>
</table>

{section name=countries loop=$aStats.countries.country_name}
	{$aStats.countries.country_name[countries]} ({$aStats.countries.no_of_players[countries]}) 
{/section}

<table>
{section name=divisions loop=$aStats.divisions}
	{if $aStats.divisions[divisions].no_of_entries > 0}
		<tr>
			<td colspan='2'><h3>{$aStats.divisions[divisions].division_name_short} {#DIVISION#}</h3></td>
		</tr>
		<tr>
			<td colspan='2'><hr  /></td>
		</tr>
			<tr>
				{if $aStats.divisions[divisions].division_name_short != "S"}
					<td class='tableLabel'>{#NUMBER_OF_PLAYERS#}</td>
				{else}
					<td class='tableLabel'>{#NUMBER_OF_TEAMS#}</td>
				{/if}
				<td>{$aStats.divisions[divisions].no_of_players}</td>
			</tr>
			<tr>
				<td class='tableLabel'>{#NUMBER_OF_PLAYED_ENTRIES#}</td>
				<td>{$aStats.divisions[divisions].no_of_entries}</td>
			</tr>
			{*
			{assign var="dPercentage" value=$aStats.divisions[divisions].no_of_games/$aStats.divisions[divisions].no_of_voided_entries * 100}
			*}
			<tr>
				<td class='tableLabel'>{#NUMBER_OF_VOIDED_ENTRIES#}</td>
				<td>{$aStats.divisions[divisions].no_of_voided_entries} ({math equation="x/y*100" x=$aStats.divisions[divisions].no_of_voided_entries y=$aStats.divisions[divisions].no_of_entries format="%.1f"}%)</td>
			</tr>		
			<tr>
				<td class='tableLabel'>{#NUMBER_OF_GAMES_IN_QUALIFICATIONS#}</td>
				<td>{$aStats.divisions[divisions].no_of_games}</td>
			</tr>
			
			<tr>
				<td colspan='3'><a href='statsAvgEntry.php?iYear={$iYear}&amp;sDivision={$aStats.divisions[divisions].division_name_short}'>{#AVERAGE_ENTRY_SCORES#}</a></td>
			</tr>
			<tr>
				<td colspan='3'><a href='statsPopularGames.php?iYear={$iYear}&amp;sDivision={$aStats.divisions[divisions].division_name_short}'>{#MOST_POPULAR_GAMES#}</a></td>
			</tr>
			{* DON'T DISPLAY THIS FOR THE SPLIT-DIVISION *}
			{if $aStats.divisions[divisions].division_name_short != S}
				<tr>
					<td colspan='3'><a href='statsPopularGamesByCountry.php?iYear={$iYear}&amp;sDivision={$aStats.divisions[divisions].division_name_short}'>{#MOST_POPULAR_GAMES_BY_COUNTRY#}</a></td>
				</tr>
			{/if}
			<tr>
				<td colspan='3'><a href='statsNoOfDifferentGames.php?iYear={$iYear}&amp;sDivision={$aStats.divisions[divisions].division_name_short}'>{#PLAYERS_TEAMS_NO_OF_DIFF_GAMES#}</a></td>
			</tr>
			<tr>
				<td colspan='3'><a href='statsVoidedEntries.php?iYear={$iYear}&amp;sDivision={$aStats.divisions[divisions].division_name_short}'>{#NUMBER_OF_VOIDED_ENTRIES#}</a></td>
			</tr>
	{/if}
{/section}
</table>

{include file="elements/footer.tpl.php" title=footer}