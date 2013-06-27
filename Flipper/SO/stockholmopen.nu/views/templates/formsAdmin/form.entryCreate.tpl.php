{if $bIsCompleted}
	{#ADMIN_ENTRY_CREATE_CREATED#}
{/if}

{if $bHasWarnings}
	<div class='warning'>	
		<b class='highLight'>{#WARNING#}</b>
		<br />
		{if $aWarnings.noOfEntriesAboveFree == true}
			- {#WARNING_ABOVE_FREE_ENTRIES#}<br />	
		{/if}
	
		{if $aWarnings.noOfEntriesAboveMax == true}
			- {#WARNING_ABOVE_MAX_ENTRIES#}<br />
		{/if}

		{if $aWarnings.shouldPay == true}
			- {#WARNING_PAY#}<br />
		{/if}		
		
	</div>
{/if}

{if $bPaidFee == false && $bDisplayForm == true}
	<br />
	<div class='warning'>	
		<b class='highLight'>{#WARNING#}</b>
		<br />
		{#WARNING_HAS_NOT_PAID_FEE#}<br />
	</div>
{/if}

<br />

{if $bHasErrors}
	<div class='highLight'>
		<b class='highLight'>{#ERROR#}</b>
		<br />
		{if $bReqFieldsMissing}
			- {#FIELDS_MISSING_FORM#}<br />
		{/if}
		
		{if $aCustomErrors.multipleGame}
			- {#ERROR_NOT_UNIQUE_GAMES#}<br />
		{/if}

		{if $aCustomErrors.invalidGame}
			- {#INVALID_GAME#}<br />
		{/if}

		{if $aCustomErrors.invalidPlayer}
			- {#INVALID_PLAYER_TEAM_ID#}<br />
		{/if}
		
		{if $aCustomErrors.invalidDivision}
			- {#INVALID_DIVISION#}<br />
		{/if}		
		</div>
{/if}

{if $bDisplayForm}
	{$sFormStart}
	<table class='formTable'>
		<tr>
			<td class='inputLabel' >{#PLAYER_TEAM#}</td>
			<td>{$aPlayer.player_firstname} {$aPlayer.player_lastname} ({$aPlayer.player_initials})</td>
		</tr>

		<tr>
			<td class='inputLabel' >{#DIVISION#}</td>
			<td>{$sDivision}</td>
		</tr>
		
		<tr>
			<td class='inputLabel'>{#ENTRIES#}</td>
			<td>{$iNoOfEntries}</td>
		</tr>

		{* loop through all the game selects *}
		{section name=section loop=$aInputGames}
		<tr>
			<td valign='top' class='inputLabel'>{#GAME#} {$smarty.section.section.iteration}</td>	
			{assign var="sInputName" value=$aInputGames[section]}
			<td>{$aInputs.$sInputName.input} {$aInputs.$sInputName.verValue}</td>
		</tr>	
		{/section}

		{if $bPaidFee == false}
			<tr>
				<td valign='top' class='inputLabel'>{#FEE_PAID#}</td>	
				<td>{$aInputs.sPayFee.input} {$aInputs.sPayFee.verValue}</td>
			</tr>	
		{/if}

		<tr>
			<td></td>
			<td>{$sButtons}</td>
		</tr>
	</table>
	{$sFormEnd}
{/if}