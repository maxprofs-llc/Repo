<?php /* Smarty version 2.6.16, created on 2008-06-05 19:18:51
         compiled from formsAdmin/form.entryCreateDivision.tpl.php */ ?>
<?php echo '
<script type="text/javascript">
	function focus()
	{
		//document.getElementById(\'iIDDivision\').focus();
		document.getElementById(\'sDivision\').focus();
	}

	womAdd(\'focus()\');
	womOn();
</script>
'; ?>


<?php if ($this->_tpl_vars['bDivisionError'] == false): ?>

	<?php if ($this->_tpl_vars['bHasErrors']): ?>
		<div class='highLight'>
			<b class='highLight'><?php echo $this->_config[0]['vars']['ERROR']; ?>
</b>
			<br />
			<?php if ($this->_tpl_vars['bReqFieldsMissing'] == true): ?>
				- <?php echo $this->_config[0]['vars']['FIELDS_MISSING_FORM']; ?>
<br />
			<?php endif; ?>
	
			<?php if ($this->_tpl_vars['aCustomErrors']['invalidDivisionID'] == true): ?>
				- <?php echo $this->_config[0]['vars']['INVALID_DIVISION']; ?>
<br />
			<?php endif; ?>	
		</div>
		<br />
	<?php endif; ?>
	
	
	<?php if ($this->_tpl_vars['bDisplayForm']): ?>
		<?php echo $this->_tpl_vars['sFormStart']; ?>

		<table class='formTable'>
			<tr>
				<td><?php echo $this->_tpl_vars['aPlayer']['player_firstname']; ?>
 <?php echo $this->_tpl_vars['aPlayer']['player_lastname']; ?>
</td>
				<td>(<?php echo $this->_tpl_vars['aPlayer']['player_initials']; ?>
)</td>
			</tr>
			<tr>
				<td width='80' class='inputLabel'><?php echo $this->_config[0]['vars']['DIVISION']; ?>
</td>
				<td>
				<?php echo $this->_tpl_vars['aInputs']['sDivision']['input']; ?>

				</td>
				<!-- <td><?php echo $this->_tpl_vars['aInputs']['iIDDivision']['input']; ?>
</td> -->
				
			</tr>
			<tr>
				<td></td>
				<td>
				<?php echo $this->_config[0]['vars']['VALID_DIVISIONS']; ?>
:
				<?php unset($this->_sections['section']);
$this->_sections['section']['name'] = 'section';
$this->_sections['section']['loop'] = is_array($_loop=$this->_tpl_vars['aDivisionsOutput']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					<?php echo $this->_tpl_vars['aDivisionsOutput'][$this->_sections['section']['index']]['division']; ?>

				<?php endfor; endif; ?>
				</td>
			</tr>
			<tr>
				<td></td>
				<td><?php echo $this->_tpl_vars['sButtons']; ?>
</td>
			</tr>
		</table>
				<?php echo $this->_tpl_vars['aInputs']['iIDPlayer']['input']; ?>

		<?php echo $this->_tpl_vars['sFormEnd']; ?>

	<?php endif;  else: ?>
<b class='highLight'><?php echo $this->_config[0]['vars']['ERROR']; ?>
</b> <?php echo $this->_config[0]['vars']['ERROR_DIVISIONS']; ?>
	
<?php endif; ?>