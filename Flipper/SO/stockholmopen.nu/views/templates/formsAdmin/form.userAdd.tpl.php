{if $bIsDefaultCompleted == true}
	<b class='highLight'>{#ADMIN_ADD_USER_ADDED#}</b>
	<br />
	<br />
{/if}

{if $bIsEditCompleted == true}
	<b class='highLight'>{#ADMIN_EDIT_USER_UPDATED#}</b>
	<br />
	<br />
{/if}

{if $bIsDeleteCompleted == true}
	<b class='highLight'>{#ADMIN_EDIT_USER_DELETED#}</b>
	<br />
	<br />
{/if}

{if $bHasErrors == true}
	<div class='highLight'>
		
	<b class='highLight'>{#ERROR#}</b>
	<br />
	{if $bReqFieldsMissing == true}
		- {#FIELDS_MISSING_FORM#}<br />
	{/if}
	{if $aCustomErrors.userNameExits == true}
		- {#ERROR_USERNAME_EXISTS#}<br />
	{/if}

	{if $aCustomErrors.invalidChars == true}
		- {#ERROR_USERNAME_INVALID_CHARS#}<br />
	{/if}
		
	{if $aCustomErrors.passwordMismatch == true}
		- {#ERROR_PASSWORD_MISMATCH#}<br />
	{/if}
	
	{if $aCustomErrors.cannotDelete == true}
		- {#ERROR_CANT_DELETE_UBER_ADMIN#}<br />
	{/if}		
	</div>		
{/if}

{if $bDisplayForm == true}
{#FIELDS_MARKED_REQUIRED#}
<br />

	{$sFormStart}
	<table class='formTable'>
		<tr>
			<td class='inputLabel'>{#USERNAME#} {#REQ_FIELD_SIGN#}</td>
			<td>{$aInputs.sUsername.input}</td>
		</tr>
		<tr>
			<td class='inputLabel'>{#FIRSTNAME#} {#REQ_FIELD_SIGN#}</td>
			<td>{$aInputs.sFirstname.input}</td>
		</tr>
		<tr>
			<td class='inputLabel'>{#LASTNAME#} {#REQ_FIELD_SIGN#}</td>
			<td>{$aInputs.sLastname.input}</td>
		</tr>
		{* only display the password inputs if it's not an edit form *}
		{if $bIsEditForm == false}
			<tr>
				<td class='inputLabel'>{#PASSWORD#} {#REQ_FIELD_SIGN#}</td>
				<td>{$aInputs.sPassword.input}</td>
			</tr>
			<tr>
				<td class='inputLabel'>{#PASSWORD_CONFIRM#} {#REQ_FIELD_SIGN#}</td>
				<td>{$aInputs.sPasswordVerify.input}</td>
			</tr>
		{/if}		
		<tr>
			<td class='inputLabel'>{#EMAIL#} {#REQ_FIELD_SIGN#}</td>
			<td>{$aInputs.sEmail.input}</td>
		</tr>	
		<tr>
			<td class='inputLabel'>{#FULL_ADMIN#}</td>
			<td>{$aInputs.sUberAdmin.input}</td>
		</tr>		
		<tr>
			<td></td>
			<td>{$sButtons}</td>
		</tr>
	</table>
	{$sFormEnd}
{/if}	