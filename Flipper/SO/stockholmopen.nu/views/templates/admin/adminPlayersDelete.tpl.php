{include file="elements/header.tpl.php"}

<h2>{#ADMIN#}: {#ADMIN_DELETE_PLAYERS_TEAMS_HL#}</h2>
{#ADMIN_DELETE_PLAYERS_TEAMS_MAIN#}
<br />
<br />
{#DISPLAY_PLAYERS_TEAMS_FROM#} {$aInputs.iYear.input}

{if $aPlayers == null}
	<br />
	<br />
	{#ERROR_NO_PLAYER_FOUND#}
{/if}

<br />
<br />

{if $aPlayers != null}
	<table class='mainTable'>
	
	<tr>
		<td class='HL'>{#PLAYER_NAME#}</td>
		<td class='HL'>{#PLAYER_ID#}</td>
		<td class='HL'>{#DIVISION#}</td>
		<td class='HL'>{#PAID#}</td>
		<td class='HL'>{#DELETE#}</td>
	</tr>
	
	{section name=section loop=$aPlayers}
		{if $aPlayers[section].division_name_short != $sPrevDivision}
			<tr class='lineDark'>
				<td colspan='5'><b>{$aPlayers[section].division_name_short} {#DIVISION#}</b></td>
			<tr>
		{/if}	

		{if $smarty.section.section.iteration is odd}
			<tr {#MOUSE_OVER_DEFAULT#}>
		{else}
			<tr class='lineDark' {#MOUSE_OVER_DARK#}>
		{/if}
			<td>{$aPlayers[section].player_first_name} {$aPlayers[section].player_last_name}</td>
			<td>{$aPlayers[section].id_player}</td>
			<td>{$aPlayers[section].division_name_short}</td>
			<td>
				{if $aPlayers[section].dtp_paid_fee == 1}
					X
				{/if}
			</td>
			<td>
			{if $aPlayers[section].player_has_played_entries == false}
			<a href='adminPlayerDelete.php?iIDDelete={$aPlayers[section].id_player}'><img src='images/icons/editdelete.gif' class='iconLink' alt='{#DELETE#}' title={#DELETE#} /></a>
			{/if}
			</td>
		</tr>
		{assign var="sPrevDivision" value=$aPlayers[section].division_name_short}
	{/section}
	</table>
{/if}

{include file="elements/footer.tpl.php"}