<?php /* Smarty version 2.6.16, created on 2008-06-06 13:47:27
         compiled from formsAdmin/form.entranceFee.tpl.php */ ?>
<?php echo '
<script type="text/javascript">
	function updateFee(sInputName)
	{
		bChecked = document.getElementById(sInputName).checked;
		new Ajax.Updater(\'player\'+sInputName, \'ajax/updateFee.php?sInput=\'+sInputName+\'&bChecked=\'+bChecked);
	}
</script>
'; ?>


<?php if ($this->_tpl_vars['bIsCompleted']): ?>
	<div class='info'>
		<?php echo $this->_config[0]['vars']['ADMIN_TENTRANCE_FEES_UPDATED']; ?>

	</div>
	<br />
<?php endif; ?>

<b class='highLight'><i><?php echo $this->_config[0]['vars']['NO_NEED_TO_SUBMIT_FORM_CHECKBOXES']; ?>
</i></b>

<?php if ($this->_tpl_vars['bDisplayForm']): ?>
	<table class='formTable'>
	<tr>
		<td class='HL'><?php echo $this->_config[0]['vars']['NAME']; ?>
</td>
		<td class='HL'><?php echo $this->_config[0]['vars']['DIVISION_SHORT']; ?>
</td>
		<td class='HL'><?php echo $this->_config[0]['vars']['PAID']; ?>
</td>
		<td class='HL' width='400'></td>
	</tr>
	<?php unset($this->_sections['section']);
$this->_sections['section']['name'] = 'section';
$this->_sections['section']['loop'] = is_array($_loop=$this->_tpl_vars['aPlayersAndDivisions']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	
	<?php if ($this->_tpl_vars['aPlayersAndDivisions'][$this->_sections['section']['index']]['division_name_short'] != $this->_tpl_vars['sPrevDivision']): ?>
		<tr class='lineDark'>
			<td colspan='4'><b><?php echo $this->_tpl_vars['aPlayersAndDivisions'][$this->_sections['section']['index']]['division_name_short']; ?>
 <?php echo $this->_config[0]['vars']['DIVISION']; ?>
</b></td>
		<tr>
	<?php endif; ?>
	
	<?php if ((1 & $this->_sections['section']['iteration'])): ?>
		<tr <?php echo $this->_config[0]['vars']['MOUSE_OVER_DEFAULT']; ?>
>
	<?php else: ?>
		<tr class='lineDark' <?php echo $this->_config[0]['vars']['MOUSE_OVER_DARK']; ?>
>
	<?php endif; ?>
		<?php $this->assign('sInput1', $this->_tpl_vars['aPlayersAndDivisions'][$this->_sections['section']['index']]['id_player']); ?>
		<?php $this->assign('sInput2', $this->_tpl_vars['aPlayersAndDivisions'][$this->_sections['section']['index']]['division_name_short']); ?>
		<?php $this->assign('sInputName', ($this->_tpl_vars['sInput1']).($this->_tpl_vars['sInput2'])); ?>

		<td><?php echo $this->_tpl_vars['aInputs']['sPlayers'][$this->_tpl_vars['sInputName']]['output']; ?>
</td>
		<td><?php echo $this->_tpl_vars['aPlayersAndDivisions'][$this->_sections['section']['index']]['division_name_short']; ?>
 <?php echo $this->_config[0]['vars']['DIVISION']; ?>
</td>
		<td><?php echo $this->_tpl_vars['aInputs']['sPlayers'][$this->_tpl_vars['sInputName']]['input']; ?>
</td>
		<td>
						<div id="player<?php echo $this->_tpl_vars['sInputName']; ?>
">
			</div>
		</td>
	</tr>
		<?php $this->assign('sPrevDivision', $this->_tpl_vars['aPlayersAndDivisions'][$this->_sections['section']['index']]['division_name_short']); ?>
	<?php endfor; endif; ?>
	</table>
<?php endif; ?>