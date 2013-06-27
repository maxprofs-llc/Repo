<?php /* Smarty version 2.6.16, created on 2008-03-30 23:16:40
         compiled from userActivity.tpl.php */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/header.tpl.php", 'smarty_include_vars' => array('title' => 'header')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo '
<script type="text/javascript">
	function displayActiveUsers()
	{
		new Ajax.PeriodicalUpdater(\'activeUsers\', \'ajax/activeUsers.php\', {asynchronous:true, frequency: 5});
	}

	function displayActiveGuests()
	{
		new Ajax.PeriodicalUpdater(\'activeGuests\', \'ajax/activeGuests.php\', {asynchronous:true, frequency: 5});
	}

	womAdd(\'displayActiveUsers()\');
	womAdd(\'displayActiveGuests()\');
	womOn();
</script>	
'; ?>


<h2><?php echo $this->_config[0]['vars']['USER_ACTIVITY_HL']; ?>
</h2>
<?php echo $this->_config[0]['vars']['USER_ACTIVITY_MAIN']; ?>


<br />
<br />
<div id='activeUsers'>
</div>

<div id='activeGuests'>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/footer.tpl.php", 'smarty_include_vars' => array('title' => 'footer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>