{if $bHasErrors}
	<div class='highLight'>
		<b class='highLight'>{#ERROR#}</b>
		<br />
		{if $bReqFieldsMissing}
			- {#FIELDS_MISSING_FORM#}<br />
		{/if}
		
		{if $aCustomErrors.notSplitTeam}
			- {#ERROR_ID_NOT_SPLIT#}<br />
		{/if}
		
		{if $aCustomErrors.notCurrentYear}
			- {#ERROR_TEAM_NOT_CURRENT_YEAR#}<br />
		{/if}
	</div>		
{/if}

{$sFormStart}
<table class='formTable'>
	<tr>
		<td class='inputLabel'>{#TEAM_ID#}</td>
		<td>{$aInputs.iIDTeam.input}</td>
	</tr>
	<tr>
		<td></td>
		<td>{$sButtons}</td>
	</tr>
</table>
{$sFormEnd}