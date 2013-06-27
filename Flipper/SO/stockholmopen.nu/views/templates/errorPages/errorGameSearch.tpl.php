{include file="elements/header.tpl.php" title=header}

<h2>{#GAME_SEARCH_HL#} - {#ERROR#}</h2>

{if $bNotFound == "true"}
	{#GAME_SEARCH_NOT_FOUND#}: <i>{$sGameSearch}</i>
{/if}

{if $bEmptyString == true}
	{#ERROR_PLEASE_ENTER_STRING_TO_SEARCH#}
{/if}

{if $bMultipleGames == "true"}
	{#GAME_SEARCH_MULTIPLE_GAMES#}: 
	{section name=section loop=$aSearchGames}
		<a href='searchGame.php?sGameSearch={$aSearchGames[section].game_name}&amp;bFromLink=true'>{$aSearchGames[section].game_name}</a>
	{/section}
{/if}

{if $bGameNull == "true"}
	{#GAME_SEARCH_NULL#}
{/if}

{include file="elements/footer.tpl.php" title=footer}