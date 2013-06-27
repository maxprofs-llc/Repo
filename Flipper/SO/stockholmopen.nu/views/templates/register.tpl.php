{include file="elements/header.tpl.php"}

<!-- echo the javascript that sets the limit for a textare -->
{$sTextAreaLimitJavascript}

{if $iIDEdit == null}
	<h2>{#REGISTER_HL#}
	
	(
	{if $bIsStart}
		{#STEP_ONE_OF_THREE#}
	{/if}
	
	{if $bIsVerOption == "verOption"}
		{#STEP_TWO_OF_THREE#}
	{/if}
	
	{if $bIsCompleted}
		{#DONE#}
	{/if}
	)
	
	
	</h2>
	
	{if $bIsVerOption == "verOption"}
		{#REGISTER_VER#}
	{/if}
	
	{if $bDisplayStartText}
		{eval var=#REGISTER_MAIN#}
		<br />
		<br />
		{eval var=#REGISTER_PROBLEMS#}
		<br />
		<br />	
	{/if}
{else}
	<h2>{#ADMIN#}: {#EDIT_PLAYER#}</h2>
{/if}
	
{include file="forms/form.playerData.tpl.php"}

{include file="elements/footer.tpl.php"}