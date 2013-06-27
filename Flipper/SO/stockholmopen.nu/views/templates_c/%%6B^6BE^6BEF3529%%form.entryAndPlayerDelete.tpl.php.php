<?php /* Smarty version 2.6.16, created on 2008-04-03 16:04:55
         compiled from formsAdmin/form.entryAndPlayerDelete.tpl.php */ ?>
	<?php echo $this->_tpl_vars['sFormStart']; ?>

	<?php echo $this->_tpl_vars['sButtons']; ?>

	<?php echo $this->_tpl_vars['sFormEnd']; ?>

	<br />
	<table>
	<tr>
		<td>
		
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
	</tr>
	
	<tr>
		<td><?php echo $this->_config[0]['vars']['INITIALS']; ?>
</td>
		<td><?php echo $this->_tpl_vars['aPlayers']['0']['player_initials']; ?>
</td>
	</tr>
	
	<?php if ($this->_tpl_vars['aPlayers']['0']['player_is_split_team'] == 1): ?>
		<tr>
			<td><?php echo $this->_config[0]['vars']['PLAYERS']; ?>
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
		<td><?php echo $this->_config[0]['vars']['CITY']; ?>
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
		<td><?php echo $this->_config[0]['vars']['COUNTRY']; ?>
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
	</table>