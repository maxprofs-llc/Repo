{if $sGameSearch == null}
	{assign var="sPreSearch" value=#GAME_NAME#"}
{else}
	{assign var="sPreSearch" value=$sGameSearch}
{/if}

<form action='searchGame.php' method='get'>
{if USE_AUTO_SUGGEST_SEARCH == true}
	<input id='sGameSearch' class='tight' name="sGameSearch" size='13' maxlength='64' type='text' value='{$sPreSearch}' {literal}onclick="clearInput('sGameSearch')"{/literal}/>
	<input type='submit' class='tight' value='{#SEARCH#}' />
	<div class='autoComplete' id='gamesearch'></div>	
	{literal}
	<script type="text/javascript">
	//<![CDATA[
	var gameSearchAutoCompleter = new Ajax.Autocompleter('sGameSearch', 'gamesearch', 'ajax/autoSuggestGameName.php', {})
	//]]>
	</script>
	{/literal}

{else}
	<form action='searchGame.php' method='get'>
	<input type='text' class='tight' size='11' maxlength='64' id='sGameSearch' name='sGameSearch' value='{$sPreSearch}' {literal}onclick="clearInput('sGameSearch')"{/literal} />
	<input type='submit' class='tight' value='{#SEARCH#}' />
{/if}
</form>