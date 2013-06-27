{config_load file=lang/$sLang/config.$sLang.lang.php}
{config_load file=config.main.php}

{if $bHasErrors}
	<div class='highLight'>
		<b class='highLight'>{#ERROR#}</b>
		<br />
		{if $aCustomErrors.nonInteger}
			- {#ERROR_NON_INTEGERS#}<br />
		{/if}
		{if $bReqFieldsMissing}
			- {#FIELDS_MISSING_FORM#}<br />
		{/if}
		{if $aCustomErrors.noDivisionSelected}
			- {#ERROR_SELECT_PLAYERS_TEAMS#}<br />
		{/if}		
	</div>		
{/if}

{$sFormStart}
<table class='formTable'>
	<tr>
		<td colspan='2'>{#NUMBER_OF#}...</td>
	</tr>
	<tr>
		<td class='inputLabel'>{#MAIN_TOURNAMENT_ENTRANCE_FEES#}</td>
		<td>{$aInputs.iMain.input} {#MAIN_TOURNAMENT_ENTRANCE_PRICE_SEK#} / {#MAIN_TOURNAMENT_ENTRANCE_PRICE_EUR#} / {#MAIN_TOURNAMENT_ENTRANCE_PRICE_USD#} / {#MAIN_TOURNAMENT_ENTRANCE_PRICE_GBP#}</td>
	</tr>
	<tr>
		<td class='inputLabel'>{#CLASSICS_DIVISION_ENTRANCE_FEES#}</td>
		<td>{$aInputs.iClassics.input} {#CLASSICS_TOURNAMENT_ENTRANCE_PRICE_SEK#} / {#CLASSICS_TOURNAMENT_ENTRANCE_PRICE_EUR#} / {#CLASSICS_TOURNAMENT_ENTRANCE_PRICE_USD#} / {#CLASSICS_TOURNAMENT_ENTRANCE_PRICE_GBP#}</td>
	</tr>
	<tr>
		<td class='inputLabel'>{#SPLIT_TEAM_MEMBER_ENTRANCE_FEES#}</td>
		<td>{$aInputs.iTeamMember.input} {#SPLIT_TOURNAMENT_ENTRANCE_PRICE_SEK#} / {#SPLIT_TOURNAMENT_ENTRANCE_PRICE_EUR#} / {#SPLIT_TOURNAMENT_ENTRANCE_PRICE_USD#} / {#SPLIT_TOURNAMENT_ENTRANCE_PRICE_GBP#}</td>
	</tr>
	<tr>
		<td></td>
		<td><i>{#SPLIT_FLIPPER_NOTE#}</i></td>
	</tr>
        <tr>
                <td class='inputLabel'>{#TSHIRT_FEES#}</td>
                <td>{$aInputs.iTShirt.input} {#TSHIRT_PRICE_SEK#} / {#TSHIRT_PRICE_EUR#} / {#TSHIRT_PRICE_USD#} / {#TSHIRT_PRICE_GBP#}</td>
        </tr>
        <tr>
                <td class='inputLabel'>{#TSHIRT_SIZE#}</td>
                <td>{$aInputs.sTShirtSize.input}</td>
        </tr>
        <tr>
                <td class='inputLabel'>{#TSHIRT_COLOR#}</td>
                <td>{$aInputs.sTShirtColor.input}</td>
        </tr>
        <tr>
                <td></td>
                <td><i>{#TSHIRT_SIZE_NOTE#}</i></td>
        </tr>
	<tr>
		<td class='inputLabel'>{#CURRENCY#} {#REQ_FIELD_SIGN#}</td>
		<td>{$aInputs.sCurrency.input}</td>
	</tr>
	<tr>
		<td></td>
		<td><i>{#PAYPAL_FEE_NOTE#}</i></td>
	</tr>
	<tr>
		<td class='inputLabel'>{#PAYMENT_TYPE#}</td>
		<td>{$aInputs.iType.input}</td>
	</tr>
	{*
	<tr>
		<td></td>
		<td><input type='button' value='{#PROCEED#}' onclick='calcEntranceFee()' /></td>
	</tr>
	*}
</table>
{$sFormEnd}
