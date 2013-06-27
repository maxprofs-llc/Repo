<?php /* Smarty version 2.6.16, created on 2008-03-30 18:15:46
         compiled from forms/form.teamData.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'eval', 'forms/form.teamData.tpl.php', 3, false),)), $this); ?>
<?php if ($this->_tpl_vars['bIsCompleted']): ?>
	<?php if ($this->_tpl_vars['iIDEdit'] == null): ?>
		<?php echo smarty_function_eval(array('var' => $this->_config[0]['vars']['REGISTER_SPLIT_REGISTERED']), $this);?>

	<?php else: ?>
		<?php echo $this->_config[0]['vars']['ADMIN_EDIT_TEAM_EDITED']; ?>

	<?php endif; ?>		
<?php endif; ?>

<?php if ($this->_tpl_vars['bHasErrors']): ?>
	<div class='highLight'>
		<b class='highLight'><?php echo $this->_config[0]['vars']['ERROR']; ?>
</b>
		<br />
		<?php if ($this->_tpl_vars['bReqFieldsMissing']): ?>
			- <?php echo $this->_config[0]['vars']['FIELDS_MISSING_FORM']; ?>
<br />
		<?php endif; ?>
		
		<?php if ($this->_tpl_vars['aCustomErrors']['samePlayer']): ?>
			- <?php echo $this->_config[0]['vars']['ERROR_SAME_PLAYER']; ?>
<br />
		<?php endif; ?>
	
		<?php if ($this->_tpl_vars['aCustomErrors']['notUniqueName']): ?>
			- <?php echo $this->_config[0]['vars']['ERROR_NOT_UNIQUE_NAME']; ?>
<br />
		<?php endif; ?>

		<?php if ($this->_tpl_vars['aCustomErrors']['player1InNonVoidedTeam']): ?>
			- <?php echo $this->_config[0]['vars']['ERROR_PLAYER_1_IN_NON_VOIDED_TEAM']; ?>
<br />
		<?php endif; ?>	

		<?php if ($this->_tpl_vars['aCustomErrors']['player2InNonVoidedTeam']): ?>
			- <?php echo $this->_config[0]['vars']['ERROR_PLAYER_2_IN_NON_VOIDED_TEAM']; ?>
<br />
		<?php endif; ?>			
		
		<!-- just for some, eventual invalid posted valued -->
		<?php if ($this->_tpl_vars['aCustomErrors']['invalidPlayer']): ?>
			- <?php echo $this->_config[0]['vars']['INVALID_PLAYER']; ?>
<br />
		<?php endif; ?>
	</div>		
<?php endif; ?>

<?php if ($this->_tpl_vars['bDisplayForm']): ?>
	<?php if ($this->_tpl_vars['bIsStart']): ?>
		<?php echo $this->_config[0]['vars']['FIELDS_MARKED_REQUIRED']; ?>

	<?php endif; ?>
<br />

	<?php echo $this->_tpl_vars['sFormStart']; ?>

	<table class='formTable'>
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['HIGH_SCORE_INITIALS']; ?>
 <?php echo $this->_config[0]['vars']['REQ_FIELD_SIGN']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['sInitials']['input']; ?>
 <?php echo $this->_tpl_vars['aInputs']['sInitials']['verValue']; ?>
</td>
		</tr>
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['TEAM_NAME']; ?>
 <?php echo $this->_config[0]['vars']['REQ_FIELD_SIGN']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['sTeamName']['input']; ?>
 <?php echo $this->_tpl_vars['aInputs']['sTeamName']['verValue']; ?>
</td>
		</tr>
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['PLAYER_1']; ?>
 <?php echo $this->_config[0]['vars']['REQ_FIELD_SIGN']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['iIDPlayer1']['input']; ?>
 <?php echo $this->_tpl_vars['aInputs']['iIDPlayer1']['verValue']; ?>
</td>
		</tr>
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['PLAYER_2']; ?>
 <?php echo $this->_config[0]['vars']['REQ_FIELD_SIGN']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['iIDPlayer2']['input']; ?>
 <?php echo $this->_tpl_vars['aInputs']['iIDPlayer2']['verValue']; ?>
</td>
		</tr>
		<tr>
			<td></td>
			<td><?php echo $this->_tpl_vars['sButtons']; ?>
</td>
		</tr>
				<?php if ($this->_tpl_vars['aInputs']['iIDEdit']['input'] != null): ?>
			<tr>
				<td></td>
				<td><?php echo $this->_tpl_vars['aInputs']['iIDEdit']['input']; ?>
</td>
			</tr>
		<?php endif; ?>		
	</table>
	<?php echo $this->_tpl_vars['sFormEnd']; ?>

<?php endif; ?>