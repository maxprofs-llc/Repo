{if $g_aUser != null}
<form action='redirects/logout.php' method='get'>
<table class='formTable'>
<tr>
	<td colspan='2' align='left'><b>Login Info</b></td>
</tr>
<tr>
	<td>{#LOGGED_IN_AS#}</td>
	<td>{$g_aUser}</td>
</tr>
<tr>
	<td colspan='2' align='left'><input type='submit' class='{#INPUT_SUBMIT_DEFAULT#}' value='{#LOGOUT#}' /></td>
</tr>
</table>
<input type='hidden' name='sRedirect' value='{$g_sPage}' />
</form>
{/if}