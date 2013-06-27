<?php /* Smarty version 2.6.16, created on 2008-03-30 21:20:04
         compiled from statsBestEntries.tpl.php */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/header.tpl.php", 'smarty_include_vars' => array('title' => 'header')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h2><?php echo $this->_config[0]['vars']['STATS_BEST_ENTRIES_HL']; ?>
</h2>
<?php echo $this->_config[0]['vars']['STATS_BEST_ENTRIES_MAIN']; ?>

<br />
<br />
<?php echo $this->_config[0]['vars']['DISPLAY']; ?>
 <?php echo $this->_tpl_vars['aInputs']['iLimit']['input']; ?>
 <?php echo $this->_config[0]['vars']['ENTRIES']; ?>

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