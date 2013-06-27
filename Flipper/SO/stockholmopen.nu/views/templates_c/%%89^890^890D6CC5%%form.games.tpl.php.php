<?php /* Smarty version 2.6.16, created on 2008-03-30 21:47:50
         compiled from formsAdmin/form.games.tpl.php */ ?>
<?php if ($this->_tpl_vars['bIsCompleted'] == true): ?>
	<b class='highLight'><?php echo $this->_config[0]['vars']['ADMIN_GAMES_ADDED']; ?>
</b>
	<br />
	<br />
	<a href='adminGames.php' id='addAnother'><?php echo $this->_config[0]['vars']['ADMIN_ADD_ANOTHER_GAME']; ?>
</a>
<?php endif; ?>

<?php if ($this->_tpl_vars['bIsEditCompleted'] == true): ?>
	<b class='highLight'><?php echo $this->_config[0]['vars']['ADMIN_GAMES_UPDATED']; ?>
</b>
<?php endif; ?>

<?php if ($this->_tpl_vars['bHasErrors'] == true): ?>
	<div class='highLight'>		
		<b class='highLight'><?php echo $this->_config[0]['vars']['ERROR']; ?>
</b>
		<br />
		<?php if ($this->_tpl_vars['bReqFieldsMissing'] == true): ?>
			- <?php echo $this->_config[0]['vars']['FIELDS_MISSING_FORM']; ?>
<br />
		<?php endif; ?>
		<?php if ($this->_tpl_vars['aCustomErrors']['invalidManufacturer'] == true): ?>
			- <?php echo $this->_config[0]['vars']['INVALID_MANUFACTURER']; ?>
<br />
		<?php endif; ?>
		
		<?php if ($this->_tpl_vars['aCustomErrors']['invalidYear'] == true): ?>
			- <?php echo $this->_config[0]['vars']['INVALID_YEAR']; ?>
<br />
		<?php endif; ?>

		<?php if ($this->_tpl_vars['aCustomErrors']['invalidLink'] == true): ?>
			- <?php echo $this->_config[0]['vars']['INVALID_LINK']; ?>
<br />
		<?php endif; ?>

		<?php if ($this->_tpl_vars['aCustomErrors']['invalidIPDB'] == true): ?>
			- <?php echo $this->_config[0]['vars']['INVALID_IPDB']; ?>
<br />
		<?php endif; ?>

		<?php if ($this->_tpl_vars['aCustomErrors']['gameExists'] == true): ?>
			- <?php echo $this->_config[0]['vars']['ERROR_GAME_EXISTS']; ?>
<br />
		<?php endif; ?>	
		 
		</div>
		<br />
<?php endif; ?>

<?php if ($this->_tpl_vars['bDisplayForm'] == true): ?>
	<?php echo $this->_config[0]['vars']['FIELDS_MARKED_REQUIRED']; ?>

	<br />
	
	<?php echo $this->_tpl_vars['sFormStart']; ?>

	<table class='formTable'>
		<tr>
			<td width='100' class='inputLabel'><?php echo $this->_config[0]['vars']['GAME_NAME']; ?>
 <?php echo $this->_config[0]['vars']['REQ_FIELD_SIGN']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['sGameName']['input']; ?>
</td>
		</tr>
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['IPDB_ID']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['iIDIPDB']['input']; ?>
 <span class='smallLight'> <?php echo $this->_config[0]['vars']['IPDB_ID_INFO']; ?>
</span></td>
		</tr>
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['RULESHEET_LINK']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['sLinkRulesheet']['input']; ?>
</td>
		</tr>
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['RELEASE_YEAR']; ?>
 <?php echo $this->_config[0]['vars']['REQ_FIELD_SIGN']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['iYearReleased']['input']; ?>
</td>
		</tr>
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['MANUFACTURER']; ?>
 <?php echo $this->_config[0]['vars']['REQ_FIELD_SIGN']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['iIDManufacturer']['input']; ?>
</td>
		</tr>
		<tr>
			<td></td>
			<td><?php echo $this->_tpl_vars['sButtons']; ?>
</td>
		</tr>
	</table>
	<?php echo $this->_tpl_vars['sFormEnd']; ?>

<?php endif; ?>	