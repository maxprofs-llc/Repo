{* ONLY INCLUDE THESE PARTS IF THE FILE ISN'T INCLUDED *}
{include file="elements/header.tpl.php" title=header}

{$aYearsAndDivisions}

{if $bShowAll == "true"}
	<h3>{#GAMES_PAGES#}:</h3>  
	{section name=section loop=$aLinks}
		{$aLinks[section]}
	{/section}	
	<br />	
	<br />	
	{#DISPLAY#} {$aInputs.iLimit.input} {#SCORES#}
	<br />
	<br />
{/if}

{section name=section loop=$aGames}

{* ONLY INCLUDE THESE PARTS IF THE FILE ISN'T INCLUDED *}
{if $bInclude == null}
	<a href='game.php?iYear={$iYear}&amp;iIDGame={$aGames[section].id_game}&amp;sDivision={$sDivision}'><h2>{$aGames[section].game_name} ({$aGames[section].game_manufacturer_name}) - {$sDivision} {#DIVISION#} - {$iYear} !!</h2></a>
	{include file="recycled/gameStats.tpl.php" title=gameStats}
	<br />
	{* DISPLAY PAST YEARS AND DIVISION LINKS *}
	{if $aGameYearsAndDivisions != null}
		{#GAME_OTHER_YEARS#}: 	
		{section name=git loop=$aGameYearsAndDivisions}
			<a href='game.php?iYear={$aGameYearsAndDivisions[git].git_year_in_tournament}&amp;iIDGame={$iIDGame}&amp;sDivision={$aGameYearsAndDivisions[git].division_name_short}'>{$aGameYearsAndDivisions[git].git_year_in_tournament} {$aGameYearsAndDivisions[git].division_name_short} {#DIVISION_SHORT#}</a> 

		{/section}
	<br />
	<br />
	{/if}
{/if}
	
<table class='mainTable'>
{if $bShowAll == true || $bInclude == true}
	<tr>
		<td colspan='10' align='center'><a href="game.php?iYear={$iYear}&amp;iIDGame={$aGames[section].id_game}&amp;sDivision={$sDivision}">{#GAME_VIEW_ALL#}</a></td>
	</tr>
{/if}

{include file="recycled/gameHeadLines.tpl.php" title=game}
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
			
		{if $bDisplay == "true"}
			{include file="recycled/gameEntryRounds.tpl.php" title=gameRounds}			
		{/if}
	{/section}
	
</table>

{* ONLY WRITE THESE LINE BREAKS IF THE FILE ISN'T INCLUDED *}
{if $bInclude == null}
	<br />
	<br />
{/if}

{/section}

{if $bShowAll == "true"}
	<h3>{#GAMES_PAGES#}:</h3>  
	{section name=section loop=$aLinks}
		{$aLinks[section]}
	{/section}
{/if}
	
{* ONLY INCLUDE THESE PARTS IF THE FILE ISN'T INCLUDED *}
{if $bInclude == null}
	{include file="elements/footer.tpl.php" title=footer}
{/if}