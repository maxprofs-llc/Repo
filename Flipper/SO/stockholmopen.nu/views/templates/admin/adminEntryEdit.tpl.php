{include file="elements/header.tpl.php"}

<h2>{#ADMIN#}: {#ADMIN_EDIT_ENTRY_HL#}</h2>
{#ADMIN_EDIT_ENTRY_MAIN#}
<br  />
<br />

<table>
<tr>
	<td>{#DISPLAY_ENTRIES_FROM#}</td>
	<td>{$aInputs.iYear.input}</td>
</tr>
{$sFormStart}
<tr>
	<td>{#OR_SEARCH_ENTRY_ID#}</td>
	<td>{$aInputs.iSearch.input}</td>
</tr>
<tr>
	<td></td>
	<td>{$sButtons}</td>
</tr>
{$sFormEnd}
</table>

{if $bNoEntriesFound == true}
	<br />
	<br />
	{#NO_ENTRIES_FOUND#}
{/if}

<br />
<br />

{if $aEntries != null}
	<table class='mainTable'>
	
	<tr>
		<td class='HL'>{#ENTRY_ID#}</td>
		<td class='HL'>{#PLAYER_NAME#}</td>
		<td class='HL'>{#PLAYER#} {#QR#}</td>
		<td class='HL'>{#POSTED#}</td>
		<td class='HL'>{#DIVISION#}</td>
		<td class='HL'>{#SCORE#}</td>
		<td class='HL'></td>
		<td class='HL'>{#HISTORY#}</td>	
		<td class='HL'>{#ENTRY#} {#QR#}</td>
		<td class='HL'>{#EDIT#}</td>
		<td class='HL'>{#DELETE#}</td>
	</tr>
	{section name=section loop=$aEntries}
		{if $smarty.section.section.iteration is odd}
			<tr {#MOUSE_OVER_DEFAULT#}>
		{else}
			<tr class='lineDark' {#MOUSE_OVER_DARK#}>
		{/if}
			<td>{$aEntries[section].id_entry}</td>
			<td>{$aEntries[section].player_firstname} {$aEntries[section].player_lastname}</td>
			<td><a href='wap/playerPrinter.php?playerId={$aEntries[section].id_player}&autoPrint=true' target='_new'><img src='images/icons/qr.png' class='iconLink' alt='{#ADMIN_PLAYER_PRINT#}' title='{#ADMIN_PLAYER_PRINT#}' /></a></td>
			<td>{$aEntries[section].entry_poster_date_posted|truncate:16:"":true}</td>
			<td>{$aEntries[section].division_name_short}</td>
			<td>{$aEntries[section].entry_score}</td>
			<td>
				{if $aEntries[section].entry_is_voided == 1}
					<i>{#VOID#}</i>
				{/if}	
			</td>
			<td><a href="#" onclick="new Ajax.Updater('entry{$aEntries[section].id_entry}', 'ajax/displayEntryHistory.php?iIDEntry={$aEntries[section].id_entry}'); return false;"><img src='images/icons/info.gif' class='iconLink' alt='{#HISTORY#}' title='{#HISTORY#}' /></a></td>
			<td><a href='wap/entryPrinter.php?entryId={$aEntries[section].id_entry}&autoPrint=true' target='_new'><img src='images/icons/qr.png' class='iconLink' alt='{#ADMIN_ENTRY_PRINT#}' title='{#ADMIN_ENTRY_PRINT#}' /></a></td>
			<td><a href='adminEntryReg.php?iIDPlayer={$aEntries[section].id_player}&amp;iIDEntry={$aEntries[section].id_entry}&bEdit=true'><img src='images/icons/edit.gif' class='iconLink' alt='{#EDIT#}' title='{#EDIT#}' /></a></td>
			<td><a href='adminEntryDelete.php?iIDDelete={$aEntries[section].id_entry}'><img src='images/icons/editdelete.gif' class='iconLink' alt='{#DELETE#}' title='{#DELETE#}' /></a></td>
		</tr>

		{* POPULATED BY AN AJAX CALL *}
		<tr>
			<td colspan='10'>
			<div id="entry{$aEntries[section].id_entry}">
			</div>
			</td>
		</tr>
	{/section}
	</table>
{/if}

{include file="elements/footer.tpl.php"}