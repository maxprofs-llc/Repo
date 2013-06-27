<?php /* Smarty version 2.6.16, created on 2008-06-07 05:54:41
         compiled from ajax/displayEntryHistory.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'ajax/displayEntryHistory.tpl.php', 1, false),array('modifier', 'truncate', 'ajax/displayEntryHistory.tpl.php', 15, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => "lang/".($this->_tpl_vars['sLang'])."/config.".($this->_tpl_vars['sLang']).".lang.php"), $this);?>

<?php echo smarty_function_config_load(array('file' => "config.javascript.php"), $this);?>


<h3><?php echo $this->_config[0]['vars']['ENTRY_HISTORY']; ?>
</h3>
<table class='minor' width='500px'>
<tr>
	<td class='HL'><?php echo $this->_config[0]['vars']['DATE']; ?>
</td>
	<td class='HL'><?php echo $this->_config[0]['vars']['ACTION']; ?>
</td>
	<td class='HL'><?php echo $this->_config[0]['vars']['ROUND_NO']; ?>
#</td>
	<td class='HL'><?php echo $this->_config[0]['vars']['USER']; ?>
</td>			
</tr>

<?php unset($this->_sections['section']);
$this->_sections['section']['name'] = 'section';
$this->_sections['section']['loop'] = is_array($_loop=$this->_tpl_vars['aEntryHistory']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<td><?php echo ((is_array($_tmp=$this->_tpl_vars['aEntryHistory'][$this->_sections['section']['index']]['date'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 16, "", true) : smarty_modifier_truncate($_tmp, 16, "", true)); ?>
</td>
		<td>
		<?php if ($this->_tpl_vars['aEntryHistory'][$this->_sections['section']['index']]['action'] == 'entryRoundGameUpdate'): ?>
			<?php echo $this->_config[0]['vars']['ROUND_GAME_CHANGE']; ?>

		<?php elseif ($this->_tpl_vars['aEntryHistory'][$this->_sections['section']['index']]['action'] == 'entryRoundScoreUpdate'): ?>
			<?php echo $this->_config[0]['vars']['ROUND_SCORE_UPDATE']; ?>

		<?php elseif ($this->_tpl_vars['aEntryHistory'][$this->_sections['section']['index']]['action'] == 'entryPosted'): ?>
			<?php echo $this->_config[0]['vars']['ENTRY_POSTED']; ?>

		<?php elseif ($this->_tpl_vars['aEntryHistory'][$this->_sections['section']['index']]['action'] == 'entryVoided'): ?>
			<?php echo $this->_config[0]['vars']['ENTRY_VOIDED']; ?>
			
		<?php elseif ($this->_tpl_vars['aEntryHistory'][$this->_sections['section']['index']]['action'] == 'entryUnvoided'): ?>
			<?php echo $this->_config[0]['vars']['ENTRY_UNVOIDED']; ?>
			
		<?php endif; ?>		
		</td>
		<td><?php echo $this->_tpl_vars['aEntryHistory'][$this->_sections['section']['index']]['roundNumber']; ?>
</td>
		<td><?php echo $this->_tpl_vars['aEntryHistory'][$this->_sections['section']['index']]['username']; ?>
</td>
	</tr>

<?php endfor; endif; ?>
</table>
<br />
<br />