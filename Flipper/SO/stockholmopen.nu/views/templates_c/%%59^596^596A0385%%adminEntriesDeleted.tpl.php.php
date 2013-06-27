<?php /* Smarty version 2.6.16, created on 2008-06-06 15:40:06
         compiled from admin/adminEntriesDeleted.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'admin/adminEntriesDeleted.tpl.php', 26, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/header.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h2><?php echo $this->_config[0]['vars']['ADMIN']; ?>
: <?php echo $this->_config[0]['vars']['ADMIN_DELETED_ENTRIES_HL']; ?>
</h2>

<?php $this->assign('bOutput', 'false');  if ($this->_tpl_vars['aEntries'] != null): ?>
	<table class='mainTable'>
	
	<tr>
		<td class='HL'><?php echo $this->_config[0]['vars']['ENTRY_ID']; ?>
</td>
		<td class='HL'><?php echo $this->_config[0]['vars']['YEAR']; ?>
</td>
		<td class='HL'><?php echo $this->_config[0]['vars']['PLAYER_NAME']; ?>
</td>
		<td class='HL'><?php echo $this->_config[0]['vars']['DELETED']; ?>
</td>
		<td class='HL'><?php echo $this->_config[0]['vars']['BY']; ?>
</td>		
	</tr>
	<?php unset($this->_sections['section']);
$this->_sections['section']['name'] = 'section';
$this->_sections['section']['loop'] = is_array($_loop=$this->_tpl_vars['aEntries']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	<?php $this->assign('bOutput', 'true'); ?>
		<?php if ((1 & $this->_sections['section']['iteration'])): ?>
			<tr <?php echo $this->_config[0]['vars']['MOUSE_OVER_DEFAULT']; ?>
>
		<?php else: ?>
			<tr class='lineDark' <?php echo $this->_config[0]['vars']['MOUSE_OVER_DARK']; ?>
>
		<?php endif; ?>
			<td><?php echo $this->_tpl_vars['aEntries'][$this->_sections['section']['index']]['id_entry']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aEntries'][$this->_sections['section']['index']]['player_year_entered']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aEntries'][$this->_sections['section']['index']]['player_firstname']; ?>
 <?php echo $this->_tpl_vars['aEntries'][$this->_sections['section']['index']]['player_lastname']; ?>
 (<?php echo $this->_tpl_vars['aEntries'][$this->_sections['section']['index']]['player_initials']; ?>
)</td>
			<td><?php echo ((is_array($_tmp=$this->_tpl_vars['aEntries'][$this->_sections['section']['index']]['entry_deleted_date_posted'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 16, "", true) : smarty_modifier_truncate($_tmp, 16, "", true)); ?>
</td>
			<td><?php echo $this->_tpl_vars['aEntries'][$this->_sections['section']['index']]['deleted_by']; ?>
</td>		
		</tr>

		<tr>
			<td colspan='5'>
			<?php unset($this->_sections['entryRounds']);
$this->_sections['entryRounds']['name'] = 'entryRounds';
$this->_sections['entryRounds']['loop'] = is_array($_loop=$this->_tpl_vars['aEntries'][$this->_sections['section']['index']]['entry_rounds']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['entryRounds']['show'] = true;
$this->_sections['entryRounds']['max'] = $this->_sections['entryRounds']['loop'];
$this->_sections['entryRounds']['step'] = 1;
$this->_sections['entryRounds']['start'] = $this->_sections['entryRounds']['step'] > 0 ? 0 : $this->_sections['entryRounds']['loop']-1;
if ($this->_sections['entryRounds']['show']) {
    $this->_sections['entryRounds']['total'] = $this->_sections['entryRounds']['loop'];
    if ($this->_sections['entryRounds']['total'] == 0)
        $this->_sections['entryRounds']['show'] = false;
} else
    $this->_sections['entryRounds']['total'] = 0;
if ($this->_sections['entryRounds']['show']):

            for ($this->_sections['entryRounds']['index'] = $this->_sections['entryRounds']['start'], $this->_sections['entryRounds']['iteration'] = 1;
                 $this->_sections['entryRounds']['iteration'] <= $this->_sections['entryRounds']['total'];
                 $this->_sections['entryRounds']['index'] += $this->_sections['entryRounds']['step'], $this->_sections['entryRounds']['iteration']++):
$this->_sections['entryRounds']['rownum'] = $this->_sections['entryRounds']['iteration'];
$this->_sections['entryRounds']['index_prev'] = $this->_sections['entryRounds']['index'] - $this->_sections['entryRounds']['step'];
$this->_sections['entryRounds']['index_next'] = $this->_sections['entryRounds']['index'] + $this->_sections['entryRounds']['step'];
$this->_sections['entryRounds']['first']      = ($this->_sections['entryRounds']['iteration'] == 1);
$this->_sections['entryRounds']['last']       = ($this->_sections['entryRounds']['iteration'] == $this->_sections['entryRounds']['total']);
?>
				<?php echo $this->_config[0]['vars']['GAMES']; ?>
: <?php echo $this->_tpl_vars['aEntries'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['game_name']; ?>
 (<?php echo $this->_tpl_vars['aEntries'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['score']; ?>
) ***
			<?php endfor; endif; ?>
		</tr>
		<tr>
			<td colspan='5'><hr /></td>
		</tr>		
	<?php endfor; endif; ?>
	</table>
<?php endif; ?>

<?php if ($this->_tpl_vars['bOutput'] == 'false'): ?>
	<?php echo $this->_config[0]['vars']['NO_DELETED_ENTRIES']; ?>

<?php endif; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/footer.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>