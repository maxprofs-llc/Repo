{if $bIsEditCompleted == true}
	<b class='highLight'>{#ADMIN_CHANGE_PASSWORD_CHANGED#}</b>
{/if}

{if $bHasErrors == true}
	<div class='highLight'>
		
	<b class='highLight'>{#ERROR#}</b>
	<br />
	{if $bReqFieldsMissing == true}
		- {#FIELDS_MISSING_FORM#}<br />
	{/if}

	{if $aCustomErrors.passwordMismatch == true}
		- {#ERROR_PASSWORD_MISMATCH#}<br />
	{/if}
		
	</div>		
{/if}

{if $bDisplayForm == true}
	{$sFormStart}
	<table class='formTable'>
		<tr>
			<td class='inputLabel'>{#PASSWORD#} {#REQ_FIELD_SIGN#}</td>
			<td>{$aInputs.sPassword.input}</td>
		</tr>
		<tr>
			<td class='inputLabel'>{#PASSWORD_CONFIRM#} {#REQ_FIELD_SIGN#}</td>
			<td>{$aInputs.sPasswordVerify.input}</td>
		</tr>		
		<tr>
			<td></td>
			<td>{$sButtons}</td>
		</tr>
	</table>
	{$sFormEnd}
{/if}