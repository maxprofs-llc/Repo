{config_load file=lang/$sLang/config.$sLang.lang.php}

<h3>{#GUEST_S#}</h3>

{if $aActiveGuests != null}
	<table width='350' class='mainTable'>
	{section name=section loop=$aActiveGuests}
		<tr class='underLine'>	
			<td>{$aActiveGuests[section].ua_ip}</td>
			<td>{$aActiveGuests[section].ua_page}</td>
		</tr>	
	{/section}
	</table>
{else}
	{#NONE#}
{/if}	