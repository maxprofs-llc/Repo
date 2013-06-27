{include file="elements/header.tpl.php"}

<h2>{#ADMIN#}: {#ADMIN_VOID_SPLIT_HL#}</h2>

{if $bVoided != true}
	<p>
	{#ADMIN_VOID_SPLIT_MAIN#}
	</p>
	
	<p>
	<b class='highLight'>{#ADMIN_VOID_SPLIT_WARNING#}</b>
	</p>
	
	<h3>{$aTeam.player_firstname}</h3>
	
	{$aTeam.split_1_firstname} {$aTeam.split_1_lastname} & {$aTeam.split_2_firstname} {$aTeam.split_2_lastname}
	
	<form method="post" action='{$sAction}'>
	<input type='submit' value='{#VOID#}' />
	<input type='hidden' name='iIDTeam' value='{$iIDTeam}' />
	<input type='hidden' name='bPost' value='true' />
	</form>
{else}
	<p>
	{#ADMIN_VOID_SPLIT_TEAM_VOIDED#}
	</p>
{/if}
	
{include file="elements/footer.tpl.php"}