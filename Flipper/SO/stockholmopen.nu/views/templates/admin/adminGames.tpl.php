{include file="elements/header.tpl.php"}

{literal}
<script type="text/javascript">
function focus()
{
	document.getElementById('addAnother').focus();
}

	womAdd('focus()');
	womOn();
</script>
{/literal}

<h2>{#ADMIN#}: {#ADMIN_GAMES#}</h2>

{#ADMIN_GAMES_MAIN#}
<br />
<br />

<h3>{#ADD_EDIT_GAME#}</h3>

{include file="formsAdmin/form.games.tpl.php"}

<h3>{#GAMES#}</h3>

{include file="recycled/gameList.tpl.php"}

{include file="elements/footer.tpl.php"}