<?php /* Smarty version 2.6.16, created on 2008-04-20 20:18:41
         compiled from statsAvgEntry.tpl.php */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/header.tpl.php", 'smarty_include_vars' => array('title' => 'header')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script type="text/javascript" src="javascript/statsAvgEntry.js"></script>

<h2><?php echo $this->_config[0]['vars']['STATS_AVG_ENTRY_HL']; ?>
 - <?php echo $this->_tpl_vars['iYear']; ?>
 - <?php echo $this->_tpl_vars['sDivision']; ?>
 <?php echo $this->_config[0]['vars']['DIVISION']; ?>
</h2>
<p>
<?php echo $this->_config[0]['vars']['SELECT_YEAR']; ?>
 <?php echo $this->_tpl_vars['sJavascriptSelectYear']; ?>
 <?php echo $this->_config[0]['vars']['OR']; ?>
 <?php echo $this->_config[0]['vars']['SELECT_DIVISION']; ?>
 <?php echo $this->_tpl_vars['sJavascriptSelectDivision']; ?>

</p>

<?php echo $this->_config[0]['vars']['STATS_AVG_ENTRY_MAIN']; ?>

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