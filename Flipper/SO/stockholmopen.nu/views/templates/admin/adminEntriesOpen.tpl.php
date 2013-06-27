{include file="elements/header.tpl.php"}

<h2>{#ADMIN#}: {#ADMIN_OPEN_ENTRIES_HL#}</h2>

{#DISPLAY_ENTRIES_FROM#} {$aInputs.iYear.input}

{if $aEntries == null}
	<br />
	<br />
	{#NO_OPEN_ENTRIES_FOUND#}
{/if}

<br />
<br />

{if $aEntries != null}
	<table class='mainTable'>
	
	<tr>
		<td class='HL'>{#ENTRY_ID#}</td>
		<td class='HL'>{#PLAYER_NAME#}</td>
		<td class='HL'>{#PLAYER#} {#QR#}</td>
		<td class='HL'>{#DIVISION#}</td>
		<td class='HL'>{#POSTED#}</td>
		<td class='HL'>{#ENTRY#} {#QR#}</td>
		<td class='HL'>{#EDIT#}</td>
	</tr>
	{section name=section loop=$aEntries}
		{if $smarty.section.section.iteration is odd}
			<tr {#MOUSE_OVER_DEFAULT#}>
		{else}
			<tr class='lineDark' {#MOUSE_OVER_DARK#}>
		{/if}
			<td>{$aEntries[section].entries_id_entry}</td>
			<td>{$aEntries[section].player_firstname} {$aEntries[section].player_lastname}</td>
			<td><a href='wap/playerPrinter.php?playerId={$aEntries[section].id_player}&autoPrint=true' target='_new'><img src='images/icons/qr.png' class='iconLink' alt='{#ADMIN_PLAYER_PRINT#}' title='{#ADMIN_PLAYER_PRINT#}' /></a></td>
			<td>{$aEntries[section].division_name_short}</td>
			<td>{$aEntries[section].entry_poster_date_posted|truncate:16:"":true}</td>
			<td><a href='wap/entryPrinter.php?entryId={$aEntries[section].entries_id_entry}&autoPrint=true' target='_new'><img src='images/icons/qr.png' class='iconLink' alt='{#ADMIN_ENTRY_PRINT#}' title='{#ADMIN_ENTRY_PRINT#}' /></a></td>
			<td><a href='adminEntryReg.php?iIDPlayer={$aEntries[section].id_player}&amp;iIDEntry={$aEntries[section].entries_id_entry}&amp;iYear={$aEntries[section].player_year_entered}'><img src='images/icons/edit.gif' class='iconLink' alt='{#EDIT#}' title='{#EDIT#}' /></a></td>
		</tr>
	{/section}
	</table>
{/if}

{include file="elements/footer.tpl.php"}