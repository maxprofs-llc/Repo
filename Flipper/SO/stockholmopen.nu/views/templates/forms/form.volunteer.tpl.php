{if $bIsCompleted}
	<p>
	{#VOLUNTEER_POSTED#}
	</p>
{/if}

{if $bDisplayForm}
	{if $bHasErrors}
		<div class='highLight'>
			<b class='highLight'>{#ERROR#}</b>
			<br />
			{if $bReqFieldsMissing}
				- {#FIELDS_MISSING_FORM#}<br />
			{/if}
			{if $aCustomErrors.invalidEmail}
				- {#INVALID_EMAIL#}<br />
			{/if}
			{if $aCustomErrors.noDuties}
				- {#NO_DUTIES#}<br />
			{/if}
			{if $aCustomErrors.noTimes}
				- {#NO_TIMES#}<br />
			{/if}						
		</div>		
	{/if}

	{#FIELDS_MARKED_REQUIRED#}
	<br />
	{$sFormStart}
	<table class='formTable'>
	<tr>
		<td class='inputLabel'>{#FIRSTNAME#} {#REQ_FIELD_SIGN#}</td>
		<td colspan='2'>{$aInputs.sFirstName.input}</td>
	</tr>

	<tr>
		<td class='inputLabel'>{#LASTNAME#} {#REQ_FIELD_SIGN#}</td>
		<td colspan='2'>{$aInputs.sLastName.input}</td>
	</tr>

	<tr>
		<td class='inputLabel'>{#EMAIL#} {#REQ_FIELD_SIGN#}</td>
		<td colspan='2'>{$aInputs.sEmail.input}</td>
	</tr>	

	<tr>
		<td class='inputLabel'>{#MOBILE_PHONE#} {#REQ_FIELD_SIGN#}</td>
		<td colspan='2'>{$aInputs.sPhoneMobile.input}</td>
	</tr>	

	<tr>
		<td class='inputLabel'>{#VOL_TOTAL_HOURS#} {#REQ_FIELD_SIGN#}</td>
		<td colspan='2'>{$aInputs.iTotalTime.input}</td>
	</tr>

	<tr>
		<td colspan='3'><i>{#VOL_TOTAL_HOURS_INFO#}</i></td>
	</tr>	

	</table>
	
	<table>
	<tr>
		<td colspan='3'><h3>{#DUTIES#}</h3>{#VOLUNTEER_DUTIES#}<br /><br /></td>
	</tr>
	
	{section name=section loop=$aCheckBoxNamesDuties}
		{assign var="sInputName" value=$aCheckBoxNamesDuties[section]}
		<tr class='underLine' {#MOUSE_OVER_LIGHT#}>
			<td align='right'>{$aInputs.sDuties.$sInputName.input}</td>
			<td colspan='2'>{$aInputs.sDuties.$sInputName.output}</td>
		</tr>
	{/section}

	<tr>
		<td colspan='3'><h3>{#TIMES#}</h3>{#VOLUNTEER_TIMES#}<br /><br /></td>
	</tr>

	<tr>
		<td colspan='2'></td>
		<td align='right'><b>{#NO_OF_REGISTERED_VOLUNTEERS#}</b></td>
	</tr>

	{section name=section loop=$aCheckBoxNamesTimes}
		{assign var="sInputName" value=$aCheckBoxNamesTimes[section]}
		<tr class='underLine' {#MOUSE_OVER_LIGHT#}>
			<td align='right'>{$aInputs.sTimes.$sInputName.input}</td>
			<td>{$aInputs.sTimes.$sInputName.output}</td>
			<td align='right'>
			{if $aNumberForTime.$sInputName > 0}
				{$aNumberForTime.$sInputName}
			{else}
				<i>{#NONE#}</i>	
			{/if}
			</td>
		</tr>
	{/section}	
	
	<tr>
		<td></td>
		<td><br />{$sButtons}</td>
	</tr>
			
	</table>
	{$sFormEnd}
{/if}