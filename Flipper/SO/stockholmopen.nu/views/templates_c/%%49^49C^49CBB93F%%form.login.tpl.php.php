<?php /* Smarty version 2.6.16, created on 2008-03-30 21:47:26
         compiled from forms/form.login.tpl.php */ ?>
<?php if ($this->_tpl_vars['bIsCompleted']): ?>
	<?php echo $this->_config[0]['vars']['LOGIN_LOGGED_IN']; ?>

<?php else: ?>
	<i><?php echo $this->_config[0]['vars']['LOGIN_USERNAME_PASSWORD_CASE_SENSITIVE']; ?>
</i>
<?php endif; ?>


<?php if ($this->_tpl_vars['bHasErrors']): ?>
	<div class='highLight'>
		<b class='highLight'><?php echo $this->_config[0]['vars']['ERROR']; ?>
</b>
		<br />
		<?php if ($this->_tpl_vars['bReqFieldsMissing'] == true): ?>
			- <?php echo $this->_config[0]['vars']['FIELDS_MISSING_FORM']; ?>
<br />
		<?php endif; ?>
		<?php if ($this->_tpl_vars['aCustomErrors']['loginFailed'] == true): ?>
			- <?php echo $this->_config[0]['vars']['LOGIN_LOGIN_FAILED']; ?>
<br />
		<?php endif; ?>
	</div>		
<?php endif; ?>

<?php if ($this->_tpl_vars['bDisplayForm']): ?>
	<?php echo $this->_tpl_vars['sFormStart']; ?>

	<table class='formTable'>
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['USERNAME']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['sUsername']['input']; ?>
</td>
		</tr>
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['PASSWORD']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['sPassword']['input']; ?>
</td>
		</tr>
		<tr>
			<td></td>
			<td><?php echo $this->_tpl_vars['sButtons']; ?>
</td>
		</tr>
	</table>
	<?php echo $this->_tpl_vars['sFormEnd']; ?>

<?php endif; ?>	