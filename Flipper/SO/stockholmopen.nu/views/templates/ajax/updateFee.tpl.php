{config_load file=lang/$sLang/config.$sLang.lang.php}

{if $bChecked == "true"}
	{#UPDATE_FEE_PAID#}
{else}
	{#UPDATE_FEE_NON_PAID#}
{/if}
{$aPlayer.player_firstname}	{$aPlayer.player_lastname} 