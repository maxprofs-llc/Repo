<!-- <form action='login.php' method='post'> -->
<form action="{$smarty.const.LOGIN_URL}" method='post'>
<br />
<div id='login' style='display:none;'>
{include file="forms/form.loginAjax.tpl.php" title=login}
</div>
</form>
