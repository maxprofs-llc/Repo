<h3>{#CURRENT_USERS#}</h3>

<table class='mainTable'>

<tr>
	<td class='HL'>{#USERNAME#}</td>
	<td class='HL'>{#FIRSTNAME#}</td>
	<td class='HL'>{#LASTNAME#}</td>
	<td class='HL' align='center'>{#EDIT#}</td>
	<!-- <td class='HL' align='center'>{#DELETE#}</td> -->
	<td class='HL' align='center'>{#PASSWORD#}</td>
	
</tr>
{section name=section loop=$aUsers}
	{if $smarty.section.section.iteration is odd}
		<tr {#MOUSE_OVER_DEFAULT#}>
	{else}
		<tr class='lineDark' {#MOUSE_OVER_DARK#}>
	{/if}

		<td>{$aUsers[section].user_username}</td>
		<td>{$aUsers[section].user_firstname}</td>
		<td>{$aUsers[section].user_lastname}</td>
		<td align='center'><a href='adminUser.php?iIDEdit={$aUsers[section].id_user}'><img src='images/icons/edit.gif' class='iconLink' alt='{#EDIT#}' title='{#EDIT#}' /></a></td>
		<!-- <td align='center'><a href='adminUser.php?iIDDelete={$aUsers[section].id_user}'><img src='images/icons/editdelete.gif' class='iconLink' alt='{#DELETE#}' title='{#DELETE#}' /></a></td> -->
		<td align='center'><a href='adminUserPassword.php?iIDEdit={$aUsers[section].id_user}'><img src='images/icons/edit.gif' class='iconLink' alt='{#EDIT#}' title='{#EDIT#}' /></a></td>
	</tr>
{/section}
</table>