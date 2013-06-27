{* A LITTLE HACK SINCE WE WANT TO INCLUDE THIS FILE FROM A LOOP SOMETIMES *}

{if $bIncludeFromLoop != "true"}
	{include file="elements/header.tpl.php" title=header}
{else}
	{if $bIncludeHeader == "true"}
		{include file="elements/header.tpl.php" title=header}
	{/if}
{/if}

{* IF IT'S THE SINGLE ENTRY PAGE *}
{if $iIDEntry != null}
	<h2>{#ENTRY_HL#} #{$iIDEntry}
		{if $bIncludedFromAdmin	== true}
      <a href='wap/entryPrinter.php?entryId={$iIDEntry}&autoPrint=true' target='_new'><img src='images/icons/qr.png' class='iconLink' alt='{#ADMIN_ENTRY_PRINT#}' title='{#ADMIN_ENTRY_PRINT#}' /></a>
    {/if}
  </h2>
	{#ENTRY_MAIN#}
{/if}

{* IF IT's THE PLAYER PAGE *}
{if $iIDPlayer != null}
	<h2>
	{if $aPlayers.0.player_is_split_team == 1}
		{#TEAM#} 
	{else}
		{#PLAYER#}
	{/if}
	#{$iIDPlayer}
	  {if $bIncludedFromAdmin	== true}
      <a href='wap/playerPrinter.php?playerId={$iIDPlayer}&autoPrint=true' target='_new'><img src='images/icons/qr.png' class='iconLink' alt='{#ADMIN_PLAYER_PRINT#}' title='{#ADMIN_PLAYER_PRINT#}' /></a></h2>
    {/if}
	{#PLAYER_MAIN#}
{/if}

<table>
<tr>
	<td class='tableLabel'>	
	{if $aPlayers.0.player_is_split_team == 1}
		{#TEAM_NAME#}
	{else}
		{#PLAYER_NAME#}
	{/if}
	</td>
	<td><a href='player.php?iIDPlayer={$aPlayers.0.id_player}'>{$aPlayers.0.player_firstname} {$aPlayers.0.player_lastname}</a></td>
	<td rowspan='10' valign='top' width='240' align='right'>
	{if $bFileExists}
		<img src='images/players/{$aPlayers.0.id_player}.jpg' border='1' width='{$iWidth}' />
	{/if}
	</td>
</tr>

<tr>
	<td class='tableLabel'>{#INITIALS#}</td>
	<td>{$aPlayers.0.player_initials}</td>
</tr>

{if $aPlayers.0.player_is_split_team == 1}
	<tr>
		<td class='tableLabel'>{#PLAYERS#}</td>
		<td><a href='player.php?iIDPlayer={$aPlayers.0.split_1_id_player}'>{$aPlayers.0.split_1_firstname} {$aPlayers.0.split_1_lastname}</a> &amp; <a href='player.php?iIDPlayer={$aPlayers.0.split_2_id_player}'>{$aPlayers.0.split_2_firstname} {$aPlayers.0.split_2_lastname}</a></td>
	</tr>
{/if}

<tr>
	<td class='tableLabel'>{#CITY#}</td>
	<td>
	{if $aPlayers.0.player_is_split_team == 1}
		{$aPlayers.0.split_1_address_city} / {$aPlayers.0.split_2_address_city}
	{else}
		{$aPlayers.0.player_address_city}
	{/if}
	</td>
</tr>
<tr>
	<td class='tableLabel'>{#COUNTRY#}</td>
	<td>
	{if $aPlayers.0.player_is_split_team == 1}
		<img src='images/icons/flags/{$aPlayers.0.split_1_country_code}.gif' alt='{$aPlayers.0.split_1_country_name}' title='{$aPlayers.0.split_1_country_name}' /> <img src='images/icons/flags/{$aPlayers.0.split_2_country_code}.gif' alt='{$aPlayers.0.split_2_country_name}' title='{$aPlayers.0.split_2_country_name}' />
	{else}
		<img src='images/icons/flags/{$aPlayers.0.country_code}.gif' alt='{$aPlayers.0.country_name}' title='{$aPlayers.0.country_name}' />
	{/if}
	</td>
</tr>

<tr>
	<td class='tableLabel'>{#YEAR_ENTERED#}</td>
	<td>{$aPlayers.0.player_year_entered}</td>
</tr>

{section name=section loop=$aDivisions}
	<tr>	
		<td class='HL' colspan='2'>{$aDivisions[section].division_name_short} {#DIVISION#}</td>
	</tr>
	<tr>
		<td class='tableLabel'>{#QUAL_POSITION#}</td>
		<td>
		{if $aDivisions[section].best_entry_position != null}
			{$aDivisions[section].best_entry_position}
		{else}
			{#NA#}
		{/if}
		</td>
	</tr>
	<tr>
		<td class='tableLabel'>{#PLAYED_ENTRIES#}</td>
		<td>
		{if $aDivisions[section].no_of_played_entries != null}
			{$aDivisions[section].no_of_played_entries}
		{else}
			{#NA#}
		{/if}
		</td>
	</tr>
	<tr>
		<td class='tableLabel'>{#AVERAGE_ENTRY_SCORE#}</td>
		<td>
		{if $aDivisions[section].avg_score != null}
			{$aDivisions[section].avg_score}
		{else}
			{#NA#}
		{/if}
		</td>
	</tr>			
{/section}

{if $bPlayerHasPlayedEntries != false}
	<tr>
		<td colspan='2'><span class='smallLight'>{#AVERAGE_VOIDED_ENTRIES_NOT_INCLUDED#}</span></td>
	</tr>
{/if}
	
{* IF IT'S THE SINGLE ENTRY PAGE *}
{if $iIDEntry != null}
	<tr>
		<td class='tableLabel'>{#ENTRY_POSTED#}</td>
		<td>{$aPlayers.0.entry_date_completed|truncate:16:"":true}</td>
	</tr>
{/if}
</table>

<h3>{#ENTRIES#}</h3>

{if $bPlayerHasPlayedEntries == false}
	<p>	
	{#THIS_PLAYER_HAS_NOT_PLAYED_ANY_ENTRIES#}
	</p>
{else}
	<table class='minor' width='500px'>
	{include file="recycled/entryRoundsHeadLines.tpl.php" title=entryRounds}
	
	{section name=section loop=$aPlayers}
		{if $aPlayers[section].division_name_short != $sTempDivision && $iIDEntry == null}
			<tr>
				<td class='HL' colspan='5'>{$aPlayers[section].division_name_short} {#DIVISION#}</td>
			</tr>
		{/if}
	
		{include file="recycled/entryRounds.tpl.php" title=entryRounds}
	
		{assign var="sTempDivision" value=$aPlayers[section].division_name_short}
		
	{/section}
	
	</table>
{/if}

{* A LITTLE HACK SINCE WE WANT TO INCLUDE THIS FILE FROM A LOOP SOMETIMES *}

{if $bIncludeFromLoop != "true"}
	{include file="elements/footer.tpl.php" title=footer}
{else}
	{if $bIncludeFooter == "true"}
		{include file="elements/footer.tpl.php" title=footer}
	{/if}
{/if}