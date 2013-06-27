<?php /* Smarty version 2.6.16, created on 2008-03-30 04:47:59
         compiled from formsAdmin/form.userAdd.tpl.php */ ?>
<?php if ($this->_tpl_vars['bIsDefaultCompleted'] == true): ?>
	<b class='highLight'><?php echo $this->_config[0]['vars']['ADMIN_ADD_USER_ADDED']; ?>
</b>
	<br />
	<br />
<?php endif; ?>

<?php if ($this->_tpl_vars['bIsEditCompleted'] == true): ?>
	<b class='highLight'><?php echo $this->_config[0]['vars']['ADMIN_EDIT_USER_UPDATED']; ?>
</b>
	<br />
	<br />
<?php endif; ?>

<?php if ($this->_tpl_vars['bIsDeleteCompleted'] == true): ?>
	<b class='highLight'><?php echo $this->_config[0]['vars']['ADMIN_EDIT_USER_DELETED']; ?>
</b>
	<br />
	<br />
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
	<?php if ($this->_tpl_vars['aCustomErrors']['userNameExits'] == true): ?>
		- <?php echo $this->_config[0]['vars']['ERROR_USERNAME_EXISTS']; ?>
<br />
	<?php endif; ?>

	<?php if ($this->_tpl_vars['aCustomErrors']['invalidChars'] == true): ?>
		- <?php echo $this->_config[0]['vars']['ERROR_USERNAME_INVALID_CHARS']; ?>
<br />
	<?php endif; ?>
		
	<?php if ($this->_tpl_vars['aCustomErrors']['passwordMismatch'] == true): ?>
		- <?php echo $this->_config[0]['vars']['ERROR_PASSWORD_MISMATCH']; ?>
<br />
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['aCustomErrors']['cannotDelete'] == true): ?>
		- <?php echo $this->_config[0]['vars']['ERROR_CANT_DELETE_UBER_ADMIN']; ?>
<br />
	<?php endif; ?>		
	</div>		
<?php endif; ?>

<?php if ($this->_tpl_vars['bDisplayForm'] == true):  echo $this->_config[0]['vars']['FIELDS_MARKED_REQUIRED']; ?>

<br />

	<?php echo $this->_tpl_vars['sFormStart']; ?>

	<table class='formTable'>
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['USERNAME']; ?>
 <?php echo $this->_config[0]['vars']['REQ_FIELD_SIGN']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['sUsername']['input']; ?>
</td>
		</tr>
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['FIRSTNAME']; ?>
 <?php echo $this->_config[0]['vars']['REQ_FIELD_SIGN']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['sFirstname']['input']; ?>
</td>
		</tr>
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['LASTNAME']; ?>
 <?php echo $this->_config[0]['vars']['REQ_FIELD_SIGN']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['sLastname']['input']; ?>
</td>
		</tr>
				<?php if ($this->_tpl_vars['bIsEditForm'] == false): ?>
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
		<?php endif; ?>		
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['EMAIL']; ?>
 <?php echo $this->_config[0]['vars']['REQ_FIELD_SIGN']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['sEmail']['input']; ?>
</td>
		</tr>	
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['FULL_ADMIN']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['sUberAdmin']['input']; ?>
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