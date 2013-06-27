<?php /* Smarty version 2.6.16, created on 2008-04-03 16:04:48
         compiled from admin/adminPlayersDelete.tpl.php */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/header.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h2><?php echo $this->_config[0]['vars']['ADMIN']; ?>
: <?php echo $this->_config[0]['vars']['ADMIN_DELETE_PLAYERS_TEAMS_HL']; ?>
</h2>
<?php echo $this->_config[0]['vars']['ADMIN_DELETE_PLAYERS_TEAMS_MAIN']; ?>

<br />
<br />
<?php echo $this->_config[0]['vars']['DISPLAY_PLAYERS_TEAMS_FROM']; ?>
 <?php echo $this->_tpl_vars['aInputs']['iYear']['input']; ?>


<?php if ($this->_tpl_vars['aPlayers'] == null): ?>
	<br />
	<br />
	<?php echo $this->_config[0]['vars']['ERROR_NO_PLAYER_FOUND']; ?>

<?php endif; ?>

<br />
<br />

<?php if ($this->_tpl_vars['aPlayers'] != null): ?>
	<table class='mainTable'>
	
	<tr>
		<td class='HL'><?php echo $this->_config[0]['vars']['PLAYER_NAME']; ?>
</td>
		<td class='HL'><?php echo $this->_config[0]['vars']['PLAYER_ID']; ?>
</td>
		<td class='HL'><?php echo $this->_config[0]['vars']['DIVISION']; ?>
</td>
		<td class='HL'><?php echo $this->_config[0]['vars']['PAID']; ?>
</td>
		<td class='HL'><?php echo $this->_config[0]['vars']['DELETE']; ?>
</td>
	</tr>
	
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
		<?php if ($this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['division_name_short'] != $this->_tpl_vars['sPrevDivision']): ?>
			<tr class='lineDark'>
				<td colspan='5'><b><?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['division_name_short']; ?>
 <?php echo $this->_config[0]['vars']['DIVISION']; ?>
</b></td>
			<tr>
		<?php endif; ?>	

		<?php if ((1 & $this->_sections['section']['iteration'])): ?>
			<tr <?php echo $this->_config[0]['vars']['MOUSE_OVER_DEFAULT']; ?>
>
		<?php else: ?>
			<tr class='lineDark' <?php echo $this->_config[0]['vars']['MOUSE_OVER_DARK']; ?>
>
		<?php endif; ?>
			<td><?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['player_first_name']; ?>
 <?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['player_last_name']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['id_player']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['division_name_short']; ?>
</td>
			<td>
				<?php if ($this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['dtp_paid_fee'] == 1): ?>
					X
				<?php endif; ?>
			</td>
			<td>
			<?php if ($this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['player_has_played_entries'] == false): ?>
			<a href='adminPlayerDelete.php?iIDDelete=<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['id_player']; ?>
'><img src='images/icons/editdelete.gif' class='iconLink' alt='<?php echo $this->_config[0]['vars']['DELETE']; ?>
' title=<?php echo $this->_config[0]['vars']['DELETE']; ?>
 /></a>
			<?php endif; ?>
			</td>
		</tr>
		<?php $this->assign('sPrevDivision', $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['division_name_short']); ?>
	<?php endfor; endif; ?>
	</table>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/footer.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>