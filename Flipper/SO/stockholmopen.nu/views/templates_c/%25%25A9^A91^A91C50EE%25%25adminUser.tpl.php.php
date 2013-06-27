<?php /* Smarty version 2.6.16, created on 2008-03-30 04:47:59
         compiled from admin/adminUser.tpl.php */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/header.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<h2><?php echo $this->_config[0]['vars']['ADMIN']; ?>
:

<?php if ($this->_tpl_vars['sFormState'] == 'defaultStart' || $this->_tpl_vars['bIsDefaultCompleted'] == 'true'): ?>
	<?php echo $this->_config[0]['vars']['ADMIN_ADD_USER_HL']; ?>

<?php endif; ?>

<?php if ($this->_tpl_vars['sFormState'] == 'editStart' || $this->_tpl_vars['bIsEditCompleted'] == 'true'): ?>
	<?php echo $this->_config[0]['vars']['ADMIN_EDIT_USER_HL']; ?>

<?php endif; ?>

<?php if ($this->_tpl_vars['bIsDeleteFailed'] == 'true' || $this->_tpl_vars['bIsDeleteCompleted'] == 'true'): ?>
	<?php echo $this->_config[0]['vars']['ADMIN_DELETE_USER_HL']; ?>

<?php endif; ?>

</h2>

<?php if ($this->_tpl_vars['sFormState'] == 'defaultStart'):  echo $this->_config[0]['vars']['ADMIN_ADD_USER_MAIN']; ?>

<br />
<br />
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "formsAdmin/form.userAdd.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/recycled/userList.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/footer.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>