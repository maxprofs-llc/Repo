{include file="elements/header.tpl.php"}

<h2>{#LOGIN_HL#}</h2>

{if $bIsPosted != true && $g_bIsLoggedIn != true}
	{#LOGIN_MAIN#}
{/if}

{if $bIsLoggedIn == false}
	{include file="forms/form.login.tpl.php"}
{else}
	{#YOU_ARE_LOGGED_IN#}
{/if}

{include file="elements/footer.tpl.php"}