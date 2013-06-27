{include file="elements/header.tpl.php"}

{if $bIsCompleted == "true"}
	{literal}
	<script type="text/javascript">

	function focus()
	{
		document.getElementById('another').focus();
	}

	womAdd('focus()');
	womOn();
	</script>
	{/literal}

{else}
	{if $sFormState == "verOption"}
		{literal}
		<script type="text/javascript">
	
		function focus()
		{
			document.getElementById('buttonVerBack').focus();
		}
	
		womAdd('focus()');
		womOn();
		</script>
		{/literal}	
	{elseif $bIsStart == "true"}
		{literal}
		<script type="text/javascript">
	
		function focus()
		{
			document.getElementById('{/literal}{$sFocus}{literal}').focus();
		}
	
		womAdd('focus()');
		womOn();
		</script>
		{/literal}		
	{else}
		{literal}
		<script type="text/javascript">
	
		function focus()
		{
			document.getElementById('{/literal}{$sFocus}{literal}').focus();
		}
	
		womAdd('focus()');
		womOn();
		</script>
		{/literal}		
	{/if}
{/if}

<h2>{#ADMIN#}: {#ADMIN_ENTRY_REG_HL#}

(
{if $bIsStart == "true"}
	{#STEP_TWO_OF_FOUR#}
{/if}

{if $bIsVerOption == "true"}
	{#STEP_THREE_OF_FOUR#}
{/if}

{if $bIsCompleted == "true"}
	{#DONE#}
{/if}
)

</h2>

{if $bIsStart == "true"}
	{#ADMIN_ENTRY_STEP_TWO#}
{/if}


{if $bIsVerOption == "true"}
	{#ADMIN_ENTRY_STEP_THREE#}
{/if}

{include file="formsAdmin/form.entryReg.tpl.php"}

{if $bIsCompleted == "true"}
{/if}

{if $bIsCompleted == "true"}
	<br />
	<a href='adminEntryRegStart.php' id='another'>{#ADMIN_ENTRY_REG_ANOTHER#}</a>
{/if}


{include file="elements/footer.tpl.php"}