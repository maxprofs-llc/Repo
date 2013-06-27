{literal}
<script type="text/javascript">
	function updateTournamentGame(sInputName)
	{
		bChecked = document.getElementById(sInputName).checked;
		new Ajax.Updater('game'+sInputName, 'ajax/updateTournamentGame.php?iIDGameAndDivision='+sInputName+'&bChecked='+bChecked);
	}
</script>
{/literal}

{if $bIsCompleted}
	<div class='info'>
		{#ADMIN_TOURN_GAMES_UPDATED#}
	</div>
	<br />
{/if}
<i>{#NO_NEED_TO_SUBMIT_FORM_CHECKBOXES#}</i>
{if $bDisplayForm}
	<table class='formTable'>
	<tr>
		{section name=section loop=$aDivisions}
			<td class='HL' colspan='3' align='right'>{$aDivisions[section].division_name}</td>
		{/section}
	</tr>
		
	{assign var="bNewRow" value=true}
	
	{section name=section loop=$aCheckBoxNames}
	
		{assign var="sInputName" value=$aCheckBoxNames[section]}
	
		{if $bNewRow == true}
			<tr class='lineDark' {#MOUSE_OVER_DARK#}>
			{assign var="bNewRow" value=false}
		{/if}
	
		<td align='right'>{$aInputs.sGames.$sInputName.output}</td>
		<td>{$aInputs.sGames.$sInputName.input}</td>
		<td>
			{* POPLUATED BY AJAX-CALLS *}
			<div id="game{$sInputName}">
			</div>
		</td>
		
		{if $smarty.section.section.iteration % $iNumberOfDivisions == 0}
			{assign var="bNewRow" value=true}
			</tr>
		{/if}
	
	{/section}
	</table>
{/if}