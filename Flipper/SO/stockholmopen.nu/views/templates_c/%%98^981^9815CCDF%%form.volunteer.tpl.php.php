<?php /* Smarty version 2.6.16, created on 2008-05-20 15:48:04
         compiled from forms/form.volunteer.tpl.php */ ?>
<?php if ($this->_tpl_vars['bIsCompleted']): ?>
	<p>
	<?php echo $this->_config[0]['vars']['VOLUNTEER_POSTED']; ?>

	</p>
<?php endif; ?>

<?php if ($this->_tpl_vars['bDisplayForm']): ?>
	<?php if ($this->_tpl_vars['bHasErrors']): ?>
		<div class='highLight'>
			<b class='highLight'><?php echo $this->_config[0]['vars']['ERROR']; ?>
</b>
			<br />
			<?php if ($this->_tpl_vars['bReqFieldsMissing']): ?>
				- <?php echo $this->_config[0]['vars']['FIELDS_MISSING_FORM']; ?>
<br />
			<?php endif; ?>
			<?php if ($this->_tpl_vars['aCustomErrors']['invalidEmail']): ?>
				- <?php echo $this->_config[0]['vars']['INVALID_EMAIL']; ?>
<br />
			<?php endif; ?>
			<?php if ($this->_tpl_vars['aCustomErrors']['noDuties']): ?>
				- <?php echo $this->_config[0]['vars']['NO_DUTIES']; ?>
<br />
			<?php endif; ?>
			<?php if ($this->_tpl_vars['aCustomErrors']['noTimes']): ?>
				- <?php echo $this->_config[0]['vars']['NO_TIMES']; ?>
<br />
			<?php endif; ?>						
		</div>		
	<?php endif; ?>

	<?php echo $this->_config[0]['vars']['FIELDS_MARKED_REQUIRED']; ?>

	<br />
	<?php echo $this->_tpl_vars['sFormStart']; ?>

	<table class='formTable'>
	<tr>
		<td class='inputLabel'><?php echo $this->_config[0]['vars']['FIRSTNAME']; ?>
 <?php echo $this->_config[0]['vars']['REQ_FIELD_SIGN']; ?>
</td>
		<td colspan='2'><?php echo $this->_tpl_vars['aInputs']['sFirstName']['input']; ?>
</td>
	</tr>

	<tr>
		<td class='inputLabel'><?php echo $this->_config[0]['vars']['LASTNAME']; ?>
 <?php echo $this->_config[0]['vars']['REQ_FIELD_SIGN']; ?>
</td>
		<td colspan='2'><?php echo $this->_tpl_vars['aInputs']['sLastName']['input']; ?>
</td>
	</tr>

	<tr>
		<td class='inputLabel'><?php echo $this->_config[0]['vars']['EMAIL']; ?>
 <?php echo $this->_config[0]['vars']['REQ_FIELD_SIGN']; ?>
</td>
		<td colspan='2'><?php echo $this->_tpl_vars['aInputs']['sEmail']['input']; ?>
</td>
	</tr>	

	<tr>
		<td class='inputLabel'><?php echo $this->_config[0]['vars']['MOBILE_PHONE']; ?>
 <?php echo $this->_config[0]['vars']['REQ_FIELD_SIGN']; ?>
</td>
		<td colspan='2'><?php echo $this->_tpl_vars['aInputs']['sPhoneMobile']['input']; ?>
</td>
	</tr>	

	<tr>
		<td class='inputLabel'><?php echo $this->_config[0]['vars']['VOL_TOTAL_HOURS']; ?>
 <?php echo $this->_config[0]['vars']['REQ_FIELD_SIGN']; ?>
</td>
		<td colspan='2'><?php echo $this->_tpl_vars['aInputs']['iTotalTime']['input']; ?>
</td>
	</tr>

	<tr>
		<td colspan='3'><i><?php echo $this->_config[0]['vars']['VOL_TOTAL_HOURS_INFO']; ?>
</i></td>
	</tr>	

	</table>
	
	<table>
	<tr>
		<td colspan='3'><h3><?php echo $this->_config[0]['vars']['DUTIES']; ?>
</h3><?php echo $this->_config[0]['vars']['VOLUNTEER_DUTIES']; ?>
<br /><br /></td>
	</tr>
	
	<?php unset($this->_sections['section']);
$this->_sections['section']['name'] = 'section';
$this->_sections['section']['loop'] = is_array($_loop=$this->_tpl_vars['aCheckBoxNamesDuties']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<?php $this->assign('sInputName', $this->_tpl_vars['aCheckBoxNamesDuties'][$this->_sections['section']['index']]); ?>
		<tr class='underLine' <?php echo $this->_config[0]['vars']['MOUSE_OVER_LIGHT']; ?>
>
			<td align='right'><?php echo $this->_tpl_vars['aInputs']['sDuties'][$this->_tpl_vars['sInputName']]['input']; ?>
</td>
			<td colspan='2'><?php echo $this->_tpl_vars['aInputs']['sDuties'][$this->_tpl_vars['sInputName']]['output']; ?>
</td>
		</tr>
	<?php endfor; endif; ?>

	<tr>
		<td colspan='3'><h3><?php echo $this->_config[0]['vars']['TIMES']; ?>
</h3><?php echo $this->_config[0]['vars']['VOLUNTEER_TIMES']; ?>
<br /><br /></td>
	</tr>

	<tr>
		<td colspan='2'></td>
		<td align='right'><b><?php echo $this->_config[0]['vars']['NO_OF_REGISTERED_VOLUNTEERS']; ?>
</b></td>
	</tr>

	<?php unset($this->_sections['section']);
$this->_sections['section']['name'] = 'section';
$this->_sections['section']['loop'] = is_array($_loop=$this->_tpl_vars['aCheckBoxNamesTimes']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<?php $this->assign('sInputName', $this->_tpl_vars['aCheckBoxNamesTimes'][$this->_sections['section']['index']]); ?>
		<tr class='underLine' <?php echo $this->_config[0]['vars']['MOUSE_OVER_LIGHT']; ?>
>
			<td align='right'><?php echo $this->_tpl_vars['aInputs']['sTimes'][$this->_tpl_vars['sInputName']]['input']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aInputs']['sTimes'][$this->_tpl_vars['sInputName']]['output']; ?>
</td>
			<td align='right'>
			<?php if ($this->_tpl_vars['aNumberForTime'][$this->_tpl_vars['sInputName']] > 0): ?>
				<?php echo $this->_tpl_vars['aNumberForTime'][$this->_tpl_vars['sInputName']]; ?>

			<?php else: ?>
				<i><?php echo $this->_config[0]['vars']['NONE']; ?>
</i>	
			<?php endif; ?>
			</td>
		</tr>
	<?php endfor; endif; ?>	
	
	<tr>
		<td></td>
		<td><br /><?php echo $this->_tpl_vars['sButtons']; ?>
</td>
	</tr>
			
	</table>
	<?php echo $this->_tpl_vars['sFormEnd']; ?>

<?php endif; ?>