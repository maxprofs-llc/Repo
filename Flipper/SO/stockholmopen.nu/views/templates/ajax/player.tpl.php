{config_load file=lang/$sLang/config.$sLang.lang.php}

{if $bSearching}
	<span class='light'>{#SEARCHING_FOR_PLAYER#} ...</span>
{/if}

{if $aPlayer != null}
	{$aPlayer.player_firstname} {$aPlayer.player_lastname} ({$aPlayer.player_initials}) 
{/if}