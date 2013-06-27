<?php /* Smarty version 2.6.16, created on 2008-03-30 05:13:58
         compiled from formsAdmin/form.news.tpl.php */ ?>
<?php if ($this->_tpl_vars['bIsDefaultCompleted'] == true): ?>
	<b class='highLight'><?php echo $this->_config[0]['vars']['ADMIN_NEWS_ADDED']; ?>
</b>
	<br />
	<br />
<?php endif; ?>

<?php if ($this->_tpl_vars['bIsEditCompleted'] == true): ?>
	<b class='highLight'><?php echo $this->_config[0]['vars']['ADMIN_NEWS_UPDATED']; ?>
</b>
	<br />
	<br />
<?php endif; ?>

<?php if ($this->_tpl_vars['bIsDeleteCompleted'] == true): ?>
	<b class='highLight'><?php echo $this->_config[0]['vars']['ADMIN_NEWS_DELETED']; ?>
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
	</div>		
<?php endif; ?>

<?php if ($this->_tpl_vars['bDisplayForm'] == true): ?>
<br />

	<?php echo $this->_tpl_vars['sFormStart']; ?>

	<table class='formTable'>
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['TEXT']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['sText']['input']; ?>
</td>
		</tr>
		<tr>
		<tr>
			<td></td>
			<td><?php echo $this->_tpl_vars['sButtons']; ?>
</td>
		</tr>
	</table>
	<?php echo $this->_tpl_vars['sFormEnd']; ?>

<?php endif; ?>	