{* WON'T USE THIS SINCE WE DON'T REALLY NEED IT AND IT'S SLOWING THE PAGE DOWN
{literal}
<script type="text/javascript">
	function displayPlayerAndEntry()
	{
		var iIDPlayer = document.form.iIDPlayer.value;
		var iIDEntry = document.form.iIDEntry.value;		
		new Ajax.Updater('playerAndEntry', 'ajax/playerAndEntry.php?iIDPlayer='+iIDPlayer+'&amp;iIDEntry='+iIDEntry);
		new Element.show('label');
		return false;
	}
*}
{literal}
<script type="text/javascript">
	function focus()
	{
		document.getElementById('iIDPlayer').focus();
	}

	womAdd('focus()');
	womOn();
</script>
{/literal}
 
{if $bHasErrors}
	<div class='highLight'>
		<b class='highLight'>{#ERROR#}</b>
		<br />
		{if $bReqFieldsMissing == true}
			- {#FIELDS_MISSING_FORM#}<br />
		{/if}

		{if $aCustomErrors.invalidPlayerID == true}
			- {#INVALID_PLAYER_TEAM_ID#}<br />
		{/if}

		{if $aCustomErrors.invalidEntryID == true}
			- {#INVALID_ENTRY_ID#}<br />
		{/if}		
		
		{if $aCustomErrors.entryPlayerMismatch == true}
			- {#ERROR_PLAYER_TEAM_ENTRY_MISMATCH#}<br />
		{/if}
		
		{if $aCustomErrors.entryCompleted == true}
			- {#ERROR_ENTRY_COMPLETED#}<br />
		{/if}
		
		{if $aCustomErrors.entryVoided == true}
			- {#ERROR_ENTRY_VOIDED#}<br />
		{/if}								
	</div>
	<br />
{/if}

{if $bDisplayForm}
	{$sFormStart}
	<table class='formTable'>
		<tr>
			<td width='80' class='inputLabel'>{#PLAYER_TEAM_ID#}</td>
			<td>{$aInputs.iIDPlayer.input}</td>
		</tr>
		<tr>
			<td class='inputLabel'>{#ENTRY_ID#}</td>
			<td>{$aInputs.iIDEntry.input}</td>
		</tr>
		<tr>
			<td></td>
			<td>{$sButtons}</td>
		</tr>	
		<!-- <tr>
			<td class='inputLabel'>
				<div id="label" style='display:none'>
				{#INFO#}
				</div>
			</td>
			<td>
				<div id="playerAndEntry">
				{* POPULATED BY AN AJAX CALL THAT LISTS PLAYERS *}
				</div>
			</td>
		</tr>-->
	</table>
	{$sFormEnd}
{/if}	