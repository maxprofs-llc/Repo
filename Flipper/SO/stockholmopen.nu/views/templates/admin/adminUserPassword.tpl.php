{include file="elements/header.tpl.php"}

<h2>{#ADMIN#}: {#ADMIN_CHANGE_PASSWORD_HL#}</h2>
{#ADMIN_CHANGE_PASSWORD_MAIN#} {$sUsername}
<br />
<br />

{include file="formsAdmin/form.userPassword.tpl.php"}

{include file="admin/recycled/userList.tpl.php"}

{include file="elements/footer.tpl.php"}