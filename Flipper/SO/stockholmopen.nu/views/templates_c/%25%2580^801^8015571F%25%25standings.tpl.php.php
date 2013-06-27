<?php /* Smarty version 2.6.16, created on 2008-04-06 18:03:34
         compiled from standings.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'eval', 'standings.tpl.php', 6, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/header.tpl.php", 'smarty_include_vars' => array('title' => 'header')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h2><?php echo $this->_config[0]['vars']['STANDINGS_HL']; ?>
 - <?php echo $this->_tpl_vars['iYear']; ?>
 - <?php echo $this->_tpl_vars['sDivision']; ?>
 <?php echo $this->_config[0]['vars']['DIVISION']; ?>
</h2>

<?php if ($this->_tpl_vars['g_iYear'] == $this->_tpl_vars['iYear']): ?>
	<?php echo smarty_function_eval(array('var' => $this->_config[0]['vars']['STANDINGS_MAIN']), $this);?>

<?php else: ?>
	<?php echo smarty_function_eval(array('var' => $this->_config[0]['vars']['STANDINGS_MAIN_OLD']), $this);?>

<?php endif; ?>
<br /><br />
<a href='slide.php?bStart=true&amp;iYear=<?php echo $this->_tpl_vars['iYear']; ?>
&amp;bTotalAndGames=true'><?php echo $this->_config[0]['vars']['STANDINGS_ALL_SLIDE']; ?>
</a> / <a href='slideTotal.php?iYear=<?php echo $this->_tpl_vars['iYear']; ?>
&amp;bStart=true'><?php echo $this->_config[0]['vars']['STANDINGS_SLIDE']; ?>
</a>
<br />
<br />
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "recycled/playersAndStandings.tpl.php", 'smarty_include_vars' => array('title' => 'footer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/footer.tpl.php", 'smarty_include_vars' => array('title' => 'footer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>