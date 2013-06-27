<?php /* Smarty version 2.6.16, created on 2008-05-20 16:24:06
         compiled from volunteers.tpl.php */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/header.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h2><?php echo $this->_config[0]['vars']['VOLUNTEERS_HL']; ?>
</h2>
<p>
<?php echo $this->_config[0]['vars']['VOLUNTEERS_MAIN']; ?>

</p>

<?php if ($this->_tpl_vars['aTopVolunteers'] != null): ?>
	<h3><?php echo $this->_config[0]['vars']['TOP_VOLUNTEERS']; ?>
</h3>
	<table class='minor'>
		<tr>
			<td></td>
			<td><b><?php echo $this->_config[0]['vars']['NUMBER_OF_HOURS']; ?>
</b></td>
		</tr>
	<?php unset($this->_sections['section']);
$this->_sections['section']['name'] = 'section';
$this->_sections['section']['loop'] = is_array($_loop=$this->_tpl_vars['aTopVolunteers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<tr class='underLine'>
			<td><?php echo $this->_tpl_vars['aTopVolunteers'][$this->_sections['section']['index']]['vol_firstname']; ?>
 <?php echo $this->_tpl_vars['aTopVolunteers'][$this->_sections['section']['index']]['vol_lastname']; ?>
</td>
			<td><?php echo $this->_tpl_vars['aTopVolunteers'][$this->_sections['section']['index']]['vol_hours']; ?>
</td>
		</tr>
	<?php endfor; endif; ?>
	</table>
<?php endif; ?>
	
<table class='mainTable'>
<?php unset($this->_sections['section']);
$this->_sections['section']['name'] = 'section';
$this->_sections['section']['loop'] = is_array($_loop=$this->_tpl_vars['aSchedule']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	<tr class='underLine'>
		<td colspan='5' valign='top'><h3><?php echo $this->_tpl_vars['aSchedule'][$this->_sections['section']['index']]['vol_time_start']; ?>
 - <?php echo $this->_tpl_vars['aSchedule'][$this->_sections['section']['index']]['vol_time_end']; ?>
</h3></td>
	</tr>
	
	<?php $this->assign('bOutput', false); ?>
			
	<?php unset($this->_sections['vols']);
$this->_sections['vols']['name'] = 'vols';
$this->_sections['vols']['loop'] = is_array($_loop=$this->_tpl_vars['aSchedule'][$this->_sections['section']['index']]['volunteers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['vols']['show'] = true;
$this->_sections['vols']['max'] = $this->_sections['vols']['loop'];
$this->_sections['vols']['step'] = 1;
$this->_sections['vols']['start'] = $this->_sections['vols']['step'] > 0 ? 0 : $this->_sections['vols']['loop']-1;
if ($this->_sections['vols']['show']) {
    $this->_sections['vols']['total'] = $this->_sections['vols']['loop'];
    if ($this->_sections['vols']['total'] == 0)
        $this->_sections['vols']['show'] = false;
} else
    $this->_sections['vols']['total'] = 0;
if ($this->_sections['vols']['show']):

            for ($this->_sections['vols']['index'] = $this->_sections['vols']['start'], $this->_sections['vols']['iteration'] = 1;
                 $this->_sections['vols']['iteration'] <= $this->_sections['vols']['total'];
                 $this->_sections['vols']['index'] += $this->_sections['vols']['step'], $this->_sections['vols']['iteration']++):
$this->_sections['vols']['rownum'] = $this->_sections['vols']['iteration'];
$this->_sections['vols']['index_prev'] = $this->_sections['vols']['index'] - $this->_sections['vols']['step'];
$this->_sections['vols']['index_next'] = $this->_sections['vols']['index'] + $this->_sections['vols']['step'];
$this->_sections['vols']['first']      = ($this->_sections['vols']['iteration'] == 1);
$this->_sections['vols']['last']       = ($this->_sections['vols']['iteration'] == $this->_sections['vols']['total']);
?>
		<?php $this->assign('bOutput', true); ?>
		<tr class='underLine' <?php echo $this->_config[0]['vars']['MOUSE_OVER_DEFAULT']; ?>
>
			<td valign='top' width='120'>
				<?php echo $this->_tpl_vars['aSchedule'][$this->_sections['section']['index']]['volunteers'][$this->_sections['vols']['index']]['vol_firstname']; ?>
 <?php echo $this->_tpl_vars['aSchedule'][$this->_sections['section']['index']]['volunteers'][$this->_sections['vols']['index']]['vol_lastname']; ?>

			</td>
			
			<td valign='top'>
				<?php unset($this->_sections['duts']);
$this->_sections['duts']['name'] = 'duts';
$this->_sections['duts']['loop'] = is_array($_loop=$this->_tpl_vars['aSchedule'][$this->_sections['section']['index']]['volunteers'][$this->_sections['vols']['index']]['duties']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['duts']['show'] = true;
$this->_sections['duts']['max'] = $this->_sections['duts']['loop'];
$this->_sections['duts']['step'] = 1;
$this->_sections['duts']['start'] = $this->_sections['duts']['step'] > 0 ? 0 : $this->_sections['duts']['loop']-1;
if ($this->_sections['duts']['show']) {
    $this->_sections['duts']['total'] = $this->_sections['duts']['loop'];
    if ($this->_sections['duts']['total'] == 0)
        $this->_sections['duts']['show'] = false;
} else
    $this->_sections['duts']['total'] = 0;
if ($this->_sections['duts']['show']):

            for ($this->_sections['duts']['index'] = $this->_sections['duts']['start'], $this->_sections['duts']['iteration'] = 1;
                 $this->_sections['duts']['iteration'] <= $this->_sections['duts']['total'];
                 $this->_sections['duts']['index'] += $this->_sections['duts']['step'], $this->_sections['duts']['iteration']++):
$this->_sections['duts']['rownum'] = $this->_sections['duts']['iteration'];
$this->_sections['duts']['index_prev'] = $this->_sections['duts']['index'] - $this->_sections['duts']['step'];
$this->_sections['duts']['index_next'] = $this->_sections['duts']['index'] + $this->_sections['duts']['step'];
$this->_sections['duts']['first']      = ($this->_sections['duts']['iteration'] == 1);
$this->_sections['duts']['last']       = ($this->_sections['duts']['iteration'] == $this->_sections['duts']['total']);
?>
				-<?php echo $this->_tpl_vars['aSchedule'][$this->_sections['section']['index']]['volunteers'][$this->_sections['vols']['index']]['duties'][$this->_sections['duts']['index']]['vol_duty_name']; ?>

				<?php endfor; endif; ?>
			</td>
			
			<td valign='top'>
				
				<?php if ($this->_tpl_vars['g_bIsLoggedIn'] == 'true'): ?>
					<?php echo $this->_tpl_vars['aSchedule'][$this->_sections['section']['index']]['volunteers'][$this->_sections['vols']['index']]['vol_email']; ?>

				<?php endif; ?>
					
			</td valign='top'>
	
			<td valign='top'>
				<?php if ($this->_tpl_vars['g_bIsLoggedIn'] == 'true'): ?>
					<?php echo $this->_tpl_vars['aSchedule'][$this->_sections['section']['index']]['volunteers'][$this->_sections['vols']['index']]['vol_phone_mobile']; ?>

				<?php endif; ?>
			</td>		
			
		</tr>
	<?php endfor; endif; ?>
	
	<?php if ($this->_tpl_vars['bOutput'] == false): ?>
		<tr>
			<td colspan='5'><i><?php echo $this->_config[0]['vars']['NONE']; ?>
</i></td>
		</tr>
	<?php endif; ?>
	
<?php endfor; endif; ?>
</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "elements/footer.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>