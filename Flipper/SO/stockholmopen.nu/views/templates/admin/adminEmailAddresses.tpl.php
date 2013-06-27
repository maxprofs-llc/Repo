{include file="elements/header.tpl.php"}

<h2>{#ADMIN#}: {#ADMIN_PLAYER_EMAIL_HL#}</h2>

{#ADMIN_PLAYER_EMAIL_MAIN#}
<br />
<br />
{#DISPLAY#} {$aInputs.iYear.input} {#EMAIL_ADDRESSES#}
<br />
<br />

{assign var="iCount" value=$aPlayers|@count}

{section name=section loop=$aPlayers}
	{if $aPlayers[section].player_email != null}
		{$aPlayers[section].player_email}{if $smarty.section.section.iteration < $iCount},{/if}
	{/if}
{/section}

{if $aPlayers == null}
	{#ERROR_NO_EMAIL#}
{/if}

	
{include file="elements/footer.tpl.php"}