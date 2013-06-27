<?php /* Smarty version 2.6.16, created on 2008-03-30 17:58:02
         compiled from register.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'eval', 'register.tpl.php', 31, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/header.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<!-- echo the javascript that sets the limit for a textare -->
<?php echo $this->_tpl_vars['sTextAreaLimitJavascript']; ?>


<?php if ($this->_tpl_vars['iIDEdit'] == null): ?>
	<h2><?php echo $this->_config[0]['vars']['REGISTER_HL']; ?>

	
	(
	<?php if ($this->_tpl_vars['bIsStart']): ?>
		<?php echo $this->_config[0]['vars']['STEP_ONE_OF_THREE']; ?>

	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['bIsVerOption'] == 'verOption'): ?>
		<?php echo $this->_config[0]['vars']['STEP_TWO_OF_THREE']; ?>

	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['bIsCompleted']): ?>
		<?php echo $this->_config[0]['vars']['DONE']; ?>

	<?php endif; ?>
	)
	
	
	</h2>
	
	<?php if ($this->_tpl_vars['bIsVerOption'] == 'verOption'): ?>
		<?php echo $this->_config[0]['vars']['REGISTER_VER']; ?>

	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['bDisplayStartText']): ?>
		<?php echo smarty_function_eval(array('var' => $this->_config[0]['vars']['REGISTER_MAIN']), $this);?>

		<br />
		<br />
		<?php echo smarty_function_eval(array('var' => $this->_config[0]['vars']['REGISTER_PROBLEMS']), $this);?>

		<br />
		<br />	
	<?php endif; ?>
<?php else: ?>
	<h2><?php echo $this->_config[0]['vars']['ADMIN']; ?>
: <?php echo $this->_config[0]['vars']['EDIT_PLAYER']; ?>
</h2>
<?php endif; ?>
	
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "forms/form.playerData.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/footer.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>