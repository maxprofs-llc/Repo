<?php /* Smarty version 2.6.16, created on 2008-03-30 21:48:49
         compiled from ajax/player.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'ajax/player.tpl.php', 1, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => "lang/".($this->_tpl_vars['sLang'])."/config.".($this->_tpl_vars['sLang']).".lang.php"), $this);?>


<?php if ($this->_tpl_vars['bSearching']): ?>
	<span class='light'><?php echo $this->_config[0]['vars']['SEARCHING_FOR_PLAYER']; ?>
 ...</span>
<?php endif; ?>

<?php if ($this->_tpl_vars['aPlayer'] != null): ?>
	<?php echo $this->_tpl_vars['aPlayer']['player_firstname']; ?>
 <?php echo $this->_tpl_vars['aPlayer']['player_lastname']; ?>
 (<?php echo $this->_tpl_vars['aPlayer']['player_initials']; ?>
) 
<?php endif; ?>