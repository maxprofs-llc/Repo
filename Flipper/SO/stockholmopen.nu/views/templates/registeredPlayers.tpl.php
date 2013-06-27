{include file="elements/header.tpl.php" title=header}

{if $sDivision == "S"}
	<h2>{#REG_TEAMS_HL#} - {$iYear} - {$sDivision} {#DIVISION#}</h2>
	{#REG_TEAMS_MAIN#}
{else}
	<h2>{#REG_PLAYERS_HL#} - {$iYear} - {$sDivision} 
	
	{*
	{if $sDivision != $sDivisionLongName}
		({$sDivisionLongName})
	{/if}
	*}
	
	{#DIVISION#}</h2>
	<p>
	{#REG_PLAYERS_MAIN#}
	<br />
	<br />
	{if $bDivisionIsFree != 1}
		{#REG_PLAYERS_PAYMENT_INFO#}
	{else}
		{#REG_PLAYERS_FREE_INFO#}
	{/if}		
	</p>
{/if}
	
<p>
{if $sDivision == "S"}
	{#NUMBER_OF_REGISTERED_TEAMS#}: 
{else}
	{#NUMBER_OF_REGISTERED_PLAYERS#}: 
{/if}
<b>{$iNoOfPlayers}</b> 


{if $sDivision != "S" && $iNumberOfCountries > 1}
	({#FROM#|lower} {$iNumberOfCountries} {#COUNTRIES#|lower})
{/if}
.

{if $bDivisionIsFree != 1}
	{#NUMBER_OF_PAID_ENTRANCE_FEES#}: <b>{$iPlayersWithEntranceFee}</b>.
{/if}

</p>

{include file="recycled/playersAndStandings.tpl.php" title=footer}

{include file="elements/footer.tpl.php" title=footer}
