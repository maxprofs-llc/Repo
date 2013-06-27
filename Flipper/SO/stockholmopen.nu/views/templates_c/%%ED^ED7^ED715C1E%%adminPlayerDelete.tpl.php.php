<?php /* Smarty version 2.6.16, created on 2008-04-03 16:04:55
         compiled from admin/adminPlayerDelete.tpl.php */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/header.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h2><?php echo $this->_config[0]['vars']['ADMIN']; ?>
: <?php echo $this->_config[0]['vars']['ADMIN_DELETE_PLAYERS_TEAMS_HL']; ?>
</h2>

<?php if ($this->_tpl_vars['bIsCompleted'] == 'true'):  echo $this->_config[0]['vars']['ADMIN_DELETE_PLAYERS_TEAMS_DELETED']; ?>

<?php endif; ?>

<?php if ($this->_tpl_vars['bDisplayForm'] == true): ?>
	<?php echo $this->_config[0]['vars']['ADMIN_DELETE_PLAYERS_TEAMS_CONF']; ?>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "formsAdmin/form.entryAndPlayerDelete.tpl.php", 'smarty_include_vars' => array('title' => 'delete')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	
<?php endif;  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/footer.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>