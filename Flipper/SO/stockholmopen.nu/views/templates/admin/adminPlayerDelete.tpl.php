{include file="elements/header.tpl.php"}

<h2>{#ADMIN#}: {#ADMIN_DELETE_PLAYERS_TEAMS_HL#}</h2>

{if $bIsCompleted == "true"}
{#ADMIN_DELETE_PLAYERS_TEAMS_DELETED#}
{/if}

{if $bDisplayForm == true}
	{#ADMIN_DELETE_PLAYERS_TEAMS_CONF#}
	{include file="formsAdmin/form.entryAndPlayerDelete.tpl.php" title=delete}	
{/if}
{include file="elements/footer.tpl.php"}