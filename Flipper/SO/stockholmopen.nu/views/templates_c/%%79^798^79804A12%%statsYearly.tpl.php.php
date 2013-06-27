<?php /* Smarty version 2.6.16, created on 2008-04-20 12:13:40
         compiled from statsYearly.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'statsYearly.tpl.php', 50, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/header.tpl.php", 'smarty_include_vars' => array('title' => 'header')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h2><?php echo $this->_config[0]['vars']['STOCKHOLM_OPEN']; ?>
 - <?php echo $this->_tpl_vars['iYear']; ?>
 - <?php echo $this->_config[0]['vars']['STATS_AND_CHARTS']; ?>
</h2>

<p>
<?php echo $this->_config[0]['vars']['SELECT_YEAR']; ?>
 <?php echo $this->_tpl_vars['sSelectYear']; ?>

</p>

<table>
<tr>
	<td class='tableLabel'><?php echo $this->_config[0]['vars']['TOTAL_NUMBER_OF_PLAYERS']; ?>
</td>
	<td><?php echo $this->_tpl_vars['aStats']['total_no_of_players']; ?>
</td>
</tr>
<tr>
	<td class='tableLabel'><?php echo $this->_config[0]['vars']['NUMBER_OF_COUNTRIES_REPRESENTED']; ?>
</td>
	<td><?php echo $this->_tpl_vars['aStats']['countries']['no_of_countries']; ?>
</td>
</tr>
</table>

<?php unset($this->_sections['countries']);
$this->_sections['countries']['name'] = 'countries';
$this->_sections['countries']['loop'] = is_array($_loop=$this->_tpl_vars['aStats']['countries']['country_name']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['countries']['show'] = true;
$this->_sections['countries']['max'] = $this->_sections['countries']['loop'];
$this->_sections['countries']['step'] = 1;
$this->_sections['countries']['start'] = $this->_sections['countries']['step'] > 0 ? 0 : $this->_sections['countries']['loop']-1;
if ($this->_sections['countries']['show']) {
    $this->_sections['countries']['total'] = $this->_sections['countries']['loop'];
    if ($this->_sections['countries']['total'] == 0)
        $this->_sections['countries']['show'] = false;
} else
    $this->_sections['countries']['total'] = 0;
if ($this->_sections['countries']['show']):

            for ($this->_sections['countries']['index'] = $this->_sections['countries']['start'], $this->_sections['countries']['iteration'] = 1;
                 $this->_sections['countries']['iteration'] <= $this->_sections['countries']['total'];
                 $this->_sections['countries']['index'] += $this->_sections['countries']['step'], $this->_sections['countries']['iteration']++):
$this->_sections['countries']['rownum'] = $this->_sections['countries']['iteration'];
$this->_sections['countries']['index_prev'] = $this->_sections['countries']['index'] - $this->_sections['countries']['step'];
$this->_sections['countries']['index_next'] = $this->_sections['countries']['index'] + $this->_sections['countries']['step'];
$this->_sections['countries']['first']      = ($this->_sections['countries']['iteration'] == 1);
$this->_sections['countries']['last']       = ($this->_sections['countries']['iteration'] == $this->_sections['countries']['total']);
?>
	<?php echo $this->_tpl_vars['aStats']['countries']['country_name'][$this->_sections['countries']['index']]; ?>
 (<?php echo $this->_tpl_vars['aStats']['countries']['no_of_players'][$this->_sections['countries']['index']]; ?>
) 
<?php endfor; endif; ?>

<table>
<?php unset($this->_sections['divisions']);
$this->_sections['divisions']['name'] = 'divisions';
$this->_sections['divisions']['loop'] = is_array($_loop=$this->_tpl_vars['aStats']['divisions']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['divisions']['show'] = true;
$this->_sections['divisions']['max'] = $this->_sections['divisions']['loop'];
$this->_sections['divisions']['step'] = 1;
$this->_sections['divisions']['start'] = $this->_sections['divisions']['step'] > 0 ? 0 : $this->_sections['divisions']['loop']-1;
if ($this->_sections['divisions']['show']) {
    $this->_sections['divisions']['total'] = $this->_sections['divisions']['loop'];
    if ($this->_sections['divisions']['total'] == 0)
        $this->_sections['divisions']['show'] = false;
} else
    $this->_sections['divisions']['total'] = 0;
if ($this->_sections['divisions']['show']):

            for ($this->_sections['divisions']['index'] = $this->_sections['divisions']['start'], $this->_sections['divisions']['iteration'] = 1;
                 $this->_sections['divisions']['iteration'] <= $this->_sections['divisions']['total'];
                 $this->_sections['divisions']['index'] += $this->_sections['divisions']['step'], $this->_sections['divisions']['iteration']++):
$this->_sections['divisions']['rownum'] = $this->_sections['divisions']['iteration'];
$this->_sections['divisions']['index_prev'] = $this->_sections['divisions']['index'] - $this->_sections['divisions']['step'];
$this->_sections['divisions']['index_next'] = $this->_sections['divisions']['index'] + $this->_sections['divisions']['step'];
$this->_sections['divisions']['first']      = ($this->_sections['divisions']['iteration'] == 1);
$this->_sections['divisions']['last']       = ($this->_sections['divisions']['iteration'] == $this->_sections['divisions']['total']);
?>
	<?php if ($this->_tpl_vars['aStats']['divisions'][$this->_sections['divisions']['index']]['no_of_entries'] > 0): ?>
		<tr>
			<td colspan='2'><h3><?php echo $this->_tpl_vars['aStats']['divisions'][$this->_sections['divisions']['index']]['division_name_short']; ?>
 <?php echo $this->_config[0]['vars']['DIVISION']; ?>
</h3></td>
		</tr>
		<tr>
			<td colspan='2'><hr  /></td>
		</tr>
			<tr>
				<?php if ($this->_tpl_vars['aStats']['divisions'][$this->_sections['divisions']['index']]['division_name_short'] != 'S'): ?>
					<td class='tableLabel'><?php echo $this->_config[0]['vars']['NUMBER_OF_PLAYERS']; ?>
</td>
				<?php else: ?>
					<td class='tableLabel'><?php echo $this->_config[0]['vars']['NUMBER_OF_TEAMS']; ?>
</td>
				<?php endif; ?>
				<td><?php echo $this->_tpl_vars['aStats']['divisions'][$this->_sections['divisions']['index']]['no_of_players']; ?>
</td>
			</tr>
			<tr>
				<td class='tableLabel'><?php echo $this->_config[0]['vars']['NUMBER_OF_PLAYED_ENTRIES']; ?>
</td>
				<td><?php echo $this->_tpl_vars['aStats']['divisions'][$this->_sections['divisions']['index']]['no_of_entries']; ?>
</td>
			</tr>
						<tr>
				<td class='tableLabel'><?php echo $this->_config[0]['vars']['NUMBER_OF_VOIDED_ENTRIES']; ?>
</td>
				<td><?php echo $this->_tpl_vars['aStats']['divisions'][$this->_sections['divisions']['index']]['no_of_voided_entries']; ?>
 (<?php echo smarty_function_math(array('equation' => "x/y*100",'x' => $this->_tpl_vars['aStats']['divisions'][$this->_sections['divisions']['index']]['no_of_voided_entries'],'y' => $this->_tpl_vars['aStats']['divisions'][$this->_sections['divisions']['index']]['no_of_entries'],'format' => "%.1f"), $this);?>
%)</td>
			</tr>		
			<tr>
				<td class='tableLabel'><?php echo $this->_config[0]['vars']['NUMBER_OF_GAMES_IN_QUALIFICATIONS']; ?>
</td>
				<td><?php echo $this->_tpl_vars['aStats']['divisions'][$this->_sections['divisions']['index']]['no_of_games']; ?>
</td>
			</tr>
			
			<tr>
				<td colspan='3'><a href='statsAvgEntry.php?iYear=<?php echo $this->_tpl_vars['iYear']; ?>
&amp;sDivision=<?php echo $this->_tpl_vars['aStats']['divisions'][$this->_sections['divisions']['index']]['division_name_short']; ?>
'><?php echo $this->_config[0]['vars']['AVERAGE_ENTRY_SCORES']; ?>
</a></td>
			</tr>
			<tr>
				<td colspan='3'><a href='statsPopularGames.php?iYear=<?php echo $this->_tpl_vars['iYear']; ?>
&amp;sDivision=<?php echo $this->_tpl_vars['aStats']['divisions'][$this->_sections['divisions']['index']]['division_name_short']; ?>
'><?php echo $this->_config[0]['vars']['MOST_POPULAR_GAMES']; ?>
</a></td>
			</tr>
						<?php if ($this->_tpl_vars['aStats']['divisions'][$this->_sections['divisions']['index']]['division_name_short'] != S): ?>
				<tr>
					<td colspan='3'><a href='statsPopularGamesByCountry.php?iYear=<?php echo $this->_tpl_vars['iYear']; ?>
&amp;sDivision=<?php echo $this->_tpl_vars['aStats']['divisions'][$this->_sections['divisions']['index']]['division_name_short']; ?>
'><?php echo $this->_config[0]['vars']['MOST_POPULAR_GAMES_BY_COUNTRY']; ?>
</a></td>
				</tr>
			<?php endif; ?>
			<tr>
				<td colspan='3'><a href='statsNoOfDifferentGames.php?iYear=<?php echo $this->_tpl_vars['iYear']; ?>
&amp;sDivision=<?php echo $this->_tpl_vars['aStats']['divisions'][$this->_sections['divisions']['index']]['division_name_short']; ?>
'><?php echo $this->_config[0]['vars']['PLAYERS_TEAMS_NO_OF_DIFF_GAMES']; ?>
</a></td>
			</tr>
			<tr>
				<td colspan='3'><a href='statsVoidedEntries.php?iYear=<?php echo $this->_tpl_vars['iYear']; ?>
&amp;sDivision=<?php echo $this->_tpl_vars['aStats']['divisions'][$this->_sections['divisions']['index']]['division_name_short']; ?>
'><?php echo $this->_config[0]['vars']['NUMBER_OF_VOIDED_ENTRIES']; ?>
</a></td>
			</tr>
	<?php endif; ?>
<?php endfor; endif; ?>
</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/footer.tpl.php", 'smarty_include_vars' => array('title' => 'footer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>