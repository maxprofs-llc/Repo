<?php /* Smarty version 2.6.16, created on 2008-04-06 18:53:17
         compiled from recycled/gameEntryRounds.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'recycled/gameEntryRounds.tpl.php', 28, false),array('modifier', 'truncate', 'recycled/gameEntryRounds.tpl.php', 33, false),)), $this); ?>
<?php if ((1 & $this->_sections['entryRounds']['iteration'])): ?>
	<tr <?php echo $this->_config[0]['vars']['MOUSE_OVER_DEFAULT']; ?>
>
<?php else: ?>
	<tr class='lineDark' <?php echo $this->_config[0]['vars']['MOUSE_OVER_DARK']; ?>
>
<?php endif; ?>
	<?php if ($this->_tpl_vars['bSlide'] == true): ?>
		<?php $this->assign('iHighestScore', $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['stats']['score_highest']); ?>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['entry_is_voided'] == 1): ?>
		<td colspan='2'><i><?php echo $this->_config[0]['vars']['VOID']; ?>
</i></td>
	<?php else: ?>
		<td><b><?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['entry_round_position']; ?>
</b></td>	
		<td><b><?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['entry_round_score_tournament']; ?>
</b></td>	
	<?php endif; ?>
	<td align='right' style='padding-right:10px;'>
	<?php if ($this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['score_game_output'] == 1 || $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['score_game_output'] == 0 || $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['entry_round_is_counted'] == 0): ?>
		<?php echo $this->_config[0]['vars']['NA']; ?>

	<?php else: ?>
		<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['score_game_output']; ?>

	<?php endif; ?>
	</td>	
	<?php if ($this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['score_game_output'] == 1 || $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['score_game_output'] == 0 || $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['entry_round_is_counted'] == 0): ?>
		<td></td>
	<?php else: ?>
			
		<?php if ($this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['entry_is_voided'] != 1): ?>
			<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: <?php echo smarty_function_math(array('equation' => "-34 + ((x / y) * 26)",'x' => $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['entry_round_score_game'],'y' => $this->_tpl_vars['iHighestScore'],'format' => "%d"), $this);?>
px 6px; margin-left: 10px;'><span class='small'><?php echo smarty_function_math(array('equation' => "x / y * 100",'x' => $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['entry_round_score_game'],'y' => $this->_tpl_vars['iHighestScore'],'format' => "%d"), $this);?>
%</span></td>
		<?php else: ?>
			<td></td>
		<?php endif; ?>	
	<?php endif; ?>
	<td><a href='player.php?iIDPlayer=<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['id_player']; ?>
'><?php echo ((is_array($_tmp=$this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['player_firstname'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 36, "...") : smarty_modifier_truncate($_tmp, 36, "...")); ?>
 <?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['player_lastname']; ?>
</a></td>	
	<td><?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['player_initials']; ?>
</td>	
		<?php if ($this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['player_is_split_team'] == 1): ?>
			<td><img src='images/icons/flags/<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['split_1_country_code']; ?>
.gif' alt='<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['split_1_country_name']; ?>
' title='<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['split_1_country_name']; ?>
' /> <img src='images/icons/flags/<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['split_2_country_code']; ?>
.gif' alt='<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['split_2_country_name']; ?>
' title='<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['split_2_country_name']; ?>
' /></td>
		<?php else: ?>
			<td><img src='images/icons/flags/<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['country_code']; ?>
.gif' alt='<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['country_name']; ?>
' title='<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['country_name']; ?>
' /></td>
		<?php endif; ?>
	<td><a href="#" onclick="new Ajax.Updater('entry<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['id_entry_round']; ?>
', 'ajax/displayEntry.php?iIDEntry=<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['id_entry']; ?>
'); return false;"><?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['id_entry']; ?>
</a></td>

	<td>
	<?php if ($this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['entry_is_voided'] != 1): ?>
		<a href="#" onclick="new Ajax.Updater('entry<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['id_entry_round']; ?>
', 'ajax/displayEntry.php?iIDEntry=<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['id_entry']; ?>
'); return false;"><?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['entry_score']; ?>
</a></td>
	<?php else: ?>
		<i><?php echo $this->_config[0]['vars']['VOID']; ?>
</i>
	<?php endif; ?>
	<td>
	<?php if ($this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['entry_round_is_counted'] != 1): ?>
		<?php echo $this->_config[0]['vars']['NA']; ?>

	<?php else: ?>
		<?php echo ((is_array($_tmp=$this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['entry_round_date_posted'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 16, "", true) : smarty_modifier_truncate($_tmp, 16, "", true)); ?>

	<?php endif; ?>
	
	</td>	
</tr>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan='10'>
	<div id="entry<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['id_entry_round']; ?>
">
	</div>
	</td>
</tr>