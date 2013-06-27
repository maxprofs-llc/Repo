{config_load file=lang/$sLang/config.$sLang.lang.php}

<h3>{#LOGGED_IN_USER_S#}</h3>

{if $aActiveUsers != null}
	<table width='350' class='mainTable'>
	{section name=section loop=$aActiveUsers}
		<tr class='underLine'>	
			<td>{$aActiveUsers[section].user_username}</td>
			<td>{$aActiveUsers[section].user_firstname}</td>
			<td>{$aActiveUsers[section].user_lastname}</td>
			<td>{$aActiveUsers[section].ua_ip}</td>
			<td>{$aActiveUsers[section].ua_page}</td>			
		</tr>	
	{/section}
	</table>
{else}
	{#NONE#}
{/if}	