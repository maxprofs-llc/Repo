{config_load file=lang/$sLang/config.$sLang.lang.php}

{if $bSearching}
	<span class='light'>{#SEARCHING#} ...</span>
{/if}

{if $aPlayer != null}
	{$aPlayer.player_firstname} {$aPlayer.player_lastname} ({$aPlayer.player_initials}/{$iIDPlayer})
{/if}

{if $iIDEntry != null}
	&amp; {$iIDEntry} = 
	{if $bMatch == false}
		<img src='images/icons/notOK.gif' alt='{#ERROR#}' />
	{/if}
	
	{if $bMatch == true}
		<img src='images/icons/OK.gif' alt='{#OK#}' />
	{/if}	
{/if}