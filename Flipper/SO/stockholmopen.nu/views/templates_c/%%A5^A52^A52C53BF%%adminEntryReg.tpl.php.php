<?php /* Smarty version 2.6.16, created on 2008-06-06 12:24:14
         compiled from admin/adminEntryReg.tpl.php */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/header.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['bIsCompleted'] == 'true'): ?>
	<?php echo '
	<script type="text/javascript">

	function focus()
	{
		document.getElementById(\'another\').focus();
	}

	womAdd(\'focus()\');
	womOn();
	</script>
	'; ?>


<?php else: ?>
	<?php if ($this->_tpl_vars['sFormState'] == 'verOption'): ?>
		<?php echo '
		<script type="text/javascript">
	
		function focus()
		{
			document.getElementById(\'buttonVerBack\').focus();
		}
	
		womAdd(\'focus()\');
		womOn();
		</script>
		'; ?>
	
	<?php elseif ($this->_tpl_vars['bIsStart'] == 'true'): ?>
		<?php echo '
		<script type="text/javascript">
	
		function focus()
		{
			document.getElementById(\'';  echo $this->_tpl_vars['sFocus'];  echo '\').focus();
		}
	
		womAdd(\'focus()\');
		womOn();
		</script>
		'; ?>
		
	<?php else: ?>
		<?php echo '
		<script type="text/javascript">
	
		function focus()
		{
			document.getElementById(\'';  echo $this->_tpl_vars['sFocus'];  echo '\').focus();
		}
	
		womAdd(\'focus()\');
		womOn();
		</script>
		'; ?>
		
	<?php endif;  endif; ?>

<h2><?php echo $this->_config[0]['vars']['ADMIN']; ?>
: <?php echo $this->_config[0]['vars']['ADMIN_ENTRY_REG_HL']; ?>


(
<?php if ($this->_tpl_vars['bIsStart'] == 'true'): ?>
	<?php echo $this->_config[0]['vars']['STEP_TWO_OF_FOUR']; ?>

<?php endif; ?>

<?php if ($this->_tpl_vars['bIsVerOption'] == 'true'): ?>
	<?php echo $this->_config[0]['vars']['STEP_THREE_OF_FOUR']; ?>

<?php endif; ?>

<?php if ($this->_tpl_vars['bIsCompleted'] == 'true'): ?>
	<?php echo $this->_config[0]['vars']['DONE']; ?>

<?php endif; ?>
)

</h2>

<?php if ($this->_tpl_vars['bIsStart'] == 'true'): ?>
	<?php echo $this->_config[0]['vars']['ADMIN_ENTRY_STEP_TWO']; ?>

<?php endif; ?>


<?php if ($this->_tpl_vars['bIsVerOption'] == 'true'): ?>
	<?php echo $this->_config[0]['vars']['ADMIN_ENTRY_STEP_THREE']; ?>

<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "formsAdmin/form.entryReg.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['bIsCompleted'] == 'true'):  endif; ?>

<?php if ($this->_tpl_vars['bIsCompleted'] == 'true'): ?>
	<br />
	<a href='adminEntryRegStart.php' id='another'><?php echo $this->_config[0]['vars']['ADMIN_ENTRY_REG_ANOTHER']; ?>
</a>
<?php endif; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/footer.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>