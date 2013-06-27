{include file="elements/header.tpl.php"}

<h2>{#ADMIN#}: {#ADMIN_DELETE_ENTRY_HL#}</h2>

{if $bIsCompleted == "true"}
	{#ADMIN_DELETE_ENTRY_DELETED#}
{else}
	<p>
	{#ADMIN_DELETE_ENTRY_NOTICE#}
	</p>	
{/if}

{if $bDisplayForm == true}
	{#ADMIN_DELETE_ENTRY_CONF#}

	{include file="formsAdmin/form.entryAndPlayerDelete.tpl.php" title=delete}
	
	<table class='minor' width='500px'>
		{include file="recycled/entryRoundsHeadLines.tpl.php" title=entryRounds}
	
		{section name=section loop=$aPlayers}
			{include file="recycled/entryRounds.tpl.php" title=entryRounds}
		{/section}
	</table>
{/if}
{include file="elements/footer.tpl.php"}