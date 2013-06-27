<?php /* Smarty version 2.6.16, created on 2008-04-20 23:56:03
         compiled from game.tpl.php */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/header.tpl.php", 'smarty_include_vars' => array('title' => 'header')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['bInclude'] == null && $this->_tpl_vars['iIDGame'] == null && $this->_tpl_vars['bFromSearch'] != 'true'): ?>
	<h2><?php echo $this->_config[0]['vars']['GAME_STANDINGS_HL']; ?>
 - <?php echo $this->_tpl_vars['sDivision']; ?>
 <?php echo $this->_config[0]['vars']['DIVISION']; ?>
 - <?php echo $this->_tpl_vars['iYear']; ?>
</h2>
	<?php echo $this->_config[0]['vars']['GAME_STANDINGS_MAIN']; ?>

<?php endif; ?>

<?php echo $this->_tpl_vars['aYearsAndDivisions']; ?>


<?php if ($this->_tpl_vars['bShowAll'] == 'true' && $this->_tpl_vars['bFromSearch'] != 'true' && $this->_tpl_vars['aLinks'] != null): ?>
	<b><?php echo $this->_config[0]['vars']['GAMES_PAGES']; ?>
:</b><br />
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

<?php endif; ?>

<?php if ($this->_tpl_vars['aGames'] == null): ?>
	<?php echo $this->_config[0]['vars']['ERROR_NO_GAMES_FOUND']; ?>
<br /><br />
<?php endif; ?>

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

<?php if ($this->_tpl_vars['bInclude'] == null): ?>
		<?php if ($this->_tpl_vars['bFromSearch'] == true): ?>
		<h3><a href='game.php?iYear=<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['git_year_in_tournament']; ?>
&amp;iIDGame=<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['id_game']; ?>
&amp;sDivision=<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['division_name_short']; ?>
'><?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['game_name']; ?>
 (<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['game_manufacturer_name']; ?>
) - <?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['division_name_short']; ?>
 <?php echo $this->_config[0]['vars']['DIVISION']; ?>
 - <?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['git_year_in_tournament']; ?>
</a></h3>
	<?php else: ?>
		<h3><a href='game.php?iYear=<?php echo $this->_tpl_vars['iYear']; ?>
&amp;iIDGame=<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['id_game']; ?>
&amp;sDivision=<?php echo $this->_tpl_vars['sDivision']; ?>
'><?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['game_name']; ?>
 (<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['game_manufacturer_name']; ?>
) - <?php echo $this->_tpl_vars['sDivision']; ?>
 <?php echo $this->_config[0]['vars']['DIVISION']; ?>
 - <?php echo $this->_tpl_vars['iYear']; ?>
</a></h3>
	<?php endif; ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "recycled/gameStats.tpl.php", 'smarty_include_vars' => array('title' => 'gameStats')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	
	<br />
		<?php if ($this->_tpl_vars['aGameYearsAndDivisions'] != null): ?>
		<?php echo $this->_config[0]['vars']['GAME_OTHER_YEARS_AND_DIVISIONS']; ?>
: 	
		<?php unset($this->_sections['git']);
$this->_sections['git']['name'] = 'git';
$this->_sections['git']['loop'] = is_array($_loop=$this->_tpl_vars['aGameYearsAndDivisions']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['git']['show'] = true;
$this->_sections['git']['max'] = $this->_sections['git']['loop'];
$this->_sections['git']['step'] = 1;
$this->_sections['git']['start'] = $this->_sections['git']['step'] > 0 ? 0 : $this->_sections['git']['loop']-1;
if ($this->_sections['git']['show']) {
    $this->_sections['git']['total'] = $this->_sections['git']['loop'];
    if ($this->_sections['git']['total'] == 0)
        $this->_sections['git']['show'] = false;
} else
    $this->_sections['git']['total'] = 0;
if ($this->_sections['git']['show']):

            for ($this->_sections['git']['index'] = $this->_sections['git']['start'], $this->_sections['git']['iteration'] = 1;
                 $this->_sections['git']['iteration'] <= $this->_sections['git']['total'];
                 $this->_sections['git']['index'] += $this->_sections['git']['step'], $this->_sections['git']['iteration']++):
$this->_sections['git']['rownum'] = $this->_sections['git']['iteration'];
$this->_sections['git']['index_prev'] = $this->_sections['git']['index'] - $this->_sections['git']['step'];
$this->_sections['git']['index_next'] = $this->_sections['git']['index'] + $this->_sections['git']['step'];
$this->_sections['git']['first']      = ($this->_sections['git']['iteration'] == 1);
$this->_sections['git']['last']       = ($this->_sections['git']['iteration'] == $this->_sections['git']['total']);
?>
			<a href='game.php?iYear=<?php echo $this->_tpl_vars['aGameYearsAndDivisions'][$this->_sections['git']['index']]['git_year_in_tournament']; ?>
&amp;iIDGame=<?php echo $this->_tpl_vars['iIDGame']; ?>
&amp;sDivision=<?php echo $this->_tpl_vars['aGameYearsAndDivisions'][$this->_sections['git']['index']]['division_name_short']; ?>
'><?php echo $this->_tpl_vars['aGameYearsAndDivisions'][$this->_sections['git']['index']]['git_year_in_tournament']; ?>
 <?php echo $this->_tpl_vars['aGameYearsAndDivisions'][$this->_sections['git']['index']]['division_name_short']; ?>
 <?php echo $this->_config[0]['vars']['DIVISION_SHORT']; ?>
</a> 
	<?php endfor; endif; ?>
	<br />
	<br />
	<?php endif;  endif; ?>

<table class='mainTable'>
<?php if (( $this->_tpl_vars['bShowAll'] == true || $this->_tpl_vars['bInclude'] == true ) && $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['no_of_played_entry_rounds'] != null): ?>
	<tr>
		<td colspan='10' align='center'>
		<?php if ($this->_tpl_vars['bFromSearch'] == 'true'): ?>
			<?php if ($this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'] != null): ?>
				<a href="game.php?iYear=<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['git_year_in_tournament']; ?>
&amp;iIDGame=<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['id_game']; ?>
&amp;sDivision=<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['division_name_short']; ?>
"><?php echo $this->_config[0]['vars']['GAME_VIEW_ALL']; ?>
</a>
			<?php endif; ?>
		<?php else: ?>
			<?php if ($this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'] != null): ?>
				<a href="game.php?iYear=<?php echo $this->_tpl_vars['iYear']; ?>
&amp;iIDGame=<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['id_game']; ?>
&amp;sDivision=<?php echo $this->_tpl_vars['sDivision']; ?>
"><?php echo $this->_config[0]['vars']['GAME_VIEW_ALL']; ?>
</a>
			<?php endif; ?>
		<?php endif; ?>
		</td>
	</tr>	
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "recycled/gameHeadLines.tpl.php", 'smarty_include_vars' => array('title' => 'game')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  if ($this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'] == null): ?>
	<tr>
		<td colspan='10' align='center'><?php echo $this->_config[0]['vars']['NO_ENTRY_ROUNDS_FOUND']; ?>
</td>
	</tr>
<?php endif; ?>

	<?php $this->assign('bDisplay', 'true'); ?>
	
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
		
				<?php if (( $this->_tpl_vars['bShowAll'] == true || $this->_tpl_vars['bInclude'] == true ) && $this->_sections['entryRounds']['iteration'] > $this->_tpl_vars['iLimit']): ?>
			<?php $this->assign('bDisplay', 'false'); ?>
		<?php endif; ?>
		
				<?php if ($this->_tpl_vars['iLimit'] == 0): ?>
			<?php $this->assign('bDisplay', 'true'); ?>
		<?php endif; ?>
			
				<?php if ($this->_sections['entryRounds']['iteration'] == 1): ?>
			<?php $this->assign('iHighestScore', $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['entry_rounds'][$this->_sections['entryRounds']['index']]['entry_round_score_game']); ?>
		<?php endif; ?>
		
		<?php if ($this->_tpl_vars['bDisplay'] == 'true'): ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "recycled/gameEntryRounds.tpl.php", 'smarty_include_vars' => array('title' => 'gameRounds')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>
		
	<?php endfor; endif; ?>
	<?php if ($this->_tpl_vars['aGames'][$this->_sections['section']['index']]['stats']['no_of_played_entry_rounds'] > 0): ?>
		<tr>
			<?php if ($this->_tpl_vars['bFromSearch'] == true): ?>	
				<td align='center' colspan='15'><a href="#" onclick="new Ajax.Updater('game<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['id_game'];  echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['git_year_in_tournament'];  echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['division_name_short']; ?>
', 'ajax/gameHistogram.php?iYear=<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['git_year_in_tournament']; ?>
&amp;iIDGame=<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['id_game']; ?>
&amp;sDivision=<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['division_name_short']; ?>
'); return false;"><?php echo $this->_config[0]['vars']['GAME_VIEW_HIDE_HISTOGRAM']; ?>
</a></td>
			<?php else: ?>
				<td align='center' colspan='15'><a href="#" onclick="new Ajax.Updater('game<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['id_game']; ?>
', 'ajax/gameHistogram.php?iYear=<?php echo $this->_tpl_vars['iYear']; ?>
&amp;iIDGame=<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['id_game']; ?>
&amp;sDivision=<?php echo $this->_tpl_vars['sDivision']; ?>
'); return false;"><?php echo $this->_config[0]['vars']['GAME_VIEW_HIDE_HISTOGRAM']; ?>
</a></td>
			<?php endif; ?>
		</tr>
	<?php endif; ?>
</table>

<?php if ($this->_tpl_vars['bFromSearch'] == true): ?>
	<div id="game<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['id_game'];  echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['git_year_in_tournament'];  echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['division_name_short']; ?>
">
<?php else: ?>
	<div id="game<?php echo $this->_tpl_vars['aGames'][$this->_sections['section']['index']]['id_game']; ?>
">
<?php endif; ?>
</div>


<?php if ($this->_tpl_vars['bInclude'] == null): ?>
	<br />
<?php endif; ?>

<?php endfor; endif; ?>

<?php if ($this->_tpl_vars['bShowAll'] == 'true' && $this->_tpl_vars['bFromSearch'] != 'true' && $this->_tpl_vars['aLinks'] != null): ?>
	<b><?php echo $this->_config[0]['vars']['GAMES_PAGES']; ?>
:</b><br />
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
<?php endif; ?>

<?php if ($this->_tpl_vars['bInclude'] == null): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/footer.tpl.php", 'smarty_include_vars' => array('title' => 'footer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>