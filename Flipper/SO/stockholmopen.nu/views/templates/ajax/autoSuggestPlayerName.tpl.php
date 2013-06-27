{if $aPlayers != null}
	<ul>
	{section name=section loop=$aPlayers}
			<li>{$aPlayers[section].player_name|truncate:24:"..."} ({$aPlayers[section].player_initials})</li>
	{/section}
	</ul>
{/if}