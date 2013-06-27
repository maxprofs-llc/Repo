{if $sPlayerSearch == null}
	{assign var="sPreSearch" value=#PLAYER_TEAM#"}
{else}
	{assign var="sPreSearch" value=$sPlayerSearch}
{/if}

<form action='searchPlayer.php' method='get'>
{if USE_AUTO_SUGGEST_SEARCH == true}
<input id='sPlayerSearch' class='tight' name="sPlayerSearch" size='13' maxlength='64' type='text' value='{$sPreSearch}' {literal}onclick="clearInput('sPlayerSearch')"{/literal} />
<input type='submit' class='tight' value='{#SEARCH#}' />
<div class='autoComplete' id='playersearch'></div>

{literal}
<script type="text/javascript">
//<![CDATA[
var playerSearchAutoCompleter = new Ajax.Autocompleter('sPlayerSearch', 'playersearch', 'ajax/autoSuggestPlayerName.php', {})
//]]>
</script>
{/literal}
{else}
<input type='text' class='tight' size='11' maxlength='64' id='sPlayerSearch' name='sPlayerSearch' value='{$sPreSearch}' {literal}onclick="clearInput('sPlayerSearch')"{/literal} />
<input type='submit' class='tight' value='{#SEARCH#}' />
{/if}
</form>