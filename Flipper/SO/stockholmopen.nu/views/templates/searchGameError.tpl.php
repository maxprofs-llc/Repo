{include file="elements/header.tpl.php" title=header}

<h2>{#GAME_SEARCH_HL#}</h2>

{if $bNotFound == "true"}
	{#GAME_SEARCH_NOT_FOUND#}: <i>{$sGameSearch}</i>
{/if}

{if $bMultipleGames == "true"}
	{#GAME_SEARCH_MULTIPLE_GAMES#}: 
	{section name=section loop=$aSearchGames}
		<a href='searchGame.php?sGameSearch={$aSearchGames[section].game_name}&bFromLink=true'>{$aSearchGames[section].game_name}</a>
	{/section}
{/if}

{include file="elements/footer.tpl.php" title=footer}