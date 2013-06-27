<?php /* Smarty version 2.6.16, created on 2008-03-30 04:50:41
         compiled from entranceFee.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'eval', 'entranceFee.tpl.php', 9, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/header.tpl.php", 'smarty_include_vars' => array('title' => 'header')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script src="javascript/displayPayEntranceFee.js" language="javascript" type="text/javascript"></script>
<script src="javascript/calcEntranceFee.js" language="javascript" type="text/javascript"></script>

<h2><?php echo $this->_config[0]['vars']['ENTRANCE_FEE_HL']; ?>
</h2>

<p>
<?php echo smarty_function_eval(array('var' => $this->_config[0]['vars']['ENTRANCE_FEE_MAIN']), $this);?>

</p>


<h3><?php echo $this->_config[0]['vars']['PAYMENT_METHODS_HL']; ?>
</h3>
<p>
<?php echo $this->_config[0]['vars']['PAYMENT_METHODS_MAIN']; ?>

</p>

<h3><?php echo $this->_config[0]['vars']['PAYMENT']; ?>
</h3>
<p>
<?php echo smarty_function_eval(array('var' => $this->_config[0]['vars']['PAYMENT_INFO']), $this);?>

</p>


<div id='payEntranceFee'></div>

<script type="text/javascript">
	womAdd('displayPayEntranceFee()');
	womOn();
</script>

<?php echo smarty_function_eval(array('var' => $this->_config[0]['vars']['ENTRANCE_FEE_MAIN_2']), $this);?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/footer.tpl.php", 'smarty_include_vars' => array('title' => 'footer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>