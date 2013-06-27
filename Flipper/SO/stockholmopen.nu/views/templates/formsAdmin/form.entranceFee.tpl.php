{literal}
<script type="text/javascript">
	function updateFee(sInputName)
	{
		bChecked = document.getElementById(sInputName).checked;
		new Ajax.Updater('player'+sInputName, 'ajax/updateFee.php?sInput='+sInputName+'&bChecked='+bChecked);
	}
</script>
{/literal}

{if $bIsCompleted}
	<div class='info'>
		{#ADMIN_TENTRANCE_FEES_UPDATED#}
	</div>
	<br />
{/if}

<b class='highLight'><i>{#NO_NEED_TO_SUBMIT_FORM_CHECKBOXES#}</i></b>

{if $bDisplayForm}
	<table class='formTable'>
	<tr>
		<td class='HL'>{#NAME#}</td>
		<td class='HL'>{#DIVISION_SHORT#}</td>
		<td class='HL'>{#PAID#}</td>
		<td class='HL' width='400'></td>
	</tr>
	{section name=section loop=$aPlayersAndDivisions}
	
	{if $aPlayersAndDivisions[section].division_name_short != $sPrevDivision}
		<tr class='lineDark'>
			<td colspan='4'><b>{$aPlayersAndDivisions[section].division_name_short} {#DIVISION#}</b></td>
		<tr>
	{/if}
	
	{if $smarty.section.section.iteration is odd}
		<tr {#MOUSE_OVER_DEFAULT#}>
	{else}
		<tr class='lineDark' {#MOUSE_OVER_DARK#}>
	{/if}
		{assign var="sInput1" value=$aPlayersAndDivisions[section].id_player}
		{assign var="sInput2" value=$aPlayersAndDivisions[section].division_name_short}
		{assign var="sInputName" value=$sInput1$sInput2}

		<td>{$aInputs.sPlayers.$sInputName.output}</td>
		<td>{$aPlayersAndDivisions[section].division_name_short} {#DIVISION#}</td>
		<td>{$aInputs.sPlayers.$sInputName.input}</td>
		<td>
			{* POPULATED BY AJAX-CALLS *}
			<div id="player{$sInputName}">
			</div>
		</td>
	</tr>
		{assign var="sPrevDivision" value=$aPlayersAndDivisions[section].division_name_short}
	{/section}
	</table>
{/if}