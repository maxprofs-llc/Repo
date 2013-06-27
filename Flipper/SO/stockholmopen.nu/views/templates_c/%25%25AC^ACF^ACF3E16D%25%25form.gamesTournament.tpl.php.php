<?php /* Smarty version 2.6.16, created on 2008-03-30 05:20:22
         compiled from formsAdmin/form.gamesTournament.tpl.php */ ?>
<?php echo '
<script type="text/javascript">
	function updateTournamentGame(sInputName)
	{
		bChecked = document.getElementById(sInputName).checked;
		new Ajax.Updater(\'game\'+sInputName, \'ajax/updateTournamentGame.php?iIDGameAndDivision=\'+sInputName+\'&bChecked=\'+bChecked);
	}
</script>
'; ?>


<?php if ($this->_tpl_vars['bIsCompleted']): ?>
	<div class='info'>
		<?php echo $this->_config[0]['vars']['ADMIN_TOURN_GAMES_UPDATED']; ?>

	</div>
	<br />
<?php endif; ?>
<i><?php echo $this->_config[0]['vars']['NO_NEED_TO_SUBMIT_FORM_CHECKBOXES']; ?>
</i>
<?php if ($this->_tpl_vars['bDisplayForm']): ?>
	<table class='formTable'>
	<tr>
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
			<td class='HL' colspan='3' align='right'><?php echo $this->_tpl_vars['aDivisions'][$this->_sections['section']['index']]['division_name']; ?>
</td>
		<?php endfor; endif; ?>
	</tr>
		
	<?php $this->assign('bNewRow', true); ?>
	
	<?php unset($this->_sections['section']);
$this->_sections['section']['name'] = 'section';
$this->_sections['section']['loop'] = is_array($_loop=$this->_tpl_vars['aCheckBoxNames']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	
		<?php $this->assign('sInputName', $this->_tpl_vars['aCheckBoxNames'][$this->_sections['section']['index']]); ?>
	
		<?php if ($this->_tpl_vars['bNewRow'] == true): ?>
			<tr class='lineDark' <?php echo $this->_config[0]['vars']['MOUSE_OVER_DARK']; ?>
>
			<?php $this->assign('bNewRow', false); ?>
		<?php endif; ?>
	
		<td align='right'><?php echo $this->_tpl_vars['aInputs']['sGames'][$this->_tpl_vars['sInputName']]['output']; ?>
</td>
		<td><?php echo $this->_tpl_vars['aInputs']['sGames'][$this->_tpl_vars['sInputName']]['input']; ?>
</td>
		<td>
						<div id="game<?php echo $this->_tpl_vars['sInputName']; ?>
">
			</div>
		</td>
		
		<?php if ($this->_sections['section']['iteration'] % $this->_tpl_vars['iNumberOfDivisions'] == 0): ?>
			<?php $this->assign('bNewRow', true); ?>
			</tr>
		<?php endif; ?>
	
	<?php endfor; endif; ?>
	</table>
<?php endif; ?>