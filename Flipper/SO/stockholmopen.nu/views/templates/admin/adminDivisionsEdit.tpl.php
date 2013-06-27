{include file="elements/header.tpl.php"}

<h2>{#ADMIN#}: {#ADMIN_DIVISIONS_ADD#}</h2>

{#ADMIN_DIVISIONS_MAIN#}
<br />
<br />

<b class='highLight'>{#WARNING#}</b>: {#USE_THIS_FUNCTION_WITH_CAUTION#}
<br />

<h3>{#ADMIN_DIVISIONS_FOR#} {$g_iYear}</h3>

{include file="formsAdmin/form.divisionEdit.tpl.php"}

{include file="elements/footer.tpl.php"}