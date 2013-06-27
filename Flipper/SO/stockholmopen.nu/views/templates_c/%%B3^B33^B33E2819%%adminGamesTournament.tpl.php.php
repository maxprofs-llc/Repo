<?php /* Smarty version 2.6.16, created on 2013-06-11 22:26:22
         compiled from admin/adminGamesTournament.tpl.php */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/header.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h2><?php echo $this->_config[0]['vars']['ADMIN']; ?>
: <?php echo $this->_config[0]['vars']['ADMIN_TOURN_GAMES']; ?>
</h2>

<?php echo $this->_config[0]['vars']['ADMIN_TOURN_GAMES_MAIN']; ?>

<br />
<br />

<b class='highLight'><?php echo $this->_config[0]['vars']['WARNING']; ?>
</b>: <?php echo $this->_config[0]['vars']['USE_THIS_FUNCTION_WITH_CAUTION']; ?>

<br />

<h3><?php echo $this->_config[0]['vars']['GAMES']; ?>
 <?php echo $this->_tpl_vars['g_iYear']; ?>
</h3>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "formsAdmin/form.gamesTournament.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/footer.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>