<?php /* Smarty version 2.6.16, created on 2008-03-30 05:07:33
         compiled from ajax/updateFee.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'ajax/updateFee.tpl.php', 1, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => "lang/".($this->_tpl_vars['sLang'])."/config.".($this->_tpl_vars['sLang']).".lang.php"), $this);?>


<?php if ($this->_tpl_vars['bChecked'] == 'true'): ?>
	<?php echo $this->_config[0]['vars']['UPDATE_FEE_PAID']; ?>

<?php else: ?>
	<?php echo $this->_config[0]['vars']['UPDATE_FEE_NON_PAID']; ?>

<?php endif;  echo $this->_tpl_vars['aPlayer']['player_firstname']; ?>
	<?php echo $this->_tpl_vars['aPlayer']['player_lastname']; ?>
 