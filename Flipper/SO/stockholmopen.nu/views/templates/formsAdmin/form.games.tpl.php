{if $bIsCompleted == true}
	<b class='highLight'>{#ADMIN_GAMES_ADDED#}</b>
	<br />
	<br />
	<a href='adminGames.php' id='addAnother'>{#ADMIN_ADD_ANOTHER_GAME#}</a>
{/if}

{if $bIsEditCompleted == true}
	<b class='highLight'>{#ADMIN_GAMES_UPDATED#}</b>
{/if}

{if $bHasErrors == true}
	<div class='highLight'>		
		<b class='highLight'>{#ERROR#}</b>
		<br />
		{if $bReqFieldsMissing == true}
			- {#FIELDS_MISSING_FORM#}<br />
		{/if}
		{if $aCustomErrors.invalidManufacturer == true}
			- {#INVALID_MANUFACTURER#}<br />
		{/if}
		
		{if $aCustomErrors.invalidYear == true}
			- {#INVALID_YEAR#}<br />
		{/if}

		{if $aCustomErrors.invalidLink == true}
			- {#INVALID_LINK#}<br />
		{/if}

		{if $aCustomErrors.invalidIPDB == true}
			- {#INVALID_IPDB#}<br />
		{/if}

		{if $aCustomErrors.gameExists == true}
			- {#ERROR_GAME_EXISTS#}<br />
		{/if}	
		 
		</div>
		<br />
{/if}

{if $bDisplayForm == true}
	{#FIELDS_MARKED_REQUIRED#}
	<br />
	
	{$sFormStart}
	<table class='formTable'>
		<tr>
			<td width='100' class='inputLabel'>{#GAME_NAME#} {#REQ_FIELD_SIGN#}</td>
			<td>{$aInputs.sGameName.input}</td>
		</tr>
		<tr>
			<td class='inputLabel'>{#IPDB_ID#}</td>
			<td>{$aInputs.iIDIPDB.input} <span class='smallLight'> {#IPDB_ID_INFO#}</span></td>
		</tr>
		<tr>
			<td class='inputLabel'>{#RULESHEET_LINK#}</td>
			<td>{$aInputs.sLinkRulesheet.input}</td>
		</tr>
		<tr>
			<td class='inputLabel'>{#RELEASE_YEAR#} {#REQ_FIELD_SIGN#}</td>
			<td>{$aInputs.iYearReleased.input}</td>
		</tr>
		<tr>
			<td class='inputLabel'>{#MANUFACTURER#} {#REQ_FIELD_SIGN#}</td>
			<td>{$aInputs.iIDManufacturer.input}</td>
		</tr>
		<tr>
			<td></td>
			<td>{$sButtons}</td>
		</tr>
	</table>
	{$sFormEnd}
{/if}	