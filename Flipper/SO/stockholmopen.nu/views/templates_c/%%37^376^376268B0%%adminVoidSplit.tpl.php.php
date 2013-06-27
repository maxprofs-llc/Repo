<?php /* Smarty version 2.6.16, created on 2013-06-15 22:58:55
         compiled from admin/adminVoidSplit.tpl.php */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/header.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h2><?php echo $this->_config[0]['vars']['ADMIN']; ?>
: <?php echo $this->_config[0]['vars']['ADMIN_VOID_SPLIT_HL']; ?>
</h2>

<?php if ($this->_tpl_vars['bVoided'] != true): ?>
	<p>
	<?php echo $this->_config[0]['vars']['ADMIN_VOID_SPLIT_MAIN']; ?>

	</p>
	
	<p>
	<b class='highLight'><?php echo $this->_config[0]['vars']['ADMIN_VOID_SPLIT_WARNING']; ?>
</b>
	</p>
	
	<h3><?php echo $this->_tpl_vars['aTeam']['player_firstname']; ?>
</h3>
	
	<?php echo $this->_tpl_vars['aTeam']['split_1_firstname']; ?>
 <?php echo $this->_tpl_vars['aTeam']['split_1_lastname']; ?>
 & <?php echo $this->_tpl_vars['aTeam']['split_2_firstname']; ?>
 <?php echo $this->_tpl_vars['aTeam']['split_2_lastname']; ?>

	
	<form method="post" action='<?php echo $this->_tpl_vars['sAction']; ?>
'>
	<input type='submit' value='<?php echo $this->_config[0]['vars']['VOID']; ?>
' />
	<input type='hidden' name='iIDTeam' value='<?php echo $this->_tpl_vars['iIDTeam']; ?>
' />
	<input type='hidden' name='bPost' value='true' />
	</form>
<?php else: ?>
	<p>
	<?php echo $this->_config[0]['vars']['ADMIN_VOID_SPLIT_TEAM_VOIDED']; ?>

	</p>
<?php endif; ?>
	
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/footer.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>