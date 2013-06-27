{include file="elements/header.tpl.php"}

{if $iIDEdit == null}
	<h2>{#REGISTER_SPLIT_HL#}
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
		{eval var=#REGISTER_SPLIT_MAIN#}
		<br />
		<br />
		{eval var=#REGISTER_PROBLEMS#}
		<br />
		<br />	
	{/if}
{else}
	<h2>{#ADMIN#}: {#EDIT_TEAM#}</h2>
{/if}
	
{include file="forms/form.teamData.tpl.php"}

{include file="elements/footer.tpl.php"}