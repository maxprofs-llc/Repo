<?php /* Smarty version 2.6.16, created on 2008-04-20 20:57:01
         compiled from statsTopScores.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'statsTopScores.tpl.php', 58, false),array('modifier', 'truncate', 'statsTopScores.tpl.php', 64, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/header.tpl.php", 'smarty_include_vars' => array('title' => 'header')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h2><?php echo $this->_config[0]['vars']['STATS_TOP_SCORES_HL']; ?>
</h2>
<?php echo $this->_config[0]['vars']['STATS_TOP_SCORES_MAIN']; ?>

<br />
<br />

<h2><?php echo $this->_config[0]['vars']['GAMES_PAGES']; ?>
:</h2>  
<?php unset($this->_sections['section']);
$this->_sections['section']['name'] = 'section';
$this->_sections['section']['loop'] = is_array($_loop=$this->_tpl_vars['aLinks']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	<?php echo $this->_tpl_vars['aLinks'][$this->_sections['section']['index']]; ?>

<?php endfor; endif; ?>

<br />
<br />
<?php echo $this->_config[0]['vars']['DISPLAY']; ?>
 <?php echo $this->_tpl_vars['aInputs']['iLimit']['input']; ?>
 <?php echo $this->_config[0]['vars']['SCORES']; ?>


<table class='mainTable'>
<?php unset($this->_sections['section']);
$this->_sections['section']['name'] = 'section';
$this->_sections['section']['loop'] = is_array($_loop=$this->_tpl_vars['aGames']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	<tr>
		<td colspan='7'><h3><?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['game_name']; ?>
 (<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['game_manufacturer_name']; ?>
)</h3></td>
	</tr>
	<tr>
		<td colspan='7'><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "recycled/gameStats.tpl.php", 'smarty_include_vars' => array('title' => 'gameStats')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
	</tr>
	<tr>
		<td colspan='7'>
		<?php echo $this->_config[0]['vars']['GAME_YEARS_AND_DIVISIONS']; ?>
: 
		<?php unset($this->_sections['years']);
$this->_sections['years']['name'] = 'years';
$this->_sections['years']['loop'] = is_array($_loop=$this->_tpl_vars['aGames'][$this->_sections['section']['index']]['game_year_and_divisions']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['years']['show'] = true;
$this->_sections['years']['max'] = $this->_sections['years']['loop'];
$this->_sections['years']['step'] = 1;
$this->_sections['years']['start'] = $this->_sections['years']['step'] > 0 ? 0 : $this->_sections['years']['loop']-1;
if ($this->_sections['years']['show']) {
    $this->_sections['years']['total'] = $this->_sections['years']['loop'];
    if ($this->_sections['years']['total'] == 0)
        $this->_sections['years']['show'] = false;
} else
    $this->_sections['years']['total'] = 0;
if ($this->_sections['years']['show']):

            for ($this->_sections['years']['index'] = $this->_sections['years']['start'], $this->_sections['years']['iteration'] = 1;
                 $this->_sections['years']['iteration'] <= $this->_sections['years']['total'];
                 $this->_sections['years']['index'] += $this->_sections['years']['step'], $this->_sections['years']['iteration']++):
$this->_sections['years']['rownum'] = $this->_sections['years']['iteration'];
$this->_sections['years']['index_prev'] = $this->_sections['years']['index'] - $this->_sections['years']['step'];
$this->_sections['years']['index_next'] = $this->_sections['years']['index'] + $this->_sections['years']['step'];
$this->_sections['years']['first']      = ($this->_sections['years']['iteration'] == 1);
$this->_sections['years']['last']       = ($this->_sections['years']['iteration'] == $this->_sections['years']['total']);
?>
			<a href='game.php?iYear=<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['game_year_and_divisions'][$this->_sections['years']['index']]['git_year_in_tournament']; ?>
&amp;iIDGame=<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['game_year_and_divisions'][$this->_sections['years']['index']]['games_id_game']; ?>
&amp;sDivision=<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['game_year_and_divisions'][$this->_sections['years']['index']]['division_name_short']; ?>
'><?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['game_year_and_divisions'][$this->_sections['years']['index']]['git_year_in_tournament']; ?>
 <?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['game_year_and_divisions'][$this->_sections['years']['index']]['division_name_short']; ?>
 	<?php echo $this->_config[0]['vars']['DIVISION_SHORT']; ?>
</a> 
		<?php endfor; endif; ?>
		</td>
	</tr>
	<?php if ($this->_tpl_vars['aGames'][$this->_sections['section']['index']]['number_of_played_rounds'] > 0): ?>
		<tr>
			<td class='HL' width='130'><?php echo $this->_config[0]['vars']['SCORE']; ?>
</td>
			<td class='HL'></td>
			<td class='HL' width='50'></td>
			<td class='HL' width='170'><?php echo $this->_config[0]['vars']['PLAYER_NAME']; ?>
</td>
			<td class='HL' width='70'><?php echo $this->_config[0]['vars']['INITIALS']; ?>
</td>
			<td class='HL' width='90'><?php echo $this->_config[0]['vars']['COUNTRY']; ?>
</td>
			<td class='HL' width='90'><?php echo $this->_config[0]['vars']['ENTRY_ID']; ?>
</td>
			<td class='HL' width='90'><?php echo $this->_config[0]['vars']['POINTS']; ?>
</td>
			<td class='HL' width='70'><?php echo $this->_config[0]['vars']['YEAR']; ?>
</td>
			<td class='HL'><?php echo $this->_config[0]['vars']['DIVISION']; ?>
</td>
		</tr>
	
		<?php unset($this->_sections['entryRounds']);
$this->_sections['entryRounds']['name'] = 'entryRounds';
$this->_sections['entryRounds']['loop'] = is_array($_loop=$this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						<?php if ($this->_sections['entryRounds']['iteration'] == 1): ?>
				<?php $this->assign('iHighestScore', $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['entry_round_score_game']); ?>
			<?php endif; ?>
			<?php if ((1 & $this->_sections['entryRounds']['iteration'])): ?>
				<tr <?php echo $this->_config[0]['vars']['MOUSE_OVER_DEFAULT']; ?>
>
			<?php else: ?>
				<tr class='lineDark' <?php echo $this->_config[0]['vars']['MOUSE_OVER_DARK']; ?>
>
			<?php endif; ?>
				<td><?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['score_game_output']; ?>
</td>
				<td align='left' style='background-image:url(images/backgrounds/pointsGraph.gif); background-repeat: no-repeat; background-position: 			<?php echo smarty_function_math(array('equation' => "-34 + ((x / y) * 26)",'x' => $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['entry_round_score_game'],'y' => $this->_tpl_vars['iHighestScore'],'format' => "%d"), $this);?>
px 6px; margin-left: 10px;'><span class='small'><?php echo smarty_function_math(array('equation' => "x / y * 100",'x' => $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['entry_round_score_game'],'y' => $this->_tpl_vars['iHighestScore'],'format' => "%d"), $this);?>
%</span></td>
				<td>
				<?php if ($this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['entry_is_voided'] == true): ?>
					<i><?php echo $this->_config[0]['vars']['VOID']; ?>
</i>
				<?php endif; ?>
				</td>
				<td><a href='player.php?iIDPlayer=<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['id_player']; ?>
'><?php echo ((is_array($_tmp=$this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['player_firstname'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 24, "...") : smarty_modifier_truncate($_tmp, 24, "...")); ?>
 <?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['player_lastname']; ?>
</a></td>
				<td><a href='player.php?iIDPlayer=<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['id_player']; ?>
'><?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['player_initials']; ?>
</a></td>
		
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
'); return false;"><?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['entries_id_entry']; ?>
</a></td>
				<td><a href="#" onclick="new Ajax.Updater('entry<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['id_entry_round']; ?>
', 'ajax/displayEntry.php?iIDEntry=<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['id_entry']; ?>
'); return false;"><?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['entry_score']; ?>
</a></td>				
				<td><a href='game.php?iYear=<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['player_year_entered']; ?>
&amp;iIDGame=<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['games_id_game']; ?>
&amp;sDivision=<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['division_name_short']; ?>
'><?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['player_year_entered']; ?>
</a></td>
				<td><a href='game.php?iYear=<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['player_year_entered']; ?>
&amp;iIDGame=<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['games_id_game']; ?>
&amp;sDivision=<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['division_name_short']; ?>
'><?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['division_name_short']; ?>
</a></td>
			</tr>
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['id_entry_round']; ?>
">
				</div>
				</td>
			</tr>
		<?php endfor; endif; ?>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['aGames'][$this->_sections['section']['index']]['stats']['no_of_played_entry_rounds'] > 0): ?>
		<tr>
			<td align='center' colspan='15'><a href="#" onclick="new Ajax.Updater('game<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['id_game']; ?>
', 'ajax/gameHistogram.php?iIDGame=<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['id_game']; ?>
'); return false;"><?php echo $this->_config[0]['vars']['GAME_VIEW_HIDE_HISTOGRAM']; ?>
</a></td>
		</tr>
	<?php endif; ?>
	
	<tr>
		<td colspan='15'>
		<div id="game<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['id_game']; ?>
">
		</div>
		</td>
	</tr>			
	
<?php endfor; endif; ?>
</table>

<br />
<br />
<h2><?php echo $this->_config[0]['vars']['GAMES_PAGES']; ?>
:</h2>  
<?php unset($this->_sections['section']);
$this->_sections['section']['name'] = 'section';
$this->_sections['section']['loop'] = is_array($_loop=$this->_tpl_vars['aLinks']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	<?php echo $this->_tpl_vars['aLinks'][$this->_sections['section']['index']]; ?>

<?php endfor; endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/footer.tpl.php", 'smarty_include_vars' => array('title' => 'footer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>