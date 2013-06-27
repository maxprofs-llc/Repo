{include file="elements/header.tpl.php"}

<h2>{#ADMIN#}: {#ADMIN_DELETED_ENTRIES_HL#}</h2>

{assign var="bOutput" value="false"}
{if $aEntries != null}
	<table class='mainTable'>
	
	<tr>
		<td class='HL'>{#ENTRY_ID#}</td>
		<td class='HL'>{#YEAR#}</td>
		<td class='HL'>{#PLAYER_NAME#}</td>
		<td class='HL'>{#DELETED#}</td>
		<td class='HL'>{#BY#}</td>		
	</tr>
	{section name=section loop=$aEntries}
	{assign var="bOutput" value="true"}
		{if $smarty.section.section.iteration is odd}
			<tr {#MOUSE_OVER_DEFAULT#}>
		{else}
			<tr class='lineDark' {#MOUSE_OVER_DARK#}>
		{/if}
			<td>{$aEntries[section].id_entry}</td>
			<td>{$aEntries[section].player_year_entered}</td>
			<td>{$aEntries[section].player_firstname} {$aEntries[section].player_lastname} ({$aEntries[section].player_initials})</td>
			<td>{$aEntries[section].entry_deleted_date_posted|truncate:16:"":true}</td>
			<td>{$aEntries[section].deleted_by}</td>		
		</tr>

		<tr>
			<td colspan='5'>
			{section name=entryRounds loop=$aEntries[section].entry_rounds}
				{#GAMES#}: {$aEntries[section].entry_rounds[entryRounds].game_name} ({$aEntries[section].entry_rounds[entryRounds].score}) ***
			{/section}
		</tr>
		<tr>
			<td colspan='5'><hr /></td>
		</tr>		
	{/section}
	</table>
{/if}

{if $bOutput == "false"}
	{#NO_DELETED_ENTRIES#}
{/if}


{include file="elements/footer.tpl.php"}