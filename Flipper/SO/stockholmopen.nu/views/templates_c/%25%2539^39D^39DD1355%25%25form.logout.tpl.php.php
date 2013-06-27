<?php /* Smarty version 2.6.16, created on 2008-03-30 04:12:03
         compiled from forms/form.logout.tpl.php */ ?>
<?php if ($this->_tpl_vars['g_aUser'] != null): ?>
<form action='redirects/logout.php' method='get'>
<table class='formTable'>
<tr>
	<td colspan='2' align='left'><b>Login Info</b></td>
</tr>
<tr>
	<td><?php echo $this->_config[0]['vars']['LOGGED_IN_AS']; ?>
</td>
	<td><?php echo $this->_tpl_vars['g_aUser']; ?>
</td>
</tr>
<tr>
	<td colspan='2' align='left'><input type='submit' class='<?php echo $this->_config[0]['vars']['INPUT_SUBMIT_DEFAULT']; ?>
' value='<?php echo $this->_config[0]['vars']['LOGOUT']; ?>
' /></td>
</tr>
</table>
<input type='hidden' name='sRedirect' value='<?php echo $this->_tpl_vars['g_sPage']; ?>
' />
</form>
<?php endif; ?>