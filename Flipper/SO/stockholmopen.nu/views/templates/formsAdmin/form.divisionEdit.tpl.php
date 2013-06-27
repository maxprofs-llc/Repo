{if $bIsCompleted}
	<b class='highLight'>{#ADMIN_DIVISIONS_UPDATED#}</b>
{/if}

{if $bHasErrors}
	<div class='highLight'>
		
	<b class='highLight'>{#ERROR#}</b>
	<br />
	{if $bFieldsMissing == true}
		- {#FIELDS_MISSING_FORM#}<br />
	{/if}
	
	</div>		
{/if}

{if $bDisplayForm}
	{$sFormStart}
	{* loop through the checkbox input names *}
	{section name=section loop=$aDivisionIDs}
		{assign var="sInputName" value=$aDivisionIDs[section]}
		{$aInputs.iDivision.$sInputName.input} {$aInputs.iDivision.$sInputName.output}
		<br />
	{/section}
	{$sButtons}
	{$sFormEnd}	
{/if}