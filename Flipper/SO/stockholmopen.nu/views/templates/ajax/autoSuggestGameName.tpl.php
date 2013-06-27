{if $aGames != null}
	<ul>
	{section name=section loop=$aGames}
			<li>{$aGames[section].game_name}</li>
	{/section}
	</ul>
{/if}	
