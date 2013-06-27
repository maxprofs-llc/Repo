<tr>
	{if $sSort == "gameAsc"}
		<td class='HLsortUp' width='190'>
	{else}
		<td width='190' class='HL'>
	{/if}
	
	{if $bNoEntryRoundSorting != "true"}
		<a href='{$sLinkMain}&amp;sSort=gameAsc'>{#MACHINE#}</a>
	{else}
		{#MACHINE#}
	{/if}
	</td>
	
	<td width='80' class='HL'>{#SCORE#}</td>
	
	{if $sSort == "posDesc"}
		<td class='HLsortDown'>
	{else}
		<td class='HL'>
	{/if}

	{if $bNoEntryRoundSorting != "true"}
		<a href='{$sLinkMain}&amp;sSort=posDesc'>{#POSITION_SHORT#}</a>
	{else}
		{#POSITION_SHORT#}
	{/if}
	</td>
	
	<td class='HL'>{#POINTS#}</td>
	<td class='HL'>{#UPDATED#}</td>
	
	{if $sSort != null}
		<td class='HL'>{#ENTRY_ID#}</td>	
	{/if}
</tr>
