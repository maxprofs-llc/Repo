{include file="elements/header.tpl.php" title=header}

{literal}
<script type="text/javascript">
	function displayActiveUsers()
	{
		new Ajax.PeriodicalUpdater('activeUsers', 'ajax/activeUsers.php', {asynchronous:true, frequency: 5});
	}

	function displayActiveGuests()
	{
		new Ajax.PeriodicalUpdater('activeGuests', 'ajax/activeGuests.php', {asynchronous:true, frequency: 5});
	}

	womAdd('displayActiveUsers()');
	womAdd('displayActiveGuests()');
	womOn();
</script>	
{/literal}

<h2>{#USER_ACTIVITY_HL#}</h2>
{#USER_ACTIVITY_MAIN#}

<br />
<br />
<div id='activeUsers'>
</div>

<div id='activeGuests'>
</div>

{include file="elements/footer.tpl.php" title=footer}