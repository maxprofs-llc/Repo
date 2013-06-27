<?php /* Smarty version 2.6.16, created on 2008-04-01 14:21:34
         compiled from admin/adminEmailAddresses.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'admin/adminEmailAddresses.tpl.php', 12, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/header.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h2><?php echo $this->_config[0]['vars']['ADMIN']; ?>
: <?php echo $this->_config[0]['vars']['ADMIN_PLAYER_EMAIL_HL']; ?>
</h2>

<?php echo $this->_config[0]['vars']['ADMIN_PLAYER_EMAIL_MAIN']; ?>

<br />
<br />
<?php echo $this->_config[0]['vars']['DISPLAY']; ?>
 <?php echo $this->_tpl_vars['aInputs']['iYear']['input']; ?>
 <?php echo $this->_config[0]['vars']['EMAIL_ADDRESSES']; ?>

<br />
<br />

<?php $this->assign('iCount', count($this->_tpl_vars['aPlayers'])); ?>

<?php unset($this->_sections['section']);
$this->_sections['section']['name'] = 'section';
$this->_sections['section']['loop'] = is_array($_loop=$this->_tpl_vars['aPlayers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['section']['show'] = true;
$this->_sections['section']['max'] = $this->_sections['section']['loop'];
$this->_sections['section']['step'] = 1;
$this->_sections['section']['start'] = $this->_sections['section']['step'] > 0 ? 0 : $this->_sections['section']['loop']-1;
if ($this->_sections['section']['show']) {
    $this->_sections['section']['total'] = $this->_sections['section']['loop'];
    if ($this->_sections['section']['total'] == 0)
        $this->_sections['section']['show'] = false;
} else
    $this->_sections['section']['total'] = 0;
if ($this->_sections['section']['show']):

            for ($this->_sections['section']['index'] = $this->_sections['section']['start'], $this->_sections['section']['iteration'] = 1;
                 $this->_sections['section']['iteration'] <= $this->_sections['section']['total'];
                 $this->_sections['section']['index'] += $this->_sections['section']['step'], $this->_sections['section']['iteration']++):
$this->_sections['section']['rownum'] = $this->_sections['section']['iteration'];
$this->_sections['section']['index_prev'] = $this->_sections['section']['index'] - $this->_sections['section']['step'];
$this->_sections['section']['index_next'] = $this->_sections['section']['index'] + $this->_sections['section']['step'];
$this->_sections['section']['first']      = ($this->_sections['section']['iteration'] == 1);
$this->_sections['section']['last']       = ($this->_sections['section']['iteration'] == $this->_sections['section']['total']);
?>
	<?php if ($this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['player_email'] != null): ?>
		<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['player_email'];  if ($this->_sections['section']['iteration'] < $this->_tpl_vars['iCount']): ?>,<?php endif; ?>
	<?php endif;  endfor; endif; ?>

<?php if ($this->_tpl_vars['aPlayers'] == null): ?>
	<?php echo $this->_config[0]['vars']['ERROR_NO_EMAIL']; ?>

<?php endif; ?>

	
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/footer.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>