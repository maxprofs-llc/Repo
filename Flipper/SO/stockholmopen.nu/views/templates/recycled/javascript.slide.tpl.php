{* TODO: THE & chars should be escaped, but it seems like the &amp; won't work in some browsers (it's not decoded correctly from the javascript) ?! *}
{literal}
<script type="text/javascript">
{/literal}

{if $bNoOutPut == "true"}
	{literal}setTimeout("redirect()",{/literal}({#SLIDE_SPEED_WITHOUT_OUTPUT#}*1000){literal});{/literal}
{else}
	{literal}setTimeout("redirect()", {/literal}({#SLIDE_SPEED#}*1000){literal});{/literal}
{/if}

{literal}
function redirect()
{
	window.location.href ='{/literal}{$sLocation}{literal}?bTotalAndGames={/literal}{$bTotalAndGames}{literal}&iYear={/literal}{$iYear}{literal}&iStart={/literal}{$iStart}{literal}&bTotal={/literal}{$bTotal}{literal}&bGames={/literal}{$bGames}{literal}&iIndexGame={/literal}{$iIndexGame}{literal}&iIndexDivision={/literal}{$iIndexDivision}{literal}&bSwitch={/literal}{$bSwitch}{literal}&bCustom={/literal}{$bCustom}{literal}&bStart={/literal}{$bStart}{literal}';
}
</script>
{/literal}