<?php /* Smarty version 2.6.16, created on 2013-06-12 00:10:46
         compiled from recycled/playersAndStandings.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'recycled/playersAndStandings.tpl.php', 141, false),array('modifier', 'truncate', 'recycled/playersAndStandings.tpl.php', 306, false),)), $this); ?>
<table class='mainTable' style='text-align:left;'>
<tr>	
	<?php if ($this->_tpl_vars['bDisplayEntryAverage'] == true): ?>
		<td class='HL'>
		<?php echo $this->_config[0]['vars']['AVG']; ?>

		</td>

		<td class='HL'>
		<?php echo $this->_config[0]['vars']['BEST']; ?>

		</td>

		<td class='HL'>
		<?php echo $this->_config[0]['vars']['WORST']; ?>

		</td>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['bDisplayUniqueGames'] == true): ?>
		<td class='HL'>
		<?php echo $this->_config[0]['vars']['NO_OF_GAMES']; ?>

		</td>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['bDisplayVoidedEntries'] == true): ?>
		<td class='HL'>
		<?php echo $this->_config[0]['vars']['VOIDED']; ?>

		</td>
	<?php endif; ?>
		
	<?php if ($this->_tpl_vars['bDisplayEntries'] == true): ?>
	
				
		<td class='HL'>
		<!-- we only want to display the position if it's sorted by score -->
		<?php if ($this->_tpl_vars['sSort'] == null || $this->_tpl_vars['sSort'] == 'scoreDesc'): ?> 
			<?php echo $this->_config[0]['vars']['POSITION_SHORT']; ?>

		<?php endif; ?>
		</td>
	
		<?php if (( $this->_tpl_vars['sSort'] == null || $this->_tpl_vars['sSort'] == 'scoreDesc' ) && $this->_tpl_vars['bIncludedFromSlide'] != 'true'): ?> 
			<td class='HLsortUp'>
		<?php else: ?>
			<td class='HL'>
		<?php endif; ?>
	
		<?php if ($this->_tpl_vars['bDisableHLLinks'] != true): ?>
			<a href='<?php echo $this->_tpl_vars['sLinkMain']; ?>
&amp;sSort=scoreDesc'><?php echo $this->_config[0]['vars']['POINTS']; ?>
</a>
		<?php else: ?>
			<?php echo $this->_config[0]['vars']['POINTS']; ?>

		<?php endif; ?>	
		</td>
	<?php endif; ?>
		
	<?php if ($this->_tpl_vars['bDisplayIDs'] == true): ?>
		<td class='HL'><?php echo $this->_config[0]['vars']['ID']; ?>
</td>	
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['sSort'] == 'nameAsc'): ?> 
		<td class='HLsortDown'>
	<?php else: ?>
		<td class='HL'>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['bDisableHLLinks'] != true): ?>
		<a href='<?php echo $this->_tpl_vars['sLinkMain']; ?>
&amp;sSort=nameAsc'><?php echo $this->_config[0]['vars']['NAME']; ?>
</a>
	<?php else: ?>
		<?php echo $this->_config[0]['vars']['NAME']; ?>

	<?php endif; ?>
		
	</td>

	<?php if ($this->_tpl_vars['sSort'] == 'initialsAsc'): ?> 
		<td class='HLsortDown'>
	<?php else: ?>
		<td class='HL'>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['bDisableHLLinks'] != true): ?>
		<a href='<?php echo $this->_tpl_vars['sLinkMain']; ?>
&amp;sSort=initialsAsc'><?php echo $this->_config[0]['vars']['INITIALS']; ?>
</a>
	<?php else: ?>
		<?php echo $this->_config[0]['vars']['INITIALS']; ?>

	<?php endif; ?>	
	</td>
	
	<!-- if it's the split division we can't sort on city -->
	<?php if ($this->_tpl_vars['sDivision'] == 'S'): ?>
		<td class='HL'>
		<?php echo $this->_config[0]['vars']['CITY']; ?>

	<?php else: ?>
		<?php if ($this->_tpl_vars['sSort'] == 'cityAsc'): ?> 
			<td class='HLsortDown'>
		<?php else: ?>
			<td class='HL'>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['bDisableHLLinks'] != true): ?>
			<a href='<?php echo $this->_tpl_vars['sLinkMain']; ?>
&amp;sSort=cityAsc'><?php echo $this->_config[0]['vars']['CITY']; ?>
</a>
		<?php else: ?>
			<?php echo $this->_config[0]['vars']['CITY']; ?>

		<?php endif; ?>
	<?php endif; ?>
	</td>

	<!-- if it's the split division we can't sort on country -->
	<?php if ($this->_tpl_vars['sDivision'] == 'S'): ?>
		<td class='HL'>
		<?php echo $this->_config[0]['vars']['COUNTRY']; ?>

	<?php else: ?>
		<?php if ($this->_tpl_vars['sSort'] == 'countryAsc'): ?> 
			<td class='HLsortDown'>
		<?php else: ?>
			<td class='HL'>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['bDisableHLLinks'] != true): ?>
			<a href='<?php echo $this->_tpl_vars['sLinkMain']; ?>
&amp;sSort=countryAsc'><?php echo $this->_config[0]['vars']['COUNTRY']; ?>
</a>
		<?php else: ?>
			<?php echo $this->_config[0]['vars']['COUNTRY']; ?>

		<?php endif; ?>	
	<?php endif; ?>
	</td>

	<?php if ($this->_tpl_vars['bDisplayDivisions'] == true): ?>
		<td class='HL'><?php echo $this->_config[0]['vars']['DIVISION_SHORT']; ?>
</td>
	<?php endif; ?>
		
	<?php if ($this->_tpl_vars['bDisplayYears'] == true): ?>
		<td class='HL'><?php echo $this->_config[0]['vars']['YEAR']; ?>
</td>
	<?php endif; ?>	
	
	
	<?php if ($this->_tpl_vars['bDisplayEntries'] == true): ?>
		<td class='HL'>
		<?php echo $this->_config[0]['vars']['ENTRY_ID']; ?>

		</td>
		
		<td class='HL' colspan='<?php echo count($this->_tpl_vars['aPlayers']['0']['entry_round_score']); ?>
'>
		<?php echo $this->_config[0]['vars']['ROUND_SCORES']; ?>

		</td>

		<td class='HL'>
		<?php echo $this->_config[0]['vars']['LAST_UPDATE']; ?>

		</td>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['bDisplayEntries'] == true || $this->_tpl_vars['bDisplayEntryAverage'] == true || $this->_tpl_vars['bDisplayUniqueGames'] == true || $this->_tpl_vars['bDisplayVoidedEntries'] == true): ?>
		<?php if ($this->_tpl_vars['bDisableHLLinks'] != true): ?>
			<?php if ($this->_tpl_vars['sSort'] == 'entriesDesc'): ?> 
				<td class='HLsortUp'>
				<a href='<?php echo $this->_tpl_vars['sLinkMain']; ?>
&amp;sSort=entriesAsc'><?php echo $this->_config[0]['vars']['ENTRIES']; ?>
</a>				
				</td>
			<?php elseif ($this->_tpl_vars['sSort'] == 'entriesAsc'): ?>
				<td class='HLsortDown'>
				<a href='<?php echo $this->_tpl_vars['sLinkMain']; ?>
&amp;sSort=entriesDesc'><?php echo $this->_config[0]['vars']['ENTRIES']; ?>
</a>
				</td>
			<?php else: ?>	
				<td class='HL'>
				<a href='<?php echo $this->_tpl_vars['sLinkMain']; ?>
&amp;sSort=entriesDesc'><?php echo $this->_config[0]['vars']['ENTRIES']; ?>
</a>
				</td>
			<?php endif; ?>
		<?php else: ?>
			<?php if ($this->_tpl_vars['bHideNoOfEntries'] != true): ?>
				<td class='HL'><?php echo $this->_config[0]['vars']['ENTRIES']; ?>
</td>
			<?php endif; ?>
		<?php endif; ?>	
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['bIncludedFromReg'] == true): ?>
		<?php if ($this->_tpl_vars['sSort'] == 'dateDesc' || $this->_tpl_vars['sSort'] == null): ?> 
			<td class='HLsortDown'>
		<?php else: ?>
			<td class='HL'>
		<?php endif; ?>
		
			<?php if ($this->_tpl_vars['bDisableHLLinks'] != 'true'): ?>
				<a href='<?php echo $this->_tpl_vars['sLinkMain']; ?>
&amp;sSort=dateDesc'><?php echo $this->_config[0]['vars']['DATE_REGISTERED']; ?>
</a>
			<?php else: ?>
				<?php echo $this->_config[0]['vars']['DATE_REGISTERED']; ?>

			<?php endif; ?>	
			</td>

		<?php if ($this->_tpl_vars['bDivisionIsFree'] != 1): ?>
			<?php if ($this->_tpl_vars['sSort'] == 'paid'): ?> 
				<td class='HLsortDown'>
			<?php else: ?>
				<td class='HL'>
			<?php endif; ?>

			<?php if ($this->_tpl_vars['bDisableHLLinks'] != 'true'): ?>	
				<a href='<?php echo $this->_tpl_vars['sLinkMain']; ?>
&amp;sSort=paid'><?php echo $this->_config[0]['vars']['PAID']; ?>
</a>
			<?php else: ?>
				<?php echo $this->_config[0]['vars']['PAID']; ?>

			<?php endif; ?>
		<?php endif; ?>
					
			</td>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['bIncludedFromAdmin'] == true): ?>
	  <td class='HL'><?php echo $this->_config[0]['vars']['QR']; ?>
</td>
  <?php endif; ?>  
	<?php if ($this->_tpl_vars['bDisplayEdit'] == 'true'): ?>
	  <td class='HL'><?php echo $this->_config[0]['vars']['EDIT']; ?>
</td>
	<?php endif; ?>
</tr>
<tr>
	<td colspan='16'></td>
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

	<?php if ($this->_tpl_vars['bIncludedFromSlide'] == 'true'): ?>
		<?php $this->assign('iPos', $this->_sections['section']['iteration']+$this->_tpl_vars['iPosStart']); ?>
	<?php else: ?>
		<?php $this->assign('iPos', $this->_sections['section']['iteration']); ?>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['bDisplayDivisionHeadlines'] == 'true' && $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['division_name_short'] != $this->_tpl_vars['sPrevDivision']): ?>
		<tr>
			<td colspan='12' class='HL'><?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['division_name_short']; ?>
 <?php echo $this->_config[0]['vars']['DIVISION']; ?>
</td>
		</tr>
	<?php endif; ?>

	<?php $this->assign('bDisplayBreak', false); ?>
		<?php if ($this->_tpl_vars['bIncludedFromSlide'] == 'true'): ?>
		<?php if ($this->_tpl_vars['iPos'] == ( $this->_tpl_vars['iNoOfPlayersInFinals']+1 )): ?>
			<?php $this->assign('bDisplayBreak', true); ?>
		<?php endif; ?>
	<?php endif; ?>
	
	<?php if (( $this->_sections['section']['iteration'] == ( $this->_tpl_vars['iNoOfPlayersInFinals']+1 ) ) && $this->_tpl_vars['iNoOfPlayersInFinals'] != null): ?>
		<?php $this->assign('bDisplayBreak', true); ?>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['bDisplayBreak'] == true && ( $this->_tpl_vars['sSort'] == null || $this->_tpl_vars['sSort'] == 'scoreDesc' )): ?>
		<tr>
			<td colspan='12'><hr /></td>
		</tr>
	<?php endif; ?>
	
	<?php if ((1 & $this->_sections['section']['iteration'])): ?>
		<tr <?php echo $this->_config[0]['vars']['MOUSE_OVER_DEFAULT']; ?>
>
	<?php else: ?>
		<tr class='lineDark' <?php echo $this->_config[0]['vars']['MOUSE_OVER_DARK']; ?>
>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['bDisplayEntryAverage'] == true): ?>
		<td><b><?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['avg_entry_score']; ?>
</b></td>
		<td><?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['max_entry_score']; ?>
</td>
		<td><?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['min_entry_score']; ?>
</td>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['bDisplayUniqueGames'] == true): ?>
		<td>
		<b><?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['unique_game_count']; ?>
</b>
		</td>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['bDisplayVoidedEntries'] == true): ?>
		<td>
		<b><?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['no_of_voided_entries']; ?>
</b>
		</td>
	<?php endif; ?>
		
	<?php if ($this->_tpl_vars['bDisplayEntries'] == 'true'): ?>
																																																																								
		<td align='center'>
				<?php if ($this->_tpl_vars['sSort'] == null || $this->_tpl_vars['sSort'] == 'scoreDesc'): ?>
			<b><?php echo $this->_tpl_vars['iPos']; ?>
</b>		
		<?php endif; ?>
		</td>
		<td><b><?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['entry_score']; ?>
</b></td>
	<?php endif; ?>

		<?php if ($this->_tpl_vars['bDisplayIDs'] == true): ?>
			<td><?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['id_player']; ?>
</td>
		<?php endif; ?>
		
		<td>
			<?php if ($this->_tpl_vars['bDisableLinks'] != true): ?>
					<?php if ($this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['player_is_split_team'] == 1 && ( $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['split_1_initials'] != null && $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['split_2_initials'] != null )): ?>
						<a href='player.php?iIDPlayer=<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['id_player']; ?>
'><?php echo ((is_array($_tmp=$this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['player_firstname'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 26, "...") : smarty_modifier_truncate($_tmp, 26, "...")); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['player_lastname'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 16, "...") : smarty_modifier_truncate($_tmp, 16, "...")); ?>
</a> (<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['split_1_initials']; ?>
 & <?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['split_2_initials']; ?>
)
					<?php else: ?>
						<a href='player.php?iIDPlayer=<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['id_player']; ?>
'><?php echo ((is_array($_tmp=$this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['player_firstname'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 26, "...") : smarty_modifier_truncate($_tmp, 26, "...")); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['player_lastname'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 16, "...") : smarty_modifier_truncate($_tmp, 16, "...")); ?>
</a>
					<?php endif; ?>
			<?php else: ?>
					<?php if ($this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['player_is_split_team'] == 1 && ( $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['split_1_initials'] != null && $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['split_2_initials'] != null )): ?>
						<?php echo ((is_array($_tmp=$this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['player_firstname'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 26, "...") : smarty_modifier_truncate($_tmp, 26, "...")); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['player_lastname'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 16, "...") : smarty_modifier_truncate($_tmp, 16, "...")); ?>
 (<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['split_1_initials']; ?>
 & <?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['split_2_initials']; ?>
)
					<?php else: ?>
						<?php echo ((is_array($_tmp=$this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['player_firstname'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 26, "...") : smarty_modifier_truncate($_tmp, 26, "...")); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['player_lastname'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 16, "...") : smarty_modifier_truncate($_tmp, 16, "...")); ?>

					<?php endif; ?>
			<?php endif; ?>
			
		</td>
		
		<td>
			<?php if ($this->_tpl_vars['bDisableLinks'] != true): ?>	
				<a href='player.php?iIDPlayer=<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['id_player']; ?>
'><?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['player_initials']; ?>
</a>
			<?php else: ?>
				<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['player_initials']; ?>

			<?php endif; ?>				
		</td>

		<?php if ($this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['player_is_split_team'] == 1): ?>
			<td><?php echo ((is_array($_tmp=$this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['split_1_address_city'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 10, "...") : smarty_modifier_truncate($_tmp, 10, "...")); ?>
 / <?php echo ((is_array($_tmp=$this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['split_2_address_city'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 10, "...") : smarty_modifier_truncate($_tmp, 10, "...")); ?>
</td>
			<td><img src='images/icons/flags/<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['split_1_country_code']; ?>
.gif' alt='<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['split_1_country_name']; ?>
' title='<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['split_1_country_name']; ?>
' /> <img src='images/icons/flags/<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['split_2_country_code']; ?>
.gif' alt='<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['split_2_country_name']; ?>
' title='<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['split_2_country_name']; ?>
' /></td>
		<?php else: ?>
			<td><?php echo ((is_array($_tmp=$this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['player_address_city'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 16, "...") : smarty_modifier_truncate($_tmp, 16, "...")); ?>
</td>
			<td><img src='images/icons/flags/<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['country_code']; ?>
.gif' alt='<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['country_name']; ?>
' title='<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['country_name']; ?>
' /></td>
		<?php endif; ?>
		
		<?php if ($this->_tpl_vars['bDisplayDivisions'] == true): ?>
			<td><?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['division_name_short']; ?>
</td>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['bDisplayYears'] == true): ?>
			<td><?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['player_year_entered']; ?>
</td>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['bDisplayEntries'] == true): ?>
			<td><a href="#" onclick="new Ajax.Updater('entry<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['id_entry']; ?>
', 'ajax/displayEntry.php?iIDEntry=<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['id_entry']; ?>
'); return false;"><?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['id_entry']; ?>
</a></td>
			<?php unset($this->_sections['entryRounds']);
$this->_sections['entryRounds']['name'] = 'entryRounds';
$this->_sections['entryRounds']['loop'] = is_array($_loop=$this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['entry_round_score']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<td>
				<a href="#" onclick="new Ajax.Updater('entry<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['id_entry']; ?>
', 'ajax/displayEntry.php?iIDEntry=<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['id_entry']; ?>
'); return false;">
				<?php if ($this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['entry_round_score'][$this->_sections['entryRounds']['index']] == 100): ?>
					<b><?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['entry_round_score'][$this->_sections['entryRounds']['index']]; ?>
</b>
				<?php else: ?>
					<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['entry_round_score'][$this->_sections['entryRounds']['index']]; ?>

				<?php endif; ?>
				</a>
			</td>		
			<?php endfor; endif; ?>
			<td><?php echo ((is_array($_tmp=$this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['entry_date_completed'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 16, "", true) : smarty_modifier_truncate($_tmp, 16, "", true)); ?>
</td>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['bDisplayEntries'] == true || $this->_tpl_vars['bDisplayEntryAverage'] == true || $this->_tpl_vars['bDisplayUniqueGames'] == true || $this->_tpl_vars['bDisplayVoidedEntries'] == true): ?>
			<?php if ($this->_tpl_vars['bHideNoOfEntries'] != true): ?>
				<td><a href='player.php?iIDPlayer=<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['id_player']; ?>
'><?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['dtp_no_of_played_entries']; ?>
</a></td>
			<?php endif; ?>		
		<?php endif; ?>

		<?php if ($this->_tpl_vars['bIncludedFromReg'] == true): ?>
			<td><?php echo ((is_array($_tmp=$this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['player_date_registered'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 10, "", true) : smarty_modifier_truncate($_tmp, 10, "", true)); ?>
</td>
			
			<?php if ($this->_tpl_vars['bDivisionIsFree'] != 1): ?>
				<td>
				<?php if ($this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['dtp_paid_fee'] == 1): ?>
					X
				<?php endif; ?>
				</td>
			<?php endif; ?>
				
		<?php endif; ?>

		<?php if ($this->_tpl_vars['bIncludedFromAdmin'] == true): ?>
		  <td><a href='wap/playerPrinter.php?playerId=<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['id_player']; ?>
&autoPrint=true' target='_new'><img src='images/icons/qr.png' alt='<?php echo $this->_config[0]['vars']['ADMIN_PLAYER_PRINT']; ?>
' title='<?php echo $this->_config[0]['vars']['ADMIN_PLAYER_PRINT']; ?>
' class='iconLink' /></a></td>    
    <?php endif; ?>
		<?php if ($this->_tpl_vars['bDisplayEdit'] == true): ?>
			<?php if ($this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['division_name_short'] != 'S'): ?>			
				<td><a href='register.php?iIDEdit=<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['id_player']; ?>
'><img src='images/icons/edit.gif' alt='<?php echo $this->_config[0]['vars']['EDIT']; ?>
' title='<?php echo $this->_config[0]['vars']['EDIT']; ?>
' class='iconLink' /></a></td>
			<?php else: ?>
				<td><a href='registerSplit.php?iIDEdit=<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['id_player']; ?>
'><img src='images/icons/edit.gif' alt='<?php echo $this->_config[0]['vars']['EDIT']; ?>
' title='<?php echo $this->_config[0]['vars']['EDIT']; ?>
' class='iconLink' /></a></td>
			<?php endif; ?>	
		<?php endif; ?>

		</tr>
		
				<?php if ($this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['is_split_team'] == 1): ?>
			<?php if ((1 & $this->_sections['section']['iteration'])): ?>
				<tr <?php echo $this->_config[0]['vars']['MOUSE_OVER_DEFAULT']; ?>
>
			<?php else: ?>
				<tr class='lineDark' <?php echo $this->_config[0]['vars']['MOUSE_OVER_DARK']; ?>
>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['bDisplayEntries'] == true): ?>
								<td></td>
				<td></td>
			<?php endif; ?>	
			<td></td>
			<td></td>
			<td colspan='16'><a href='player.php?iIDPlayer=<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['split_1_id_player']; ?>
' style='font-weight:normal'><?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['split_1_firstname']; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['split_1_lastname'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 20, "...") : smarty_modifier_truncate($_tmp, 20, "...")); ?>
</a> &amp; <a href='player.php?iIDPlayer=<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['split_2_id_player']; ?>
' style='font-weight:normal'><?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['split_2_firstname']; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['split_2_lastname'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 20, "...") : smarty_modifier_truncate($_tmp, 20, "...")); ?>
</a></td>
		</tr>		
		<?php endif; ?>
		
		<?php if ($this->_tpl_vars['bDisplayEntries'] == true): ?>		
						<tr>
				<td></td>
				<td></td>
				<td colspan='10'>
				<div id="entry<?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['id_entry']; ?>
">
				</div>
				</td>
			</tr>
		<?php endif; ?>
		<?php $this->assign('sPrevDivision', $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['division_name_short']);  endfor; endif; ?>
</table>

<?php if ($this->_tpl_vars['aPlayers'] == null): ?>
	<center>
	<?php echo $this->_config[0]['vars']['NO_DATA_FOUND']; ?>

	</center>
<?php endif; ?>