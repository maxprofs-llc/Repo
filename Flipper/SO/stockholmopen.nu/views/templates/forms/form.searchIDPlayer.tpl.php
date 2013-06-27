{if $iIDPlayerSearch == null}
	{assign var="sPreSearch" value=#PLAYER_ID#"}
{else}
	{assign var="sPreSearch" value=$iIDPlayerSearch}
{/if}

<form action='player.php' method='get'>
<input type='text' class='tight' size='13' maxlength='10' name='iIDPlayerSearch' id='iIDPlayerSearch' value='{$sPreSearch}' {literal}onfocus="clearInput('iIDPlayerSearch')"{/literal} />
<input type='submit' class='tight' value='{#SEARCH#}' />
</form>