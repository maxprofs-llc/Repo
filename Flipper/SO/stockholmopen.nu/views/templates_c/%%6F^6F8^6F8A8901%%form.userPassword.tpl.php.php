<?php /* Smarty version 2.6.16, created on 2008-03-30 04:48:01
         compiled from formsAdmin/form.userPassword.tpl.php */ ?>
<?php if ($this->_tpl_vars['bIsEditCompleted'] == true): ?>
	<b class='highLight'><?php echo $this->_config[0]['vars']['ADMIN_CHANGE_PASSWORD_CHANGED']; ?>
</b>
<?php endif; ?>

<?php if ($this->_tpl_vars['bHasErrors'] == true): ?>
	<div class='highLight'>
		
	<b class='highLight'><?php echo $this->_config[0]['vars']['ERROR']; ?>
</b>
	<br />
	<?php if ($this->_tpl_vars['bReqFieldsMissing'] == true): ?>
		- <?php echo $this->_config[0]['vars']['FIELDS_MISSING_FORM']; ?>
<br />
	<?php endif; ?>

	<?php if ($this->_tpl_vars['aCustomErrors']['passwordMismatch'] == true): ?>
		- <?php echo $this->_config[0]['vars']['ERROR_PASSWORD_MISMATCH']; ?>
<br />
	<?php endif; ?>
		
	</div>		
<?php endif; ?>

<?php if ($this->_tpl_vars['bDisplayForm'] == true): ?>
	<?php echo $this->_tpl_vars['sFormStart']; ?>

	<table class='formTable'>
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['PASSWORD']; ?>
 <?php echo $this->_config[0]['vars']['REQ_FIELD_SIGN']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['sPassword']['input']; ?>
</td>
		</tr>
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['PASSWORD_CONFIRM']; ?>
 <?php echo $this->_config[0]['vars']['REQ_FIELD_SIGN']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['sPasswordVerify']['input']; ?>
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