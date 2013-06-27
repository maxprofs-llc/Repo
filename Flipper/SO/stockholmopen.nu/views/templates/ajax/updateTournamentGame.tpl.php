{config_load file=lang/$sLang/config.$sLang.lang.php}

{*
{if $bChecked == "true"}
	{#UPDATE_TOURNAMENT_GAME_IN#}
{else}
	{#UPDATE_TOURNAMENT_GAME_OFF#}
{/if}
*}
{$aPlayer.player_firstname}	{$aPlayer.player_lastname} 