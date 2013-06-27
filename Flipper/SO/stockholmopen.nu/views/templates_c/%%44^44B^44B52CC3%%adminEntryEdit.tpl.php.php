<?php /* Smarty version 2.6.16, created on 2013-06-11 22:22:31
         compiled from admin/adminEntryEdit.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'admin/adminEntryEdit.tpl.php', 59, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/header.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h2><?php echo $this->_config[0]['vars']['ADMIN']; ?>
: <?php echo $this->_config[0]['vars']['ADMIN_EDIT_ENTRY_HL']; ?>
</h2>
<?php echo $this->_config[0]['vars']['ADMIN_EDIT_ENTRY_MAIN']; ?>

<br  />
<br />

<table>
<tr>
	<td><?php echo $this->_config[0]['vars']['DISPLAY_ENTRIES_FROM']; ?>
</td>
	<td><?php echo $this->_tpl_vars['aInputs']['iYear']['input']; ?>
</td>
</tr>
<?php echo $this->_tpl_vars['sFormStart']; ?>

<tr>
	<td><?php echo $this->_config[0]['vars']['OR_SEARCH_ENTRY_ID']; ?>
</td>
	<td><?php echo $this->_tpl_vars['aInputs']['iSearch']['input']; ?>
</td>
</tr>
<tr>
	<td></td>
	<td><?php echo $this->_tpl_vars['sButtons']; ?>
</td>
</tr>
<?php echo $this->_tpl_vars['sFormEnd']; ?>

</table>

<?php if ($this->_tpl_vars['bNoEntriesFound'] == true): ?>
	<br />
	<br />
	<?php echo $this->_config[0]['vars']['NO_ENTRIES_FOUND']; ?>

<?php endif; ?>

<br />
<br />

<?php if ($this->_tpl_vars['aEntries'] != null): ?>
	<table class='mainTable'>
	
	<tr>
		<td class='HL'><?php echo $this->_config[0]['vars']['ENTRY_ID']; ?>
</td>
		<td class='HL'><?php echo $this->_config[0]['vars']['PLAYER_NAME']; ?>
</td>
		<td class='HL'><?php echo $this->_config[0]['vars']['PLAYER']; ?>
 <?php echo $this->_config[0]['vars']['QR']; ?>
</td>
		<td class='HL'><?php echo $this->_config[0]['vars']['POSTED']; ?>
</td>
		<td class='HL'><?php echo $this->_config[0]['vars']['DIVISION']; ?>
</td>
		<td class='HL'><?php echo $this->_config[0]['vars']['SCORE']; ?>
</td>
		<td class='HL'></td>
		<td class='HL'><?php echo $this->_config[0]['vars']['HISTORY']; ?>
</td>	
		<td class='HL'><?php echo $this->_config[0]['vars']['ENTRY']; ?>
 <?php echo $this->_config[0]['vars']['QR']; ?>
</td>
		<td class='HL'><?php echo $this->_config[0]['vars']['EDIT']; ?>
</td>
		<td class='HL'><?php echo $this->_config[0]['vars']['DELETE']; ?>
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
		<?php if ((1 & $this->_sections['section']['iteration'])): ?>
			<tr <?php echo $this->_config[0]['vars']['MOUSE_OVER_DEFAULT']; ?>
>
		<?php else: ?>
			<tr class='lineDark' <?php echo $this->_config[0]['vars']['MOUSE_OVER_DARK']; ?>
>
		<?php endif; ?>
			<td><?php echo $this->_tpl_vars['aEntries'][$this->_sections['section']['index']]['id_entry']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aEntries'][$this->_sections['section']['index']]['player_firstname']; ?>
 <?php echo $this->_tpl_vars['aEntries'][$this->_sections['section']['index']]['player_lastname']; ?>
</td>
			<td><a href='wap/playerPrinter.php?playerId=<?php echo $this->_tpl_vars['aEntries'][$this->_sections['section']['index']]['id_player']; ?>
&autoPrint=true' target='_new'><img src='images/icons/qr.png' class='iconLink' alt='<?php echo $this->_config[0]['vars']['ADMIN_PLAYER_PRINT']; ?>
' title='<?php echo $this->_config[0]['vars']['ADMIN_PLAYER_PRINT']; ?>
' /></a></td>
			<td><?php echo ((is_array($_tmp=$this->_tpl_vars['aEntries'][$this->_sections['section']['index']]['entry_poster_date_posted'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 16, "", true) : smarty_modifier_truncate($_tmp, 16, "", true)); ?>
</td>
			<td><?php echo $this->_tpl_vars['aEntries'][$this->_sections['section']['index']]['division_name_short']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aEntries'][$this->_sections['section']['index']]['entry_score']; ?>
</td>
			<td>
				<?php if ($this->_tpl_vars['aEntries'][$this->_sections['section']['index']]['entry_is_voided'] == 1): ?>
					<i><?php echo $this->_config[0]['vars']['VOID']; ?>
</i>
				<?php endif; ?>	
			</td>
			<td><a href="#" onclick="new Ajax.Updater('entry<?php echo $this->_tpl_vars['aEntries'][$this->_sections['section']['index']]['id_entry']; ?>
', 'ajax/displayEntryHistory.php?iIDEntry=<?php echo $this->_tpl_vars['aEntries'][$this->_sections['section']['index']]['id_entry']; ?>
'); return false;"><img src='images/icons/info.gif' class='iconLink' alt='<?php echo $this->_config[0]['vars']['HISTORY']; ?>
' title='<?php echo $this->_config[0]['vars']['HISTORY']; ?>
' /></a></td>
			<td><a href='wap/entryPrinter.php?entryId=<?php echo $this->_tpl_vars['aEntries'][$this->_sections['section']['index']]['id_entry']; ?>
&autoPrint=true' target='_new'><img src='images/icons/qr.png' class='iconLink' alt='<?php echo $this->_config[0]['vars']['ADMIN_ENTRY_PRINT']; ?>
' title='<?php echo $this->_config[0]['vars']['ADMIN_ENTRY_PRINT']; ?>
' /></a></td>
			<td><a href='adminEntryReg.php?iIDPlayer=<?php echo $this->_tpl_vars['aEntries'][$this->_sections['section']['index']]['id_player']; ?>
&amp;iIDEntry=<?php echo $this->_tpl_vars['aEntries'][$this->_sections['section']['index']]['id_entry']; ?>
&bEdit=true'><img src='images/icons/edit.gif' class='iconLink' alt='<?php echo $this->_config[0]['vars']['EDIT']; ?>
' title='<?php echo $this->_config[0]['vars']['EDIT']; ?>
' /></a></td>
			<td><a href='adminEntryDelete.php?iIDDelete=<?php echo $this->_tpl_vars['aEntries'][$this->_sections['section']['index']]['id_entry']; ?>
'><img src='images/icons/editdelete.gif' class='iconLink' alt='<?php echo $this->_config[0]['vars']['DELETE']; ?>
' title='<?php echo $this->_config[0]['vars']['DELETE']; ?>
' /></a></td>
		</tr>

				<tr>
			<td colspan='10'>
			<div id="entry<?php echo $this->_tpl_vars['aEntries'][$this->_sections['section']['index']]['id_entry']; ?>
">
			</div>
			</td>
		</tr>
	<?php endfor; endif; ?>
	</table>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/footer.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>