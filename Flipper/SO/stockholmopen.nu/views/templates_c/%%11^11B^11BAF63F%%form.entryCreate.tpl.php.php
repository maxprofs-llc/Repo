<?php /* Smarty version 2.6.16, created on 2008-03-30 21:48:58
         compiled from formsAdmin/form.entryCreate.tpl.php */ ?>
<?php if ($this->_tpl_vars['bIsCompleted']): ?>
	<?php echo $this->_config[0]['vars']['ADMIN_ENTRY_CREATE_CREATED']; ?>

<?php endif; ?>

<?php if ($this->_tpl_vars['bHasWarnings']): ?>
	<div class='warning'>	
		<b class='highLight'><?php echo $this->_config[0]['vars']['WARNING']; ?>
</b>
		<br />
		<?php if ($this->_tpl_vars['aWarnings']['noOfEntriesAboveFree'] == true): ?>
			- <?php echo $this->_config[0]['vars']['WARNING_ABOVE_FREE_ENTRIES']; ?>
<br />	
		<?php endif; ?>
	
		<?php if ($this->_tpl_vars['aWarnings']['noOfEntriesAboveMax'] == true): ?>
			- <?php echo $this->_config[0]['vars']['WARNING_ABOVE_MAX_ENTRIES']; ?>
<br />
		<?php endif; ?>

		<?php if ($this->_tpl_vars['aWarnings']['shouldPay'] == true): ?>
			- <?php echo $this->_config[0]['vars']['WARNING_PAY']; ?>
<br />
		<?php endif; ?>		
		
	</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['bPaidFee'] == false && $this->_tpl_vars['bDisplayForm'] == true): ?>
	<br />
	<div class='warning'>	
		<b class='highLight'><?php echo $this->_config[0]['vars']['WARNING']; ?>
</b>
		<br />
		<?php echo $this->_config[0]['vars']['WARNING_HAS_NOT_PAID_FEE']; ?>
<br />
	</div>
<?php endif; ?>

<br />

<?php if ($this->_tpl_vars['bHasErrors']): ?>
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
		
		<?php if ($this->_tpl_vars['aCustomErrors']['invalidDivision']): ?>
			- <?php echo $this->_config[0]['vars']['INVALID_DIVISION']; ?>
<br />
		<?php endif; ?>		
		</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['bDisplayForm']): ?>
	<?php echo $this->_tpl_vars['sFormStart']; ?>

	<table class='formTable'>
		<tr>
			<td class='inputLabel' ><?php echo $this->_config[0]['vars']['PLAYER_TEAM']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aPlayer']['player_firstname']; ?>
 <?php echo $this->_tpl_vars['aPlayer']['player_lastname']; ?>
 (<?php echo $this->_tpl_vars['aPlayer']['player_initials']; ?>
)</td>
		</tr>

		<tr>
			<td class='inputLabel' ><?php echo $this->_config[0]['vars']['DIVISION']; ?>
</td>
			<td><?php echo $this->_tpl_vars['sDivision']; ?>
</td>
		</tr>
		
		<tr>
			<td class='inputLabel'><?php echo $this->_config[0]['vars']['ENTRIES']; ?>
</td>
			<td><?php echo $this->_tpl_vars['iNoOfEntries']; ?>
</td>
		</tr>

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
			<td valign='top' class='inputLabel'><?php echo $this->_config[0]['vars']['GAME']; ?>
 <?php echo $this->_sections['section']['iteration']; ?>
</td>	
			<?php $this->assign('sInputName', $this->_tpl_vars['aInputGames'][$this->_sections['section']['index']]); ?>
			<td><?php echo $this->_tpl_vars['aInputs'][$this->_tpl_vars['sInputName']]['input']; ?>
 <?php echo $this->_tpl_vars['aInputs'][$this->_tpl_vars['sInputName']]['verValue']; ?>
</td>
		</tr>	
		<?php endfor; endif; ?>

		<?php if ($this->_tpl_vars['bPaidFee'] == false): ?>
			<tr>
				<td valign='top' class='inputLabel'><?php echo $this->_config[0]['vars']['FEE_PAID']; ?>
</td>	
				<td><?php echo $this->_tpl_vars['aInputs']['sPayFee']['input']; ?>
 <?php echo $this->_tpl_vars['aInputs']['sPayFee']['verValue']; ?>
</td>
			</tr>	
		<?php endif; ?>

		<tr>
			<td></td>
			<td><?php echo $this->_tpl_vars['sButtons']; ?>
</td>
		</tr>
	</table>
	<?php echo $this->_tpl_vars['sFormEnd']; ?>

<?php endif; ?>