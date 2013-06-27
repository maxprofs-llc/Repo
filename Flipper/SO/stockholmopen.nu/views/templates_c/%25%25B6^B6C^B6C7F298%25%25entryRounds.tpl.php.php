<?php /* Smarty version 2.6.16, created on 2008-03-30 05:40:46
         compiled from recycled/entryRounds.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'recycled/entryRounds.tpl.php', 19, false),)), $this); ?>
<?php if ($this->_tpl_vars['sSort'] == null): ?>
	<tr>
		<td colspan='5'><?php echo $this->_config[0]['vars']['ENTRY_ID']; ?>
 #<a href='player.php?iIDEntry=<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['id_entry']; ?>
'><?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['id_entry']; ?>
</a> (<b><?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['division_name_short']; ?>
</b> <?php echo $this->_config[0]['vars']['DIVISION_SHORT']; ?>
)</td>
	</tr>
<?php endif; ?>
	
<?php unset($this->_sections['entryRounds']);
$this->_sections['entryRounds']['name'] = 'entryRounds';
$this->_sections['entryRounds']['loop'] = is_array($_loop=$this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['entry_rounds']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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

<?php if ($this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['entry_is_voided'] == true): ?>
	<?php $this->assign('bIsVoided', 'true');  endif; ?>

<?php if ((1 & $this->_sections['entryRounds']['iteration'])): ?>
	<tr class='lineDark' <?php echo $this->_config[0]['vars']['MOUSE_OVER_DARK']; ?>
>
<?php else: ?>
	<tr <?php echo $this->_config[0]['vars']['MOUSE_OVER_DEFAULT']; ?>
>
<?php endif; ?>
	
	<td><a href='game.php?iYear=<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['player_year_entered']; ?>
&amp;iIDGame=<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['games_id_game']; ?>
&amp;sDivision=<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['division_name_short']; ?>
'><?php echo ((is_array($_tmp=$this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['game_name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 38, "...", true) : smarty_modifier_truncate($_tmp, 38, "...", true)); ?>
</a></td>

	<td align='right' style='padding-right:10px'>
	   	<?php if ($this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['entry_round_score_game'] < 2): ?>
	    	<?php echo $this->_config[0]['vars']['NA']; ?>

    	<?php else: ?>
						<?php if ($this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['entry_round_is_counted'] != 1): ?>
				<?php echo $this->_config[0]['vars']['NA']; ?>
	
			<?php else: ?>
		    	<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['score_game_output']; ?>

			<?php endif; ?>
    	<?php endif; ?>
	</td>
	
	<td>    
    <?php if ($this->_tpl_vars['bIsVoided'] == true): ?>
	    <i><?php echo $this->_config[0]['vars']['VOID']; ?>
</i>
    <?php else: ?>
	    <?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['entry_round_position']; ?>

    <?php endif; ?>
	</td>

	<td>
    <?php if ($this->_tpl_vars['bIsVoided'] == true): ?>
	    <i><?php echo $this->_config[0]['vars']['VOID']; ?>
</i>
    <?php else: ?>
	<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['entry_round_score_tournament']; ?>

	<?php endif; ?>
	</td>

	<td>
	<?php if ($this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['entry_round_is_counted'] != 1): ?>
		<?php echo $this->_config[0]['vars']['NA']; ?>

	<?php else: ?>
		<?php echo ((is_array($_tmp=$this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['entry_round_date_posted'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 16, "", true) : smarty_modifier_truncate($_tmp, 16, "", true)); ?>

	<?php endif; ?>
	</td>

	<?php if ($this->_tpl_vars['sSort'] != null): ?>
		<td><a href='player.php?iIDEntry=<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['id_entry']; ?>
'><?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['id_entry']; ?>
</a></td>	
	<?php endif; ?>
</tr>
<?php endfor; endif; ?>

<tr>
	<td></td>
	<td></td>
	<td class='tableLabel'><?php echo $this->_config[0]['vars']['TOTAL']; ?>
</td>
	<td>
	<?php if ($this->_tpl_vars['bIsVoided'] == true): ?>
		<i><?php echo $this->_config[0]['vars']['VOID']; ?>
</i>
	<?php else: ?>
		<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['entry_score']; ?>

	<?php endif; ?>
	</td>
	
	<td></td>
</tr>