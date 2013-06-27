{if $bIsCompleted}
	{#ADMIN_ENTRY_REG_REGGED#}
{else}
	{if $bEdit}
		<br />
		<br />
		{#ADMIN_ENTRY_REG_EDIT_NOTICE#}	
		<br />
		<br />
	{/if}
{/if}

{if $bHasWarnings == true}
	<br />
	<br />
	<div class='warning'>	
		<b class='highLight'>{#WARNING#}</b>
		<br />
		{if $aWarnings.entryWillBeVoided == true}
			- {#WARNING_ENTRY_WILL_BE_VOIDED#} 
			<br />	
		{/if}

		{if $aWarnings.scoreNotEndingWithZero == true}
			- {#WARNING_SCORES_NOT_ENDING_WITH_ZERO#} 
			<br />	
		{/if}
	</div>
	<br />
{/if}

{if $bHasErrors == true}
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

		{if $aCustomErrors.invalidEntryID}
			- {#INVALID_ENTRY_ID#}<br />
		{/if}		

		{if $aCustomErrors.invalidPlayerID}
			- {#ERROR_PLAYER_TEAM_ENTRY_MISMATCH#}<br />
		{/if}		
		
		{if $aCustomErrors.invalidScore}
			- {#INVALID_SCORE#}<br />
		{/if}		
		</div>
<br />
{/if}

{if $bDisplayForm == true}
	{$sFormStart}
	<table class='formTable'>
		<tr>
			<td width='80' class='inputLabel' >{#PLAYER_TEAM#}</td>
			<td valign='top'>{$aPlayer.player_firstname} {$aPlayer.player_lastname} ({$aPlayer.player_initials}) <a href='wap/playerPrinter.php?playerId={$aPlayer.id_player}&autoPrint=true' target='_new'><img src='images/icons/qr.png' class='iconLink' alt='{#ADMIN_PLAYER_PRINT#}' title='{#ADMIN_PLAYER_PRINT#}' /></a></td>
		</tr>
		<tr>
			<td width='80' class='inputLabel' >{#ENTRY_ID#}</td>
			<td valign='top'>{$iIDEntry} <a href='wap/entryPrinter.php?entryId={$iIDEntry}&autoPrint=true' target='_new'><img src='images/icons/qr.png' class='iconLink' alt='{#ADMIN_ENTRY_PRINT#}' title='{#ADMIN_ENTRY_PRINT#}' /></a></td>
		</tr>		
		<tr>
			<td class='inputLabel'>{#ENTRIES#}</td>
			<td>{$iNoOfEntries}</td>
		</tr>
			{if $bIsStart == true}
				{* ONLY DISPLAY THE HR IF IT'S THE START OF THE FORM *}
				<tr>
					<td colspan='2'><hr /></td>
				</tr>
			{/if}
			<tr>
				<td class='inputLabel'>
				{if $bIsStart == true}
					{* ONLY DISPLAY THE LABEL IF IT'S THE START OF THE FORM *}
					{#VOID_ENTRY#}
				{/if}
				</td>
				<td>{$aInputs.bVoid.input}</td>
			</tr>
			
		<tr>
			<td colspan='2'><hr /></td>
		</tr>						
		
		{* loop through all the game and score selects *}
		{assign var="iNumber" value="1"}
		{section name=section loop=$aInputGames}
		<tr>
			<td valign='top' class='inputLabel'>
			{if $smarty.section.section.iteration % 2 != 0}
				{#GAME#} 
			{else}
				{#SCORE#}
			{/if}
			{$iNumber} | 
			</td>	
			{assign var="sInputName" value=$aInputGames[section]}
			<td>
			{$aInputs.$sInputName.input} 
				
				{if $aInputs.$sInputName.hasWarning == "true"}
					<b class='highLight'>{$aInputs.$sInputName.verValue}</b>
				{else}
					{$aInputs.$sInputName.verValue}
				{/if}			
			</td>
		</tr>	
			{if $smarty.section.section.iteration % 2 == 0}
				<tr>
					<td colspan='2'><hr /></td>
				</tr>
				{assign var="iNumber" value="`$iNumber+1`"}
			{/if}
		{/section}
		<tr>
			<td></td>
			<td>{$sButtons}</td>
		</tr>
	</table>
	{$sFormEnd}
{/if}