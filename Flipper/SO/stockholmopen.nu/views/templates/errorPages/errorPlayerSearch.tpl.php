{include file="elements/header.tpl.php" title=header}

<h2>{#PLAYER_TEAM_SEARCH#} - {#ERROR#}</h2>

{if $bEmptyString == true}
	{#ERROR_PLEASE_ENTER_STRING_TO_SEARCH#}
{else}
	{#ERROR_PLAYER_TEAM_SEARCH_NOT_FOUND#} <i>{$sPlayerSearch}</i>
{/if}

{include file="elements/footer.tpl.php" title=footer}