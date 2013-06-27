{if $iIDEntrySearch == null}
	{assign var="sPreSearch" value=#ENTRY_ID#"}
{else}
	{assign var="sPreSearch" value=$iIDEntrySearch}
{/if}

<form action='player.php' method='get'>
<input type='text' class='tight' size='13' maxlength='10' name='iIDEntrySearch' id='iIDEntrySearch' value='{$sPreSearch}' {literal}onfocus="clearInput('iIDEntrySearch')"{/literal} />
<input type='submit' class='tight' value='{#SEARCH#}' />
</form>