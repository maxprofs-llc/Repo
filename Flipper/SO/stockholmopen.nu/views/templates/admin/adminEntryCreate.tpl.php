{include file="elements/header.tpl.php"}

{if $bIsCompleted == "true"}
	{literal}
	<script type="text/javascript">

	function focus()
	{
		document.getElementById('another').focus();
	}

	womAdd('focus()');
	womOn();
	</script>
	{/literal}

{elseif $bIsVerOption}
	{literal}
	<script type="text/javascript">

	function focus()
	{
		document.getElementById('buttonVerBack').focus();
	}

	womAdd('focus()');
	womOn();
	</script>
	{/literal}
{else}
	{literal}
	<script type="text/javascript">

	function focus()
	{
		document.getElementById('iIDGame_0').focus();
	}

	womAdd('focus()');
	womOn();
	</script>
	{/literal}
{/if}

<h2>{#ADMIN#}: {#ADMIN_ENTRY_CREATE_HL#}

(
{if $bIsStart == "true"}
	{#STEP_THREE_OF_FIVE#}
{/if}

{if $bIsVerOption == "true"}
	{#STEP_FOUR_OF_FIVE#}
{/if}

{if $bIsCompleted == "true"}
	{#DONE#}
{/if}
)

</h2>

{if $bIsVerOption == "true"}
	<p>{#ADMIN_ENTRY_CREATE_VER#}</p>
{/if}

{if $bDisplayStartText == "true"}
	{#ADMIN_ENTRY_CREATE_MAIN#}
{/if}
	
{include file="formsAdmin/form.entryCreate.tpl.php"}

{if $bIsCompleted == "true"}
	<h3>{#ENTRY_INFO#}</h3>
	
	<hr width='300' align='left' />
	{section name=section loop=$aEntry}
		<table class='mainTable'>
			<tr>
				<td width='90' class='tableLabel'>{#PLAYER_TEAM#}</td>
				<td>{$aEntry.0.player_firstname} {$aEntry.0.player_lastname}</td>
			</tr>
			<tr>
				<td class='tableLabel'>{#PLAYER_TEAM_ID#}</td>
				<td valign='top'>{$aEntry.0.id_player} <a href='wap/playerPrinter.php?playerId={$aEntry.0.id_player}&autoPrint=true' target='_new'><img src='images/icons/qr.png' class='iconLink' alt='{#ADMIN_PLAYER_PRINT#}' title='{#ADMIN_PLAYER_PRINT#}' /></a></td>
			</tr>
			<tr>
				<td class='tableLabel'>{#INITIALS#}</td>
				<td>{$aEntry.0.player_initials}</td>
			</tr>
			<tr>
				<td class='tableLabel'>{#ENTRIES#}</td>
				<td>{$iNoOfEntries}</td>
			</tr>
			<tr>
				<td colspan='2'><i class='small'>{#INCLUDING_THE_ONE_JUST_CREATED#}</td>
			</tr>
			<tr>
				<td class='tableLabel'>{#ENTRY_ID#}</td>
				<td>{$aEntry.0.id_entry}</td>
			</tr>			
			{section name=entryRounds loop=$aEntry[section].entry_rounds}
				<tr>
					<td class='tableLabel'>{#GAME#} {$smarty.section.entryRounds.iteration}</td>
					<td>{$aEntry[section].entry_rounds[entryRounds].game_name}</td>
				</tr>
			{/section}	
		</table>
	{/section}
	<hr width='300' align='left' />

{/if}

{if $bIsCompleted == "true"}
	<br />
	<a href='wap/entryPrinter.php?entryId={$aEntry.0.id_entry}&autoPrint=true' id='printEntry' target='_new'>{#ADMIN_ENTRY_PRINT#}</a><br />
	<a href='adminEntryCreateStart.php' id='another'>{#ADMIN_ENTRY_CREATE_ANOTHER#}</a>
{/if}


{include file="elements/footer.tpl.php"}