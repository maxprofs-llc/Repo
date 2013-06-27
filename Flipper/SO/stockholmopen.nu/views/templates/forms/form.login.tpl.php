{if $bIsCompleted}
	{#LOGIN_LOGGED_IN#}
{else}
	<i>{#LOGIN_USERNAME_PASSWORD_CASE_SENSITIVE#}</i>
{/if}


{if $bHasErrors}
	<div class='highLight'>
		<b class='highLight'>{#ERROR#}</b>
		<br />
		{if $bReqFieldsMissing == true}
			- {#FIELDS_MISSING_FORM#}<br />
		{/if}
		{if $aCustomErrors.loginFailed == true}
			- {#LOGIN_LOGIN_FAILED#}<br />
		{/if}
	</div>		
{/if}

{if $bDisplayForm}
	{$sFormStart}
	<table class='formTable'>
		<tr>
			<td class='inputLabel'>{#USERNAME#}</td>
			<td>{$aInputs.sUsername.input}</td>
		</tr>
		<tr>
			<td class='inputLabel'>{#PASSWORD#}</td>
			<td>{$aInputs.sPassword.input}</td>
		</tr>
		<tr>
			<td></td>
			<td>{$sButtons}</td>
		</tr>
	</table>
	{$sFormEnd}
{/if}	