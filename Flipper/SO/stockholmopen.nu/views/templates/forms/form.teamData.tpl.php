{if $bIsCompleted}
	{if $iIDEdit == null}
		{eval var=#REGISTER_SPLIT_REGISTERED#}
	{else}
		{#ADMIN_EDIT_TEAM_EDITED#}
	{/if}		
{/if}

{if $bHasErrors}
	<div class='highLight'>
		<b class='highLight'>{#ERROR#}</b>
		<br />
		{if $bReqFieldsMissing}
			- {#FIELDS_MISSING_FORM#}<br />
		{/if}
		
		{if $aCustomErrors.samePlayer}
			- {#ERROR_SAME_PLAYER#}<br />
		{/if}
	
		{if $aCustomErrors.notUniqueName}
			- {#ERROR_NOT_UNIQUE_NAME#}<br />
		{/if}

		{if $aCustomErrors.player1InNonVoidedTeam}
			- {#ERROR_PLAYER_1_IN_NON_VOIDED_TEAM#}<br />
		{/if}	

		{if $aCustomErrors.player2InNonVoidedTeam}
			- {#ERROR_PLAYER_2_IN_NON_VOIDED_TEAM#}<br />
		{/if}			
		
		<!-- just for some, eventual invalid posted valued -->
		{if $aCustomErrors.invalidPlayer}
			- {#INVALID_PLAYER#}<br />
		{/if}
	</div>		
{/if}

{if $bDisplayForm}
	{if $bIsStart}
		{#FIELDS_MARKED_REQUIRED#}
	{/if}
<br />

	{$sFormStart}
	<table class='formTable'>
		<tr>
			<td class='inputLabel'>{#HIGH_SCORE_INITIALS#} {#REQ_FIELD_SIGN#}</td>
			<td>{$aInputs.sInitials.input} {$aInputs.sInitials.verValue}</td>
		</tr>
		<tr>
			<td class='inputLabel'>{#TEAM_NAME#} {#REQ_FIELD_SIGN#}</td>
			<td>{$aInputs.sTeamName.input} {$aInputs.sTeamName.verValue}</td>
		</tr>
		<tr>
			<td class='inputLabel'>{#PLAYER_1#} {#REQ_FIELD_SIGN#}</td>
			<td>{$aInputs.iIDPlayer1.input} {$aInputs.iIDPlayer1.verValue}</td>
		</tr>
		<tr>
			<td class='inputLabel'>{#PLAYER_2#} {#REQ_FIELD_SIGN#}</td>
			<td>{$aInputs.iIDPlayer2.input} {$aInputs.iIDPlayer2.verValue}</td>
		</tr>
		<tr>
			<td></td>
			<td>{$sButtons}</td>
		</tr>
		{* USED IF WE'RE EDITING A TEAM *}
		{if $aInputs.iIDEdit.input != null}
			<tr>
				<td></td>
				<td>{$aInputs.iIDEdit.input}</td>
			</tr>
		{/if}		
	</table>
	{$sFormEnd}
{/if}