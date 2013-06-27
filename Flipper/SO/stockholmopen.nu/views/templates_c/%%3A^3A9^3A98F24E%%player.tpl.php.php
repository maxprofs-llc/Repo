<?php /* Smarty version 2.6.16, created on 2013-06-12 00:06:38
         compiled from player.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'player.tpl.php', 137, false),)), $this); ?>

<?php if ($this->_tpl_vars['bIncludeFromLoop'] != 'true'): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/header.tpl.php", 'smarty_include_vars' => array('title' => 'header')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  else: ?>
	<?php if ($this->_tpl_vars['bIncludeHeader'] == 'true'): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/header.tpl.php", 'smarty_include_vars' => array('title' => 'header')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif;  endif; ?>

<?php if ($this->_tpl_vars['iIDEntry'] != null): ?>
	<h2><?php echo $this->_config[0]['vars']['ENTRY_HL']; ?>
 #<?php echo $this->_tpl_vars['iIDEntry']; ?>

		<?php if ($this->_tpl_vars['bIncludedFromAdmin'] == true): ?>
      <a href='wap/entryPrinter.php?entryId=<?php echo $this->_tpl_vars['iIDEntry']; ?>
&autoPrint=true' target='_new'><img src='images/icons/qr.png' class='iconLink' alt='<?php echo $this->_config[0]['vars']['ADMIN_ENTRY_PRINT']; ?>
' title='<?php echo $this->_config[0]['vars']['ADMIN_ENTRY_PRINT']; ?>
' /></a>
    <?php endif; ?>
  </h2>
	<?php echo $this->_config[0]['vars']['ENTRY_MAIN']; ?>

<?php endif; ?>

<?php if ($this->_tpl_vars['iIDPlayer'] != null): ?>
	<h2>
	<?php if ($this->_tpl_vars['aPlayers']['0']['player_is_split_team'] == 1): ?>
		<?php echo $this->_config[0]['vars']['TEAM']; ?>
 
	<?php else: ?>
		<?php echo $this->_config[0]['vars']['PLAYER']; ?>

	<?php endif; ?>
	#<?php echo $this->_tpl_vars['iIDPlayer']; ?>

	  <?php if ($this->_tpl_vars['bIncludedFromAdmin'] == true): ?>
      <a href='wap/playerPrinter.php?playerId=<?php echo $this->_tpl_vars['iIDPlayer']; ?>
&autoPrint=true' target='_new'><img src='images/icons/qr.png' class='iconLink' alt='<?php echo $this->_config[0]['vars']['ADMIN_PLAYER_PRINT']; ?>
' title='<?php echo $this->_config[0]['vars']['ADMIN_PLAYER_PRINT']; ?>
' /></a></h2>
    <?php endif; ?>
	<?php echo $this->_config[0]['vars']['PLAYER_MAIN']; ?>

<?php endif; ?>

<table>
<tr>
	<td class='tableLabel'>	
	<?php if ($this->_tpl_vars['aPlayers']['0']['player_is_split_team'] == 1): ?>
		<?php echo $this->_config[0]['vars']['TEAM_NAME']; ?>

	<?php else: ?>
		<?php echo $this->_config[0]['vars']['PLAYER_NAME']; ?>

	<?php endif; ?>
	</td>
	<td><a href='player.php?iIDPlayer=<?php echo $this->_tpl_vars['aPlayers']['0']['id_player']; ?>
'><?php echo $this->_tpl_vars['aPlayers']['0']['player_firstname']; ?>
 <?php echo $this->_tpl_vars['aPlayers']['0']['player_lastname']; ?>
</a></td>
	<td rowspan='10' valign='top' width='240' align='right'>
	<?php if ($this->_tpl_vars['bFileExists']): ?>
		<img src='images/players/<?php echo $this->_tpl_vars['aPlayers']['0']['id_player']; ?>
.jpg' border='1' width='<?php echo $this->_tpl_vars['iWidth']; ?>
' />
	<?php endif; ?>
	</td>
</tr>

<tr>
	<td class='tableLabel'><?php echo $this->_config[0]['vars']['INITIALS']; ?>
</td>
	<td><?php echo $this->_tpl_vars['aPlayers']['0']['player_initials']; ?>
</td>
</tr>

<?php if ($this->_tpl_vars['aPlayers']['0']['player_is_split_team'] == 1): ?>
	<tr>
		<td class='tableLabel'><?php echo $this->_config[0]['vars']['PLAYERS']; ?>
</td>
		<td><a href='player.php?iIDPlayer=<?php echo $this->_tpl_vars['aPlayers']['0']['split_1_id_player']; ?>
'><?php echo $this->_tpl_vars['aPlayers']['0']['split_1_firstname']; ?>
 <?php echo $this->_tpl_vars['aPlayers']['0']['split_1_lastname']; ?>
</a> &amp; <a href='player.php?iIDPlayer=<?php echo $this->_tpl_vars['aPlayers']['0']['split_2_id_player']; ?>
'><?php echo $this->_tpl_vars['aPlayers']['0']['split_2_firstname']; ?>
 <?php echo $this->_tpl_vars['aPlayers']['0']['split_2_lastname']; ?>
</a></td>
	</tr>
<?php endif; ?>

<tr>
	<td class='tableLabel'><?php echo $this->_config[0]['vars']['CITY']; ?>
</td>
	<td>
	<?php if ($this->_tpl_vars['aPlayers']['0']['player_is_split_team'] == 1): ?>
		<?php echo $this->_tpl_vars['aPlayers']['0']['split_1_address_city']; ?>
 / <?php echo $this->_tpl_vars['aPlayers']['0']['split_2_address_city']; ?>

	<?php else: ?>
		<?php echo $this->_tpl_vars['aPlayers']['0']['player_address_city']; ?>

	<?php endif; ?>
	</td>
</tr>
<tr>
	<td class='tableLabel'><?php echo $this->_config[0]['vars']['COUNTRY']; ?>
</td>
	<td>
	<?php if ($this->_tpl_vars['aPlayers']['0']['player_is_split_team'] == 1): ?>
		<img src='images/icons/flags/<?php echo $this->_tpl_vars['aPlayers']['0']['split_1_country_code']; ?>
.gif' alt='<?php echo $this->_tpl_vars['aPlayers']['0']['split_1_country_name']; ?>
' title='<?php echo $this->_tpl_vars['aPlayers']['0']['split_1_country_name']; ?>
' /> <img src='images/icons/flags/<?php echo $this->_tpl_vars['aPlayers']['0']['split_2_country_code']; ?>
.gif' alt='<?php echo $this->_tpl_vars['aPlayers']['0']['split_2_country_name']; ?>
' title='<?php echo $this->_tpl_vars['aPlayers']['0']['split_2_country_name']; ?>
' />
	<?php else: ?>
		<img src='images/icons/flags/<?php echo $this->_tpl_vars['aPlayers']['0']['country_code']; ?>
.gif' alt='<?php echo $this->_tpl_vars['aPlayers']['0']['country_name']; ?>
' title='<?php echo $this->_tpl_vars['aPlayers']['0']['country_name']; ?>
' />
	<?php endif; ?>
	</td>
</tr>

<tr>
	<td class='tableLabel'><?php echo $this->_config[0]['vars']['YEAR_ENTERED']; ?>
</td>
	<td><?php echo $this->_tpl_vars['aPlayers']['0']['player_year_entered']; ?>
</td>
</tr>

<?php unset($this->_sections['section']);
$this->_sections['section']['name'] = 'section';
$this->_sections['section']['loop'] = is_array($_loop=$this->_tpl_vars['aDivisions']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<td class='HL' colspan='2'><?php echo $this->_tpl_vars['aDivisions'][$this->_sections['section']['index']]['division_name_short']; ?>
 <?php echo $this->_config[0]['vars']['DIVISION']; ?>
</td>
	</tr>
	<tr>
		<td class='tableLabel'><?php echo $this->_config[0]['vars']['QUAL_POSITION']; ?>
</td>
		<td>
		<?php if ($this->_tpl_vars['aDivisions'][$this->_sections['section']['index']]['best_entry_position'] != null): ?>
			<?php echo $this->_tpl_vars['aDivisions'][$this->_sections['section']['index']]['best_entry_position']; ?>

		<?php else: ?>
			<?php echo $this->_config[0]['vars']['NA']; ?>

		<?php endif; ?>
		</td>
	</tr>
	<tr>
		<td class='tableLabel'><?php echo $this->_config[0]['vars']['PLAYED_ENTRIES']; ?>
</td>
		<td>
		<?php if ($this->_tpl_vars['aDivisions'][$this->_sections['section']['index']]['no_of_played_entries'] != null): ?>
			<?php echo $this->_tpl_vars['aDivisions'][$this->_sections['section']['index']]['no_of_played_entries']; ?>

		<?php else: ?>
			<?php echo $this->_config[0]['vars']['NA']; ?>

		<?php endif; ?>
		</td>
	</tr>
	<tr>
		<td class='tableLabel'><?php echo $this->_config[0]['vars']['AVERAGE_ENTRY_SCORE']; ?>
</td>
		<td>
		<?php if ($this->_tpl_vars['aDivisions'][$this->_sections['section']['index']]['avg_score'] != null): ?>
			<?php echo $this->_tpl_vars['aDivisions'][$this->_sections['section']['index']]['avg_score']; ?>

		<?php else: ?>
			<?php echo $this->_config[0]['vars']['NA']; ?>

		<?php endif; ?>
		</td>
	</tr>			
<?php endfor; endif; ?>

<?php if ($this->_tpl_vars['bPlayerHasPlayedEntries'] != false): ?>
	<tr>
		<td colspan='2'><span class='smallLight'><?php echo $this->_config[0]['vars']['AVERAGE_VOIDED_ENTRIES_NOT_INCLUDED']; ?>
</span></td>
	</tr>
<?php endif; ?>
	
<?php if ($this->_tpl_vars['iIDEntry'] != null): ?>
	<tr>
		<td class='tableLabel'><?php echo $this->_config[0]['vars']['ENTRY_POSTED']; ?>
</td>
		<td><?php echo ((is_array($_tmp=$this->_tpl_vars['aPlayers']['0']['entry_date_completed'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 16, "", true) : smarty_modifier_truncate($_tmp, 16, "", true)); ?>
</td>
	</tr>
<?php endif; ?>
</table>

<h3><?php echo $this->_config[0]['vars']['ENTRIES']; ?>
</h3>

<?php if ($this->_tpl_vars['bPlayerHasPlayedEntries'] == false): ?>
	<p>	
	<?php echo $this->_config[0]['vars']['THIS_PLAYER_HAS_NOT_PLAYED_ANY_ENTRIES']; ?>

	</p>
<?php else: ?>
	<table class='minor' width='500px'>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "recycled/entryRoundsHeadLines.tpl.php", 'smarty_include_vars' => array('title' => 'entryRounds')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	
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
		<?php if ($this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['division_name_short'] != $this->_tpl_vars['sTempDivision'] && $this->_tpl_vars['iIDEntry'] == null): ?>
			<tr>
				<td class='HL' colspan='5'><?php echo $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['division_name_short']; ?>
 <?php echo $this->_config[0]['vars']['DIVISION']; ?>
</td>
			</tr>
		<?php endif; ?>
	
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "recycled/entryRounds.tpl.php", 'smarty_include_vars' => array('title' => 'entryRounds')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	
		<?php $this->assign('sTempDivision', $this->_tpl_vars['aPlayers'][$this->_sections['section']['index']]['division_name_short']); ?>
		
	<?php endfor; endif; ?>
	
	</table>
<?php endif; ?>


<?php if ($this->_tpl_vars['bIncludeFromLoop'] != 'true'): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/footer.tpl.php", 'smarty_include_vars' => array('title' => 'footer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  else: ?>
	<?php if ($this->_tpl_vars['bIncludeFooter'] == 'true'): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/footer.tpl.php", 'smarty_include_vars' => array('title' => 'footer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif;  endif; ?>