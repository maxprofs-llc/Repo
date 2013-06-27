{if $bIsDefaultCompleted == true}
	<b class='highLight'>{#ADMIN_NEWS_ADDED#}</b>
	<br />
	<br />
{/if}

{if $bIsEditCompleted == true}
	<b class='highLight'>{#ADMIN_NEWS_UPDATED#}</b>
	<br />
	<br />
{/if}

{if $bIsDeleteCompleted == true}
	<b class='highLight'>{#ADMIN_NEWS_DELETED#}</b>
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
	</div>		
{/if}

{if $bDisplayForm == true}
<br />

	{$sFormStart}
	<table class='formTable'>
		<tr>
			<td class='inputLabel'>{#TEXT#}</td>
			<td>{$aInputs.sText.input}</td>
		</tr>
		<tr>
		<tr>
			<td></td>
			<td>{$sButtons}</td>
		</tr>
	</table>
	{$sFormEnd}
{/if}	