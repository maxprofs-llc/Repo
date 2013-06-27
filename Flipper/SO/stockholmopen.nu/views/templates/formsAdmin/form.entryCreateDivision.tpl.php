{literal}
<script type="text/javascript">
	function focus()
	{
		//document.getElementById('iIDDivision').focus();
		document.getElementById('sDivision').focus();
	}

	womAdd('focus()');
	womOn();
</script>
{/literal}

{if $bDivisionError == false}

	{if $bHasErrors}
		<div class='highLight'>
			<b class='highLight'>{#ERROR#}</b>
			<br />
			{if $bReqFieldsMissing == true}
				- {#FIELDS_MISSING_FORM#}<br />
			{/if}
	
			{if $aCustomErrors.invalidDivisionID == true}
				- {#INVALID_DIVISION#}<br />
			{/if}	
		</div>
		<br />
	{/if}
	
	
	{if $bDisplayForm}
		{$sFormStart}
		<table class='formTable'>
			<tr>
				<td>{$aPlayer.player_firstname} {$aPlayer.player_lastname}</td>
				<td>({$aPlayer.player_initials})</td>
			</tr>
			<tr>
				<td width='80' class='inputLabel'>{#DIVISION#}</td>
				<td>
				{$aInputs.sDivision.input}
				</td>
				<!-- <td>{$aInputs.iIDDivision.input}</td> -->
				
			</tr>
			<tr>
				<td></td>
				<td>
				{#VALID_DIVISIONS#}:
				{section name=section loop=$aDivisionsOutput}
					{$aDivisionsOutput[section].division}
				{/section}
				</td>
			</tr>
			<tr>
				<td></td>
				<td>{$sButtons}</td>
			</tr>
		</table>
		{* A HIDDEN INPUT WITH THE PLAYER ID *}
		{$aInputs.iIDPlayer.input}
		{$sFormEnd}
	{/if}
{else}
<b class='highLight'>{#ERROR#}</b> {#ERROR_DIVISIONS#}	
{/if}