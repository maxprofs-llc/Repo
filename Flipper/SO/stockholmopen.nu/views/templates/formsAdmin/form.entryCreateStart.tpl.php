{literal}
<script type="text/javascript">
	function displayPlayers()
	{
		var iIDPlayer = document.getElementById('iIDPlayer').value;
		new Ajax.Updater('player', 'ajax/player.php?iIDPlayer='+iIDPlayer);
		new Element.show('label');
		return false;
	}

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
		{if $aCustomErrors.voidedTeam == true}
			- {#SPLIT_TEAM_IS_VOIDED#}<br />
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
			<td class='inputLabel'>
				<div id="label" style='display:none'>
				{#PLAYER_TEAM#}
				</div>
			</td>
			<td>
				<div id="player">
				{* POPULATED BY AN AJAX CALL THAT LISTS PLAYERS *}
				</div>
			</td>
		</tr>

		<tr>
			<td></td>
			<td>{$sButtons}</td>
		</tr>
	</table>
	{$sFormEnd}
{/if}	