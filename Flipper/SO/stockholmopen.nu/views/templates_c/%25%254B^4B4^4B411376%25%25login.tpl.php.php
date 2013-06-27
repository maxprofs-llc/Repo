<?php /* Smarty version 2.6.16, created on 2008-03-30 04:47:34
         compiled from login.tpl.php */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/header.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h2><?php echo $this->_config[0]['vars']['LOGIN_HL']; ?>
</h2>

<?php if ($this->_tpl_vars['bIsPosted'] != true && $this->_tpl_vars['g_bIsLoggedIn'] != true): ?>
	<?php echo $this->_config[0]['vars']['LOGIN_MAIN']; ?>

<?php endif; ?>

<?php if ($this->_tpl_vars['bIsLoggedIn'] == false): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "forms/form.login.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  else: ?>
	<?php echo $this->_config[0]['vars']['YOU_ARE_LOGGED_IN']; ?>

<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/footer.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>