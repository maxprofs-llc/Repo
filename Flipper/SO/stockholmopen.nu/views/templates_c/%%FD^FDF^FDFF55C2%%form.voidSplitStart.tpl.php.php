<?php /* Smarty version 2.6.16, created on 2009-12-11 15:51:56
         compiled from formsAdmin/form.voidSplitStart.tpl.php */ ?>
<?php if ($this->_tpl_vars['bHasErrors']): ?>
	<div class='highLight'>
		<b class='highLight'><?php echo $this->_config[0]['vars']['ERROR']; ?>
</b>
		<br />
		<?php if ($this->_tpl_vars['bReqFieldsMissing']): ?>
			- <?php echo $this->_config[0]['vars']['FIELDS_MISSING_FORM']; ?>
<br />
		<?php endif; ?>
		
		<?php if ($this->_tpl_vars['aCustomErrors']['notSplitTeam']): ?>
			- <?php echo $this->_config[0]['vars']['ERROR_ID_NOT_SPLIT']; ?>
<br />
		<?php endif; ?>
		
		<?php if ($this->_tpl_vars['aCustomErrors']['notCurrentYear']): ?>
			- <?php echo $this->_config[0]['vars']['ERROR_TEAM_NOT_CURRENT_YEAR']; ?>
<br />
		<?php endif; ?>
	</div>		
<?php endif; ?>

<?php echo $this->_tpl_vars['sFormStart']; ?>

<table class='formTable'>
	<tr>
		<td class='inputLabel'><?php echo $this->_config[0]['vars']['TEAM_ID']; ?>
</td>
		<td><?php echo $this->_tpl_vars['aInputs']['iIDTeam']['input']; ?>
</td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo $this->_tpl_vars['sButtons']; ?>
</td>
	</tr>
</table>
<?php echo $this->_tpl_vars['sFormEnd']; ?>