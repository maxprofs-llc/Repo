<?php /* Smarty version 2.6.16, created on 2008-04-20 13:00:39
         compiled from recycled/noOfEntryRounds.tpl.php */ ?>
<table class='mainTable'>
	<tr>
		<td class='HL'><?php echo $this->_config[0]['vars']['ROUNDS']; ?>
</td>
		<td class='HL'><?php echo $this->_config[0]['vars']['GAME']; ?>
</td>
		<td class='HL'><?php echo $this->_config[0]['vars']['BEST_SCORE']; ?>
</td>
		<td class='HL'><?php echo $this->_config[0]['vars']['BY']; ?>
</td>
		<td class='HL'><?php echo $this->_config[0]['vars']['COUNTRY']; ?>
</td>
	</tr>
	<?php unset($this->_sections['section']);
$this->_sections['section']['name'] = 'section';
$this->_sections['section']['loop'] = is_array($_loop=$this->_tpl_vars['aGameRounds']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<?php $this->assign('bOutput', true); ?>
		<?php if (( $this->_tpl_vars['aGameRounds'][$this->_sections['section']['index']]['highest_score']['country_name'] != $this->_tpl_vars['sPrevCountry'] ) && $this->_tpl_vars['bDisplayCountryHeadline'] == true): ?>
			<tr>
				<td colspan='10' class='HL'><?php echo $this->_tpl_vars['aGameRounds'][$this->_sections['section']['index']]['highest_score']['country_name']; ?>
</td>
			</tr>
		<?php endif; ?>
		
		<?php if ((1 & $this->_sections['section']['iteration'])): ?>
			<tr <?php echo $this->_config[0]['vars']['MOUSE_OVER_DEFAULT']; ?>
>
		<?php else: ?>
			<tr class='lineDark' <?php echo $this->_config[0]['vars']['MOUSE_OVER_DARK']; ?>
>
		<?php endif; ?>
	
		<td><b><?php echo $this->_tpl_vars['aGameRounds'][$this->_sections['section']['index']]['entry_round_count']; ?>
</b></td>
		<td><a href='game.php?iYear=<?php echo $this->_tpl_vars['iYear']; ?>
&amp;iIDGame=<?php echo $this->_tpl_vars['aGameRounds'][$this->_sections['section']['index']]['id_game']; ?>
&amp;sDivision=<?php echo $this->_tpl_vars['sDivision']; ?>
'><?php echo $this->_tpl_vars['aGameRounds'][$this->_sections['section']['index']]['game_name']; ?>
</a></td>
		<td><?php echo $this->_tpl_vars['aGameRounds'][$this->_sections['section']['index']]['highest_score']['score_highest_output']; ?>
</td>
		<td><a href='player.php?iIDPlayer=<?php echo $this->_tpl_vars['aGameRounds'][$this->_sections['section']['index']]['highest_score']['id_player']; ?>
'><?php echo $this->_tpl_vars['aGameRounds'][$this->_sections['section']['index']]['highest_score']['player_firstname']; ?>
 <?php echo $this->_tpl_vars['aGameRounds'][$this->_sections['section']['index']]['highest_score']['player_lastname']; ?>
</a></td>
		<?php if ($this->_tpl_vars['aGameRounds'][$this->_sections['section']['index']]['highest_score']['player_is_split_team'] == 1): ?>
			<td><img src='images/icons/flags/<?php echo $this->_tpl_vars['aGameRounds'][$this->_sections['section']['index']]['highest_score']['split_1_country_code']; ?>
.gif' alt='<?php echo $this->_tpl_vars['aGameRounds'][$this->_sections['section']['index']]['highest_score']['split_1_country_name']; ?>
' title='<?php echo $this->_tpl_vars['aGameRounds'][$this->_sections['section']['index']]['highest_score']['split_1_country_name']; ?>
' /> <img src='images/icons/flags/<?php echo $this->_tpl_vars['aGameRounds'][$this->_sections['section']['index']]['highest_score']['split_2_country_code']; ?>
.gif' alt='<?php echo $this->_tpl_vars['aGameRounds'][$this->_sections['section']['index']]['highest_score']['split_2_country_name']; ?>
' title='<?php echo $this->_tpl_vars['aGameRounds'][$this->_sections['section']['index']]['highest_score']['split_2_country_name']; ?>
' /></td>
		<?php else: ?>
			<td><img src='images/icons/flags/<?php echo $this->_tpl_vars['aGameRounds'][$this->_sections['section']['index']]['highest_score']['country_code']; ?>
.gif' alt='<?php echo $this->_tpl_vars['aGameRounds'][$this->_sections['section']['index']]['highest_score']['country_name']; ?>
' title='<?php echo $this->_tpl_vars['aGameRounds'][$this->_sections['section']['index']]['highest_score']['country_name']; ?>
' /></td>
			<?php endif; ?>

		<?php $this->assign('sPrevCountry', $this->_tpl_vars['aGameRounds'][$this->_sections['section']['index']]['highest_score']['country_name']); ?>
	</tr>
	<?php endfor; endif; ?>

	<?php if ($this->_tpl_vars['bOutput'] != true): ?>
	<tr>
		<td colspan='5' align='center'><?php echo $this->_config[0]['vars']['NO_DATA_FOUND']; ?>
</td>
	</tr>
	<?php endif; ?>
</table>
