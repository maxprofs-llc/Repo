{include file="elements/header.tpl.php"}

<h2>{#ADMIN#}: {#ADMIN_TOURN_GAMES#}</h2>

{#ADMIN_TOURN_GAMES_MAIN#}
<br />
<br />

<b class='highLight'>{#WARNING#}</b>: {#USE_THIS_FUNCTION_WITH_CAUTION#}
<br />

<h3>{#GAMES#} {$g_iYear}</h3>

{include file="formsAdmin/form.gamesTournament.tpl.php"}

{include file="elements/footer.tpl.php"}