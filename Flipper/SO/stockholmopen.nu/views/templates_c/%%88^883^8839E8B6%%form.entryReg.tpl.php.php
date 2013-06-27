<?php /* Smarty version 2.6.16, created on 2013-06-11 22:50:40
         compiled from formsAdmin/form.entryReg.tpl.php */ ?>
<?php if ($this->_tpl_vars['bIsCompleted']): ?>
	<?php echo $this->_config[0]['vars']['ADMIN_ENTRY_REG_REGGED']; ?>

<?php else: ?>
	<?php if ($this->_tpl_vars['bEdit']): ?>
		<br />
		<br />
		<?php echo $this->_config[0]['vars']['ADMIN_ENTRY_REG_EDIT_NOTICE']; ?>
	
		<br />
		<br />
	<?php endif;  endif; ?>

<?php if ($this->_tpl_vars['bHasWarnings'] == true): ?>
	<br />
	<br />
	<div class='warning'>	
		<b class='highLight'><?php echo $this->_config[0]['vars']['WARNING']; ?>
</b>
		<br />
		<?php if ($this->_tpl_vars['aWarnings']['entryWillBeVoided'] == true): ?>
			- <?php echo $this->_config[0]['vars']['WARNING_ENTRY_WILL_BE_VOIDED']; ?>
 
			<br />	
		<?php endif; ?>

		<?php if ($this->_tpl_vars['aWarnings']['scoreNotEndingWithZero'] == true): ?>
			- <?php echo $this->_config[0]['vars']['WARNING_SCORES_NOT_ENDING_WITH_ZERO']; ?>
 
			<br />	
		<?php endif; ?>
	</div>
	<br />
<?php endif; ?>

<?php if ($this->_tpl_vars['bHasErrors'] == true): ?>
	<div class='highLight'>
		<b class='highLight'><?php echo $this->_config[0]['vars']['ERROR']; ?>
</b>
		<br />
		<?php if ($this->_tpl_vars['bReqFieldsMissing']): ?>
			- <?php echo $this->_config[0]['vars']['FIELDS_MISSING_FORM']; ?>
<br />
		<?php endif; ?>
		
		<?php if ($this->_tpl_vars['aCustomErrors']['multipleGame']): ?>
			- <?php echo $this->_config[0]['vars']['ERROR_NOT_UNIQUE_GAMES']; ?>
<br />
		<?php endif; ?>

		<?php if ($this->_tpl_vars['aCustomErrors']['invalidGame']): ?>
			- <?php echo $this->_config[0]['vars']['INVALID_GAME']; ?>
<br />
		<?php endif; ?>

		<?php if ($this->_tpl_vars['aCustomErrors']['invalidPlayer']): ?>
			- <?php echo $this->_config[0]['vars']['INVALID_PLAYER_TEAM_ID']; ?>
<br />
		<?php endif; ?>

		<?php if ($this->_tpl_vars['aCustomErrors']['invalidEntryID']): ?>
			- <?php echo $this->_config[0]['vars']['INVALID_ENTRY_ID']; ?>
<br />
		<?php endif; ?>		

		<?php if ($this->_tpl_vars['aCustomErrors']['invalidPlayerID']): ?>
			- <?php echo $this->_config[0]['vars']['ERROR_PLAYER_TEAM_ENTRY_MISMATCH']; ?>
<br />
		<?php endif; ?>		
		
		<?php if ($this->_tpl_vars['aCustomErrors']['invalidScore']): ?>
			- <?php echo $this->_config[0]['vars']['INVALID_SCORE']; ?>
<br />
		<?php endif; ?>		
		</div>
<br />
<?php endif; ?>

<?php if ($this->_tpl_vars['bDisplayForm'] == true): ?>
	<?php echo $this->_tpl_vars['sFormStart']; ?>

	<table class='formTable'>
		<tr>
			<td width='80' class='inputLabel' ><?php echo $this->_config[0]['vars']['PLAYER_TEAM']; ?>
</td>
			<td valign='top'><?php echo $this->_tpl_vars['aPlayer']['player_firstname']; ?>
 <?php echo $this->_tpl_vars['aPlayer']['player_lastname']; ?>
 (<?php echo $this->_tpl_vars['aPlayer']['player_initials']; ?>
) <a href='wap/playerPrinter.php?playerId=<?php echo $this->_tpl_vars['aPlayer']['id_player']; ?>
&autoPrint=true' target='_new'><img src='images/icons/qr.png' class='iconLink' alt='<?php echo $this->_config[0]['vars']['ADMIN_PLAYER_PRINT']; ?>
' title='<?php echo $this->_config[0]['vars']['ADMIN_PLAYER_PRINT']; ?>
' /></a></td>
		</tr>
		<tr>
			<td width='80' class='inputLabel' ><?php echo $this->_config[0]['vars']['ENTRY_ID']; ?>
</td>
			<td valign='top'><?php echo $this->_tpl_vars['iIDEntry']; ?>
 <a href='wap/entryPrinter.php?entryId=<?php echo $this->_tpl_vars['iIDEntry']; ?>
&autoPrint=true' target='_new'><img src='images/icons/qr.png' class='iconLink' alt='<?php echo $this->_config[0]['vars']['ADMIN_ENTRY_PRINT']; ?>
' title='<?php echo $this->_config[0]['vars']['ADMIN_ENTRY_PRINT']; ?>
' /></a></td>
		</tr>		
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['ENTRIES']; ?>
</td>
			<td><?php echo $this->_tpl_vars['iNoOfEntries']; ?>
</td>
		</tr>
			<?php if ($this->_tpl_vars['bIsStart'] == true): ?>
								<tr>
					<td colspan='2'><hr /></td>
				</tr>
			<?php endif; ?>
			<tr>
				<td class='inputLabel'>
				<?php if ($this->_tpl_vars['bIsStart'] == true): ?>
										<?php echo $this->_config[0]['vars']['VOID_ENTRY']; ?>

				<?php endif; ?>
				</td>
				<td><?php echo $this->_tpl_vars['aInputs']['bVoid']['input']; ?>
</td>
			</tr>
			
		<tr>
			<td colspan='2'><hr /></td>
		</tr>						
		
				<?php $this->assign('iNumber', '1'); ?>
		<?php unset($this->_sections['section']);
$this->_sections['section']['name'] = 'section';
$this->_sections['section']['loop'] = is_array($_loop=$this->_tpl_vars['aInputGames']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<td valign='top' class='inputLabel'>
			<?php if ($this->_sections['section']['iteration'] % 2 != 0): ?>
				<?php echo $this->_config[0]['vars']['GAME']; ?>
 
			<?php else: ?>
				<?php echo $this->_config[0]['vars']['SCORE']; ?>

			<?php endif; ?>
			<?php echo $this->_tpl_vars['iNumber']; ?>
 | 
			</td>	
			<?php $this->assign('sInputName', $this->_tpl_vars['aInputGames'][$this->_sections['section']['index']]); ?>
			<td>
			<?php echo $this->_tpl_vars['aInputs'][$this->_tpl_vars['sInputName']]['input']; ?>
 
				
				<?php if ($this->_tpl_vars['aInputs'][$this->_tpl_vars['sInputName']]['hasWarning'] == 'true'): ?>
					<b class='highLight'><?php echo $this->_tpl_vars['aInputs'][$this->_tpl_vars['sInputName']]['verValue']; ?>
</b>
				<?php else: ?>
					<?php echo $this->_tpl_vars['aInputs'][$this->_tpl_vars['sInputName']]['verValue']; ?>

				<?php endif; ?>			
			</td>
		</tr>	
			<?php if ($this->_sections['section']['iteration'] % 2 == 0): ?>
				<tr>
					<td colspan='2'><hr /></td>
				</tr>
				<?php $this->assign('iNumber', ($this->_tpl_vars['iNumber']+1)); ?>
			<?php endif; ?>
		<?php endfor; endif; ?>
		<tr>
			<td></td>
			<td><?php echo $this->_tpl_vars['sButtons']; ?>
</td>
		</tr>
	</table>
	<?php echo $this->_tpl_vars['sFormEnd']; ?>

<?php endif; ?>