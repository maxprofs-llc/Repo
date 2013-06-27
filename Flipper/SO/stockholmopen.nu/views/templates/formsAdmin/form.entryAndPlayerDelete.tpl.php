	{$sFormStart}
	{$sButtons}
	{$sFormEnd}
	<br />
	<table>
	<tr>
		<td>
		
		{if $aPlayers.0.player_is_split_team == 1}
			{#TEAM_NAME#}
		{else}
			{#PLAYER_NAME#}
		{/if}	
		
		</td>
		<td><a href='player.php?iIDPlayer={$aPlayers.0.id_player}'>{$aPlayers.0.player_firstname} {$aPlayers.0.player_lastname}</a></td>
	</tr>
	
	<tr>
		<td>{#INITIALS#}</td>
		<td>{$aPlayers.0.player_initials}</td>
	</tr>
	
	{if $aPlayers.0.player_is_split_team == 1}
		<tr>
			<td>{#PLAYERS#}</td>
			<td><a href='player.php?iIDPlayer={$aPlayers.0.split_1_id_player}'>{$aPlayers.0.split_1_firstname} {$aPlayers.0.split_1_lastname}</a> &amp; <a href='player.php?iIDPlayer={$aPlayers.0.split_2_id_player}'>{$aPlayers.0.split_2_firstname} {$aPlayers.0.split_2_lastname}</a></td>
		</tr>
	{/if}
	
	<tr>
		<td>{#CITY#}</td>
		<td>
		{if $aPlayers.0.player_is_split_team == 1}
			{$aPlayers.0.split_1_address_city} / {$aPlayers.0.split_2_address_city}
		{else}
			{$aPlayers.0.player_address_city}
		{/if}
		</td>
	</tr>
	<tr>
		<td>{#COUNTRY#}</td>
		<td>
		{if $aPlayers.0.player_is_split_team == 1}
			<img src='images/icons/flags/{$aPlayers.0.split_1_country_code}.gif' alt='{$aPlayers.0.split_1_country_name}' title='{$aPlayers.0.split_1_country_name}' /> <img src='images/icons/flags/{$aPlayers.0.split_2_country_code}.gif' alt='{$aPlayers.0.split_2_country_name}' title='{$aPlayers.0.split_2_country_name}' />
		{else}
			<img src='images/icons/flags/{$aPlayers.0.country_code}.gif' alt='{$aPlayers.0.country_name}' title='{$aPlayers.0.country_name}' />
		{/if}
		</td>
	</tr>
	</table>