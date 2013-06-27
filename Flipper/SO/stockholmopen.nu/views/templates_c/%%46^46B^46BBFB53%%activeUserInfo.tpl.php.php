<?php /* Smarty version 2.6.16, created on 2008-03-30 17:57:58
         compiled from elements/activeUserInfo.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'elements/activeUserInfo.tpl.php', 2, false),)), $this); ?>
<p>
<?php $this->assign('iUsers', count($this->_tpl_vars['g_aActiveUsers'])); ?>
<?php $this->assign('iGuests', count($this->_tpl_vars['g_aActiveGuests'])); ?>
<?php if ($this->_tpl_vars['iUsers'] > 0 && $this->_tpl_vars['iGuests'] > 0): ?>
	<?php echo $this->_config[0]['vars']['THERE_ARE_CURRENTLY']; ?>
 <?php echo $this->_tpl_vars['iUsers']; ?>
 <?php echo $this->_config[0]['vars']['LOGGED_IN_USER_S']; ?>
 <?php echo $this->_config[0]['vars']['AND']; ?>
 <?php echo $this->_tpl_vars['iGuests']; ?>
 <?php echo $this->_config[0]['vars']['GUEST_S']; ?>
 <?php echo $this->_config[0]['vars']['ON_THE_SITE']; ?>

<?php elseif ($this->_tpl_vars['iUsers'] > 0): ?>
	<?php echo $this->_config[0]['vars']['THERE_ARE_CURRENTLY']; ?>
 <?php echo $this->_tpl_vars['iUsers']; ?>
 <?php echo $this->_config[0]['vars']['LOGGED_IN_USER_S']; ?>
 <?php echo $this->_config[0]['vars']['ON_THE_SITE']; ?>

<?php elseif ($this->_tpl_vars['iGuests'] > 0): ?>
	<?php echo $this->_config[0]['vars']['THERE_ARE_CURRENTLY']; ?>
 <?php echo $this->_tpl_vars['iGuests']; ?>
 <?php echo $this->_config[0]['vars']['GUEST_S']; ?>
 <?php echo $this->_config[0]['vars']['ON_THE_SITE']; ?>

<?php endif; ?>
</p>