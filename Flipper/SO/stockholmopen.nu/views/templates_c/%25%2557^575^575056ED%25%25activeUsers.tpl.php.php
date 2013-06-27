<?php /* Smarty version 2.6.16, created on 2008-03-30 23:25:22
         compiled from ajax/activeUsers.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'ajax/activeUsers.tpl.php', 1, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => "lang/".($this->_tpl_vars['sLang'])."/config.".($this->_tpl_vars['sLang']).".lang.php"), $this);?>


<h3><?php echo $this->_config[0]['vars']['LOGGED_IN_USER_S']; ?>
</h3>

<?php if ($this->_tpl_vars['aActiveUsers'] != null): ?>
	<table width='350' class='mainTable'>
	<?php unset($this->_sections['section']);
$this->_sections['section']['name'] = 'section';
$this->_sections['section']['loop'] = is_array($_loop=$this->_tpl_vars['aActiveUsers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<tr class='underLine'>	
			<td><?php echo $this->_tpl_vars['aActiveUsers'][$this->_sections['section']['index']]['user_username']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aActiveUsers'][$this->_sections['section']['index']]['user_firstname']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aActiveUsers'][$this->_sections['section']['index']]['user_lastname']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aActiveUsers'][$this->_sections['section']['index']]['ua_ip']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aActiveUsers'][$this->_sections['section']['index']]['ua_page']; ?>
</td>			
		</tr>	
	<?php endfor; endif; ?>
	</table>
<?php else: ?>
	<?php echo $this->_config[0]['vars']['NONE']; ?>

<?php endif; ?>	